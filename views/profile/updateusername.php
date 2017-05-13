<?php

use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>


<div class="box">
    <div class="box-body">
        <div class="box-header with-border"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h3 class="box-title">...</h3>
        </div>
        <div class="box-body">
            <?php
            $form = ActiveForm::begin([
                'enableAjaxValidation' => true,
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal'
                        ],
                        'id' => 'form',
            ]);
            ?>

            
                    <?php echo $form->field($modelUser, 'username')->textInput() ?>  
           
                    <?php echo $form->field($modelUser, 'password_hash')->passwordInput()->label(FALSE) ?>
                    
                    <?php echo $form->field($modelUser, 'email')->textInput()->label(FALSE) ?>

            <div class="form-actions">
                <?= Html::submitButton($modelUser->isNewRecord ? 'Create' : 'Update', ['class' => $modelUser->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

