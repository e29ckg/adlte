<?php

use yii\helpers\Html;

//print_r($model);
?>

            <div class="box-header with-border">
              <h3 class="box-title"><?= $model->title; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-newspaper-o margin-r-5"></i> <?= $model->description; ?></strong>

              <p class="text-muted">
               <i class="fa fa-calendar"></i> <?= $model->create_date; ?>
              </p>
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>