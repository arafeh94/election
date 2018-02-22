<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "candidateresult".
 *
 * @property int $CandidateResultId
 * @property int $ElectorListResultId
 * @property int $CandidateId
 * @property int $Votes
 *
 * @property Electorlistresult $electorListResult
 * @property Candidate $candidate
 */
class CandidateResult extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'candidateresult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Votes', 'default', 'value' => '0'],
            [['CandidateResultId', 'ElectorListResultId', 'CandidateId', 'Votes'], 'integer', 'min' => 0],
            [['ElectorListResultId'], 'exist', 'skipOnError' => true, 'targetClass' => Electorlistresult::className(), 'targetAttribute' => ['ElectorListResultId' => 'ElectorListResultId']],
            [['CandidateId'], 'exist', 'skipOnError' => true, 'targetClass' => Candidate::className(), 'targetAttribute' => ['CandidateId' => 'CandidateId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CandidateResultId' => Yii::t('app','Candidate Result ID'),
            'ElectorListResultId' => Yii::t('app','Elector List Result ID'),
            'CandidateId' => Yii::t('app','Candidate ID'),
            'Votes' => Yii::t('app','Votes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElectorListResult()
    {
        return $this->hasOne(Electorlistresult::className(), ['ElectorListResult' => 'ElectorListResultId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidate()
    {
        return $this->hasOne(Candidate::className(), ['CandidateId' => 'CandidateId']);
    }
}
