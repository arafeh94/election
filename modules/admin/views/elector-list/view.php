<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ElectorListResult */

$this->title = $model->ElectorListResultId;
$this->params['breadcrumbs'][] = ['label' => 'Elector List Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elector-list-result-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ElectorListResultId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ElectorListResultId], [
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
            'ElectorListResultId',
            'ElectorListId',
            'kalamId',
            'Votes',
        ],
    ]) ?>

</div>
