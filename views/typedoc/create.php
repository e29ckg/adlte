<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TypeDoc */

$this->title = 'judgement';
$this->params['breadcrumbs'][] = ['label' => 'Type Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-doc-create">
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
