<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elector List Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elector-list-result-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Elector List Result', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ElectorListResultId',
            'ElectorListId',
            'kalamId',
            'Votes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
