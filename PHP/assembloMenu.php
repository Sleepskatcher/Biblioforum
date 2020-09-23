<?php

function assembloMenu($bool) {

    $menu = '';

    if($bool) {
        //menù della pagina principale
        if(empty($_GET)) {

            if(!isset($_SESSION["username"])) {

                $menu = '<li class="hamburger" id="non_cliccabile" xml:lang="en">Home</li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                $menu = '<li class="hamburger" id="non_cliccabile" xml:lang="en">Home</li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=recensioni" title="le mie recensioni" tabindex="10">Le mie recensioni</a></li>';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $menu = '<li class="hamburger" id="non_cliccabile" xml:lang="en">Home</li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="modifica libri e rimuovi commenti" tabindex="8">Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=inserisci" title="inserisci libri" tabindex="9">Inserisci Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=statistiche" title="statistiche sito" tabindex="10">Statistiche sito</a></li>';

            } else {

                //qui non dovrei finirci mai, messo per sicurezza
                $menu = '';

            }

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && count($_GET) == 1) {

            if(!isset($_SESSION["username"])) {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger" id="non_cliccabile">Libri</li>
                <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger" id="non_cliccabile">Libri</li>
                <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=recensioni" title="le mie recensioni" tabindex="10">Le mie recensioni</a></li>';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger" id="non_cliccabile">Libri</li>
                <li class="hamburger"><a href="indgen.php?pagina=inserisci" title="inserisci libri" tabindex="9">Inserisci Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=statistiche" title="statistiche sito" tabindex="10">Statistiche sito</a></li>';

            } else {

                //qui non dovrei finirci mai, messo per sicurezza
                $menu = '';

            }
            //quando ho scelto un genere del catalogo sarà tutto cliccabile il menù per ogni utente del sito
        } elseif(isset($_GET["inizio"]) && isset($_GET["fine"])) {

            if(!isset($_SESSION["username"])) {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=recensioni" title="le mie recensioni" tabindex="10">Le mie recensioni</a></li>';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="modifica libri e rimuovi commenti" tabindex="8">Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=inserisci" title="inserisci libri" tabindex="9">Inserisci Libri</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=statistiche" title="statistiche sito" tabindex="10">Statistiche sito</a></li>';

            } else {

                //qui non dovrei finirci mai, messo per sicurezza
                $menu = '';

            }
            //ho fatto ricerca ho trovato libro e schiacciato sul link del libro per aprirlo e sono nella pagina del libro
        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'informazioni') {

            if(!isset($_SESSION["username"])) {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
                <li class="hamburger" id="non_cliccabile">Informazioni</li>';

            } else {

                $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
                <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
                <li class="hamburger" id="non_cliccabile">Informazioni</li>
                <li class="hamburger"><a href="indgen.php?pagina=recensioni" title="le mie recensioni" tabindex="10">Le mie recensioni</a></li>';

            }
            //parte utente LOGGATO, NO ADMIN
        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'recensioni') {

            $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>
            <li class="hamburger" id="non_cliccabile">Le mie recensioni</li>';

            //qui inizia parte admin
            //admin vuole inserire un libro
        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'inserisci') {

            $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=libri" title="modifica libri e rimuovi commenti" tabindex="8">Libri</a></li>
            <li class="hamburger" id="non_cliccabile">Inserisci Libri</li>
            <li class="hamburger"><a href="indgen.php?pagina=statistiche" title="statistiche sito" tabindex="10">Statistiche sito</a></li>';

            //pagina statistiche sito
        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'statistiche') {

            $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=libri" title="modifica libri e rimuovi commenti" tabindex="8">Libri</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=inserisci" title="inserisci libri" tabindex="9">Inserisci Libri</a></li>
            <li class="hamburger" id="non_cliccabile">Statistiche sito</li>';

        } else {

            //qui non dovrei finirci mai, messo per sicurezza
            $menu = '';

        }

    } else {

        //menù tutto cliccabile pagina di errore
        if(!isset($_SESSION["username"])) {

            $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>';

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=libri" title="libri" tabindex="8">Libri</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=informazioni" title="informazioni" tabindex="9">Informazioni</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=recensioni" title="le mie recensioni" tabindex="10">Le mie recensioni</a></li>';

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $menu = '<li class="hamburger"><a href="indgen.php" title="home" xml:lang="en" tabindex="7">Home</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=libri" title="modifica libri e rimuovi commenti" tabindex="8">Libri</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=inserisci" title="inserisci libri" tabindex="9">Inserisci Libri</a></li>
            <li class="hamburger"><a href="indgen.php?pagina=statistiche" title="statistiche sito" tabindex="10">Statistiche sito</a></li>';

        } else {

            //qui non dovrei finirci mai, messo per sicurezza
            $menu = '';

        }

    }

    return $menu;

}

?>
