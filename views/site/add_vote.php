<?php

/* @var app\models\Vote $vote */
/* @var Data $votes */
/* @var bool $result */

/* @var \app\models\Kalam $kalam */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView;

?>
<div>
    <div class="form-group">
        <?php
        $form = ActiveForm::begin();

        echo $form->field($vote, 'KalamNumber')->textInput(['autocomplete' => 'off', 'value' => $kalam->Number]);
        echo $form->field($vote, 'ElectorNumber')->textInput(['autocomplete' => 'off', 'autofocus' => true]);
        echo Html::submitButton('Add', ['class' => 'btn btn-primary']);

        ActiveForm::end();
        ?>
    </div>
    <div>
        <?= GridView::widget([
            'dataProvider' => $votes,
            'columns' => [
                'KalamNumber',
                'ElectorNumber',
                ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}', 'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = Yii::$app->urlManager->createUrl(['site/delete-vote?id=' . $model->VoteId]);
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-trash"]);
                        return Html::a($icon, $url);
                    }
                ]],
            ],
        ]); ?>
    </div>
</div>