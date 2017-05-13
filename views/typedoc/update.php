<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypeDoc */

$this->title = 'แก้ไข : ' . $model->type_doc_name;
$this->params['breadcrumbs'][] = ['label' => 'Type Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_type, 'url' => ['view', 'id' => $model->id_type]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-doc-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
