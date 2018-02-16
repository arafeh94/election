<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CandidateResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CandidateResultId')->textInput() ?>

    <?= $form->field($model, 'ElectorListResultId')->textInput() ?>

    <?= $form->field($model, 'CandidateId')->textInput() ?>

    <?= $form->field($model, 'Votes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
