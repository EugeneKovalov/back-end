<?php

?>
<div class="container mb-5">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <a class="navbar-brand" href="index.php"><?= $config['company'] ?></a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <?php foreach ($config['menu'] as $item): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=<?= $item['id'] ?>">
                            <?= $item['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item active">
                    <span class="nav-link">{{basket}}</span>
                </li>
                <? if(isset($_SESSION['login'])): ?>
                    <li class="nav-item active">
                        <span class="nav-link">Hello dear: <?=$_SESSION['login']?></span>
                    </li>
                <?endif;?>
            </ul>
        </div>
    </nav>
</div>