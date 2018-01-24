<?php
$router = \App\Core\App::getRouter();
?>
<div class="col-lg-12">
    <h3><?= __('header.login') ?></h3>
</div>

<form action="" method="post">
    <label for="email" class="form-control-label">Email: </label>
    <input type="text" id="login" name="email" class="form-control" placeholder="enter email" required>
    <label for="password" class="form-control-label">Password: </label>
    <input type="password" id="password" name="password" class="form-control" placeholder="enter password"
           required>
    <br>
    <input type="submit" class="btn btn-success" value="<?= __('form.login') ?>">
    <a class="btn btn-success" href="<?= $router->buildUri('users.register') ?>"><?= __('header.register') ?></a>
</form>
