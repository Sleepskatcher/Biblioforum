<?php

session_start();

include('controlUrl.php');
include('funzioneSostituisciEn.php');

$location = '';
$bool = false;

if(controlUrl()) {

    if(!empty($_POST["isbn"]) && is_numeric($_POST["isbn"]) && !empty($_POST["titolo"]) && !empty($_POST["trama"]) && !empty($_POST["casaEditrice"]) && !empty($_POST["genere"]) && !empty($_POST["autori"])) {

        include('connessioneDatabase.php');

        $titolo = strip_tags($_POST["titolo"]);
        $trama = strip_tags($_POST["trama"]);
        $casaEditrice = strip_tags($_POST["casaEditrice"]);

        $titolo = sostituisciEn($titolo);

        $trama = sostituisciEn($trama);

        $casaEditrice = sostituisciEn($casaEditrice);

        $isbn = $_POST["isbn"];
        $titolo = mysqli_real_escape_string($connessioneDatabase, $titolo);
        $trama = mysqli_real_escape_string($connessioneDatabase, $trama);
        $casaEditrice = mysqli_real_escape_string($connessioneDatabase, $casaEditrice);
        $genere = $_POST["genere"];
        $autori = $_POST["autori"];

        $query_esisteDoppio = "SELECT * FROM libro WHERE isbn = '$isbn'"; //query con ISBN e basta

        if($controlloEsisteDoppio = mysqli_query($connessioneDatabase, $query_esisteDoppio)) {

            $bool = true;
            $risultatoEsisteDoppio = mysqli_fetch_assoc($controlloEsisteDoppio);

            if($risultatoEsisteDoppio != NULL) {

                $location = 'Location: indgen.php?pagina=inserisci&inserito=doppio';

            } else {

                $query_insLibro = "INSERT INTO libro(isbn, titolo, trama, casa_editrice, genere) VALUES('$isbn', '$titolo', '$trama', '$casaEditrice', '$genere')";
                if($bool = mysqli_query($connessioneDatabase, $query_insLibro)) $location;
                else $location = 'Location: ../HTML/erroreDatabase.html';

                $array_autori = explode(',', $autori);

                array_walk($array_autori, function(&$valore) {

                    $valore = trim($valore);

                });

                for($i = 0; $i < count($array_autori) && $bool; $i++) {

                    $autore = $array_autori[$i];
                    $autore = strip_tags($autore);

                    $autore = sostituisciEn($autore);

                    $autore = mysqli_real_escape_string($connessioneDatabase, $autore);
                    $query_insAutore = "INSERT INTO scrittura(libro, nome_autore) VALUES('$isbn', '$autore')";
                    if($bool = mysqli_query($connessioneDatabase, $query_insAutore)) $location;
                    else $location = 'Location: ../HTML/erroreDatabase.html';

                }

                if($bool) $location = 'Location: indgen.php?pagina=inserisci&inserito=si';
                else $location = 'Location: ../HTML/erroreDatabase.html';

            }

            mysqli_free_result($controlloEsisteDoppio);

        } else {

            $bool = false;
            $location = 'Location: ../HTML/erroreDatabase.html';

        }

        mysqli_close($connessioneDatabase);

        if($bool) $location;
        else $location = 'Location: ../HTML/erroreDatabase.html';

    } else {

        $location = 'Location: indgen.php?pagina=inserisci&inserito=no';

    }

} else {

    if(isset($_SESSION["username"]) && $_SESSION["username"]) $location = 'Location: indgen.php?pagina=inserisci';
    else $location = 'Location: logOut.php';

}

header($location);
exit();

?>
