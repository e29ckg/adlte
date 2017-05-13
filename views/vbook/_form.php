<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Vbook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vbook-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php //echo $form->field($model, 'book_no')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'book_date')->textInput() ?>
    <?= $form->field($model, 'book_date')->widget(
        DatePicker::className(), [
          'options' => ['placeholder' => 'Select issue date ...'],
            // inline too, not bad
             'inline' => false,
             // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'language' => 'th',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
    ]);?>

    <?= $form->field($model, 'book_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_detail')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'book_photo')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'create_at')->textInput() ?>

    <?php //= $form->field($model, 'update_at')->textInput() ?>

    <?php //= $form->field($model, 'file')->fileinput() ?>
    <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
    'options' => [
      //'accept' => 'image/*'
      'multiple' => true
    ],
    'pluginOptions' => [
        'initialPreview'=>$model->initialPreview($model->docs,'docs','file'), //<-----
        'initialPreviewConfig'=>$model->initialPreview($model->docs,'docs','config'),//<-----
//        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf','PDF','jpg'],
        'showPreview' => true,
        'showRemove' => false,
        'showUpload' => false
     ]
]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
