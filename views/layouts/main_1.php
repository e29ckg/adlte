<?php

//use yii\widgets\Breadcrumbs;
//use Yii;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="dist/sweetalert2.js"></script> 
        <link rel="stylesheet" href="dist/sweetalert.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/fullcalendar.css" />
        <link rel="stylesheet" href="css/matrix-style.css" />
        <link rel="stylesheet" href="css/matrix-media.css" />
        
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/jquery.gritter.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    
    </head>
    <body>

        <!--Header-part-->
        <div id="header">
            <h1><a href="">Matrix Admin</a></h1>
        </div>
        <!--close-Header-part--> 


        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php
                            if (!Yii::$app->user->isGuest) {
                                echo Yii::$app->user->identity->username;
                            } else {
                                echo 'Guest';
                            }
                            ?></span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="?r=site/logout" onclick="return confirm('คุณแน่ใจที่ ออกจากโปรแกรม')"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#" onclick="swal('Good job!','You clicked the button!','success')"><i class="icon-plus"></i> new message</a></li>
                        <li class="divider"></li>
                        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
                        <li class="divider"></li>
                        <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
                        <li class="divider"></li>
                        <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
                    </ul>
                </li>
                <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
                <li class=""><a title="" href="?r=site/logout" onclick="return confirm('คุณแน่ใจที่ ออกจากโปรแกรม')"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        <!--close-top-Header-menu-->
        <!--start-top-serch-->
        <div id="search">
            <input type="text" placeholder="Search here..."/>
            <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
        </div>
        <!--close-top-serch-->
        <!--sidebar-menu-->
        <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
            <ul>
                <li class="<?php
                if ($this->title == 'Dashboard') {
                    echo 'active';
                }
                ?>">
                    <a href="?r=site/index"><i class="icon icon-home"></i> <span>Dashboard</span></a> 
                </li>

                <li class=" <?php
                if ($this->title == 'judgement') {
                    echo 'active';
                }
                ?>" > 
                    <a href="?r=judgement/index"><i class="icon icon-inbox"></i> <span>หนังสือเวียน</span></a> 
                </li>
                <li class="<?php
                if ($this->title == 'member') {
                    echo 'active';
                }
                ?>">
                    <a href="?r=profile/index"><i class="icon icon-th"></i> <span>Member สมาชิก</span></a></li>
                <li class="<?php
                if ($this->title == 'About') {
                    echo 'active';
                }
                ?>">
                    <a href="?r=site/about"><i class="icon icon-signal"></i> <span>About</span></a> 
                </li> 
                <li class="content"> <span>Monthly Bandwidth Transfer</span>
                    <div class="progress progress-mini progress-danger active progress-striped">
                        <div style="width: 77%;" class="bar"></div>
                    </div>
                    <span class="percent">77%</span>
                    <div class="stat">21419.94 / 14000 MB</div>
                </li>
                <li class="content"> <span>Disk Space Usage</span>
                    <div class="progress progress-mini active progress-striped">
                        <div style="width: 87%;" class="bar"></div>
                    </div>
                    <span class="percent">87%</span>
                    <div class="stat">604.44 / 4000 MB</div>
                </li>
            </ul>
        </div>
        <!--sidebar-menu-->

        <!--main-container-part-->
        <div id="content">
<?= $content ?>  
        </div>

        <!--end-main-container-part-->

        <!--Footer-part-->

        <div class="row-fluid">
            <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
        </div>

        <!--end-Footer-part-->

        <script src="js/excanvas.min.js"></script> 
        <script src="js/jquery.min.js"></script> 
        <script src="js/jquery.ui.custom.js"></script> 
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/jquery.flot.min.js"></script> 
        <script src="js/jquery.flot.resize.min.js"></script> 
        <script src="js/jquery.peity.min.js"></script> 
        <script src="js/fullcalendar.min.js"></script> 
        <script src="js/matrix.js"></script> 
        <script src="js/matrix.dashboard.js"></script> 
        <script src="js/jquery.gritter.min.js"></script> 
        <script src="js/matrix.interface.js"></script> 
        <script src="js/matrix.chat.js"></script> 
        <script src="js/jquery.validate.js"></script> 
        <script src="js/matrix.form_validation.js"></script> 
        <script src="js/jquery.wizard.js"></script> 
        <script src="js/jquery.uniform.js"></script> 
        <script src="js/select2.min.js"></script> 
        <script src="js/matrix.popover.js"></script> 
        <script src="js/jquery.dataTables.min.js"></script> 
        <script src="js/matrix.tables.js"></script> 

        
        <script src="js/site.js"></script> 
      
    </body>
</html>
