<?php
    $path = "../assets/figures/svg/";
    $files = scandir($path);

    $files = array_diff(scandir($path), array('.', '..'));

    echo json_encode($files);
?>