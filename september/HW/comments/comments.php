<?php

//error_reporting(-1);
//ini_set('display_errors', 1);

$filename = __DIR__ . '/data.txt';
$censoredFileName = __DIR__ . '/censored.txt';

// Массив содержит все комментарии
$comments = unserialize(file_get_contents($filename));

// Слова которые мы должны фильтровать
$censored = explode("\n", file_get_contents($censoredFileName));

// Строка с сообщением об ошибках
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Логика оработки запроса
    $author = htmlspecialchars($_POST['author']);
    $comment = htmlspecialchars($_POST['comment']);
    $email = htmlspecialchars($_POST['email']);

    if (strlen($author) && strlen($comment) && strlen($email)) {
        $emailArr = array_column($comments, 'email');

        if (in_array($email, $emailArr)) {
            array_push($errors,  "Введенный email существует в базе");
        } else {
            $comments[] = [
                'date' => date('H:i:s d.m.Y'),
                'timestamp' => time(),
                'author' => $author,
                'comment' => $comment,
                'email' => $email
            ];
            file_put_contents($filename, serialize($comments));
        }
    } else {
        array_push($errors,  "Форма заполнена некорректно");
    }
}

if (!empty($comments)) {
    usort($comments, function ($a, $b) {
        return isset($a['timestamp']) && $a['timestamp'] > $b['timestamp'] ? -1 : 1;
    });
}

// Постраничная навигация
$commentsPerPage = 5;
$maxPages = ceil(count($comments) / $commentsPerPage);

if ($_GET['p'] > $maxPages) {
    header("Location: ?p=1");
}

// Вырезать нужные комментарии из $comments
if (count($comments) <= $commentsPerPage) {
    $visible = $comments;
} else {
    $visible = array_slice($comments, $commentsPerPage * (int)($_GET['p'] - 1), $commentsPerPage);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Title</title>
</head>
<body>
<div class="container">
    <h1>Поделитесь вашим мнением</h1>
    <?if (!empty($errors)):?>
        <div class="alert alert-danger">
            <?=implode('<br>', $errors)?>
        </div>
    <?endif;?>
    <div class="row">
        <form method="post">
            <div class="form-group">
                <label for="author">Ваше имя:</label>
                <input class="form-control" name="author" id="author">
            </div>
            <div class="form-group">
                <label for="comment">Ваше комментарий:</label>
                <textarea class="form-control" name="comment" id="comment" required></textarea>
            </div>
            <div class="form-group">
                <label for="email">Ваш email:</label>
                <input class="form-control" type="email" name="email" id="email" required/>
            </div>
            <button class="btn btn-primary" type="submit">Отправить</button>
        </form>

        <div class="col-md-6">
            <?php
            if (!empty($comments)) {
                foreach ($visible as $comment):
                    foreach (['author', 'comment', 'email'] as $key) {
                        $comment[$key] = str_ireplace($censored, '[censored]', $comment[$key]);
                    }

                    ?>
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title">
                                <?= $comment['author']?>
                            </div>
                            <div class="card-title">
                                <?= $comment['date']?>
                            </div>
                            <div class="card-text">
                                <?= $comment['comment']?>
                            </div>
                            <div class="card-text">
                                <?= $comment['email']?>
                            </div>
                        </div>
                    </div>
                    <?php

                endforeach;
            }
            // Вывод ссылок постраничной навигации
            ?>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $maxPages; $i++) {
                    ?>
                    <a href="?p=<?= $i ?>"><?= $i ?></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
