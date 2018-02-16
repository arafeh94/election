<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CandidateResult */

$this->title = 'Update Candidate Result: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Candidate Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CandidateResultId, 'url' => ['view', 'id' => $model->CandidateResultId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="candidate-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
