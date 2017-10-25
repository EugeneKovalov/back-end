<?php

if (isset($_POST['save']) || isset($_POST['delete'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $data = [];

    if (strlen($title)) {
       $data['title'] = $title;
    }

    if (!empty($data)) {
        if (isset($_POST['delete'])) {
            $result = deleteCategory($id, $data);
        }
        if ($id > 0) {
            $result = updateCategory($id, $data);
        } else {
            $result = createCategory($data);
        }
    }
}

if(isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 0;
}

if ($page < 2) {
    $from = 0;
} else {
    $from = ($page * 5) - 5;
}

$id = $_GET['id'];
$categoryResult = categoryList(0, $from);

?>
<div>
    <a href="?page=category&id=0">Добавить категорию</a>
    <?php if (isset($id)) {
        $title = '';
        if ($id > 0) {
            $category = mysqli_fetch_assoc(categoryList($id, $from));
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
    $category_count = "SELECT * FROM category";
    $find_count = mysqli_query($connection, $category_count);
    $count = mysqli_num_rows($find_count);

    while ($category = mysqli_fetch_assoc($categoryResult)) {
        ?>
        <li>
            <a href="?page=category&id=<?=$category['id']?>">
                <?=$category['id']?>: <?=$category['title']?>
            </a>

            <form action="?page=category" method="post" style="display: inline; margin-left: 20px">
                <input type="hidden" name="id" value="<?=$category['id']?>">
                <input type="hidden" name="title" value="<?=$category['title']?>">
                <input type="submit" name="delete" value="Удалить">
            </form>
        </li>
        <?
    }
    ?>
    </ul>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= ceil($count / 5); $i++) {
            ?>
            <a href="?page=category&p=<?=$i?>"><?=$i?></a>
            <?php
        }
        ?>
    </div>
</div>