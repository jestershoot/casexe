<?php
use backend\models\Prize;
?>

<h1>Prizes list</h1>

<?php if (sizeof($prizes)) : ?>
    <p><a href="/admin/prize/manage/">Add new prize</a></p>
    <table class="table table-bordered table-hover">
        <thead>
        <tr><td>Prize Name</td>
            <td>Type</td>
            <td>Amount</td>
            <td>Prizes available</td>
            <td colspan="2">Operations</td>
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
    <p>Призы не определены. <a href="/admin/prize/manage/">Add new prize</a></p>
<?php endif; ?>
