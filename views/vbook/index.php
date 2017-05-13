<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vbooks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
<div class="box-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<div class="box-body">
    <p>
        <?= Html::a('Create Vbook', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('เพิ่มหนังสือ',['value' => Url::to(['vbook/create']), 'title' => 'เพิ่มหนังสือ', 'class' => 'btn btn-success','id'=>'activity-create-link']); ?>

    </p>
    <?php
    Modal::begin([
        'id' => 'activity-modal',
        'header' => '<h4 class="modal-title">หนังสือ</h4>',
        'size' => 'modal-lg',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
    ]);
    Modal::end();
    ?>

<?php Pjax::begin(['id'=>'customer_pjax_id']); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
            'enablePushState' => false,
            'options' => ['id' => 'CustomerGrid'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
          //'book_no',
            'book_date',
            'book_name',
            //'book_detail:ntext',
            // 'ref',
            // 'book_photo',
            // 'create_at',
            // 'update_at',
            // 'docs',

            ['class' => 'yii\grid\ActionColumn',
              'header'=>'เครื่องมือ',
//              'template'=>'{copy}{view}{update}{delete}',
              'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{view} {update} {delete} </div>',
              'options'=> ['style'=>'width:250px;'],
              'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> VIEW', '#', [
                                    'class' => 'activity-view-link btn btn-default',
                                    'title' => 'เปิดดูข้อมูล',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#activity-modal',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> แก้ไข', '#', [
                                    'class' => 'activity-update-link btn btn-default',
                                    'title' => 'แก้ไขข้อมูล',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#activity-modal',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
                        ]);
                    },
                  'delete' => function ($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> ลบ', $url, [
                                    'class' => 'activity-delete-link btn btn-default',
                                    'title' => Yii::t('yii', 'ลบข้อมูล'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                        ]);
                  },

                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end() ?>
    </div>
</div>
    <?php $this->registerJs('
        function init_click_handlers(){
            $("#activity-create-link").click(function(e) {
                    $.get(
                        "?r=vbook/create",
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เพิ่มข้อมูลสมาชิก");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-view-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "?r=vbook/view",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เปิดดูข้อมูลVbook");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "?r=vbook/update",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("แก้ไขข้อมูลสมาชิก");
                            $("#activity-modal").modal("show");
                        }
                    );
                });

        }
        init_click_handlers(); //first run
        $("#customer_pjax_id").on("pjax:success", function() {
          init_click_handlers(); //reactivate links in grid after pjax update
        });'); ?>
