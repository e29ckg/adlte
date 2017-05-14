<?php

use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Dashboard!';
//print_r($events) ;
?>
<?php
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">header</h4>',
    'size' => 'modal-md',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
]);
Modal::end();
?>

<section class="content">
    <!--<div class="row">-->
    <!--<div class="pad margin no-print">-->
    <!--            <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    <marquee scrollamount="5"><h4>ความเร็วในการวิ่ง 5 ทดสอบอักษรวิ่ง
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </h4>
                    </marquee>
                </div>-->
    <!--</div>-->
    <!--</div>-->
    <div class="row">
        <div class="col-md-12">
        <div class="callout callout-info" style="margin-bottom: 10px">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <marquee scrollamount="5"><h4>ความเร็วในการวิ่ง 5 ทดสอบอักษรวิ่ง
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </h4>
            </marquee>
        </div>
            </div>
        <div class="col-md-4">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ประกาศล่าสุด!</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">หนังสือทราบทั่วกัน</a></li>

                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <!--/.item -->
                                <?php foreach ($judA as $judAA) { ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div> 
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title"><?= $judAA->red_number; ?>
                                                <!--<span class="label label-warning pull-right">$1800</span>-->
                                            </a>
                                            <span class="product-description">
                                                <i class="fa fa-clock-o"></i> <?= $judAA->create_at; ?>
                                            </span>
                                        </div>
                                    </li>
                                <?php } ?>

                                <!--/.item -->
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="?r=judgement/all" class="uppercase">ดูทั้งหมด</a>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <!--/.item -->
                                <?php foreach ($judB as $judBB) { ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div> 
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title"><?= $judBB->red_number; ?>
                                                <!--<span class="label label-warning pull-right">$1800</span>-->
                                            </a>
                                            <span class="product-description">
                                                <?= $judBB->create_at; ?>
                                            </span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="?r=judgement/all" class="uppercase">ดูทั้งหมด</a>
                        </div>

                    </div>
                    <!-- /.tab-pane -->

                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
        <div class="col-md-8">    
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ปฏิทินกิจกรรม</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body no-padding">
                        <?=
                        yii2fullcalendar\yii2fullcalendar::widget([
                            'id' => 'calendar',
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
                                        "?r=event/view0",
                                        {
                                            id: calEvent.id
                                        },
                                        function (data)
                                        {
                                            $("#activity-modal").find(".modal-body").html(data);
                                            $(".modal-body").html(data);
                                            $(".modal-title").html("Event " + calEvent.id);
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
        </div>



    </div>
</section>
