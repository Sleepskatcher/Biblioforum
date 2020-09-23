<?php

session_start();
include('controlUrlPageout.php');

$location = '';

if(controlUrlPageout()) {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {

        include('connessioneDatabase.php');
        $username = mysqli_real_escape_string($connessioneDatabase, (strip_tags($_POST["username"])));
        $password = mysqli_real_escape_string($connessioneDatabase, (strip_tags($_POST["password"])));

        $query_login = "SELECT * FROM utente WHERE username = '$username' AND password = '$password'";

        if($controlloLogin = mysqli_query($connessioneDatabase, $query_login)) {

            $risultatoLogin = mysqli_fetch_assoc($controlloLogin);

            if($risultatoLogin != NULL) {

                $_SESSION["username"] = $username;

                if(isset($_SESSION["username"])) {

                    $location = 'Location: indgen.php';

                } else {

                    //qui non faccio nulla

                }

            } else {

                $location = 'Location: formLogin.php?error=no';

            }

            mysqli_free_result($controlloLogin);

        } else {

            $location = 'Location: ../HTML/erroreDatabase.html';

        }

        mysqli_close($connessioneDatabase);

    } else {

        $location = 'Location: formLogin.php?error=no';

    }

} else {

    $location = 'Location: indgen.php';

}

header($location);
exit();

?>
