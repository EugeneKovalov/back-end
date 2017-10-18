<?php
define('DS', DIRECTORY_SEPARATOR);
// Определим корневую директорию
$base = $_SERVER['DOCUMENT_ROOT'];
// Определяем путь выбранной директории относительно корня
$path = '';

// EDIT FILE
if (isset($_POST['edit_button'])): ?>
    <form method="post">
        <p><?= $_POST['editFile'] ?></p>
        <input type="hidden" name="file" value="<?= $_POST["editFile"] ?>">
        <?
        $content = file_get_contents($_POST['editFile']);
        echo "<textarea rows='10' name='content'>" .
            file_get_contents($base.$_GET['dir'].DS.$_POST['editFile']) . "</textarea>";
        ?>
        <input name="submit_edit" type="submit" value="submit edit">
    </form>
<?endif;

// EDIT SUBMIT
if (isset($_POST['submit_edit'])):
    $file = $base.$_GET['dir'].DS.$_POST['file'];
    $openFile = fopen($file,"w+");
    $newContent = $_POST['content'];
    fwrite($openFile, $newContent);
    fclose($openFile);
endif;

// RENAME FILE
if (isset($_POST['rename_button'])):?>
    <form method="post">
        <p><?= $_POST['renameFile'] ?></p>
        <input name="new_file" value="" placeholder="Rename">
        <input type="hidden" name="old_file" value="<?= $_POST["renameFile"] ?>">
        <input name="submit_rename" type="submit" value="submit rename">
    </form>
<?endif;

// SUBMIT RENAME FILE
if (isset($_POST['submit_rename'])):
    $fileName = $base.$_GET['dir'].DS;
    rename($fileName.$_POST['old_file'], $fileName.$_POST['new_file']);
endif;

// REMOVE FILE
if (isset($_POST['remove_button'])) {
    $fileName = $base.$_GET['dir'].DS.$_POST['removeFile'];

    if(is_file($fileName)) {
        echo $_POST['removeFile'] . " file has been deleted.";
        unlink($fileName);
    } else {
        $n = $_POST['removeFile'];
        $n = substr($n, 14);
        $n = substr($n, 0, strpos($n, '"'));

        echo $_POST['removeFile'] . " dir has been deleted.";
        rmdir($base.$n);
    }
}

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

                                <?if (!is_dir($file['path'])): ?>
                                    <? $path_parts = pathinfo($file['path']); ?>
                                    <?if ($path_parts['extension'] == 'php'|| $path_parts['extension'] == 'txt'): ?>
                                        <form method="post">
                                            <input type="hidden" name="editFile" value="<?=
                                            htmlspecialchars($file['name'])
                                            ?>">
                                            <input name="edit_button" type="submit" value="edit">
                                        </form>
                                    <?endif;?>
                                <?endif;?>
                            <?endif;?>
                        </td>
                        <td><?= $file['name'] ?></td>
                        <td><?= $file['size'] ?></td>
                        <td><?= $file['created_at'] ?></td>
                        <td><?= $file['edited_at'] ?></td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>