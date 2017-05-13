<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use app\models\Judgement;
use app\models\SearchEvent;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'about'],
                'rules' => [
                    [
                        'actions' => ['logout', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $events = Event::find()->all();
        $tasks = [];

        foreach ($events AS $eve) {
            //Testing
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $eve->id;
            $Event->title = $eve->title;
            $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($eve->create_date));
            //$Event->end = date('Y-m-d\TH:i:s\Z',strtotime($eve->date_end.' '.$eve->time_end));
            $Event->color = '#641E16';
            //$Event->backgroundColor = '#2A55D1';
            $tasks[] = $Event;
        }

        $judA = Judgement::find()
                ->orderBy([
//                    'create_at' => SORT_ASC,
                    'create_at' => SORT_DESC,
                ])
                ->limit(5)
                ->all();
        $judB = Judgement::find()
                ->where(['doc_type_id' => ['หนังสือเวียนA', 'หนังสือเวียนB']])
                ->orderBy([
//                    'create_at' => SORT_ASC,
                    'create_at' => SORT_DESC,
                ])
                ->limit(5)
                ->all();
        $judC = Judgement::find()
                ->where(['doc_type_id' => ['ตารางเวร']])
                ->orderBy([
//                    'create_at' => SORT_ASC,
                    'create_at' => SORT_DESC,
                ])
                ->limit(5)
                ->all();




        return $this->render('index', [
                    'judA' => $judA,
                    'judB' => $judB,
                    'judC' => $judC,
                    'events' => $tasks,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        // $this->layout = 'login';   
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

}
