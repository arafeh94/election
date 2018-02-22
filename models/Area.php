<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $AreaId
 * @property int $DaairaId
 * @property string $Name
 *
 * @property Daaira $daaira
 * @property Kalam[] $kalams
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AreaId'], 'required'],
            [['AreaId', 'DaairaId'], 'integer'],
            [['Name'], 'string', 'max' => 255],
            [['AreaId'], 'unique'],
            [['DaairaId'], 'exist', 'skipOnError' => true, 'targetClass' => Daaira::className(), 'targetAttribute' => ['DaairaId' => 'DaairaId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AreaId' => Yii::t('app', 'Area ID'),
            'DaairaId' => Yii::t('app', 'Daaira ID'),
            'Name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaaira()
    {
        return $this->hasOne(Daaira::className(), ['DaairaId' => 'DaairaId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalams()
    {
        return $this->hasMany(Kalam::className(), ['AreaId' => 'AreaId']);
    }
}
