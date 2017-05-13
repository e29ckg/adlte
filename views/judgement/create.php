<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Judgement */

$this->title = 'Create Judgement';
$this->params['breadcrumbs'][] = ['label' => 'Judgements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
