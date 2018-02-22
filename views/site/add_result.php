<?php
/* @var \app\models\ElectorList[] $electoralList */

/* @var \app\models\Kalam $kalam */


use app\assets\SelectizeAssets;
use app\models\CandidateResult;
use app\models\ElectorListResult;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

SelectizeAssets::register($this);

$areas = \app\models\Area::find()->asArray()->all();
$kalams = \app\models\Kalam::find()->asArray()->all();

?>

<script>
    var areas = <?=json_encode($areas)?>;
    var kalams = <?=json_encode($kalams)?>;
</script>

<div id="sections" class="hidden">
    <div id="section1">
        <select id="area" name="area">
            <option value="" title="Tooltip"><?= Yii::t('app', 'Select Area') ?></option>
        </select>
        <select id="kalam" name="kalam">
            <option value="" title="Tooltip"><?= Yii::t('app', 'Select Kalam') ?></option>
        </select>
    </div>
    <div id="section2">
    </div>
</div>


<script>
    var page = {
        user: <?=json_encode(['Type' => Yii::$app->user->identity->Type, 'PlaceId' => Yii::$app->user->identity->PlaceId])?>,
        sections: function () {
            return $('#sections');
        },
        section1: function () {
            return $('#section1');
        },
        section2: function () {
            return $('#section2');
        },
        selectizeArea: function () {
            if (this._selectizeArea) return this._selectizeArea;
            this._selectizeArea = $('#area').selectize({
                valueField: 'AreaId',
                labelField: 'Name',
                searchField: ['name'],
                options: areas,
                onChange: function (value) {
                    if (!value.length) return;
                    page.selectKalam().disable();
                    page.selectKalam().clearOptions();
                    page.selectKalam().load(function (callback) {
                        page.selectKalam().enable();
                        var filtered = kalams.filter(function (kalam) {
                            return kalam.AreaId == value;
                        });
                        callback(filtered);
                    });
                }
            });
            return this._selectizeArea;
        },
        selectizeKalam: function () {
            if (this._selectizeKalam) return this._selectizeKalam;
            this._selectizeKalam = $('#kalam').selectize({
                valueField: 'KalamId',
                labelField: 'Number',
                onChange: function (value) {
                    page.section2().empty();
                    if (!value.length) return;
                    page.section2().append('<div class=loader style="margin:auto;margin-top: 16px"></div>');
                    $.get('http://localhost/election/web/site/add-result-form?id=' + value, function (data) {
                        page.section2().empty();
                        page.section2().append(data);
                    })
                }
            });
            return this._selectizeKalam;
        },
        selectArea: function () {
            return this.selectizeArea()[0].selectize;
        },
        selectKalam: function () {
            return this.selectizeKalam()[0].selectize;
        }
    };


    window.addEventListener('load', function (ev) {
        page.selectKalam();
        page.selectArea();
        page.sections().removeClass('hidden');
        if (page.user.Type == 2) {
            page.selectArea().setValue(page.user.PlaceId);
            page.selectArea().disable();
        } else {
            page.selectKalam().disable();
        }
    });

</script>
