<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\ArrayHelper;
use app\models\profile;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Judgement */

$this->title = $model->black_number;
$this->params['breadcrumbs'][] = ['label' => 'Judgements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">
<!--        <div class="span6">-->
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-file"></i> </span>
                    <h5>ยืนยัน</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'scan_by')->checkBoxList(ArrayHelper::map(app\models\Userdt::find()->where(['status' => '10'])->all(),'id','username')) ?>
                    
                     <div class="form-actions">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
<!--        </div>-->
</div>
<?= print_r($allUser) ?>