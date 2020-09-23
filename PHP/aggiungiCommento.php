<?php

session_start();

include('controlUrl.php');
include('funzioneSostituisciEn.php');

$location = '';
$bool = false;
$url = '';

if(controlUrl()) {

    if(!empty($_POST["commento"])) {

        include('connessioneDatabase.php');

        $utente = $_SESSION["username"];
        $isbn = $_POST["isbn"];
        $commento = strip_tags($_POST["commento"]);

        $commento = sostituisciEn($commento);

        $commento = mysqli_real_escape_string($connessioneDatabase, $commento);
        $data = date("Y-m-d H:i:s");

        $query_aggiungiCommento = "INSERT INTO commento(testo, data_ora, utente, libro) VALUES ('$commento', '$data', '$utente', '$isbn')";

        if($bool = mysqli_query($connessioneDatabase, $query_aggiungiCommento)) $location;
        else $location = 'Location: ../HTML/erroreDatabase.html';
        mysqli_close($connessioneDatabase);

    } else {

        $bool = true;

    }

    $url = 'indgen.php?pagina=libri&genere=' . $_POST["genere"] . '&inizio=' . $_POST["inizio"] . '&fine=' . $_POST["fine"] . '&isbn=' . $_POST["isbn"];

    if($bool) $location = 'Location: ' . $url;
    else $location = 'Location: ../HTML/erroreDatabase.html';

} else {

    if(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') $location = 'Location: indgen.php';
    else $location = 'Location: logOut.php';

}

header($location);
exit();

?>
