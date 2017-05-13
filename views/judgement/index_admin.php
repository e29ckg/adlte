<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\JsExpression;
use fedemotta\datatables\DataTables;
use app\models\JudgementSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JudgementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Judgements';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">หนังสือ</h4>',
    'size' => 'modal-lg',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
]);
Modal::end();
?>
<div class="judgement-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>


        <div class="box-body">
            <p>
                <?= Html::button('<i class="fa fa-plus" aria-hidden="true"></i> เพิ่มหนังสือแจ้งทราบ', ['value' => Url::to(['event/create']), 'title' => 'Create Event', 'class' => 'btn btn-success', 'id' => 'activity-create-link']); ?>

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

            <?php Pjax::begin(['id' => 'customer_pjax_id']); ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'red_number',
                    'create_at',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'เครื่องมือ',
//              'template'=>'{copy}{view}{update}{delete}',
                        'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view} {update} {delete} </div>',
                        'options' => ['style' => 'width:200px;'],
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
                                    'delete' => function ($url, $model, $key) {
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
                    "?r=judgement/create",
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
                    "?r=judgement/view",
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
                    "?r=judgement/update",
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
    });

');
            ?>