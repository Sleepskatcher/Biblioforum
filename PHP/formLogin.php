<?php

include('controlUrlPageout.php');

$formLogin = '';

if(controlUrlPageout()) {

    $formLogin = file_get_contents('../HTML/login.html');

    if(isset($_GET["error"]) && $_GET["error"] == 'no') $formLogin = str_replace('$ERRORELOGINUSERNAME-PASSWORD$', '<p class="avviso_php">Credenziali errate</p>', $formLogin);

    else $formLogin = str_replace('$ERRORELOGINUSERNAME-PASSWORD$', '', $formLogin);

} else {

    $formLogin = file_get_contents('../HTML/outPage404.html');

}

echo $formLogin;

?>
