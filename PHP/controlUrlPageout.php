<?php

function controlUrlPageout() {

    $againOk = true;

    if(empty($_GET)) $againOk = true;

    elseif(isset($_GET["error"]) && $_GET["error"] == 'no' && count($_GET) == 1) $againOk = true;

    elseif(isset($_GET["error"]) && ($_GET["error"] == 'username' || $_GET["error"] == 'email' || $_GET["error"] == 'rippass' || $_GET["error"] == 'diffpass' || $_GET["error"] == 'doppiapass' || $_GET["error"] == 'general') && count($_GET) == 1) $againOk = true;

    else $againOk = false;

    return $againOk;

}

?>
