<?php
/* @var \app\models\ElectorList[] $electoralList */

/* @var \app\models\Kalam $kalam */


use app\assets\SelectizeAssets;
use app\models\CandidateResult;
use app\models\ElectorListResult;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

SelectizeAssets::register($this);

$areas = \app\models\AdministrativeArea::find()->asArray()->all();
$locations = \app\models\Location::find()->asArray()->all();
$kalams = \app\models\Kalam::find()->asArray()->all();
$places = \app\models\UserBLL::GetPlace();

?>

<script>
    var areas = <?=json_encode($areas)?>;
    var locations = <?=json_encode($locations)?>;
    var kalams = <?=json_encode($kalams)?>;
    var places = <?=json_encode($places)?>;
</script>

<div id="sections" class="hidden">
    <div id="section1">
        <select id="area" name="area">
            <option value="" title="Tooltip"><?= Yii::t('app', 'Select Area') ?></option>
        </select>
        <select id="location" name="LocationId" required>
            <option value="" title="Tooltip"><?= Yii::t('app', 'Select Location') ?></option>
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
                valueField: 'AdministrativeAreaId',
                labelField: 'Name',
                searchField: ['Name'],
                options: areas,
                onChange: function (value) {
                    page.section2().empty();
                    page.selectLocation().disable();
                    page.selectLocation().clearOptions();
                    if (!value.length) return;
                    page.selectLocation().load(function (callback) {
                        page.selectLocation().enable();
                        var filtered = locations.filter(function (location) {
                            return location.AdministrativeAreaId == value;
                        });
                        callback(filtered);
                    });
                }
            });
            return this._selectizeArea;
        },
        selectizeLocation: function () {
            if (this._selectizeLocation) return this._selectizeLocation;
            this._selectizeLocation = $('#location').selectize({
                valueField: 'LocationId',
                labelField: 'Name',
                searchField: ['Name'],
                options: locations,
                onChange: function (value) {
                    page.section2().empty();
                    page.selectKalam().disable();
                    page.selectKalam().clearOptions();
                    if (!value.length) return;
                    page.selectKalam().load(function (callback) {
                        page.selectKalam().enable();
                        var filtered = kalams.filter(function (kalam) {
                            return kalam.LocationId == value;
                        });
                        callback(filtered);
                    });
                }
            });
            return this._selectizeLocation;
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
        },
        selectLocation: function () {
            return this.selectizeLocation()[0].selectize;
        }
    };


    window.addEventListener('load', function (ev) {
        page.selectKalam();
        page.selectLocation();
        page.selectArea();
        page.sections().removeClass('hidden');
        page.selectLocation().disable();
        page.selectKalam().disable();
        if (places.AdministrativeAreaId) {
            page.selectArea().setValue(places.AdministrativeAreaId);
            page.selectArea().disable();
        }
        if(places.LocationId){
            page.selectLocation().setValue(places.LocationId);
            page.selectLocation().disable();
        }
    });

</script>
