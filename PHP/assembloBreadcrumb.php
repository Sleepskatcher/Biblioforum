<?php

function assembloBreadcrumb($bool) {

    $breadcrumb = '';

    if($bool) {

        if(empty($_GET)) {

            $breadcrumb = '<p class="breadcrumb">Sei qui: <span xml:lang="en">Home</span></p>'; //controllare

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && count($_GET) == 1) {

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" tabindex="11" xml:lang="en">Home</a> - Libri</p>';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && count($_GET) == 4) {

            $genere = $_GET["genere"];
            if($_GET["genere"] == 'horror' || $_GET["genere"] == 'fantasy') $genere = '<span xml:lang="en">' . $genere . '</span>';

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - <a href="indgen.php?pagina=libri" title="libri" tabindex="12">Libri</a> - ' . $genere . '</p>';

        } elseif(isset($_GET["isbn"]) && !isset($_GET["pagina2"]) && !isset($_GET["ricerca"])) {

            $genere = $_GET["genere"];
            $linkGenere = '';
            $isbn = $_GET["isbn"];
            $inizio = $_GET["inizio"];
            $fine = $_GET["fine"];

            if($_GET["genere"] == 'horror' || $_GET["genere"] == 'fantasy') $linkGenere = '<a href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '" title="genere" xml:lang="en" tabindex="13">' . $genere . '</a>';
            else $linkGenere = '<a href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '" title="genere" tabindex="13">' . $genere . '</a>';

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - <a href="indgen.php?pagina=libri" title="libri" tabindex="12">Libri</a> - ' . $linkGenere . ' - ' . $isbn . '</p>';

        } elseif(isset($_GET["ricerca"]) && count($_GET) == 3) {

            $ricerca = $_GET["ricerca"];
            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - ' . $ricerca . '</p>';

        } elseif(isset($_GET["ricerca"]) && isset($_GET["isbn"]) && !isset($_GET["pagina2"])) {

            $ricerca = $_GET["ricerca"];
            $isbn = $_GET["isbn"];
            $inizio = $_GET["inizio"];
            $fine = $_GET["fine"];
            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - <a href="indgen.php?ricerca=' . $ricerca . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '" title="ricerca" tabindex="12">' . $ricerca . '</a> - ' . $isbn . '</p>';

        } elseif(isset($_GET["ricerca"]) && isset($_GET["isbn"]) && isset($_GET["pagina2"])) {

            $ricerca = $_GET["ricerca"];
            $isbn = $_GET["isbn"];
            $inizio = $_GET["inizio"];
            $fine = $_GET["fine"];
            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - <a href="indgen.php?ricerca=' . $ricerca . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '" title="ricerca" tabindex="12">' . $ricerca . '</a> - <a href="indgen.php?ricerca=' . $ricerca . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '&amp;isbn=' . $isbn . '" title="isbn" tabindex="13">' . $isbn . '</a> - Modifica</p>';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'informazioni') {

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - Informazioni</p>';

            //utente loggato
        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'recensioni') {

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - Mie recensioni</p>';

            //admin
        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'inserisci') {

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - Inserisci</p>';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'statistiche') {

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - Statistiche sito</p>';

        } elseif(isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica') {

            $genere = $_GET["genere"];
            $linkGenere = '';
            $isbn = $_GET["isbn"];
            $inizio = $_GET["inizio"];
            $fine = $_GET["fine"];

            if($_GET["genere"] == 'horror' || $_GET["genere"] == 'fantasy') $linkGenere = '<a href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '" title="genere" xml:lang="en" tabindex="13">' . $genere . '</a>';
            else $linkGenere = '<a href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '" title="genere" tabindex="13">' . $genere . '</a>';

            $breadcrumb = '<p class="breadcrumb">Sei qui: <a href="indgen.php" title="home" xml:lang="en" tabindex="11">Home</a> - <a href="indgen.php?pagina=libri" title="libri" tabindex="12">Libri</a> - ' . $linkGenere . ' - <a href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizio . '&amp;fine=' . $fine . '&amp;isbn=' . $isbn . '" title="isbn" tabindex="14">' . $isbn . '</a> - Modifica</p>';

        } else {

            //non dovrei arrivarci, messo per sicurezza
            $breadcrumb = '';

        }

    } else {

        //qui breadcrumb va lasciata VUOTA
        $breadcrumb = '';

    }

    return $breadcrumb;

}

?>
