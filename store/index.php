<?php

spl_autoload_register(function ($name) {
    $name = str_replace('\\', DIRECTORY_SEPARATOR, $name);
    include_once $name.'.php';
});

include_once('App/lib/core.php');

if ($destination) {
    $incPath = $_SERVER['DOCUMENT_ROOT'].'/PHP-Academy/store/inc/'.$destination;
} else {
    $incPath = $_SERVER['DOCUMENT_ROOT'].'/PHP-Academy/store/inc/public';
}

$page = 'main';

if ($_GET['page']) {
    $page = str_replace('/', '', $_GET['page']);
}

ob_start();

include($incPath.'/header.php');

if (!include($incPath."/$page.php")) {
    echo '404';
}

include($incPath.'/footer.php');


echo ob_get_clean();