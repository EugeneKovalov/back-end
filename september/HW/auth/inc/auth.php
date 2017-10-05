<?php
$postData = $_POST;

if (isset($postData['signIn'])) {
    $errors = array();

    if (!trim($postData['login']) == '') {
        if (!in_array($postData['login'], array_column($config['users'], 0))) {
            $errors[] = 'No user with this name!';
        } else if ($config['users'][array_search($_POST['login'], array_column($config['users'], 0))]
            [1] === sha1($salt . $postData['password'])) {
            $_SESSION['login'] = $postData['login'];
            $_SESSION['auth'] = true;

            header("Location: index.php");
        } else {
            $errors[] = 'Incorrect password!';
        }
    } else {
        $errors[] = 'Enter login name!';
    }
}


?>
<div class="container">
    <main class="row">
        <div class="col-md-6 offset-md-3" style="text-align: center">
            <h1>Вход</h1>

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
                <button type="submit" name="signIn" class="btn btn-primary">Войти</button>
            </form>
        </div>

        <div class="container">
            <br/>
            <div class="col-md-6 offset-md-3" style="text-align: center">
                <a class="btn btn-primary" href="?page=registration">Зарегистрироваться</a>
            </div>
        </div>
    </main>
</div>

