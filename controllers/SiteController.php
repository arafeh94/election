<?php

namespace app\controllers;

use app\components\Tools;
use app\models\CandidateResult;
use app\models\ElectorList;
use app\models\ElectorListResult;
use app\models\forms\ElectoralListResultForm;
use app\models\forms\LoginForm;
use app\models\Kalam;
use app\models\Vote;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add-vote', 'add-result', 'logout', 'delete-vote', 'delete-result'],
                'rules' => [
                    [
                        'actions' => ['add-vote', 'add-result', 'logout', 'delete-vote', 'delete-result'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->goHome();
        }
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAddVote($result = null)
    {
        $vote = new Vote();
        if ($vote->load(Yii::$app->request->post()) && $vote->validate()) {
            $result = $vote->save();
            $vote = new Vote();
        }
        return $this->render('add_vote', [
            'vote' => $vote,
            'votes' => new ActiveDataProvider(['query' => Vote::find()]),
            'result' => $result,
            'kalam' => Yii::$app->user->identity->kalam,
        ]);
    }

    public function actionDeleteVote($id)
    {
        $vote = Vote::findOne($id);
        $result = $vote->delete();
        return $this->redirect(['site/add-vote']);
    }

    public function actionAddResult($kalamId = null)
    {
        $request = Yii::$app->request;
        $error = [];
        if ($request->post()) {
            $eList = $request->post('ElectorListResult');
            $cLists = $request->post('CandidateResult');
            foreach ($eList as $i => $item) {
                $candidateVotes = array_sum(ArrayHelper::getColumn($cLists[$i], 'Votes'));
                if ($candidateVotes > $item['Votes']) {
                    $error[] = 'invalid input, candidates votes bigger than the list votes';
                }
            }
            foreach ($eList as $i => $item) {
                $listResult = new ElectorListResult();
                $listResult->load($item, '');
                $listResult->validate();
                $listResult->save();
                foreach ($cLists[$i] as $cItem) {
                    $candidateResult = new CandidateResult();
                    $candidateResult->load($cItem, '');
                    $candidateResult->ElectorListResultId = $listResult->ElectorListResultId;
                    $candidateResult->validate();
                    $candidateResult->save();
                }
            }
        }


        return $this->render('add_result', [
            'electoralList' => ElectorList::find()->all(),
            'kalam' => Yii::$app->user->identity->kalam,
            'error' => $error,
        ]);
    }
}
