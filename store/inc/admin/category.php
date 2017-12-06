<?php

use App\DB\Connection;
use App\Entity\CategoryEntity;
use App\Main\Config;

$connection = Connection::getInstance();
$config = new Config();
$categoryInstance = new CategoryEntity($connection, $config);

define("COUNT", 5);

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $data = [];

    if (strlen($title)) {
        $data['title'] = $title;
    }

    if (!empty($data)) {
        if ($id > 0) {
            $result = $categoryInstance->update($id, $data);
        } else {
            $result = $categoryInstance->create($data);
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $result = $categoryInstance->delete($id);
}

if(isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 0;
}

if ($page < 2) {
    $from = 0;
} else {
    $from = ($page * COUNT) - COUNT;
}

$id = $_GET['id'];
$categoryResult = $categoryInstance->get(0, $from, COUNT);

?>
<div>
    <a href="?page=category&id=0">Добавить категорию</a>
    <?php if (isset($id)) {
        $title = '';
        if ($id > 0) {
            $category = mysqli_fetch_assoc($categoryInstance->get($id));
            $title = $category['title'];
        }

        ?>
        <form action="?page=category" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" value="<?=$title?>"
                   placeholder="Название категории" name="title">
            <input type="submit" name="save" value="Сохранить">
        </form>
    <? } ?>
    <ul>
        <?php
        while ($category = mysqli_fetch_assoc($categoryResult)) {
            ?>
            <li>
                <a href="?page=category&id=<?=$category['id']?>">
                    <?=$category['id']?>: <?=$category['title']?>
                </a>

                <form action="?page=category" method="post" style="display: inline; margin-left: 20px">
                    <input type="hidden" name="id" value="<?=$category['id']?>">
                    <input type="submit" name="delete" value="Удалить">
                </form>
            </li>
            <?
        }
        ?>
    </ul>
    <div class="pagination">
        <?php
        $countLength = ceil($categoryInstance->getCountItems() / COUNT);
        for ($i = 1; $i <= $countLength; $i++) {
            ?>
            <a href="?page=category&p=<?=$i?>"><?=$i?></a>
            <?php
        }
        ?>
    </div>
</div>