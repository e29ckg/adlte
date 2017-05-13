<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\modeles\Vbook;

/* @var $this yii\web\View */
/* @var $model app\models\Vbook */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vbook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="box">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'book_no',
            'book_date',
            'book_name',
            'book_detail:ntext',
            'ref',
            'book_photo',
            'create_at',
            'update_at',
            [
              'attribute'=>'docs',
              'value'=>$model->listDownloadFiles('docs'),
              'format'=>'html'
            ],
            //'docs',
        ],
    ]) ?>

</div>
</div>
