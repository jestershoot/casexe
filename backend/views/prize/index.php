<?php
use backend\models\Prize;
?>

<h1>Prizes list</h1>

<?php if (sizeof($prizes)) : ?>
    <p><a href="/admin/prize/manage/">Add new prize</a></p>
    <table class="table table-bordered table-hover">
        <thead>
        <tr><th>Prize Name</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Prizes available</th>
            <th colspan="2">Operations</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($prizes as $prize) : ?>
            <tr>
                <td><?= $prize->name ?></td>
                <td><?= Prize::prizeType($prize->type) ?></td>
                <td><?= $prize->amount ?></td>
                <td><?= $prize->cnt ?></td>
                <td><a href="/admin/prize/manage/?id=<?= $prize->id ?>">Edit</a></td>
                <td><a href="/admin/prize/delete/?id=<?= $prize->id ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>List is empty. <a href="/admin/prize/manage/">Add new prize</a></p>
<?php endif; ?>
