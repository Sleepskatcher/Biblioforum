<?php

session_start();

include('controlUrl.php');
include('funzioneSostituisciEn.php');

$location = '';
$bool = false;
$url = '';

if(controlUrl()) {

    if(!empty($_POST["isbn"]) && !empty($_POST["titolo"]) && !empty($_POST["trama"]) && !empty($_POST["casaEditrice"]) && !empty($_POST["genere"]) && !empty($_POST["autori"])) {

        include('connessioneDatabase.php');

        $titolo = strip_tags($_POST["titolo"]);
        $trama = strip_tags($_POST["trama"]);
        $casaEditrice = strip_tags($_POST["casaEditrice"]);

        $titolo = sostituisciEn($titolo);

        $trama = sostituisciEn($trama);

        $casaEditrice = sostituisciEn($casaEditrice);

        $vecchioIsbn = $_POST["vecchioIsbn"];
        $vecchioGenere = $_POST["vecchioGenere"];
        $arry_vecchioIsbn = '';
        $array_nuovoIsbn = '';
        $inizio = $_POST["inizio"];
        $fine = $_POST["fine"];
        $isbn = $_POST["isbn"];
        $titolo = mysqli_real_escape_string($connessioneDatabase, $titolo);
        $trama = mysqli_real_escape_string($connessioneDatabase, $trama);
        $casaEditrice = mysqli_real_escape_string($connessioneDatabase, $casaEditrice);
        $genere = $_POST["genere"];
        $autori = $_POST["autori"];

        $url = 'indgen.php?pagina=libri&genere=' . $genere . '&inizio=' . $inizio . '&fine=' . $fine . '&isbn=' . $isbn . '&pagina2=modifica';

        $query_modifica = "UPDATE libro SET isbn = '$isbn', titolo = '$titolo', trama = '$trama', casa_editrice = '$casaEditrice', genere = '$genere' WHERE isbn = '$vecchioIsbn'";

        if($bool = mysqli_query($connessioneDatabase, $query_modifica)) $location;
        else {

            $bool = false;
            $url = $url . '&modificato=doppio';
            $location = 'Location:' . $url;
        }

        if($genere != $vecchioGenere) {

            $arry_vecchioIsbn = array('isbn=' . $vecchioIsbn, 'genere=' . $vecchioGenere, 'inizio=' . $inizio, 'fine=' . $fine);

            $count = 0;

            $query_gen = "SELECT * FROM libro WHERE genere = '$genere' ORDER BY titolo";
            if($bool && ($nuovo_genere = mysqli_query($connessioneDatabase, $query_gen))) {

                $boolTrovataRiga = false;
                $bool = true;
                while(($risultatoNuovo = mysqli_fetch_assoc($bool)) && !$boolTrovataRiga) {

                    if($risultatoNuovo["isbn"] == $isbn) $boolTrovataRiga = true;
                    else $count = $count + 1;

                }

                mysqli_free_result($nuovo_genere);

            } else {

                $bool = false;
                $location = 'Location: ../HTML/erroreDatabase.html';

            }

            $pagina = floor($count/($_POST["fine"] - $_POST["inizio"]));
            $nuovoInizio = $pagina * ($_POST["fine"] - $_POST["inizio"]);
            $nuovaFine = ($pagina + 1) * ($_POST["fine"] - $_POST["inizio"]);

            $array_nuovoIsbn = array('isbn=' . $isbn, 'genere=' . $genere, 'inizio=' . $nuovoInizio, 'fine=' . $nuovaFine);

        } else {

            $arry_vecchioIsbn = array('isbn=' . $vecchioIsbn, 'genere=' . $vecchioGenere);

            $array_nuovoIsbn = array('isbn=' . $isbn, 'genere=' . $genere);

        }

        $url = str_replace($arry_vecchioIsbn, $array_nuovoIsbn, $url);

        $array_autori = explode(',', $autori);

        $query_elimina_autori = "DELETE from scrittura WHERE libro = '$isbn'";
        if($bool && ($bool = mysqli_query($connessioneDatabase, $query_elimina_autori))) $location;
        else $location = 'Location: ../HTML/erroreDatabase.html';

        array_walk($array_autori, function(&$valore) {

            $valore = trim($valore);

        });

        for($i = 0; $i < count($array_autori) && $bool; $i++) {

            $autore = $array_autori[$i];
            $autore = strip_tags($autore);

            $autore = sostituisciEn($autore);

            $autore = mysqli_real_escape_string($connessioneDatabase, $autore);
            $query_autori = "INSERT INTO scrittura(libro, nome_autore) VALUES ('$isbn', '$autore')";
            //$query_autori = "INSERT INTO scrittura(libro, nome_autore) VALUES ('$isbn', '$autore') ON DUPLICATE KEY UPDATE nome_autore = '$autore'";
            if($bool = mysqli_query($connessioneDatabase, $query_autori)) $location;
            else $location = 'Location: ../HTML/erroreDatabase.html';

        }

        mysqli_close($connessioneDatabase);

        if($bool) {

            $url = $url . '&modificato=si';
            $location = 'Location:' . $url;

        } else {

            $location = 'Location: ../HTML/erroreDatabase.html';

        }

    } else {

        $url = $url . '&modificato=no';
        $location = 'Location:' . $url;

    }

} else {

    if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') $location = 'Location: indgen.php';
    else $location = 'Location: logOut.php';

}

header($location);
exit();

?>
