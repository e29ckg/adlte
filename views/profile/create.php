<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

$this->title = 'member';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="profile-create">-->

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'modelUser' => $modelUser,
    ]) ?>

<!--</div>-->
