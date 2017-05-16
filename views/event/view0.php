<?php

use yii\helpers\Html;

//print_r($model);
?>

            <div class="box-header with-border">
              <h3 class="box-title"><?= $model->title; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><?= $model->description; ?></strong>

              <p class="text-muted">
               <i class="fa fa-calendar"></i> <?= $model->create_date; ?>
              </p>
            
            </div>
         
