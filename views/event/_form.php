<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_date')->widget(DateTimePicker::className(), [
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
])->label(false) ;?>


    <?php echo $form->field($model, 'title')
        ->textInput([
            'maxlength' => true ,
            'placeholder' => "ชื่อกิจกรรม"
            ])
        ->label(false) ?>

    <?php //= $form->field($model, 'description')->textarea(['rows' => 6,'placeholder' => "รายละเอียด"])->label(false) ?>   

    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?php //= $form->field($model, 'create_date')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

