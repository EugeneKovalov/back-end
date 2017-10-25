<?php

$isLoginSuccess = false;

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {

    $userName = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    if ($userName == 'admin' && $password == 'admin') {
        $isLoginSuccess = true;
    }
}

if (!$isLoginSuccess){
    header('WWW-Authenticate: Basic realm="Alert! Stop! Security over here!"');
    header('HTTP/1.1 401 Unauthorized');

    print "Login failed!".PHP_EOL;
}
else {
    print 'you reached the secret world!'.PHP_EOL;
    $destination = 'admin';
    include('index.php');
}