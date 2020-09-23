<?php

function assembloInserisciLibro() {

    $formInserimentoLibro = file_get_contents('../HTML/inserimentoLibro.html');

    if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

        if(isset($_GET["inserito"]) && $_GET["inserito"] == 'si') {

            $formInserimentoLibro = str_replace('$ERROREFORMINSERIMENTOLIBRO$', '<p class="avviso_php">Inserimento del libro avvenuto correttamente!</p>', $formInserimentoLibro);

        } elseif(isset($_GET["inserito"]) && $_GET["inserito"] == 'no') {

            $formInserimentoLibro = str_replace('$ERROREFORMINSERIMENTOLIBRO$', '<p class="avviso_php">Inserimento del libro non avvenuto, ricontrolla i campi da inserire!</p>', $formInserimentoLibro);

        } elseif(isset($_GET["inserito"]) && $_GET["inserito"] == 'doppio') {

            $formInserimentoLibro = str_replace('$ERROREFORMINSERIMENTOLIBRO$', '<p class="avviso_php">Inserimento del libro non avvenuto, esiste già questo libro!</p>', $formInserimentoLibro);

        } else {

            $formInserimentoLibro = str_replace('$ERROREFORMINSERIMENTOLIBRO$', '', $formInserimentoLibro);

        }

    } else {

        $formInserimentoLibro = file_get_contents('../HTML/404.html');

    }

    return $formInserimentoLibro;

}

?>
