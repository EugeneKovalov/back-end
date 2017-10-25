<?php

$LoginSuccessful = false;

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {

    $Username = $_SERVER['PHP_AUTH_USER'];
    $Password = $_SERVER['PHP_AUTH_PW'];

    if ($Username == 'admin' && $Password == 'admin') {
        $LoginSuccessful = true;
    }
}

if (!$LoginSuccessful){
    header('WWW-Authenticate: Basic realm="Alert! Stop! Security over here!"');
    header('HTTP/1.0 401 Unauthorized');

    print "Login failed!".PHP_EOL;
}
else {
    print 'you reached the secret world!'.PHP_EOL;
    $destination = 'admin';
    include('index.php');
}