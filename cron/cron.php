<?php
$sapi = php_sapi_name();
if ($sapi !='cli') {
    require_once __DIR__."/../include/thread.php";
}
?>