<?php

function assembloLibro() {

    $visualizzaLibro = file_get_contents('../HTML/visualizzaLibro.html');
    $isbn = $_GET["isbn"];
    $autori = '';
    $tuttiCommenti = '';

    include('connessioneDatabase.php');

    $query_libro = "SELECT * FROM libro WHERE isbn = '$isbn'";

    if($richiestaLibro = mysqli_query($connessioneDatabase, $query_libro)) {

        $risultatoLibro = mysqli_fetch_assoc($richiestaLibro);

        if($risultatoLibro != NULL) {

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

            $visualizzaLibro = str_replace('$TITOLO$', $risultatoLibro["titolo"], $visualizzaLibro);
            $visualizzaLibro = str_replace('$COPERTINA$', '<img src="../pictures/' . $isbn . '.jpg" alt="Immagine copertina del libro"/>', $visualizzaLibro);
            $visualizzaLibro = str_replace('$AUTORI$', $autori, $visualizzaLibro);
            $visualizzaLibro = str_replace('$GENERE$', $risultatoLibro["genere"], $visualizzaLibro);
            $visualizzaLibro = str_replace('$CASAEDITRICE$', $risultatoLibro["casa_editrice"], $visualizzaLibro);
            $visualizzaLibro = str_replace('$ISBN$', $risultatoLibro["isbn"], $visualizzaLibro);
            $visualizzaLibro = str_replace('$TRAMA$', $risultatoLibro["trama"], $visualizzaLibro);

        } else {

            mysqli_close($connessioneDatabase);
            header('Location: ../HTML/erroreDatabase.html');
            exit();

        }

        mysqli_free_result($richiestaLibro);

    } else {

        mysqli_close($connessioneDatabase);
        header('Location: ../HTML/erroreDatabase.html');
        exit();

    }

    //parte form
    if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

        $indirizzo = '';

        if(isset($_GET["rece"]) && $_GET["rece"] == 'eliminatasi') $visualizzaLibro = str_replace('$COMMENTOELIMINATO$', '<p class="avviso_php">Recensione eliminata correttamente.</p>', $visualizzaLibro);
        else $visualizzaLibro = str_replace('$COMMENTOELIMINATO$', '', $visualizzaLibro);

        if(isset($_GET["pagina"])) $indirizzo = 'indgen.php?pagina=' . $_GET["pagina"] . '&amp;genere=' . $_GET["genere"] . '&amp;inizio=' . $_GET["inizio"] . '&amp;fine=' . $_GET["fine"] . '&amp;isbn=' . $_GET["isbn"] . '&amp;pagina2=modifica';
        else $indirizzo = 'indgen.php?ricerca=' . $_GET["ricerca"] . '&amp;inizio=' . $_GET["inizio"] . '&amp;fine=' . $_GET["fine"] . '&amp;isbn=' . $_GET["isbn"] . '&amp;pagina2=modifica';

        $formModifica = '<form action="' . $indirizzo . '" method="post">
                            <fieldset id="field_admin">
                                <legend>Modifica libro</legend>
                                <input type="hidden" name="isbn" value="' . $isbn . '"/>
                                <button type="submit" tabindex="20">Modifica libro</button>
                            </fieldset>
                        </form>';

        $visualizzaLibro = str_replace('$BOTTONOADMINMODIFICA$', $formModifica, $visualizzaLibro);
        $visualizzaLibro = str_replace('$FORMCOMMENTO$', '<p>Sei l\'amministratore non puoi recensire i libri. Creati un profilo personale se vuoi scrivere anche tu la tua recensione!</p>', $visualizzaLibro);

    } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

        $visualizzaLibro = str_replace('$BOTTONOADMINMODIFICA$', '', $visualizzaLibro);
        $visualizzaLibro = str_replace('$COMMENTOELIMINATO$', '', $visualizzaLibro);
        $formCommento = '';
        //qui assemblo commenti singolo utente e faccio query
        $username = $_SESSION["username"];
        $query_recensione = "SELECT * FROM commento WHERE libro = '$isbn' AND utente = '$username'";

        if($richiesta_recensione = mysqli_query($connessioneDatabase, $query_recensione)) {

            $risultati_recensione = mysqli_fetch_assoc($richiesta_recensione);

            if($risultati_recensione != NULL) {

                $singoloCommento = file_get_contents('../HTML/commentoSottoLibro.html');

                $singoloCommento = str_replace('$NOMEUTENTE$', $risultati_recensione["utente"], $singoloCommento);
                $singoloCommento = str_replace('$DATAORA$', $risultati_recensione["data_ora"], $singoloCommento);
                $singoloCommento = str_replace('$TESTOCOMMENTO$', $risultati_recensione["testo"], $singoloCommento);

                $tuttiCommenti = $tuttiCommenti . $singoloCommento;

                $formCommento = '<p>Hai già effettuato una recensione per questo libro, come vedi la tua recensione è stata messa per prima. Modificala ne "Le mie recensioni" o scrivi un\'altra recensione di un altro libro!</p>';

            } else {

                $formCommento = '<form action="aggiungiCommento.php" method="post">
                                    <fieldset id="commento">
                                        <legend>Commenti</legend>
                                        <p id="avviso_recensione"></p>
                                        <label for="recensione_libro">Scrivi la tua recensione:</label>
                                        <textarea onkeyup="inserisciRecensioneLibro()" onchange="inserisciRecensioneLibro()" onblur="inserisciRecensioneLibro()" id="recensione_libro" rows="10" cols="200" name="commento" tabindex="20"></textarea>
                                        <input type="hidden" name="isbn" value="' . $isbn . '"/>
                                        <input type="hidden" name="genere" value="' . $_GET["genere"] . '"/>
                                        <input type="hidden" name="inizio" value="' . $_GET["inizio"] . '"/>
                                        <input type="hidden" name="fine" value="' . $_GET["fine"] . '"/>
                                        <button type="reset" onclick="bottoneResetRecensione()" xml:lang="en" tabindex="21">Reset</button>
                                        <button id="inserisci_recensione_libro" type="submit" tabindex="22">Commenta</button>
                                    </fieldset>
                                </form>';

            }

        } else {

            mysqli_close($connessioneDatabase);
            header('Location: ../HTML/erroreDatabase.html');
            exit();

        }

        $visualizzaLibro = str_replace('$FORMCOMMENTO$', $formCommento, $visualizzaLibro);

    } else {

        $visualizzaLibro = str_replace('$BOTTONOADMINMODIFICA$', '', $visualizzaLibro);
        $visualizzaLibro = str_replace('$COMMENTOELIMINATO$', '', $visualizzaLibro);
        $visualizzaLibro = str_replace('$FORMCOMMENTO$', '<p>Registrati nel nostro sito per poter effettuare la tua recensione!</p>', $visualizzaLibro);

    }

    //finito di assemblare libro

    //assemblo commenti di tutti più i miei
    $query_commenti = "SELECT * FROM commento WHERE libro = '$isbn' ORDER BY ID DESC";
    $boolCommenti = false;
    $tabindex = 21;

    if($richiestaCommenti = mysqli_query($connessioneDatabase , $query_commenti)) {

        while($risultatiCommenti = mysqli_fetch_assoc($richiestaCommenti)) {

            if(isset($_SESSION["username"]) && ($risultatiCommenti["utente"] == $_SESSION["username"])) {

                $singoloCommento = '';
                $boolCommenti = true;

            } else {

                $singoloCommento = '';
                $boolCommenti = true;

                if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                    $singoloCommento = file_get_contents('../HTML/commentoSottoLibroAdmin.html');
                    $singoloCommento = str_replace('$VIDCOMMENTO$', $risultatiCommenti["ID"], $singoloCommento);
                    $singoloCommento = str_replace('$VADMINGENERE$', $_GET["genere"], $singoloCommento);
                    $singoloCommento = str_replace('$VADMININIZIO$', $_GET["inizio"], $singoloCommento);
                    $singoloCommento = str_replace('$VADMINFINE$', $_GET["fine"], $singoloCommento);
                    $singoloCommento = str_replace('$VADMINISBN$', $_GET["isbn"], $singoloCommento);
                    $singoloCommento = str_replace('$TABINDEXADMINELIMINACOMMENTO$', $tabindex, $singoloCommento);
                    $tabindex = $tabindex + 1;

                } else {

                    $singoloCommento = file_get_contents('../HTML/commentoSottoLibro.html');

                }

                $singoloCommento = str_replace('$NOMEUTENTE$', $risultatiCommenti["utente"], $singoloCommento);
                $singoloCommento = str_replace('$DATAORA$', $risultatiCommenti["data_ora"], $singoloCommento);
                $singoloCommento = str_replace('$TESTOCOMMENTO$', $risultatiCommenti["testo"], $singoloCommento);

                $tuttiCommenti = $tuttiCommenti . $singoloCommento;

            }

        }

        mysqli_free_result($richiestaCommenti);

    } else {

        mysqli_close($connessioneDatabase);
        header('Location: ../HTML/erroreDatabase.html');
        exit();

    }

    mysqli_close($connessioneDatabase);

    if($boolCommenti) $tuttiCommenti = '<ul id="lista_commenti">' . $tuttiCommenti . '</ul>';
    else $tuttiCommenti = '';

    $visualizzaLibro = str_replace('$LISTACOMMENTI$', $tuttiCommenti, $visualizzaLibro);

    return $visualizzaLibro;

}

?>
