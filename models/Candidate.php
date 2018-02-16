<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "candidate".
 *
 * @property int $CandidateId
 * @property int $ElectorListId
 * @property int $KalamId
 * @property int $Number
 * @property string $Name
 *
 * @property Kalam $kalam
 * @property Electorlist $electorList
 * @property Candidateresult[] $candidateresults
 */
class Candidate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'candidate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CandidateId'], 'required'],
            [['CandidateId', 'ElectorListId', 'KalamId', 'Number'], 'integer'],
            [['Name'], 'string', 'max' => 255],
            [['CandidateId'], 'unique'],
            [['KalamId'], 'exist', 'skipOnError' => true, 'targetClass' => Kalam::className(), 'targetAttribute' => ['KalamId' => 'KalamId']],
            [['ElectorListId'], 'exist', 'skipOnError' => true, 'targetClass' => Electorlist::className(), 'targetAttribute' => ['ElectorListId' => 'ElectorListId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CandidateId' => 'Candidate ID',
            'ElectorListId' => 'Elector List ID',
            'KalamId' => 'Kalam ID',
            'Number' => 'Number',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalam()
    {
        return $this->hasOne(Kalam::className(), ['KalamId' => 'KalamId']);
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
    public function getCandidateresults()
    {
        return $this->hasMany(Candidateresult::className(), ['CandidateId' => 'CandidateId']);
    }
}
