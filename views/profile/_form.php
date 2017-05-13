<?php

use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dep;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="box">
    <div class="box-body">
        <div class="box-header with-border"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h3 class="box-title">เพิ่มเอกสาร/หนังสือเวียน</h3>
        </div>
        <div class="box-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal'
                        ],
                        'id' => 'form',
            ]);
            ?>

            
                    <?= $form->field($modelUser, 'username')->textInput() ?>   
                    

           
                    <?php //= $form->field($modelUser, 'password_hash')->passwordInput()->label(FALSE) ?>
                    
                    <?php //= $form->field($modelUser, 'email')->textInput()->label(FALSE) ?>
                    
                    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                
                    <?= $form->field($model, 'dep')->dropDownList(ArrayHelper::map(Dep::find(['st' => 1])->all(), 'id', 'name'));?>
            
                    <?= $form->field($model, 'id_card')->textInput(['maxlength' => 13]) ?>
                
                    <?php //= $form->field($model, 'birthday')->textInput() ?>
                    <?= $form->field($model, 'birthday')->widget(
        DatePicker::className(), [
          'options' => ['placeholder' => 'Select issue date ...'],
            // inline too, not bad
//             'inline' => false,
             // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'language' => 'th',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
    ]);?>
                
                    <?= $form->field($model, 'img')->fileInput() ?>
                

            <div class="form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

