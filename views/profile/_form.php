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


            <?= $form->field($modelUser, 'username')->textInput() ?>   



            <?php //= $form->field($modelUser, 'password_hash')->passwordInput()->label(FALSE) ?>

            <?php //$form->field($modelUser, 'email')->textInput()->label(FALSE) ?>

            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dep')->dropDownList(ArrayHelper::map(Dep::find(['st' => 1])->all(), 'id', 'name')); ?>

            <?= $form->field($model, 'id_card')->textInput(['maxlength' => 13]) ?>

            <?php //= $form->field($model, 'birthday')->textInput() ?>
            <?=
            $form->field($model, 'birthday')->widget(
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
            ]);
            ?>
            <?= $form->field($model, 'bloodtype')->dropDownList(['A' => 'A','B' => 'B','AB' => 'AB','O' => 'O',]) ?>  
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>


            <div class="row">
                <div class="col-md-2">
                    <div class="well text-center">
                        <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>
                    </div>
                </div>
                <div class="col-md-10">
                    <?= $form->field($model, 'img')->fileInput() ?>
                </div>
            </div>


            <div class="form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

