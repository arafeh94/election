<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CandidateResult */

$this->title = 'Create Candidate Result';
$this->params['breadcrumbs'][] = ['label' => 'Candidate Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
