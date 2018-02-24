<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kalam".
 *
 * @property int $KalamId
 * @property int $LocationId
 * @property int $Number
 *
 * @property Candidate[] $candidates
 * @property ElectorListResult[] $electorlistresults
 * @property LocationId $location
 * @property User[] $users
 */
class Kalam extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kalam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KalamId'], 'required'],
            [['KalamId', 'LocationId', 'Number'], 'integer'],
            [['KalamId'], 'unique'],
            [['LocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['LocationId' => 'LocationId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'KalamId' => Yii::t('app','Kalam ID'),
            'LocationId' => Yii::t('app','Location ID'),
            'Number' => Yii::t('app','Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidates()
    {
        return $this->hasMany(Candidate::className(), ['KalamId' => 'KalamId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElectorlistresults()
    {
        return $this->hasMany(Electorlistresult::className(), ['kalamId' => 'KalamId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['LocationId' => 'LocationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['KalamId' => 'KalamId']);
    }
}
