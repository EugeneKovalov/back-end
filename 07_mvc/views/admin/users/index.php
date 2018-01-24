<?php
$router = \App\Core\App::getRouter();
$session = \App\Core\App::getSession();
?>
<div class="row">
    <table class="table">
        <tr align="center">
            <th scope="col"><?= 'login' ?></th>
            <th scope="col"><?= 'email' ?></th>
            <th scope="col"><?= 'role' ?></th>
            <th scope="col"><?= 'active' ?></th>
        </tr>
        </thead>

        <? foreach ($data as $users): ?>
            <tr <?= ($users['login'] === $session->get('login')) ?>>
                <td>
                    <a class="btn btn-success btn-sm" href="<?= $router->buildUri('edit', [$users['id']]) ?>">Edit</a>
                    <a class="btn btn-sm btn-warning" onclick="return confirmDelete();" href="<?= $router->buildUri('delete', [$users['id']]) ?>">Delete</a>
                </td>
                <td><?= $users['login'] ?></td>
                <td><?= $users['email'] ?></td>
                <td><?= $users['role'] ?></td>
                <td><input type="checkbox"
                        <?= ($users['active'])? 'checked':'' ?> disabled></td>
            </tr>
        <? endforeach; ?>
    </table>
</div>