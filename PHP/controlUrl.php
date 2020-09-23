<?php

function controlUrl() {

    $allOk = true;
    //controlli genererici che valgono sia per utente non loggato, che per utente loggato che per admin
    if(empty($_GET)) $allOk = true;

    elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && count($_GET) == 1) $allOk = true;

    elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && ($_GET["genere"] == 'horror' || $_GET["genere"] == 'gialli' || $_GET["genere"] == 'fantasy' || $_GET["genere"] == 'classici' || $_GET["genere"] == 'rosa' || $_GET["genere"] == 'tutti') && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && count($_GET) == 4) $allOk = true;

    elseif(isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && ($_GET["genere"] == 'horror' || $_GET["genere"] == 'gialli' || $_GET["genere"] == 'fantasy' || $_GET["genere"] == 'classici' || $_GET["genere"] == 'rosa' || $_GET["genere"] == 'tutti') && isset($_GET["isbn"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && count($_GET) == 5) {

        //TODO, sentire anche altri colleghi se controllo va bene o se si lascia come prima, cancello tutto e metto solo $allOk = true;
        include('connessioneDatabase.php');
        $isbn = $_GET["isbn"];
        $query_isbn = "SELECT isbn FROM libro WHERE isbn = '$isbn'";

        if(($richiestaLibro = mysqli_query($connessioneDatabase, $query_isbn)) != "") {

            $risultatoLibro = mysqli_fetch_assoc($richiestaLibro);

            if($risultatoLibro != NULL) {

                $allOk = true;

            } else {

                $allOk = false;

            }

            mysqli_free_result($richiestaLibro);

        } else {

            $allOk = false;

        }

        mysqli_close($connessioneDatabase);

        //RICERCA
    } elseif(isset($_GET["ricerca"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && count($_GET) == 3) $allOk = true;

    elseif(isset($_GET["ricerca"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["isbn"]) && count($_GET) == 4) $allOk = true;

    //adesso inizio con parti solo per gli utenti loggati e non, si tratta delle INFORMAZIONI che non devono essere visualizzate dal admin
    elseif((!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) && isset($_GET["pagina"]) && $_GET["pagina"] == 'informazioni' && count($_GET) == 1) $allOk = true;

    //qui inizia solo sessione per UTENTE LOGGATO
    elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'recensioni' && count($_GET) == 1) $allOk = true;

    elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'recensioni' && isset($_GET["rece"]) && ($_GET["rece"] == 'modificatasi' || $_GET["rece"] == 'eliminatasi') && count($_GET) == 2) $allOk = true;

    //qui controlli admin, NON POSSO INSERIRE RECENSIONI
    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'inserisci' && count($_GET) == 1) $allOk = true;

    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'inserisci' && isset($_GET["inserito"]) && ($_GET["inserito"] == 'si' || $_GET["inserito"] == 'no' || $_GET["inserito"] == 'doppio') && count($_GET) == 2) $allOk = true;

    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'statistiche' && count($_GET) == 1) $allOk = true;

    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && ($_GET["genere"] == 'horror' || $_GET["genere"] == 'gialli' || $_GET["genere"] == 'fantasy' || $_GET["genere"] == 'classici' || $_GET["genere"] == 'rosa' || $_GET["genere"] == 'tutti') && isset($_GET["isbn"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica' && count($_GET) == 6) $allOk = true;

    //qui sotto faccio quando modifica avvenuta con successo o no, rimango sulla pagina di modifica perchè nel caso voglia fare altre modifiche posso continuare a farne
    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && ($_GET["genere"] == 'horror' || $_GET["genere"] == 'gialli' || $_GET["genere"] == 'fantasy' || $_GET["genere"] == 'classici' || $_GET["genere"] == 'rosa' || $_GET["genere"] == 'tutti') && isset($_GET["isbn"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica' && isset($_GET["modificato"]) && ($_GET["modificato"] == 'si' || $_GET["modificato"] == 'no' || $_GET["modificato"] == 'doppio') && count($_GET) == 7) $allOk = true;

    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["ricerca"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["isbn"]) && isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica' && count($_GET) == 5) $allOk = true;

    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["ricerca"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["isbn"]) && isset($_GET["pagina2"]) && $_GET["pagina2"] == 'modifica' && isset($_GET["modificato"]) && ($_GET["modificato"] == 'si' || $_GET["modificato"] == 'no' || $_GET["modificato"] == 'doppio') && count($_GET) == 6) $allOk = true;

    //qui nel caso admin decida di eliminare un commento di una recensione di un libro
    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["pagina"]) && $_GET["pagina"] == 'libri' && isset($_GET["genere"]) && ($_GET["genere"] == 'horror' || $_GET["genere"] == 'gialli' || $_GET["genere"] == 'fantasy' || $_GET["genere"] == 'classici' || $_GET["genere"] == 'rosa' || $_GET["genere"] == 'tutti') && isset($_GET["isbn"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["rece"]) && $_GET["rece"] == 'eliminatasi' && count($_GET) == 6) $allOk = true;

    //ho fatto ricerca come admin, cercato libro e voglio eliminare un commento
    elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && isset($_GET["ricerca"]) && isset($_GET["inizio"]) && is_int((int)$_GET["inizio"]) && isset($_GET["fine"]) && is_int((int)$_GET["fine"]) && isset($_GET["isbn"]) && isset($_GET["rece"]) && $_GET["rece"] == 'eliminatasi' && count($_GET) == 5) $allOk = true;

    else $allOk = false;

    return $allOk;

}

?>
