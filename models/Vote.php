<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vote".
 *
 * @property int $VoteId
 * @property int $KalamNumber
 * @property int $ElectorNumber
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KalamNumber', 'ElectorNumber'], 'required'],
            [['KalamNumber', 'ElectorNumber'], 'integer', 'min' => 1, 'max' => 999],
            [['ElectorNumber'], 'unique', 'targetClass' => Vote::className(), 'targetAttribute' => ['ElectorNumber', 'KalamNumber']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VoteId' => 'Vote ID',
            'KalamNumber' => 'Kalam Number',
            'ElectorNumber' => 'Elector Number',
        ];
    }
}
