<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use app\models\SearchEvent;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SearchEvent();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $events = Event::find()->all();
        
        $model = Event::find()
                ->where("create_date > 0")
                ->orderBy([
                    'create_date' => SORT_ASC,
//                    'create_date' => SORT_DESC,
                ])
                ->limit(10)
                ->all();

        $tasks = [];

        foreach ($events AS $eve) {
            //Testing
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $eve->id;
            $Event->title = $eve->title;
            $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($eve->create_date));
            $Event->end = date('Y-m-d\TH:i:s\Z',strtotime($eve->end_date));
            $Event->color = $eve->color;

            $tasks[] = $Event;
        }


        return $this->render('index', [
                    'event1' => $model,
                    'events' => $tasks,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionView0($id) {
        return $this->renderAjax('view0', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($date = null) {
        $model = new Event();
        $model->create_date = $date;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
