<?php
/* @var \app\models\ElectorList[] $electoralList */

/* @var \app\models\Kalam $kalam */


use app\models\CandidateResult;
use app\models\ElectorListResult;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

echo "<h4><b>Adding results of kalam $kalam->Number</b></h4>";

$form = ActiveForm::begin([
    'id' => 'ElectoralListForm',
    'validateOnChange' => false,
]);
foreach ($electoralList as $i => $list) {
    $electoralListResult = new ElectorListResult();
    echo "<ul class='list-group' id='elector-list-$i'>";
    echo $form->field($electoralListResult, "[$i]kalamId")->hiddenInput(['value' => $kalam->KalamId])->label(false);
    echo $form->field($electoralListResult, "[$i]ElectorListId")->hiddenInput(['value' => $list->ElectorListId])->label(false);
    echo $form->field($electoralListResult, "[$i]Votes")->textInput(['autocomplete' => 'off'])->label(ucfirst($list->Name) . ' Votes', ['onclick' => "toggle(this,$i)", 'class' => 'glyphicon-minus hover unselectable']);
    foreach ($list->getCandidates($kalam->KalamId)->all() as $j => $candidate) {
        $candidateResult = new CandidateResult();
        echo $form->field($candidateResult, "[$i][$j]CandidateId")->hiddenInput(['value' => $candidate->CandidateId])->label(false);
        echo "<li class='list-group-item child$i'>" . $form->field($candidateResult, "[$i][$j]Votes")->textInput(['autocomplete' => 'off'])->label(ucfirst($candidate->Name) . ' Votes') . '</li>';
    }
    echo '</ul>';
}

echo Html::submitButton('Add Result', ['class' => 'btn btn-primary']);
ActiveForm::end();

?>
<style>
    .hover {
        cursor: pointer
    }

    .unselectable {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>
<script>
    function toggle(span, pos) {
        span = $(span);
        var child = $('.child' + pos);
        child.toggle(200);
        if (span.hasClass('glyphicon-minus')) {
            span.removeClass('glyphicon-minus');
            span.addClass('glyphicon-plus');
        } else {
            span.removeClass('glyphicon-plus');
            span.addClass('glyphicon-minus');
        }
    }

    window.addEventListener('load', function (ev) {
        var form = $('#ElectoralListForm');
        form.on('afterValidate', function (e) {
            console.log(e);
            var electorList = $('[id^=elector-list]');
            var hasError = false;
            electorList.each(function (index) {
                var jquery = $(this);
                var electorListResult = jquery.find('#electorlistresult-' + index + '-votes');
                var candidateResults = jquery.find('[id^=candidateresult][id$=votes]');
                var electorListResultVotes = parseInt(electorListResult.val(), 10);
                var candidateResultsVotes = 0;
                candidateResults.each(function () {
                    candidateResultsVotes += parseInt(this.value, 10);
                });
                if (candidateResultsVotes > electorListResultVotes) {
                    hasError = true;
                    candidateResults.each(function () {
                        form.yiiActiveForm('updateAttribute', this.id, ["candidates total votes must be equal or less than the list votes"]);
                    });
                }
            });
            return !hasError;
        });

    });
</script>
