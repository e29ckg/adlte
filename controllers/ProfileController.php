<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Profile;
use app\models\Userdt;
use app\models\Dep;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['index','index_admin', 'view', 'create', 'update', 'delete', 'suspend', 'enableuser'], //action ทั้งหมดที่มี
                'rules' => [
                    [
//                        'actions' => ['index','index_admin', 'view', 'create', 'update', 'delete', 'suspend', 'enableuser'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex() {

        $modelUser = $this->findModelUser(Yii::$app->user->identity->id);
        $model = Profile::find()->where(['user_id' => $modelUser->id])->one();
        return $this->render('index', [
                    'model' => $model,
                    'modelUser' => $modelUser,
        ]);
    }

    public function actionIndex_admin() {
        $query = Profile::find();


//        $modelUser = User::find()->all();
        if (!empty($_GET['q'])) {

            $query = $query->where(['LIKE', 'fullname', $_GET['q']]);
        } else {
            $query = Profile::find();
        }

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $models = $query->orderBy(['create_at' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index_admin', [
                    'models' => $models,
//                    'modelUser' => $modelUser,
                    'pagination' => $pagination,
        ]);
    }

    public function actionIndexdep() {
        $query = Dep::find();


//        $modelUser = User::find()->all();
        if (!empty($_GET['q'])) {

            $query = $query->where(['LIKE', 'name', $_GET['q']]);
        } else {
            $query = Dep::find();
        }

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $models = $query->orderBy(['name' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index_dep', [
                    'models' => $models,
                    'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Profile();
        $modelUser = new Userdt();

        if (Yii::$app->request->isAjax && $modelUser->load(Yii::$app->request->post())) {

            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelUser, $model);
        }

        if ($model->load(Yii::$app->request->post()) &&
                $modelUser->load(Yii::$app->request->post()) &&
                Model::validateMultiple([$model, $modelUser])) {

            $modelUser->password_hash = Yii::$app->security->generatePasswordHash('password');
            $modelUser->auth_key = Yii::$app->security->generateRandomString();
            $modelUser->email = Yii::$app->security->generateRandomString(9) . '@coj.go.th';
//            $modelUser->updated_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
            $modelUser->save();

            $model->user_id = $modelUser->id;
            $model->img = $model->upload($model, 'img');
            $model->save();

            return $this->redirect(['index_admin', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
                        'modelUser' => $modelUser,
            ]);
        }
    }

    public function actionCreatedep() {
        $model = new Dep();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['indexdep', 'id' => $model->id]);
        } else {
            return $this->renderAjax('createdep', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $modelUser = $this->findModelUser($model->user_id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $modelUser->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model, $modelUser);
        }

        $imgOld = $model->img;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $photo = UploadedFile::getInstance($model, 'img');
            $path = $model->getUploadPath();

            if ($model->validate() && $photo !== null) {
                $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
                //$fileName = $photo->baseName . '.' . $photo->extension;
                $photo->saveAs($path . $fileName);
                $model->img = $fileName;
                if ($imgOld) {
                    $model->delphoto($imgOld);
                }
            } else {
                $model->img = $imgOld;
            }
            $model->save();
            if ($modelUser->load(Yii::$app->request->post()) && $model->validate()) {
                $modelUser->save();
            }
            Yii::$app->session->setFlash('success', 'บันทักเรียบร้อย');
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
                        'modelUser' => $modelUser,
            ]);
        }
    }

    public function actionResetpass($id) {

        $model = $this->findModel($id);
        $modelUser = $this->findModelUser($model->user_id);
        $oldPass = $modelUser->password_hash;
        $modelUser->password_hash = Yii::$app->security->generatePasswordHash('password');
        if ($modelUser->save()) {
            Yii::$app->session->setFlash('success', 'Reset Password เรียบร้อย');
            return $this->redirect(['index', 'masss' => $model->username . '-' . 'password' . '-' . $modelUser->password_hash]);
        }
        Yii::$app->session->setFlash('success', 'NOT Save');
        return $this->redirect(['index', 'masss' => $model->username . '-' . 'password' . '-' . $modelUser->password_hash]);
    }

    public function actionUpdatedep($id) {

        $model = $this->findModeldep($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['indexdep', 'id' => $model->id]);
        } else {
            return $this->renderAjax('updatedep', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSuspend($id) {
        $modelProfile = $this->findModel($id);
        $modelUser = $this->findModelUser($modelProfile->user_id);
        $modelUser->status = 0;
        $modelUser->save();

        return $this->redirect(['index_admin']);
    }

    public function actionEnableuser($id) {
        $modelProfile = $this->findModel($id);
        $modelUser = $this->findModelUser($modelProfile->user_id);
        $modelUser->status = 10;
        $modelUser->save();
        return $this->redirect(['index_admin']);
    }

    public function actionDelete($id) {
        $modelUser = $this->findModel($id);
        $this->findModelUser($modelUser->user_id)->delete();
        $model = $this->findModel($id);
        if ($model->img) {
            $model->delphoto($model->img);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModeldep($id) {
        if (($model = dep::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUser($id) {
        if (($model = Userdt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
