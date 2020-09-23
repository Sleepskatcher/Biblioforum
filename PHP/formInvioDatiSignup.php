<?php

session_start();
include('controlUrlPageout.php');

$location = '';
$bool = false;

if(controlUrlPageout()) {

    if(empty($_POST["email"]) || (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {

        $location = 'Location: formSignup.php?error=email';

    } elseif(empty($_POST["ripetiPassword"]) || (!empty($_POST["ripetiPassword"]) && $_POST["ripetiPassword"] == "")) {

        $location = 'Location: formSignup.php?error=rippass';

    } elseif($_POST["password"] != $_POST["ripetiPassword"]) {

        $location = 'Location: formSignup.php?error=diffpass';

    } elseif(!empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["ripetiPassword"])) {

        include('connessioneDatabase.php');

        $email = $_POST["email"];
        $username = mysqli_real_escape_string($connessioneDatabase, (strip_tags($_POST["username"])));
        $password = mysqli_real_escape_string($connessioneDatabase, (strip_tags($_POST["password"])));
        $ripetiPassword = strip_tags($_POST["ripetiPassword"]);

        $query_signup = "SELECT * FROM utente WHERE username = '$username' OR email = '$email'";

        if($controlloSignup = mysqli_query($connessioneDatabase, $query_signup)) {

            $bool = true;
            $risultatoSignup = mysqli_fetch_assoc($controlloSignup);

            if($risultatoSignup != NULL) {

                if($risultatoSignup["username"] == $username) $location = 'Location: formSignup.php?error=username';
                else $location = 'Location: formSignup.php?error=email';

            } else {

                $query_inserisci = "INSERT INTO utente(username, email, password) VALUES ('$username', '$email', '$password')";

                if($bool = mysqli_query($connessioneDatabase, $query_inserisci)) $location;
                else $location = 'Location: ../HTML/erroreDatabase.html';

                $_SESSION["username"] = $username;

                if(isset($_SESSION["username"]) && $bool) {

                    $location = 'Location: indgen.php';

                } else {

                    $location;

                }

            }

            mysqli_free_result($controlloSignup);

        } else {

            $location = 'Location: ../HTML/erroreDatabase.html';

        }

        mysqli_close($connessioneDatabase);

        if($bool) $location;
        else $location = 'Location: ../HTML/erroreDatabase.html';

    } else {

        $location = 'Location: formSignup.php?error=general';

    }

} else {

    $location = 'Location: indgen.php';

}

header($location);
exit();

?>
