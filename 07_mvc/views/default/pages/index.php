<?php

/** @var array $data */
?>

<div class="container">
    <ul class="list-group">
        <? foreach ($data as $page): ?>
            <li class="list-group-item">
                <a href="<?= \App\Core\App::getRouter()->buildUri('view', [$page['id']]) ?>"><?= $page['title'] ?></a>
            </li>
        <? endforeach; ?>
    </ul>
</div>
