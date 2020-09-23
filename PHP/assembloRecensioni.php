<?php

function assembloRecensioni() {

    $paginaRecensioni = file_get_contents('../HTML/leMieRecensioni.html');
    $username = $_SESSION["username"];
    $tuttiCommenti = '';
    $tabindex = 20;

    if(isset($_GET["rece"]) && $_GET["rece"] == 'modificatasi') $paginaRecensioni = str_replace('$FRASECOMMENTI$', '<p class="avviso_php">Recensione modificata correttamente.</p>', $paginaRecensioni);
    elseif(isset($_GET["rece"]) && $_GET["rece"] == 'eliminatasi') $paginaRecensioni = str_replace('$FRASECOMMENTI$', '<p class="avviso_php">Recensione eliminata correttamente.</p>', $paginaRecensioni);
    else $paginaRecensioni = str_replace('$FRASECOMMENTI$', '', $paginaRecensioni);

    include('connessioneDatabase.php');

    $query_commenti = "SELECT * FROM commento INNER JOIN libro ON commento.libro = libro.isbn WHERE utente = '$username' ORDER BY commento.ID DESC"; //GROUP BY libro
    $boolCommenti = false;
    $autori = '';

    if($richiestaCommenti = mysqli_query($connessioneDatabase, $query_commenti)) {

        while($risultatiCommenti = mysqli_fetch_assoc($richiestaCommenti)) {

            $singoloCommento = file_get_contents('../HTML/commentiMieRecensioni.html');
            $boolCommenti = true;

            $isbn = $risultatiCommenti["isbn"];
            $query_autori = "SELECT * FROM scrittura WHERE libro = '$isbn'";

            if($controlloAutori = mysqli_query($connessioneDatabase, $query_autori)) {

                $count = 0;

                while($risultatiAutori = mysqli_fetch_assoc($controlloAutori)) {

                    if($count == 0) $autori = $risultatiAutori["nome_autore"];
                    else $autori = $autori . ', ' . $risultatiAutori["nome_autore"];

                    $count = $count + 1;

                }

                mysqli_free_result($controlloAutori);

            } else {

                mysqli_close($connessioneDatabase);
                header('Location: ../HTML/erroreDatabase.html');
                exit();

            }

            $singoloCommento = str_replace('$TITOLO$', $risultatiCommenti["titolo"], $singoloCommento);
            $singoloCommento = str_replace('$AUTORI$', $autori, $singoloCommento);
            $singoloCommento = str_replace('$GENERE$', $risultatiCommenti["genere"], $singoloCommento);
            $singoloCommento = str_replace('$DATAORA$', $risultatiCommenti["data_ora"], $singoloCommento);
            $testo = $risultatiCommenti["testo"];
            $testo = sostituisciSpan($testo);
            $singoloCommento = str_replace('$COMMENTO$', $testo, $singoloCommento);
            $singoloCommento = str_replace('$VIDCOMMENTO1$', $risultatiCommenti["ID"], $singoloCommento);
            $singoloCommento = str_replace('$VIDCOMMENTO2$', $risultatiCommenti["ID"], $singoloCommento);
            $singoloCommento = str_replace('$TAB1$', $tabindex, $singoloCommento);
            $tabindex = $tabindex + 1;
            $singoloCommento = str_replace('$TAB2$', $tabindex, $singoloCommento);
            $tabindex = $tabindex + 1;
            $singoloCommento = str_replace('$TAB3$', $tabindex, $singoloCommento);
            $tabindex = $tabindex + 1;

            $tuttiCommenti = $tuttiCommenti . $singoloCommento;

        }

        mysqli_free_result($richiestaCommenti);

    } else {

        mysqli_close($connessioneDatabase);
        header('Location: ../HTML/erroreDatabase.html');
        exit();

    }

    mysqli_close($connessioneDatabase);

    $pag = '';

    if($boolCommenti) {

        $pag = '';
        $tuttiCommenti = '<ul id="tutte_recensioni">' . $tuttiCommenti . '</ul>';

    } else {

        $pag = '<p>Non hai scritto nessuna recensione. Corri a scriverne una!</p>';
        $tuttiCommenti = '';

    }

    $paginaRecensioni = str_replace('$FRASECOMMENTI$', $pag, $paginaRecensioni);
    $paginaRecensioni = str_replace('$FORMSINGOLOCOMMENTO$', $tuttiCommenti, $paginaRecensioni);

    return $paginaRecensioni;

}

?>
