<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kalam".
 *
 * @property int $KalamId
 * @property int $AreaId
 * @property int $Number
 *
 * @property Candidate[] $candidates
 * @property Electorlistresult[] $electorlistresults
 * @property Area $area
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
            [['KalamId', 'AreaId', 'Number'], 'integer'],
            [['KalamId'], 'unique'],
            [['AreaId'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['AreaId' => 'AreaId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'KalamId' => 'Kalam ID',
            'AreaId' => 'Area ID',
            'Number' => 'Number',
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
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['AreaId' => 'AreaId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['KalamId' => 'KalamId']);
    }
}
