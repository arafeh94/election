<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ElectorListResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elector-list-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ElectorListResultId')->textInput() ?>

    <?= $form->field($model, 'ElectorListId')->textInput() ?>

    <?= $form->field($model, 'kalamId')->textInput() ?>

    <?= $form->field($model, 'Votes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
