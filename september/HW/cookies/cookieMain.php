<?php
$file = "";

if (isset($_POST['submit'])) {
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'folder' . DIRECTORY_SEPARATOR;
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    $uploadFile = $uploadDir . basename($_FILES['uploadfile']['name']);
    move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadFile);
}

if (isset($_FILES['uploadfile'])) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'folder' . DIRECTORY_SEPARATOR . basename($_FILES['uploadfile']['name']);
}

if (file_exists($file)) {
    if (ob_get_level()) {
        ob_end_clean();
    }

    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header("Content-Description: File Transfer");
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($file));

    readfile($file);
    exit();
}
//}

if (isset($_COOKIE['visits_count'])) {
    $visitCounter = $_COOKIE['visits_count'];
    $visitCounter++;
} else {
    $visitCounter = 1;
}

setcookie('visits_count', $visitCounter,  time()+3600);

if ($_COOKIE['visits_count'] >= 5) {
    setcookie('visits_count', "", time()-3600);
}

echo "Вы зашли: " . $_COOKIE['visits_count'] . " раз.<br>";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cookies</title>
</head>
<body>
<form enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000"/>
    <input type="file" name="uploadfile"/>
    <input type="submit" name="submit" value="Send File"/>
</form>
</body>
</html>