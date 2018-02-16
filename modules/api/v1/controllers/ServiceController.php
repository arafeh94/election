<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 1/19/2018
 * Time: 9:52 PM
 */

namespace app\modules\api\v1\controllers;

use app\models\ElectorListResult;
use app\models\Vote;
use yii\rest\Controller;

class ServiceController extends Controller
{
    function actionIndex()
    {
        return ['state' => 'web service is working'];
    }

    function actionVotes()
    {
        return Vote::find()->select(['KalamNumber', 'ElectorNumber'])->all();
    }


    function actionElectorResults()
    {
        return ElectorListResult::find()->with('candidateResults')->asArray()->all();
    }
}