<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JudgementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="judgement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'black_number') ?>

    <?= $form->field($model, 'doc_type_id') ?>

    <?= $form->field($model, 'black_append') ?>

    <?= $form->field($model, 'red_number') ?>

    <?php // echo $form->field($model, 'doc_style_id') ?>

    <?php // echo $form->field($model, 'file_name') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <?php // echo $form->field($model, 'scan_by') ?>

    <?php // echo $form->field($model, 'scan_datetime') ?>

    <?php // echo $form->field($model, 'upload_by') ?>

    <?php // echo $form->field($model, 'upload_datetime') ?>

    <?php // echo $form->field($model, 'transfer_status') ?>

    <?php // echo $form->field($model, 'file_page') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
