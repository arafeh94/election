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
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId'], 'required'],
            [['UserId', 'KalamId'], 'integer'],
            [['Password'], 'string'],
            [['Username'], 'string', 'max' => 255],
            [['UserId'], 'unique'],
            [['KalamId'], 'exist', 'targetClass' => Kalam::className(), 'targetAttribute' => ['KalamId' => 'KalamId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserId' => Yii::t('app','User ID'),
            'Username' => Yii::t('app','Username'),
            'Password' => Yii::t('app','Password'),
            'KalamId' => Yii::t('app','Kalam ID'),
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
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ($token == 'election') {
            return User::findOne(['Username' => 'admin']);
        }
        return null;
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->UserId;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return "election";
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $authKey == "election";
    }
}
