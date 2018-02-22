<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vote".
 *
 * @property int $VoteId
 * @property int $KalamId
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
            [['KalamId', 'ElectorNumber'], 'required'],
            [['ElectorNumber'], 'integer', 'min' => 1, 'max' => 999],
            [['KalamId'], 'exist', 'targetClass' => Kalam::className(), 'targetAttribute' => ['KalamId' => 'KalamId']],
            [['ElectorNumber'], 'unique', 'targetClass' => Vote::className(), 'targetAttribute' => ['ElectorNumber', 'KalamId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VoteId' => Yii::t('app', 'Vote ID'),
            'KalamId' => Yii::t('app', 'Kalam Id'),
            'ElectorNumber' => Yii::t('app', 'Elector Number'),
        ];
    }
}
