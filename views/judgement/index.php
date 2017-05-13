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


<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>


    <div class="box-body"><div class="col-md-12">


            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <!--/.item -->
                    <?php foreach ($judA as $judAll) { ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div> 
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title"><?= $judAll->red_number; ?>
                                    <!--<span class="label label-warning pull-right">$1800</span>-->
                                </a>
                                <span class="product-description">
                                    <?= $judAll->create_at; ?>
                                </span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>       
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