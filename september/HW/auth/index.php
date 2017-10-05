<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
ini_set('display_errors', 1);

$usersStorage = 'config'.DS.'users.txt';
$config = require 'config'.DS.'global.php';

ob_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <title>Hello world</title>
    </head>
    <body>
    <?php
    var_dump($_SESSION);

    $page = 'main';
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }

    if (!isset($_SESSION['auth']) && $page != 'registration') {
        $page = 'auth';
    }

    $parts = [
        'header', $page, 'footer',
    ];

    foreach ($parts as $part) {
        ob_start();

        include 'inc'.DS.$part.'.php';

        $partContent = str_ireplace(
            '{{basket}}',
            "В корзине 3 товара",
            ob_get_clean());

        $partContent = str_ireplace(
            '{{login}}',
            $_SESSION['login'],
            $partContent);

        echo $partContent;
    }
    ?>
    </body>
    </html>
<?php

$pageContent = ob_get_clean();

echo $pageContent;