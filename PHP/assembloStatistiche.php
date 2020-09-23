<?php

function assembloStatistiche() {

    include('connessioneDatabase.php');

    $statistiche = file_get_contents('../HTML/statistiche.html');
    $bool = false;

    $query_libri = "SELECT COUNT(isbn) AS totLibri FROM libro";
    $query_utenti = "SELECT COUNT(username) AS totUtenti FROM utente";
    $query_commenti = "SELECT COUNT(ID) AS totCommenti FROM commento";

    $totUtenti = '';
    $totCommenti = '';

    if($controlloLibri = mysqli_query($connessioneDatabase, $query_libri)) {

        $risultatoLibri = mysqli_fetch_assoc($controlloLibri);
        $statistiche = str_replace('$STATLIBRITOTALI$', $risultatoLibri["totLibri"], $statistiche);
        $bool = true;
        mysqli_free_result($controlloLibri);

    } else {

        $bool = false;

    }

    if($bool && ($controlloUtenti = mysqli_query($connessioneDatabase, $query_utenti))) {

        $risultatoUtenti = mysqli_fetch_assoc($controlloUtenti);
        $statistiche = str_replace('$STATUTENTITOTALI$', $risultatoUtenti["totUtenti"], $statistiche);
        $totUtenti = $risultatoUtenti["totUtenti"];
        $bool = true;
        mysqli_free_result($controlloUtenti);

    } else {

        $bool = false;

    }

    if($bool && ($controlloCommenti = mysqli_query($connessioneDatabase, $query_commenti))) {

        $risultatoCommenti = mysqli_fetch_assoc($controlloCommenti);
        $statistiche = str_replace('$STATCOMMENTITOTALI$', $risultatoCommenti["totCommenti"], $statistiche);
        $totCommenti = $risultatoCommenti["totCommenti"];
        $bool = true;
        mysqli_free_result($controlloCommenti);

    } else {

        $bool = false;

    }

    if($bool) {

        $media = $totCommenti/$totUtenti;
        $media = number_format($media, 1, '.', '');
        $statistiche = str_replace('$STATCOMMENTIMEDITOTALI$', $media, $statistiche);
        $bool = true;

    } else {

        $bool = false;

    }

    mysqli_close($connessioneDatabase);

    if($bool) {

        $statistiche;

    } else {

        header('Location: ../HTML/erroreDatabase.html');
        exit();

    }

    return $statistiche;

}

?>
