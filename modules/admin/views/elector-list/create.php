<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElectorListResult */

$this->title = 'Create Elector List Result';
$this->params['breadcrumbs'][] = ['label' => 'Elector List Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elector-list-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
