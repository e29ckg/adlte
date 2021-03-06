<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>

<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb">
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="?r=site/index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    </div>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb"> <a href="?r=site/index" onclick="alert('1234')"> <i class="icon-dashboard"></i> <span class="label label-important">20</span> My Dashboard </a> </li>
            <li class="bg_lg span3"> <a href="?r=site/login"> <i class="icon-signal"></i> Login</a> </li>
            <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span class="label label-success">101</span> Widgets </a> </li>
            <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
            <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
            <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
            <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
            <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
            <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
            <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>
        </ul>
    </div>

    <!--End-Action boxes-->   


    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>เอกสาร</h5>
            </div>
            <div class="widget-content" >
                <div class="row-fluid">
                    <div class="span12">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr/>

</div>
