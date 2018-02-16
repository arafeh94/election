<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vote */

$this->title = 'Update Vote: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->VoteId, 'url' => ['view', 'id' => $model->VoteId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
