<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 1/19/2018
 * Time: 9:52 PM
 */

namespace app\modules\api\v1\controllers;

use app\models\Vote;
use yii\rest\Controller;

class IndexController extends Controller
{
    function actionIndex()
    {
        return ['state' => 'sweb service is working'];
    }

    function actionVotes()
    {
        return Vote::find()->all();
    }
}