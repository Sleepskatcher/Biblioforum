<?php

include('assembloCatalogo.php');
include('assembloLibro.php');
include('assembloRicerca.php');
include('assembloRecensioni.php');
include('assembloInserisciLibro.php');
include('assembloStatistiche.php');
include('assembloModificaLibro.php');
include('funzioneSostituisciSpan.php');

function assembloBody($bool) {

    $body = '';

    if($bool) {

        //pagine uguali per tutti
        if(empty($_GET)) $body = file_get_contents('../HTML/benvenuto.html');

        elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && count($_GET) == 1) $body = file_get_contents('../HTML/libri.html');

        elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && count($_GET) == 4) $body = assembloCatalogo();

        elseif(isset($_GET["isbn"]) && !isset($_GET["pagina2"])) $body = assembloLibro();

        //ricerca
        elseif(isset($_GET["ricerca"]) && count($_GET) == 3) $body = assembloRicerca();

        elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'informazioni') $body = file_get_contents('../HTML/info.html');

        //utente loggato
        elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'recensioni') $body = assembloRecensioni();

        //admin
        elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'inserisci') $body = assembloInserisciLibro();

        elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'statistiche') $body = assembloStatistiche();

        elseif(isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica') $body = assembloModificaLibro();

        else $body = '';

    } else {

        $body = file_get_contents('../HTML/404.html');

    }

    return $body;

}

?>
