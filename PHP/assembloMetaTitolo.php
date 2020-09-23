<?php

function assembloMeta($bool) {

    $metaTitolo = '';

    if($bool) {

        if(empty($_GET)) {

            $metaTitolo = 'Biblioforum';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && count($_GET) == 1) {

            $metaTitolo = 'Categorie libri';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && count($_GET) == 4) {

            $genere = $_GET["genere"];
            $metaTitolo = "$genere";

        } elseif(isset($_GET["isbn"]) && !isset($_GET["pagina2"])) {

            $metaTitolo = 'Libro';

        } elseif(isset($_GET["ricerca"]) && count($_GET) == 3) {

            $metaTitolo = 'Risultati ricerca';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'informazioni') {

            $metaTitolo = 'Informazioni';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'recensioni') {

            $metaTitolo = 'Le mie recensioni';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'statistiche') {

            $metaTitolo = 'Statistiche sito';

        } elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'inserisci') {

            $metaTitolo = 'Inserisci libro';

        } elseif(isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica') {

            $metaTitolo = 'Modifica libro';

        } else {

            $metaTitolo = 'Biblioforum';

        }

    } else {

        $metaTitolo = 'Pagina 404';

    }

    return $metaTitolo;

}

?>
