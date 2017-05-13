<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypeDocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'judgement';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
         <a href="?r=judgement/index" title="" class="tip-bottom"></i> หนังสือเวียน</a>
    </div>
</div>

<div class="container-fluid">    
    <div class="row-fluid">
        <p class="pull-left">
            <a class="btn btn-info" href="?r=typedoc/create"><i class="glyphicon glyphicon-plus"></i> เพิ่มประเภทเอกสาร</a>
        </p>
        <div class="widget-box">

            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>ประเภทหนังสือ/เอกสาร</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ประเภทหนังสือ</th>                        
                            <th>เครื่องมือ</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($model as $jud): ?>
                            <tr class="gradeX">
                                <td><?= $jud->id_type ?></td>

                                <td><?= $jud->type_doc_name ?></td>


                                <td ><a class="btn btn-info btn-xs" href="?r=typedoc/update&id=<?= $jud->id_type ?>" >แก้ไข</a>
                                    <a class="btn btn-danger btn-xs" href="?r=typedoc/delete&id=<?= $jud->id_type ?>" onclick="return confirm('คุณแน่ใจที่จะลบข้อมูล')">ลบ</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
