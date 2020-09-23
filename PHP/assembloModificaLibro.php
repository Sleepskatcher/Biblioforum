<?php

function assembloModificaLibro() {

    $formModifica = file_get_contents('../HTML/modificaLibro.html');

    if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

        if(isset($_GET["modificato"]) && $_GET["modificato"] == 'si') {

            $formModifica = str_replace('$ERROREFORMMODIFICALIBRO$', '<p class="avviso_php">Modifica effettuata correttamente!</p>', $formModifica);

        } elseif(isset($_GET["modificato"]) && $_GET["modificato"] == 'no') {

            $formModifica = str_replace('$ERROREFORMMODIFICALIBRO$', '<p class="avviso_php">Modifica non effettuata, ricontrolla i campi da inserire!</p>', $formModifica);

        } elseif(isset($_GET["modificato"]) && $_GET["modificato"] == 'doppio') {

            $formModifica = str_replace('$ERROREFORMMODIFICALIBRO$', '<p class="avviso_php">Inserimento del libro non avvenuto, esiste già questo libro!</p>', $formModifica);

        } else {

            $formModifica = str_replace('$ERROREFORMMODIFICALIBRO$', '', $formModifica);

        }

        include('connessioneDatabase.php');

        $isbn = $_GET["isbn"];

        $query_formModifica = "SELECT * FROM libro WHERE isbn = '$isbn'";

        if($controlloModifica = mysqli_query($connessioneDatabase, $query_formModifica)) {

            $risultatoFormModifica = mysqli_fetch_assoc($controlloModifica);

            if($risultatoFormModifica != NULL) {

                $isbn = $risultatoFormModifica["isbn"];
                $titolo = $risultatoFormModifica["titolo"];
                $trama = $risultatoFormModifica["trama"];
                $casaEditrice = $risultatoFormModifica["casa_editrice"];
                $genere = $risultatoFormModifica["genere"];

                $titolo = sostituisciSpan($titolo);

                $trama = sostituisciSpan($trama);

                $casaEditrice = sostituisciSpan($casaEditrice);

                $formModifica = str_replace('$VISBN$', $isbn, $formModifica);
                $formModifica = str_replace('$VECCHIOISBN$', $isbn, $formModifica);
                $formModifica = str_replace('$VTITOLO$', $titolo, $formModifica);
                $formModifica = str_replace('$VTRAMA$', $trama, $formModifica);
                $formModifica = str_replace('$VCASAEDITRICE$', $casaEditrice, $formModifica);

                if($risultatoFormModifica["genere"] == 'horror') $formModifica = str_replace('$SELECTHORROR$', 'selected="selected"', $formModifica);
                else $formModifica = str_replace('$SELECTHORROR$', '', $formModifica);

                if($risultatoFormModifica["genere"] == 'fantasy') $formModifica = str_replace('$SELECTFANTASY$', 'selected="selected"', $formModifica);
                else $formModifica = str_replace('$SELECTFANTASY$', '', $formModifica);

                if($risultatoFormModifica["genere"] == 'rosa') $formModifica = str_replace('$SELECTROSA$', 'selected="selected"', $formModifica);
                else $formModifica = str_replace('$SELECTROSA$', '', $formModifica);

                if($risultatoFormModifica["genere"] == 'gialli') $formModifica = str_replace('$SELECTGIALLI$', 'selected="selected"', $formModifica);
                else $formModifica = str_replace('$SELECTGIALLI$', '', $formModifica);

                if($risultatoFormModifica["genere"] == 'classici') $formModifica = str_replace('$SELECTCLASSICI$', 'selected="selected"', $formModifica);
                else $formModifica = str_replace('$SELECTCLASSICI$', '', $formModifica);

                $formModifica = str_replace('$VECCHIOGENERE$', $risultatoFormModifica["genere"], $formModifica);

            } else {

                //location con errore
                mysqli_close($connessioneDatabase);
                header('Location: ../HTML/erroreDatabase.html');
                exit();

            }

            mysqli_free_result($controlloModifica);

        } else {

            mysqli_close($connessioneDatabase);
            header('Location: ../HTML/erroreDatabase.html');
            exit();

        }

        $query_autori = "SELECT * FROM scrittura WHERE libro = '$isbn'";
        $autori = '';

        if($controlloAutori = mysqli_query($connessioneDatabase, $query_autori)) {

            $count = 0;

            while($risultatiAutori = mysqli_fetch_assoc($controlloAutori)) {

                if($count == 0) {

                    $autore = $risultatiAutori["nome_autore"];

                    $autore = sostituisciSpan($autore);

                    $autori = $autore;


                } else {

                    $autore = $risultatiAutori["nome_autore"];

                    $autore = sostituisciSpan($autore);

                    $autori = $autori . ', ' . $autore;

                }

                $count = $count + 1;

            }

            $formModifica = str_replace('$VAUTORI$', $autori, $formModifica);

            mysqli_free_result($controlloAutori);

        } else {

            mysqli_close($connessioneDatabase);
            header('Location: ../HTML/erroreDatabase.html');
            exit();

        }

        $formModifica = str_replace('$INIZIO$', $_GET["inizio"], $formModifica);
        $formModifica = str_replace('$FINE$', $_GET["fine"], $formModifica);

        mysqli_close($connessioneDatabase);

    } else {

        $formModifica = file_get_contents('../HTML/404.html');

    }

    return $formModifica;

}

?>
