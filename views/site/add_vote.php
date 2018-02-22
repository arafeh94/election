<?php

/* @var app\models\Vote $vote */
/* @var Data $votes */
/* @var bool $result */

/* @var \app\models\Kalam $kalam */

use app\assets\SelectizeAssets;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

SelectizeAssets::register($this);

$areas = \app\models\Area::find()->asArray()->all();
$kalams = \app\models\Kalam::find()->asArray()->all();

?>
<style>
    .vote-input {
        width: 50px;
        display: inline;
        margin: 4px;
    }
</style>
<script>
    var areas = <?=json_encode($areas)?>;
    var kalams = <?=json_encode($kalams)?>;
</script>

<?php $form = ActiveForm::begin([
    'id' => 'ElectoralListForm'
]); ?>
<div class="sections hidden" id="sections">
    <div id="section1">
        <select id="area" name="AreaId" required>
            <option value="" title="Tooltip"><?= Yii::t('app', 'Select Area') ?></option>
        </select>
        <select id="kalam" name="KalamId" required>
            <option value="" title="Tooltip"><?= Yii::t('app', 'Select Kalam') ?></option>
        </select>
    </div>

    <div id="section2" class="hidden">
        <div id="auto-input">
        </div>
        <input type="submit" class="btn btn-primary" value="<?= Yii::t('app', 'Submit') ?>">
    </div>

</div>

<?php ActiveForm::end() ?>

<script>
    var page = {
        input_count: 0,
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
        autoInput: function () {
            return $('#auto-input');
        },
        selectizeArea: function () {
            if (this._selectizeArea) return this._selectizeArea;
            this._selectizeArea = $('#area').selectize({
                valueField: 'AreaId',
                labelField: 'Name',
                searchField: ['Name'],
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
                searchField: ['Number'],
                onChange: function (value) {
                    if (value.length) {
                        page.section2().removeClass('hidden');
                    } else {
                        page.section2().addClass('hidden');
                    }
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

    window.addEventListener('load', function (ev) {
        var input = $("<input type=number size=3 class='auto-create form-control vote-input' min=0 max=999  data-pos=0 name='votes[0]'>");
        page.autoInput().append(input);
        page.autoInput().on('focus', '.auto-create', function () {
            if (this.getAttribute('data-pos') != page.input_count) return;
            var clone = input.clone();
            clone.val('');
            clone.attr('data-pos', ++page.input_count);
            clone.attr('name', 'votes[' + page.input_count + ']');
            page.autoInput().append(clone);
        });
        page.autoInput().on('keyup', '.auto-create', function (event) {
            if (event.target.value.length > 3) this.value = this.value.substr(0, 3);
        });
    });

</script>