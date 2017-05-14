<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\JsExpression;
//use fedemotta\datatables\DataTables;
use app\models\SearchEvent;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchEvent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
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

<section class="content">
    <div class="row">

        <div class="">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <?=
                    yii2fullcalendar\yii2fullcalendar::widget([
                        'options' => [
                            'lang' => 'th',
                        //... more options to be defined here!
                        ],
                        'clientOptions' => [
                            'height' => 500,
                            'language' => 'th',
                            //'eventLimit' => TRUE,
                            'selectable' => true,
                            'selectHelper' => true,
                            'droppable' => true,
                            'editable' => true,
//          'theme'=>true,
                            'fixedWeekCount' => false,
                            'defaultDate' => date('Y-m-d'),
                            'eventClick' => new JsExpression('function(calEvent, jsEvent, view) {
                            //alert("Event: " + calEvent.id);
                            //alert("Event: " + calEvent.title);
                            //alert("Coordinates: " + jsEvent.pageX + "," + jsEvent.pageY);
                            //alert("View: " + view.name);
                            // change the border color just for fun                            
                            $(this).css("border-color", "red");
                                    $.get(
                                        "?r=event/update",
                                        {
                                            id: calEvent.id
                                        },
                                        function (data)
                                        {
                                            $("#activity-modal").find(".modal-body").html(data);
                                            $(".modal-body").html(data);
                                            $(".modal-title").html("Event");
                                            $("#activity-modal").modal("show");
                                        }
                                    );
            }'),
//          'select'=>new JsExpression($JSCode)
                        ],
                        'events' => $events
                    ]);
                    ?>
                </div>                  
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Event</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>  
            <div class="box-body">
                <div class="">
                    <?=
                    Html::button('เพิ่มกิจกรรม/งานพิธี', [
                        'value' => Url::to(['event/create']),
                        //'title' => 'Create Event',
                        'class' => 'btn btn-success',
                        'id' => 'activity-create-link'
                    ]);
                    ?>
                </div>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'title',
                        //'description:ntext',
                        'create_date',
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'เครื่องมือ',
//                        'template' => '{copy}{view}{update}{delete}',
                            'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view} {update} {delete} </div>',
                            'options' => ['style' => 'width:200px;'],
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span> VIEW', '#', [
                                                'class' => 'activity-view-link btn btn-default',
                                                //'title' => 'เปิดดูข้อมูล',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#activity-modal',
                                                'data-id' => $key,
                                                'data-pjax' => '0',
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> แก้ไข', '#', [
                                                'class' => 'activity-update-link btn btn-default',
                                                //'title' => 'แก้ไขข้อมูล',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#activity-modal',
                                                'data-id' => $key,
                                                'data-pjax' => '0',
                                    ]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span> ลบ', $url, [
                                                'class' => 'activity-delete-link btn btn-danger',
                                                //'title' => Yii::t('yii', 'ลบข้อมูล'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                                'data-method' => 'post',
                                    ]);
                                },
                            ]
                        ],
                    ],
                ]);
                ?>

            </div> 
        </div>
    </div>
</section>






<?php $this->registerJs('
    function init_click_handlers(){
        $("#activity-create-link").click(function(e) {
                $.get(
                    "?r=event/create",
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
                    "?r=event/view",
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
                    "?r=event/update",
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
            $(".fc-day-top").click(function(e) {
              var date = $(this).attr("data-date");
                    $.get(
                        "?r=event/create",{date:date},
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เพิ่มข้อมูลสมาชิก");
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
