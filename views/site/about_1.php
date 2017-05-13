<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb">
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    </div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="widget-content" >
                <div class="row-fluid">
                    <div class="span12">
                        <p>
                            This is the About page. You may modify the following file to customize its content:
                        </p>

                        <code><?= __FILE__ ?></code>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-about">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            This is the About page. You may modify the following file to customize its content:
        </p>

        <code><?= __FILE__ ?></code>
    </div>
    <hr/>
   <form class="form-horizontal" method="post" action="?r=site/logout" name="basic_validate" id="basic_validate" novalidate="novalidate">
        <input type="submit" value="Validate" class="btn btn-success">
    </form>
    <?php if(!Yii::$app->user->isGuest){echo Yii::$app->user->identity->username;}else{echo 'Guest';}?>
</div>

