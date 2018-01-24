<?php
$router = \App\Core\App::getRouter();
?>

<div class="row">
    <table>
        <tr align="center">
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Message</th>
        </tr>
        </thead>
        <? foreach ($data as $contact): ?>
            <tr>
                <td>
                    <a class="btn btn-success" href="<?= $router->buildUri('edit', [$contact['id']]) ?>">Edit</a>
                    <a class="btn btn-warning" onclick="return confirmDelete();" href="<?= $router->buildUri('delete', [$contact['id']]) ?>">Delete</a>
                </td>

                <td><?= $contact['name'] ?></td>
                <td><?= $contact['email'] ?></td>
                <td><?= $contact['messages'] ?></td>
            </tr>
        <? endforeach; ?>
    </table>
</div>