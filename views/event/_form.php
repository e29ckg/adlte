<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

//use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-3">
                <?php
                echo $form->field($model, 'create_date')->widget(DateTimePicker::className(), [
                    'language' => 'th',
                    'options' => ['placeholder' => 'วันที่และเวลา'],
                    //'size' => 'ms',
                    'template' => '{input}',
                    'pickButtonIcon' => 'glyphicon glyphicon-time',
                    //'inline' => true,
                    'clientOptions' => [
                        'autoclose' => true,
                        //'format' => 'dd MM yyyy - HH:ii P',
                        'todayBtn' => true
                    ]
                ])->label();
                ?>
            </div>
            <div class="col-xs-4">
                <?php
                echo $form->field($model, 'end_date')->widget(DateTimePicker::className(), [
                    'language' => 'th',
                    'options' => ['placeholder' => 'วันที่และเวลา'],
                    //'size' => 'ms',
                    'template' => '{input}',
                    'pickButtonIcon' => 'glyphicon glyphicon-time',
                    //'inline' => true,
                    'clientOptions' => [
                        'autoclose' => true,
                        //'format' => 'dd MM yyyy - HH:ii P',
                        'todayBtn' => true
                    ]
                ])->label();
                ?>
            </div>

        </div>
    </div>





    <?php
    echo $form->field($model, 'title')
            ->textInput([
                'maxlength' => true,
                'placeholder' => "ชื่อกิจกรรม"
            ])
            ->label(false)
    ?>

    <?php //= $form->field($model, 'description')->textarea(['rows' => 6,'placeholder' => "รายละเอียด"])->label(false) ?>   

    <?php
    echo $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/uploads'],
            'imageUpload' => ['/uploads'],
            'fileUpload' => ['/uploads'],
            'lang' => 'en',
            'plugins' => ['clips', 'fontcolor', 'imagemanager']
        ]
    ])
    ?>
    <?php //= $form->field($model, 'create_date')->textInput()  ?>
    <div class="input-wrap">
        <div class="clearfix">
            <?= $form->field($model, 'color')->radioList(['#FF0000' => 'RED', '#A020F0' => 'Purple', '#FFC0CB' => 'Pink', '#FFFF00' => 'Yellow'])->label('เลือกสี'); ?>
            
        </div>
        <div class="help-block"></div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

