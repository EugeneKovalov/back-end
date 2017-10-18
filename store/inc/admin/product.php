<?php

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $category_id = $_POST['fk'];

    $data = [];

    if (strlen($title)) {
        $data['title'] = $title;
        $data['price'] = $price;
        $data['category_id'] = $category_id;
    }

    if (!empty($data)) {
        if ($id > 0) {
            $result = updateProduct($id, $data);
        } else {
            $result = createProduct($data);
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];

    $data = [];

    if (strlen($title)) {
        $data['title'] = $title;
    }

    if (!empty($data)) {
        if ($id > 0) {
            $result = deleteProduct($id, $data);
        }
    }
}

$id = $_GET['id'];
$productResult = productList();

?>
<div>
    <a href="?page=product&id=0">Добавить продукт</a>
    <?php if (isset($id)) {

        $title = '';
        $price = 1;

        if ($id > 0) {
            $product = mysqli_fetch_assoc(productList($id));
            $title = $product['title'];
            $price = $product['price'];
            $currentSelect = $product['category_id'];
        }

        ?>
        <form action="?page=product" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" value="<?=$title?>"
                   placeholder="Название продукта" name="title">
            <input type="number" value="<?=$price?>"
                   placeholder="Стоимость продукта" name="price">
            <label for="fk">
                <select name="fk">
                    <?php
                    $categoryList = categoryList();
                    while ($category = mysqli_fetch_assoc($categoryList)) {
                        ?>
                        <option value="<?=$category['id']?>"
                            <? if ($currentSelect === $category['id']) {
                                ?> selected <?
                            }
                            ?>
                        >
                            <?=$category['title']?>
                        </option>
                    <? } ?>
                </select>
            </label>
            <input type="submit" name="save" value="Сохранить">
        </form>
    <? } ?>
    <ul>
        <?php
        while ($product = mysqli_fetch_assoc($productResult)) {
            ?>
            <li>
                <a href="?page=product&id=<?=$product['id']?>">
                    <?=$product['id']?>: <?=$product['title']?>
                </a>

                <form action="?page=product" method="post" style="display: inline; margin-left: 20px">
                    <input type="hidden" name="id" value="<?=$product['id']?>">
                    <input type="hidden" name="title" value="<?=$product['title']?>">
                    <input type="submit" name="delete" value="Удалить">
                </form>
            </li>
            <?
        }
        ?>
    </ul>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= 6; $i++) {
            ?>
            <a href="?page=product&p=<?= $i ?>"><?= $i ?></a>
            <?php
        }
        ?>
    </div>
</div>