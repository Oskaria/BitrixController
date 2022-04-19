<?php
    error_reporting(E_ERROR);

    session_start();
    include_once(__DIR__."/classes/autoload.php");

    $main = new Main;

    include_once(__DIR__."/templates/langs/ru.php");

    include_once(__DIR__."/modules/modules.php");
    if (empty($_GET['module'])) {
        include_once(__DIR__."/modules/header.php");
        include_once(__DIR__."/modules/sites.php");
    } else {
        if (!in_array($_GET['module'].".php", $files)) {
            header("HTTP/1.0 404 Not Found");
            include_once(__DIR__."/modules/header.php");
            include_once(__DIR__."/templates/404.php");
        } else {
            if ($_GET['module'] == "ajax") {
                include_once(__DIR__."/modules/ajax.php");
                exit();
            }
            include_once(__DIR__."/modules/header.php");
            include_once(__DIR__."/modules/".$_GET['module'].".php");
        }
    }

    include_once(__DIR__."/templates/footer.php");

?>