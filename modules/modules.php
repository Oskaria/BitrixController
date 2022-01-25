<?php

$files = scandir(__DIR__);
foreach ($files as $k=>$v) {
    if (strlen($v) < 5) {
        unset($files[$k]);
    }
}

?>