<?php

namespace app\models;

use app\components\Tools;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $UserId
 * @property string $Username
 * @property string $Password
 * @property int $KalamId
 *
 * @property Kalam $kalam
 */
class UserBLL extends User
{
    static function GetPlace()
    {
        switch (Yii::$app->user->identity->Type) {
            case 1:
                return ['AdministrativeAreaId' => Yii::$app->user->identity->PlaceId, 'LocationId' => null];
            case 2:
                return [
                    'AdministrativeAreaId' => Location::findOne(Yii::$app->user->identity->PlaceId)->AdministrativeAreaId,
                    'LocationId' => Yii::$app->user->identity->PlaceId
                ];
            default:
                return ['AdministrativeAreaId' => null, 'LocationId' => null];
        }
    }
}
