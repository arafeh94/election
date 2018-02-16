<?php

namespace app\models\forms;

use app\components\Tools;
use app\models\User;
use yii\base\Model;

class ElectoralListResultForm extends Model
{
    public $listId = null;

    public $votes = null;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'min' => 3, 'max' => 16],
            [['username'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'Username']],
            ['password', 'validatePassword']
        ];
    }


}