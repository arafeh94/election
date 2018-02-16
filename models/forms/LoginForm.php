<?php

namespace app\models\forms;

use app\components\Tools;
use app\models\User;
use yii\base\Model;

class LoginForm extends Model
{
    public $username = null;
    public $password = null;
    private $user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'min' => 3, 'max' => 16],
            [['username'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'Username']],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || $this->password != $user->Password) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    private function getUser()
    {
        if ($this->user == null) {
            return User::findOne(['username' => $this->username]);
        }
        return $this->user;
    }

}