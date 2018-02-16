<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElectorListResult */

$this->title = 'Update Elector List Result: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Elector List Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ElectorListResultId, 'url' => ['view', 'id' => $model->ElectorListResultId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elector-list-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
