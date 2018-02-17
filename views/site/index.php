<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Lebanese Election';
?>

<style>
    .big-button {
        display: block;
        width: 200px;
        height: 55px;
        margin: 16px;
    }

    .center {
        position: relative;
        left: -50%;
    }

    .action-container {
        position: absolute;
        left: 50%;
    }
</style>
<div class="site-index">
    <div class="action-container">
        <div class="center">
            <?= Html::a(Html::button("Add Vote", ['class' => 'big-button btn btn-primary']), Url::to(['site/add-vote'])) ?>
            <?= Html::a(Html::button("Add List Result", ['class' => 'big-button btn btn-primary']), Url::to(['site/add-result'])) ?>
        </div>
    </div>
</div>
