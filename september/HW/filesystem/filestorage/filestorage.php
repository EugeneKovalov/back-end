<?php

//Написать скрипт для загрузки пользовательских файлов. При загрузке, в зависимости от типа файла – он на сервере должен помещаться в папку /doc, или /img..etc

//Должно быть ограничение на прием файлов – не более 2 мб.

//Ссылку на форму загрузки разместить на главной странице сайта.

//После добавления файлов, при заходе на главную, пользователь должен видеть галерею ранее загруженных картинок, и список загруженных документов (все, что не картинки).

//Код максимально писать функциями.

define('DS', DIRECTORY_SEPARATOR);

$fileDir = __DIR__ . DS;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_FILES);
    $file = $_FILES['image']['name'];

    if (file_exists($fileDir.$file['name'])) {

//        $path_parts = pathinfo($_FILES['tmp_name']);
//        $fileDir .= $path_parts['extension'];

        if (!is_dir($fileDir)) {
            mkdir($fileDir);
        }
        // Если все ок - перемещаем загруженную картинку в свою директорию
        move_uploaded_file(
            $file['tmp_name'],
            $fileDir . DS . $file['name']
        );
    }
}

// Получаем список файлов директории и очищаем от лишних элементов
$images = array_diff(scandir($fileDir), ['.', '..']);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <title>Gallery</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Загрузите свои картинки</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="image" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">
                    Отправить
                </button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <?if (!empty($errors)):?>
            <div class="alert alert-danger">
                <?=implode('<br>', $errors)?>
            </div>
        <?endif;?>
        <div class="col-md-12">
            <div class="row">
                <? foreach ($images as $imgPath): ?>
                    <div class="col-md-6"
                         style="height: 250px;
                                 background: url('get_img.php?name=<?= $imgPath ?>') no-repeat center/cover">
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>