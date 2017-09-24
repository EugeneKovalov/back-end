<?php

//В колонку "Действия" добавить ссылку по нажатию на которую появится форма с текстовым полем для переименования файла/директории (в котором по-умолчанию указано текущее имя) и кнокной "Переименовать"

//*4. Для текстовых и php файлов добавить ссылку по нажатию на которую появится форма с текстовым полем (textarea) для редактирования содержимого файла и кнокной "Сохранить".

define('DS', DIRECTORY_SEPARATOR);
// Определим корневую директорию
$base = $_SERVER['DOCUMENT_ROOT'];
// Определяем путь выбранной директории относительно корня
$path = '';
if (!empty($_GET['dir']) && !in_array($_GET['dir'], ['.', '/'])) {
    $path = $_GET['dir'];
}
// Получаем все файлы и директории из текущего пути
$files = scandir($base.DS.$path);
// Очищаем от лишних элементов
$removeParts = ['.'];
if (!$path) {
    // Если мы в корне - удаляем элемент родительской директории
    $removeParts[] = '..';
}
$files = array_diff($files, $removeParts);
// Формируем данные для вывода
$result = [];
var_dump($_POST);

foreach ($files as $file) {
    $name = $file;
    $absFile = $base.DS.$path.DS.$file;
    // Для директорий делаем имя со ссылкой
    if (is_dir($absFile)) {
        if ($file == '..') {
            // Ссылку "вверх" делаем на один элемент вложенности меньше
            $url = dirname($path);
        } else {
            $url = $path.DS.$name;
        }
        $name = "<a href=\"?dir={$url}\">{$name}</a>";
    }

    // Добавляем текущий элемент в массив результата
    $result[] = [
        'name' => $name,
        'size' => round(filesize($absFile)/1024, 2) . ' кб',

        // but if you are using UNIX you can get the change time and that would be all.
        'created_at' => date('H:i:s d.m.Y', filectime($absFile)),
        'edited_at' => date('H:i:s d.m.Y', filemtime($absFile)),
        'path' => $absFile
    ];
}

if (isset($_POST['remove_button'])) {
    $fileName = $_POST['removeFile'];

    foreach ($result as $item) {
        if ($fileName == $item['name']) {
            $abs = $item['path'];

            if(is_dir($abs)) {
                echo $fileName . " dir has been deleted.";
                rmdir($item['path']);
                break;
            } else {
                echo $fileName . " file has been deleted.";
                unlink($item['path']);
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>File Manager</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" width="100">
                <thead>
                <tr class="bg-warning">
                    <th>Действия</th>
                    <th>Имя файла</th>
                    <th>Размер файла</th>
                    <th>Дата создания</th>
                    <th>Дата изменения</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($result as $file):?>
                    <tr>
                        <td>
                            <?if ($file['name'] != '..'):?>
                                <form method="post">
                                    <input type="hidden" name="removeFile" value="<?= htmlspecialchars($file['name'])?>">
                                    <input name="remove_button" type="submit" value="remove">
                                </form>
                                <form method="post">
                                    <input type="hidden" name="renameFile" value="<?= htmlspecialchars($file['name'])?>">
                                    <input name="rename_button" type="submit" value="rename">
                                </form>
                            <?endif;?>
                        </td>
                        <td><?= $file['name'] ?></td>
                        <td><?= $file['size'] ?></td>
                        <td><?= $file['created_at'] ?></td>
                        <td><?= $file['edited_at'] ?></td>
                    </tr>
                <? endforeach; ?>

                <?if (isset($_POST['rename_button'])): ?>
                    <form method="post">
                        <p><?= $_POST['renameFile'] ?></p>
                        <input name="title" value="" placeholder="Rename">
                        <input name="submit_rename" type="submit" value="submit rename"">
                    </form>
                    <?if (isset($_POST['submit_rename'])):

                        $fileName = $_POST['renameFile'];
                        echo "dwdw";
                        foreach ($result as $item) {
                            if ($fileName == $item['name']) {
                                $abs = $item['path'];

                                if (is_dir($abs)) {

                                    break;
                                } else {
                                    echo $fileName . " file has been renamed.";
                                    rename($item['path'] . $item['name'], $item[$path] . $_POST['title']);
                                    break;
                                }
                            }
                        }
                    endif;?>
                <?endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>