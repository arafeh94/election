<?php

use app\models\CandidateResult;
use app\models\ElectorList;
use app\models\ElectorListResult;
use app\models\Kalam;
use yii\bootstrap\ActiveForm;

/* @var ElectorList[] $electoralLists */
/* @var Candidates[] $candidates */
/* @var ElectorListResult[] $electoralListResults */
/* @var CandidateResult[][] $candidateResults */
/* @var Kalam $kalam */
?>
<div class="wrapper" id="wrapper">
    <div id="loader" class="loader hidden" style="margin: auto;margin-top: 32px"></div>
    <?php
    $form = ActiveForm::begin([
        'id' => 'ElectoralListForm',
        'method' => 'post',
        'action' => ['site/add-result'],
        'validateOnChange' => false,
        'fieldConfig' => [
            'template' => "<div class='vote-div'>{label}{input}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);
    ?>
    <?php foreach ($electoralListResults as $i => $listResult): ?>
        <div class="lists">
            <div style="width: 100%;height: 40px;background-color: <?= $electoralLists[$i]->Color ?>;text-align: center;line-height: 40px;">
                <span style="color: whitesmoke"><?= ucfirst($electoralLists[$i]->Name) ?></span>
            </div>
            <ul class="vote-list" id="elector-list">
                <?= $form->field($listResult, "[$i]ElectorListResultId")->hiddenInput(['value' => $listResult->ElectorListResultId])->label(false); ?>
                <?= $form->field($listResult, "[$i]kalamId")->hiddenInput(['value' => $kalam->KalamId])->label(false); ?>
                <?= $form->field($listResult, "[$i]ElectorListId")->hiddenInput(['value' => $listResult->ElectorListId])->label(false); ?>
                <?= $form->field($listResult, "[$i]Votes")
                    ->textInput(['autocomplete' => 'off', 'class' => 'form-control vote-input', 'type' => 'number'])
                    ->label(Yii::t('app', 'List Votes'), ['onclick' => "toggle(this,$i)", 'class' => 'hover unselectable']); ?>
                <?php foreach ($candidateResults[$i] as $j => $candidateResult) : ?>
                    <?= $form->field($candidateResult, "[$i][$j]CandidateId")->hiddenInput(['value' => $candidateResult->CandidateId])->label(false); ?>
                    <?= $form->field($candidateResult, "[$i][$j]CandidateResultId")->hiddenInput(['value' => $candidateResult->CandidateResultId])->label(false); ?>
                    <li class="vote-list-item child<?= $i ?>">
                        <?= $form->field($candidateResult, "[$i][$j]Votes")->textInput(['autocomplete' => 'off', 'class' => 'vote-input form-control'])->label(ucfirst($candidates[$i][$j]->Name), ['class' => '']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
    <?= \yii\bootstrap\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'id' => 'submit']) ?>
    <?php ActiveForm::end(); ?>
</div>
<script>
    var form_page = {
        error_template: '<span class="glyphicon glyphicon-upload input-error" style="color: red"></span>',
        form: $('#ElectoralListForm'),
        loader: $('#loader'),
        wrapper: $('#wrapper')
    };
    form_page.form.on('submit', function (event) {
        event.preventDefault();
        var electorList = $('[id^=elector-list]');
        var hasError = false;
        electorList.each(function (index) {
            var jquery = $(this);
            var electorListResult = jquery.find('#electorlistresult-' + index + '-votes');
            if (electorListResult.val() == "") {
                hasError = true;
                if (!electorListResult.parent().hasClass('has-error')) {
                    electorListResult.parent().addClass('has-error');
                    electorListResult.parent().append(form_page.error_template);
                }
            }
            var candidateResults = jquery.find('[id^=candidateresult][id$=votes]');
            var electorListResultVotes = parseInt(electorListResult.val(), 10);
            var candidateResultsVotes = 0;
            debugger;
            candidateResults.each(function () {
                this.value = this.value || 0;
                candidateResultsVotes += parseInt(this.value, 10);
            });
            if (candidateResultsVotes > electorListResultVotes) {
                hasError = true;
                candidateResults.each(function () {
                    if (!$(this).parent().hasClass('has-error')) {
                        $(this).parent().addClass('has-error');
                        $(this).parent().append(form_page.error_template);
                    }
                });
            }
        });
        if (!hasError) {
            form_page.form.addClass('hidden');
            form_page.loader.removeClass('hidden');
            $.post('http://localhost/election/web/site/add-result', form_page.form.serialize(), function (data) {
                form_page.loader.addClass('hidden');
                form_page.wrapper.append(data);
            });
        }
    });
    form_page.form.on('focusin', '.form-control', function () {
        if ($(this).parent().hasClass('has-error')) {
            $(this).parent().removeClass('has-error');
            $(this).parent().find('.input-error').remove();
        }
    });

</script>
<style>
    .input-error {
        margin-right: -25px;
    }

    .vote-input {
        width: 100px;
        margin: 4px;
        display: inline-block;
    }

    .vote-div {
        display: block;
    }

    .vote-input label {
        display: inline;
    }

    .lists {
        border: 2px solid #00b3ee;
        margin: 4px;
    }

    .vote-list {
        width: 100%;
        list-style: none;
        overflow: auto;
    }

    .vote-list-item {
        width: auto;
        float: right;
        margin: 0 8px 0 0;
    }

    @media only screen and (max-device-width: 480px) {
        .vote-list-item {

        }
    }
</style>

