<?php

function assembloHeader() {

    $header = file_get_contents('../HTML/header.html');

    if(empty($_GET)) {

        $header = str_replace('$LOGO$', '<h1>Biblioforum</h1>', $header);

    } else {

        $header = str_replace('$LOGO$', '<a href="indgen.php" title="Link alla home" tabindex="1">Biblioforum</a>', $header);

    }

    if(isset($_SESSION["username"])) {

        $username = $_SESSION["username"];
        //inserire link per logout e profilo utente
        $header = str_replace('$LOGIN$', '<a href="profilo.php" title="profilo" tabindex="3">' . $username . '</a>', $header);
        $header = str_replace('$SIGNUP$', '<a href="logOut.php" title="sloggarsi dal sito" tabindex="4">Esci</a>', $header);

    } else {

        //inserire link per login e signup
        $header = str_replace('$LOGIN$', '<a href="formLogin.php" title="accedi" tabindex="3">Accedi</a>', $header);
        $header = str_replace('$SIGNUP$', '<a href="formSignup.php" title="registazione" tabindex="4">Registrati</a>', $header);

    }

    return $header;

}

?>
