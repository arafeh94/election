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
            [['KalamNumber', 'ElectorNumber'], 'integer', 'min' => 1, 'max' => 999],
            [['KalamNumber'], 'unique', 'targetClass' => Vote::className(), 'targetAttribute' => 'KalamNumber'],
            [['ElectorNumber'], 'unique', 'targetClass' => Vote::className(), 'targetAttribute' => 'ElectorNumber'],
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
