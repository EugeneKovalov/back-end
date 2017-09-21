<?php
define('DS', DIRECTORY_SEPARATOR);
$galleryDir = __DIR__.DS.'files';

if (!is_dir($galleryDir)) {
    mkdir($galleryDir);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $file = $_FILES['image'];

   if (file_exists($file['tmp_name'])) {
        move_uploaded_file($file['tmp_name'], $galleryDir.DS.$file['name']);
   }
}

$images = array_diff(scandir($galleryDir), ['.', '..']);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Gallery</title>
</head>
<body>
<div class="container">
    <div class="row">
       <div class="col-md-12">
           <h1>Загрузите свои картинки</h1>
           <form method="post" enctype="multipart/form-data">
               <input type="hidden" name="MAX_FILE_SIZE" value="500000">
               <input type="file" name="image" required>
               <button class="btn btn-default" type="submit">Отправить</button>
           </form>

           <div class="col-md-6">
               <? foreach ($images as $imgPath): ?>
                   <div class="col-md-3">
                       <img src="<?= $imgPath ?>">
                   </div>
               <? endforeach; ?>
           </div>

       </div>
    </div>
</div>
</body>
</html>
