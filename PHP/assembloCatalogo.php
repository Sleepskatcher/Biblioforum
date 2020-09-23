<?php

function assembloCatalogo() {

    $lista = file_get_contents('../HTML/lista.html');
    $tuttiLibri = '';
    $libro = '';
    $tabindex = 20;

    include('connessioneDatabase.php');

    $genere = $_GET["genere"];
    $inizio = $_GET["inizio"];
    $fine = $_GET["fine"];
    $boolLibri = false;

    $query_catalogo = '';

    if($_GET["genere"] == 'tutti') $query_catalogo = "SELECT * FROM libro ORDER BY titolo";
    else $query_catalogo = "SELECT * FROM libro WHERE genere = '$genere' ORDER BY titolo";

    if($richiestaCatalogo = mysqli_query($connessioneDatabase, $query_catalogo)) {

        mysqli_data_seek($richiestaCatalogo, $inizio);

        while(($libro = mysqli_fetch_assoc($richiestaCatalogo)) && $inizio < $fine) {

            $singoloLibro = file_get_contents('../HTML/singoloElementoLista.html');

            $isbn = $libro["isbn"];
            $titolo = $libro["titolo"];
            $boolLibri = true;

            $autori = '';
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

            $singoloLibro = str_replace('$TITOLO$' , '<a href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $_GET["inizio"] . '&amp;fine=' . $_GET["fine"] . '&amp;isbn=' . $isbn . '" title="link libro" tabindex="' . $tabindex . '">' . $titolo . '</a>', $singoloLibro);
            $singoloLibro = str_replace('$COPERTINA$', '<img src="../pictures/' . $isbn . '.jpg" alt="Immagine copertina del libro"/>', $singoloLibro);
            $singoloLibro = str_replace('$ISBN$', $isbn, $singoloLibro);
            $singoloLibro = str_replace('$AUTORI$', $autori, $singoloLibro);

            $tuttiLibri = $tuttiLibri . $singoloLibro;

            $tabindex = $tabindex + 1;
            $inizio = $inizio + 1;

        }

        mysqli_free_result($richiestaCatalogo);

    } else {

        mysqli_close($connessioneDatabase);
        header('Location: ../HTML/erroreDatabase.html');
        exit();

    }

    mysqli_close($connessioneDatabase);

    $pagina = $_GET["fine"]/($_GET["fine"] - $_GET["inizio"]);

    $pag = '';

    if($boolLibri) {

        $pag = '<p>Sei a pagina ' . $pagina . '</p>';
        $tuttiLibri = '<dl>' . $tuttiLibri . '</dl>';

    } else {

        $pag = '<p>Non sono ancora presenti libri in questa sezione del catalogo.</p>';
        $tuttiLibri = '';

    }

    $lista = str_replace('$PAGINA$', $pag, $lista);
    $lista = str_replace('$SINGOLOELEMENTO$', $tuttiLibri, $lista);

    $inizioPrev = $_GET["inizio"] - ($_GET["fine"] - $_GET["inizio"]);
    $finePrev = $_GET["inizio"];

    if($_GET["inizio"] == 0) $lista = str_replace('$LINKPREV$', '', $lista);
    else $lista = str_replace('$LINKPREV$', '<a id="pag_prec" href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizioPrev . '&amp;fine=' . $finePrev . '" title="pagina precedente" tabindex="' . $tabindex . '">Pagina precedente</a>', $lista);

    $inizioSUcc = $_GET["fine"];
    $fineSucc = $_GET["fine"] + ($_GET["fine"] - $_GET["inizio"]);
    if($inizio != $fine || $libro == NULL) $lista = str_replace('$LINKSUCC$', '', $lista);
    else $lista = str_replace('$LINKSUCC$', '<a id="pag_succ" href="indgen.php?pagina=libri&amp;genere=' . $genere . '&amp;inizio=' . $inizioSUcc . '&amp;fine=' . $fineSucc . '" title="pagina successiva" tabindex="' . $tabindex . '">Pagina successiva</a>', $lista);

    return $lista;

}

?>
