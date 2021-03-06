<?php

namespace app\controllers;

use Yii;
use app\models\Judgement;
use app\models\JudgementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TypeDoc;
use app\models\VbookLog;
use app\models\Userdt;
use app\models\profile;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\db\Query;

/**
 * JudgementController implements the CRUD actions for Judgement model.
 */
class JudgementController extends Controller {

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
     * Lists all Judgement models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JudgementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $judA = Judgement::find()
                ->orderBy([
//                    'create_at' => SORT_ASC,
                    'create_at' => SORT_DESC,
                ])
                ->limit(100)
                ->all();
        
        return $this->render('index', [
                    'judA' => $judA,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAll() {
        $searchModel = new JudgementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $judA = Judgement::find()
                ->orderBy([
//                    'create_at' => SORT_ASC,
                    'create_at' => SORT_DESC,
                ])
                ->limit(100)
                ->all();
        
        return $this->render('index', [
                    'judA' => $judA,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex_admin() {
        $searchModel = new JudgementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_admin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Judgement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Judgement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Judgement();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->black_number = Yii::$app->getSecurity()->generateRandomString(9);
            mkdir(Judgement::getUploadPath() . $model->black_number, 777);

            $model->file_name = $model->upload($model, 'file_name', $model->black_number);
            $model->save();

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Judgement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['index', 'id' => $model->id]);
//        } else {
//            return $this->renderAjax('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Judgement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Judgement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Judgement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Judgement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionConfirm($black_number, $doc_type_id) {
//        $modelN = new Judgement();
        $bN = Yii::$app->getSecurity()->generateRandomString(9);
        $model = $this->findModel($black_number, $doc_type_id);

        $a = Judgement::getUploadPath();
        $new = $a;
        $new .= $bN;
        $a .= iconv('UTF-8', 'TIS-620', $model->black_number);
        $old = $a;

        $oName = $a . '/';
        $oName .= iconv('UTF-8', 'TIS-620', $model->file_name);
//        $oName = $a.'/111.pdf';
        $nName = md5($model->file_name . time()) . '.pdf';

        $nNamelink = $a . '/' . $nName;
        rename($oName, $nNamelink); // ชื่อ

        rename($old, $new); //floder

        $model->black_number = $bN;
        $model->file_name = $nName;
        $model->upload_by = '';
        $model->transfer_status = 1;
//
        $model->save();
        return $this->redirect(['index', 'black_number' => $model->black_number, 'filename' => $model->file_name]);
    }

    public function actionViewconf($black_number, $doc_type_id) {
        $all_user = Userdt::find()->where(['status' => '10'])->all();
        $user_count = Userdt::find()->where(['status' => '10'])->count();
        $model = $this->findModel($black_number, $doc_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        } else {
            return $this->render('viewconf', [
                        'model' => $this->findModel($black_number, $doc_type_id),
                        'allUser' => $all_user,
            ]);
        }
    }

    public function actionUpdate($black_number, $doc_type_id) {
        $model = $this->findModel($black_number, $doc_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $photo = UploadedFile::getInstance($model, 'file_name');

            if ($photo !== null) {
                if (isset($model->file_name)) {
                    $model->deleteallfile($model->black_number);
                }
            }

            $model->file_name = $model->upload($model, 'file_name', $model->black_number);
            $model->upload_by = 'ok';
            $model->save();

            // แจ้งทาง Line
            $message = 'มีการแก้ไข ' . $model->doc_type_id . ' เรื่อง ' . $model->red_number;
            $message .= ' เรียบร้อยแล้ว สามารถดูได้ที่ เว็บภายใน';
            $message .= 'http://';
            $message .= $_SERVER['HTTP_HOST'];
            $message .= ' หัวข้อ ';
            $message .= $model->doc_type_id;
//            $res = $this->notify_message($message);            // แจ้งทาง Line

            return $this->redirect(['index', 'black_number' => $model->black_number, 'doc_type_id' => $model->doc_type_id]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdatec($black_number, $doc_type_id) {
        $model = $this->findModel($black_number, $doc_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $photo = UploadedFile::getInstance($model, 'file_name');

            if ($photo !== null) {
                if (isset($model->file_name)) {
                    $model->deleteallfile($model->black_number);
                }
            }

            $model->file_name = $model->upload($model, 'file_name', $model->black_number);

            $model->save();
            return $this->redirect(['index', 'black_number' => $model->black_number, 'doc_type_id' => $model->doc_type_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLine_alert() {
        $black_number = $_GET['black_number'];
        $doc_type_id = $_GET['doc_type_id'];
        $model = $this->findModel($black_number, $doc_type_id);

        $message = 'แจ้งทราบ! เรื่อง ' . $model->red_number;
        $message .= ' ดูรายละเอียดได้ที่ pkkjcเว็บภายใน ';
        $message .= 'http://';
        $message .= $_SERVER['HTTP_HOST'] . ' หัวข้อ' . $model->doc_type_id;
//            $message .= '/scan_system/frontend/web/index.php?r=judgement/view&black_number=';
//            $message .= $model->black_number.'&doc_type_id='.$model->black_number;
        $res = $this->notify_message($message);

        return $this->redirect(['index', 'ses' => $res]);
    }

    /**
     * Deletes an existing Judgement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $black_number
     * @param string $doc_type_id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model->deleteDirFiles($model->id)) {
            Yii::$app->session->setFlash($model->doc_type_id);
        }

        return $this->redirect(['index_admin']);
    }

    public function actionReport($black_number, $doc_type_id) {
//        $this->layout = 'em';
        $model = $this->findModel($black_number, $doc_type_id);
        $vbook_log = VbookLog::find()->where(['vbook_id' => $black_number])->all();
        $num_vlog = VbookLog::find()->where(['vbook_id' => $black_number])->count();
        $user = Userdt::find()->where(['status' => '10'])->all();
        $num_user = Userdt::find()->where(['status' => '10'])->count();

        $query = new Query;
        $query->select(['user.username AS name', 'profile.fullname', 'user.id as id'])
                ->from('user', 'status = 10')
                ->leftJoin('profile', 'user_id = user.id');
//		->limit(2); 

        $command = $query->createCommand();
        $data1 = $command->queryAll();

        $query = new Query;
        $query->select(['user_id', 'vbook_id', 'create_at'])
                ->from('vbook_log', 'user_id = $black_number');
//                ->leftJoin('profile', 'user_id = user.id');
//		->limit(2); 

        $command = $query->createCommand();
        $data2 = $command->queryAll();

        foreach ($data1 as $profile):
            $data2 = $profile;
        endforeach;


        for ($x = 0; $x < $num_user; $x++) {
            $data[$x]['headName'] = $model->red_number;
            $data[$x]['user'] = $data1[$x]['name'];
            for ($y = 0; $y < $num_vlog; $y++) {
//                if ($data2[$y]['user_id'] == $data1[$x]['id']) {
//                    $data[$x]['create_at'] = '$data2[$x][]';
//                } else {
//                    $data[$x]['create_at'] = '$data2[$x][]';
//                }
            }
        }

        return $this->render('report', [
                    'models' => $model,
                    'num_user' => $num_user,
                    'user' => $user,
                    'vbook_log' => $vbook_log,
                    'data' => $data,
                    'data2' => $data2
        ]);
    }

    //ส่งข้อความผ่าน line Notify
    public function notify_message($message) {
        $line_api = 'https://notify-api.line.me/api/notify';
//        $line_token = 'F0azI4vr7lqONb78603crxxeXCYto8xAQ2XUHhUpdiK'; //pk-test
        $line_token = 'F0azI4vr7lqONb78603crxxeXCYto8xAQ2XUHhUpdiK'; //pk-test
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Authorization: Bearer " . $line_token . "\r\n" . "Content-Length: "
                . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }

    public function actionView_download() {
        $jud = new Judgement();
        $link = 'http://';
        $link .= $_SERVER['HTTP_HOST'];
        $link .= $jud->urlfiles;
        $link .= $_GET['black_number'] . '/' . $_GET['file_name'];
        return $this->redirect($link);
    }

}
