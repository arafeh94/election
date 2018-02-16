<?php

namespace app\models;

use app\components\Tools;
use Yii;

/**
 * This is the model class for table "electorlist".
 *
 * @property int $ElectorListId
 * @property string $Name
 * @property string $Color
 *
 * @property Candidate[] $candidates
 * @property Electorlistresult[] $electorlistresults
 */
class ElectorList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'electorlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ElectorListId'], 'required'],
            [['ElectorListId'], 'integer'],
            [['Name', 'Color'], 'string', 'max' => 255],
            [['ElectorListId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ElectorListId' => 'Elector List ID',
            'Name' => 'Name',
            'Color' => 'Color',
        ];
    }

    /**
     * @param null $kalamId
     * @return \yii\db\ActiveQuery
     */
    public function getCandidates($kalamId = null)
    {
        $query = $this->hasMany(Candidate::className(), ['ElectorListId' => 'ElectorListId']);
        if ($kalamId != null) {
            $query->innerJoin(Kalam::tableName(), Kalam::tableName() . '.KalamId' . '=' . Candidate::tableName() . '.KalamId');
            $query->innerJoin(Area::tableName(), Area::tableName() . '.AreaId' . '=' . Kalam::tableName() . '.AreaId');
            $query->innerJoin(Daaira::tableName(), Daaira::tableName() . '.DaairaId' . '=' . Area::tableName() . '.DaairaId');
            $query->where([Daaira::tableName() . '.DaairaId' => Kalam::findOne($kalamId)->area->DaairaId]);
            return $query;
        }
        return $query;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElectorListResults()
    {
        return $this->hasMany(Electorlistresult::className(), ['ElectorListId' => 'ElectorListId']);
    }
}