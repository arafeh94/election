<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vote */

$this->title = $model->VoteId;
$this->params['breadcrumbs'][] = ['label' => 'Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->VoteId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->VoteId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'VoteId',
            'KalamNumber',
            'ElectorNumber',
        ],
    ]) ?>

</div>
