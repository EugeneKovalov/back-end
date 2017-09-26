<?php
if (isset($_FILES['uploadfile'])) {
    $name = basename($_FILES['uploadfile']['name']);
    header("Content-Disposition: attachment; filename=$name");
    readfile(__DIR__ . DIRECTORY_SEPARATOR . 'folder' . DIRECTORY_SEPARATOR . basename($_FILES['uploadfile']['name']));
}

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

echo "Вы зашли: " . $_COOKIE['visits_count'] . " раз." . "<br>";

if (isset($_POST['submit'])) {
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'folder' . DIRECTORY_SEPARATOR;
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    $uploadFile = $uploadDir . basename($_FILES['uploadfile']['name']);
    if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadFile)) {
        echo "ALL DONE!<br>";
    } else {
        echo "SOMETHING GOES WRONG!<br>";
    }
}

//При каждом посещении страницы отправляем клиенту cookie с именем visits_count, значение по-умолчанию - 1. C каждым открытием страницы значение cookie должно увеличиваться на 1. Когда значение cookie превысит 5 - нужно удалить куку. (На следующем за удалением открытием страницы - снова отправляем со значением по-умолчанию и идем по кругу)
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
<!--    --><?//if (isset($_POST['submit'])): ?>
<!--        --><?// $uploadDir = __DIR__.DIRECTORY_SEPARATOR.'folder'.DIRECTORY_SEPARATOR;
//        if (!is_dir($uploadDir)) {
//            mkdir($uploadDir);
//        }
//
//        $uploadFile = $uploadDir . basename($_FILES['uploadfile']['name']);
//        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadFile)) {
//            echo "ALL DONE!<br>";
//        } else {
//            echo "SOMETHING GOES WRONG!<br>";
//        }
//
//        if (file_exists($uploadFile)) {
////            header("Content-Disposition: attachment; filename=");
//            header("Cache-Control: public");
//            header("Content-Description: File Transfer");
//            header('Content-Type: application/octet-stream');
//            header("Content-Transfer-Encoding: binary");
//            readfile($uploadFile);
//        }
//        ?>
<!--    --><?//endif;?>
</body>
</html>