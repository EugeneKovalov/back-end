<?php

$postData = $_POST;

// регистрация. Можно добавить много нужных проверок на длину пароля, корректный имэил и тд.
if (isset($postData['signUp'])) {
    $errors = array();

    if (!trim($postData['login']) == '') {
        if (in_array($postData['login'], array_column($config['users'], 0))) {
            $errors[] = 'This name has been already registered';
        }
    } else {
        $errors[] = 'Enter login name!';
    }

    if (strlen($postData['password']) < 3) {
        $errors[] = 'Enter password longer than three symbols!';
    }

    if ($postData['password_repeat'] != $postData['password']) {
        $errors[] = 'Repeated password not correct';
    }

    if (empty($errors)) {
        $tmp = $config['users'];
        $tmp[] = [$postData['login'], sha1($salt . $postData['password'])];

        file_put_contents($usersStorage, serialize($tmp));

        $config['users'] = $tmp;

        header("Location: ?page=auth");
        die('Successful registered!');
    }
}

?>
<div class="container">
    <main class="row">
        <div class="col-md-6 offset-md-3" style="text-align: center">
            <h1>Регистрация</h1>

            <? if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?= implode('<br>', $errors) ?>
                </div>
                <hr/>
            <? endif; ?>

            <form method="post">
                <div class="form-group">
                    <input name="login" type="text"
                           class="form-control"
                           placeholder="Логин">
                </div>
                <div class="form-group">
                    <input name="password" type="password"
                           class="form-control"
                           placeholder="Пароль">
                </div>
                <div class="form-group">
                    <input name="password_repeat" type="password"
                           class="form-control"
                           placeholder="Повторите введенный пароль">
                </div>
                <button type="submit" name="signUp" class="btn btn-primary">Зарегистрироваться</button>
            </form>
        </div>
    </main>
</div>

