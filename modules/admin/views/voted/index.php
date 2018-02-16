<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Votes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'VoteId',
            'KalamNumber',
            'ElectorNumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
