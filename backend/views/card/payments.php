<?php
use frontend\models\Card;
?>

<h1>Payments list</h1>

<?php if (sizeof($payments)) : ?>
    <table class="table table-bordered table-hover">
        <thead>
        <tr><th>Card Type</th>
            <th>Card Number</th>
            <th>Amount</th>
            <th>status</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($payments as $payment) : ?>
            <tr>
                <td><?= Card::cardType($payment->cardType) ?></td>
                <td><?= $payment->cardNumber ?></td>
                <td>$<?= $payment->amount ?></td>
                <td><?= Card::cardStatus($payment->status) ?></td>
                <td>
                    <?php if (!$payment->status) : ?>
                        <a href="/admin/card/pay/?id=<?= $payment->id ?>">Pay Now</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>No payment requests found.</p>
<?php endif; ?>
