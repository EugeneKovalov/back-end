<?php

header('HTTP/1.1 201');
$fileName = $_GET['name'];
$fileDir = __DIR__.DIRECTORY_SEPARATOR.'gallery_files';
readfile(
    $fileDir
    .DIRECTORY_SEPARATOR
    .$fileName
);