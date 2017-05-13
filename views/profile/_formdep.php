<?php

use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dep;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="box">
    <div class="box-body">
        <div class="box-header with-border"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h3 class="box-title">ตำแหน่ง</h3>
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

            
                    <?= $form->field($model, 'name')->textInput() ?>   
                

            <div class="form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

