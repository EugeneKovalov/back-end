<?php
$router = \App\Core\App::getRouter();

?>

<div class="container">
    <div class="row">
        <div>
            <a class="btn btn-success"
               href="<?= $router->buildUri('edit') ?>">создать</a>
        </div>
    </div>
    <ul class="list-group">
        <? foreach ($data as $page): ?>
            <li>
                <a class="btn btn-success" href="<?= $router->buildUri('edit', [$page['id']]) ?>">Edit</a>
                <a class="btn btn-warning" onclick="return confirmDelete();" href="<?= $router->buildUri('delete', [$page['id']]) ?>">Delete</a>
                <?= $page['title'] ?>
            </li>
        <? endforeach; ?>
    </ul>
</div>