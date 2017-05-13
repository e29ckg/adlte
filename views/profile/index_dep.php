<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตำแหน่ง';
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
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">จัดการตำแหน่ง</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p class="pull-left">
            <a id = "activity-create-link" class=" btn btn-danger" href="#"><i class="glyphicon glyphicon-plus"></i> เพิ่ม <?= $this->title; ?></a>

        </p>
        <p class="pull-right">
            <?php
            $form = ActiveForm::begin(['action' => ['indexdep'], 'method' => 'get', 'options' => [ 'data-pjax' => true, 'class' => 'form-inline pull-right'
                        ]
            ]);
            ?>
        <div class="form-group">
            <input type="text" class="form-control " name="q" id="q"  placeholder="ค้นหา" autocomplete="off">
            <button type="submit" class="btn btn-primary" id="btnSearch"><span class="glyphicon glyphicon-search"></span>
                ค้นหา
            </button>
        </div>

        <?php ActiveForm::end(); ?>
        </p>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="text-center" style="width: 50px">id</th>
                    <th class="text-center">ชื่อตำแหน่ง</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center" style="width: 175px">เครื่องมือ</th>
                </tr>

                <?php foreach ($models as $dep): ?>
                    <tr>
                        <td class="text-center" ><?= $dep->id ?></td>
                        <td class="text-center" ><?= $dep->name ?></td>
                        <td class="text-center" ><a href="?r=profile/view&id=<?= $dep->id ?>"><?= ($dep->st == 1 ? 'True' : 'False') ?></a>
                        </td>
                        <td>                                
                            <a class="btn btn-primary btn-xs activity-update-link " data-id = <?= $dep->id ?> href="#" >แก้ไข</a>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody></table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="pagination pagination-sm no-margin pull-right">
            <?= LinkPager::widget(['pagination' => $pagination]); ?>
        </div>
    </div>
</div>

<?php $this->registerJs('
    function init_click_handlers(){
        $("#activity-create-link").click(function(e) {
                $.get(
                    "?r=profile/createdep",
                    function (data)
                    {
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("เพิ่มตำแหน่ง");
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
                var fID = $(this).attr("data-id");
                $.get(
                    "?r=profile/updatedep",
                    {
                        id: fID
                    },
                    function (data)
                    {
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("แก้ไขตำแหน่ง");
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

