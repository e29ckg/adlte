<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TypeDoc */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="content-header">
    <div id="breadcrumb">
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    </div>
</div>

<div class="container-fluid">    
    <div class="row-fluid">
        
        <div class="widget-box">

            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5><?= $this->title ?></h5>
            </div>
            <div class="widget-content nopadding">
                <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>

            <div class="control-group">
                    <label class="control-label">รหัส</label>
                    <div class="controls">
                       <?= $form->field($model, 'id_type')->textInput()->label(FALSE) ?>
                    </div>
                </div>
                
              <div class="control-group">
                    <label class="control-label">ชื่อประเภทหนังสือ/เอกสาร</label>
                    <div class="controls">
                       <?= $form->field($model, 'type_doc_name')->textInput(['maxlength' => true])->label(FALSE) ?>

                    </div>
                </div>  
            
            <div class="form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



