<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "electorlistresult".
 *
 * @property int $ElectorListResultId
 * @property int $ElectorListId
 * @property int $kalamId
 * @property int $Votes
 *
 * @property CandidateResult[] $candidateResults
 * @property ElectorList $electorList
 * @property Kalam $kalam
 */
class ElectorListResult extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'electorlistresult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Votes', 'required'],
            [['ElectorListResultId', 'ElectorListId', 'kalamId', 'Votes'], 'integer'],
            [['ElectorListResultId'], 'unique'],
            [['ElectorListId'], 'exist', 'skipOnError' => true, 'targetClass' => Electorlist::className(), 'targetAttribute' => ['ElectorListId' => 'ElectorListId']],
            [['kalamId'], 'exist', 'skipOnError' => true, 'targetClass' => Kalam::className(), 'targetAttribute' => ['kalamId' => 'KalamId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ElectorListResult' => Yii::t('app','Elector List Result'),
            'ElectorListId' => Yii::t('app','Elector List ID'),
            'kalamId' => Yii::t('app','Kalam ID'),
            'Votes' => Yii::t('app','Votes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateResults()
    {
        return $this->hasMany(CandidateResult::className(), ['ElectorListResultId' => 'ElectorListResultId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElectorList()
    {
        return $this->hasOne(Electorlist::className(), ['ElectorListId' => 'ElectorListId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalam()
    {
        return $this->hasOne(Kalam::className(), ['KalamId' => 'kalamId']);
    }
}
