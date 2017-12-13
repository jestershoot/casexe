<?php
use frontend\models\Address;
use backend\models\Prize;
?>

<h1>Prizes send requests list</h1>

<?php if (sizeof($addresses)) : ?>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td>Prize</td>
            <td>Reciever Name</td>
            <td>Zip</td>
            <td>Country</td>
            <td>State</td>
            <td>City</td>
            <td>Address</td>
            <td>Status</td>
            <td>Operations</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($addresses as $addr) : ?>
            <tr>
                <td><?= Prize::prizeName($addr->prize_id) ?></td>
                <td><?= $addr->reciever ?></td>
                <td><?= $addr->zip ?></td>
                <td><?= $addr->country ?></td>
                <td><?= $addr->state ?></td>
                <td><?= $addr->city ?></td>
                <td><?= $addr->address ?></td>
                <td><?= Address::sendStatus($addr->status) ?></td>
                <td>
                    <?php if (!$addr->status) : ?>
                        <a href="/admin/address/send/?id=<?= $addr->id ?>">Prize sent</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>No send requests found.</p>
<?php endif; ?>
