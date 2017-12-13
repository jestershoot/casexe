<?php if (!empty($prize)) : ?>

<div class="won-prize">
    <h3>Congratulations!</h3>
    <p>You win:</p>
    <h3><?= $prize->name ?></h3>
    <br /><br />
    <div class="buttons">

<?php if ($prize->type == 1) : ?>
        <a class="btn btn-success prize-action" href="/card/show?id=<?= $prize->id ?>">Take money</a> <a class="btn btn-warning prize-action" href="/game/convert?id=<?= $prize->id ?>">Convert to Bonus Coins</a> <a class="btn btn-secondary" href="/game/play">Refuse</a>
<?php elseif ($prize->type == 2) :  ?>
    <a class="btn btn-success prize-action" href="/game/bonus?id=<?= $prize->id ?>">Take Bonus Coins</a> <a class="btn btn-secondary" href="/game/play">Refuse</a>
<?php elseif ($prize->type == 3) :  ?>
    <a class="btn btn-success prize-action" href="/address/show?id=<?= $prize->id ?>">Take prize</a> <a class="btn btn-secondary" href="/game/play">Refuse</a>
<?php else:  ?>
    <p>Unknown prize</p>
<?php endif; ?>
    </div>
</div>

<?php else : ?>
    <div class="won-prize">
        <p>Sorry, but all prizes are played. Try again later.</p>
    </div>

<?php endif; ?>
