<?php

$connessioneDatabase = '';

if($_SERVER['SERVER_NAME'] == "localhost" && (strpos($_SERVER['REQUEST_URI'], 'mmitillo') === false)) {

    $connessioneDatabase = mysqli_connect("localhost", "root", "") or die(header('Location: ../HTML/erroreDatabase.html')); //da aggiungere pagina HTML
    mysqli_select_db($connessioneDatabase, "tecweb"); //nome del database, cambiare se cambiamo nome
    mysqli_set_charset($connessioneDatabase, "utf8");

} elseif($_SERVER['SERVER_NAME'] == "localhost" && (strpos($_SERVER['REQUEST_URI'], 'mmitillo') !== false)) {

    $connessioneDatabase = mysqli_connect("localhost", "mmitillo", "Mi5ithei4les7Sie") or die(header('Location: ../HTML/erroreDatabase.html')); //da aggiungere pagina HTML
    mysqli_select_db($connessioneDatabase, "mmitillo"); //nome del database, cambiare se cambiamo nome
    mysqli_set_charset($connessioneDatabase, "utf8");

} else {
    //caso in cui non ho più come server localhost ma avrò tecweb.studenti.unipd.it
    $connessioneDatabase = mysqli_connect("localhost", "mmitillo", "Mi5ithei4les7Sie") or die(header('Location: ../HTML/erroreDatabase.html')); //da aggiungere pagina HTML
    mysqli_select_db($connessioneDatabase, "mmitillo"); //nome del database, cambiare se cambiamo nome
    mysqli_set_charset($connessioneDatabase, "utf8");

}

?>
