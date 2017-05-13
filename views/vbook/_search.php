<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VbookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vbook-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'book_no') ?>

    <?= $form->field($model, 'book_date') ?>

    <?= $form->field($model, 'book_name') ?>

    <?= $form->field($model, 'book_detail') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <?php // echo $form->field($model, 'book_photo') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
