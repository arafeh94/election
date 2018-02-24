<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 1/19/2018
 * Time: 9:52 PM
 */

namespace app\modules\api\v1\controllers;

use app\components\Tools;
use app\models\Area;
use app\models\Candidate;
use app\models\Daaira;
use app\models\ElectorList;
use app\models\ElectorListResult;
use app\models\Kalam;
use app\models\User;
use app\models\Vote;
use yii\rest\Controller;
use yii\web\Request;

class SyncController extends Controller
{
    function actionIndex()
    {
        return ['state' => 'web service is working'];
    }

    static function save($model, $rows)
    {
        $results = [];
        $model = "app\\models\\" . $model;
        foreach ($rows as $row) {
            $dataObject = new $model;
            $dataObject->load($row, '');
            $dataObject->save();
            if ($dataObject->hasErrors()) {
                $results[] = $dataObject->errors;
            } else {
                $results[] = ['id' => $dataObject->getPrimaryKey()];
            }
        }
        return $results;
    }

    function actionDaaira()
    {
        return self::save('Daaira', \Yii::$app->request->post());
    }

    function actionArea()
    {
        return self::save('Area', \Yii::$app->request->post());
    }

    function actionKalam()
    {
        return self::save('Kalam', \Yii::$app->request->post());
    }

    function actionUser()
    {
        return self::save('User', \Yii::$app->request->post());
    }

    function actionElectorList()
    {
        return self::save('ElectorList', \Yii::$app->request->post());
    }

    function actionCandidate()
    {
        return self::save('Candidate', \Yii::$app->request->post());
    }

    function actionLocation()
    {
        return self::save('Location', \Yii::$app->request->post());
    }

    function actionAdministrativeArea()
    {
        return self::save('AdministrativeArea', \Yii::$app->request->post());
    }
}