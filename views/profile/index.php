<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii2mod\alert\Alert;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'member';
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
if (Yii::$app->session->hasFlash('success')){echo Alert::widget();};
?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Bordered Table</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p class="pull-left"><a class="btn btn-danger" href="?r=profile/create"><i class="glyphicon glyphicon-plus"></i> เพิ่ม <?= $this->title; ?></a></p>
        <p class="pull-right">
            <?php
            $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => [ 'data-pjax' => true, 'class' => 'form-inline pull-right'
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
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th style="width: 10px">profile_id</th>
                    <th class="text-center">user_id</th>
                    <th class="text-center">ชื่อ-สกุล</th>
                    <th class="text-center" style="width: 200px">Login Username</th>
                    <th class="text-center" style="width: 350px">เครื่องมือ</th>
                </tr>

                <?php foreach ($models as $profile): ?>
                    <tr>
                        <td class="text-center" ><?= $profile->id ?></td>
                        <td class="text-center" ><?= $profile->user_id ?></td>
                        <td  ><a class="activity-view-link" href="#" data-id="<?= $profile->id ?>"><?= $profile->fullname ?></a><?php
                            if ($profile->user['status'] == 0) {
                                echo ' <span class="label label-warning">ระงับ</span>';
                            }
                            ?>  </td>
                        <td class="text-center" ><a class="activity-updateU-link" href="#" data-id ="<?= $profile->id ?>"><?= $profile->user['username']; ?></a>
                        </td>
                        <td>                                
                            <a class="btn btn-info btn-xs" href="?r=profile/resetpass&id=<?= $profile->id ?>" data-id="<?= $profile->id ?>" >Reset Password</a>
                            <a class="activity-update-link btn btn-primary btn-xs" href="#" data-id="<?= $profile->id ?>" >แก้ไขข้อมูลผู้ใช้</a>
                            <?php if ($profile->user['status'] == 0) { ?>
                                <a class="btn btn-warning btn-xs" href="?r=profile/enableuser&id=<?= $profile->id ?>" >สั่งเปิดการใช้</a>
                                <a class="btn btn-danger btn-xs" href="?r=profile/delete&id=<?= $profile->id ?>" onclick="return confirm('คุณแน่ใจที่จะลบข้อมูล')">ลบ</a>
                            <?php } else { ?>
                                <a class="btn btn-info btn-xs" href="?r=profile/suspend&id=<?= $profile->id ?>" >สั่งระงับ</a>
                            <?php } ?>
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
                var fID = $(this).data("id");
                $.get(
                    "?r=profile/view",
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
                var fID = $(this).data("id");
                $.get(
                    "?r=profile/update",
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
            $(".activity-updateU-link").click(function(e) {
                var fID = $(this).data("id");
                $.get(
                    "?r=profile/updateusername",
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

