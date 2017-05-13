<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

$this->title = 'member';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="content-header">
    <div id="breadcrumb">
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="?r=profile/index" title="สมาชิก" class="tip-bottom"></i>member</a>
    </div>
</div>

<div class="container-fluid">
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
            <h5>เอกสาร</h5>
        </div>
        <div class="widget-content" >
            <div class="row-fluid">
                <div class="span12">
                    <TABLE class="table table-borderless table-hover ">
                        <thead >
                        <th class="text-center" >#</th>
                        <th class="text-center" >รายละเอียด</th>                
                        </thead>
                        <tbody>                    
                            <tr>
                                <td class="text-right" > id </td>
                                <td class="text-left" ><?= $model->id ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >user_id</td>
                                <td class="text-left" ><?= $model->user_id ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >Username</td>
                                <td class="text-left" ><?= $model->user['username'] ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >password</td>
                                <td class="text-left" ><?= $model->user['password_hash'] ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >ชื่อ-สกุล</td>
                                <td class="text-left" ><?= $model->fullname ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >ตำแหน่ง</td>
                                <td class="text-left" ><?= $model->dep ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >เลขบัตรประชาชน</td>
                                <td class="text-left" ><?= $model->id_card ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >วันเกิด</td>
                                <td class="text-left" ><?= $model->birthday ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >E-mail</td>
                                <td class="text-left" ><?= $model->user['email'] ?></td>                            
                            </tr>
                            <tr>
                                <td class="text-right" >รูป</td>
                                <td class="text-left" ><?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?></td>                            
                            </tr>                        
                            <tr>
                                <td class="text-right" >สถานะ</td>
                                <td class="text-left" > 
                                    <?php
                                    if ($model->user['status'] == 0) {
                                        echo ' <span class="label label-danger"><i class="glyphicon glyphicon-ban-circle"></i>ระงับการใช้งาน</span>';
                                    }
                                    ?>
                                </td>                            
                            </tr>

                        </tbody>
                    </TABLE>

                </div>
            </div>
        </div>
    </div>
</div>

<hr/>
</div>
