<?php

session_start();

include('controlUrl.php');

$location = '';
$bool = false;
$url = '';

if(controlUrl()) {

    include('connessioneDatabase.php');

    $id = $_POST["idcommento"];

    $query_aggiungiCommento = "DELETE FROM commento WHERE ID = '$id'";

    if($bool = mysqli_query($connessioneDatabase, $query_aggiungiCommento)) $location;
    else $location = 'Location: ../HTML/erroreDatabase.html';

    mysqli_close($connessioneDatabase);

    if($bool) {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $url = 'indgen.php?pagina=libri&genere=' . $_POST["genere"] . '&inizio=' . $_POST["inizio"] . '&fine=' . $_POST["fine"] . '&isbn=' . $_POST["isbn"] . '&rece=eliminatasi';
            $location = 'Location: ' . $url;

        } else {

            $location = 'Location: indgen.php?pagina=recensioni&rece=eliminatasi';

        }

    } else {

        $location = 'Location: ../HTML/erroreDatabase.html';

    }

} else {

    if(isset($_SESSION["username"])) $location = 'Location: indgen.php';
    else $location = 'Location: logOut.php';

}

header($location);
exit();

?>
