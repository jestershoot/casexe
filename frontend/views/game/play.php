<?php

use frontend\assets\AppAsset;

$this->registerJsFile('@web/js/game.js', ['depends' => 'yii\web\YiiAsset']);

?>

<h1><?= $this->title ?></h1>

<div class="prize-wrapper">
    <p>Click on button to win prize!</p>
    <p><a id="playButton" class="btn btn-success prize-action" href="/game/play/">PLAY!</a></p>
</div>