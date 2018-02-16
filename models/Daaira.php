<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "daaira".
 *
 * @property int $DaairaId
 * @property string $Name
 *
 * @property Area[] $areas
 */
class Daaira extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daaira';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DaairaId'], 'required'],
            [['DaairaId'], 'integer'],
            [['Name'], 'string', 'max' => 255],
            [['DaairaId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DaairaId' => 'Daaira ID',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Area::className(), ['DaairaId' => 'DaairaId']);
    }
}
