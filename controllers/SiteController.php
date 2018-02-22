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
    public function init()
    {
        parent::init();
        Yii::$app->language = 'ar';
    }

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

    public function actionAddVote()
    {
        if (Yii::$app->request->post()) {
            $kalamId = Yii::$app->request->post('KalamId');
            $votes = Yii::$app->request->post('votes');
            foreach ($votes as $elector) {
                $vote = new Vote();
                $vote->KalamId = $kalamId;
                $vote->ElectorNumber = $elector;
                $vote->save();
            }
        }
        return $this->render('add_vote');
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
                $listResult = $item['ElectorListResultId'] ? ElectorListResult::findOne($item['ElectorListResultId']) : new ElectorListResult();
                $listResult->load($item, '');
                $listResult->validate();
                $listResult->save();
                foreach ($cLists[$i] as $cItem) {
                    $candidateResult = $cItem['CandidateResultId'] ? CandidateResult::findOne($cItem['CandidateResultId']) : new CandidateResult();
                    $candidateResult->load($cItem, '');
                    $candidateResult->ElectorListResultId = $listResult->ElectorListResultId;
                    $candidateResult->validate();
                    $candidateResult->save();
                }
            }
            return $this->renderPartial('result', ['errors' => $error, 'success' => true, 'message' => 'added successfully']);
        }


        return $this->render('add_result', [
            'electoralList' => ElectorList::find()->all(),
            'kalam' => Yii::$app->user->identity->kalam,
            'error' => $error,
        ]);
    }

    public function actionAddResultForm($id)
    {
        $electoralListResults = ElectorListResult::findAll(['KalamId' => $id]);
        $candidateResults = [];
        $candidates = [];
        $electoralLists = ElectorList::find()->all();
        if (!$electoralListResults) {
            foreach ($electoralLists as $i => $list) {
                $electoralListResult = new ElectorListResult();
                $electoralListResult->kalamId = $id;
                $electoralListResult->ElectorListId = $list->ElectorListId;
                $electoralListResults[] = $electoralListResult;
                $candidatesResult = [];
                $listCandidate = $list->getCandidates($id)->all();
                foreach ($listCandidate as $candidate) {
                    $candidateResult = new CandidateResult();
                    $candidateResult->CandidateId = $candidate->CandidateId;
                    $candidatesResult[] = $candidateResult;
                }
                $candidates[] = $listCandidate;
                $candidateResults[] = $candidatesResult;
            }
        } else {
            foreach ($electoralLists as $i => $list) {
                $candidates[] = $list->getCandidates($id)->all();
            }
            foreach ($electoralListResults as $listResult) {
                $candidateResults[] = $listResult->candidateResults;
            }
        }
        return $this->renderPartial('form_add_results', [
            'kalam' => Kalam::findOne($id),
            'electoralListResults' => $electoralListResults,
            'candidateResults' => $candidateResults,
            'electoralLists' => $electoralLists,
            'candidates' => $candidates,
        ]);
    }
}
