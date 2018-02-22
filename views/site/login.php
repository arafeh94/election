<?php

/* @var $this yii\web\View */

/* @var $model app\models\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'تسجيل دخول';
?>
<style>
    .site-login {
        margin: auto;
        width: 300px;
    }
</style>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>أرجو إدخال المعلومات اللازمة </p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('اسم المستخدم') ?>

    <?= $form->field($model, 'password')->passwordInput()->label('كلمة المورور') ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('سجل', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
