<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="loginbox">            
    <!--<form id="loginform" class="form-vertical" action="index.html">-->
    <?php
    $form = ActiveForm::begin(['options' => ['class' => 'form-vertical']]);
    ?>
    <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
    <div class="control-group">
        <div class="controls">
            <div class="main_input_box">
                <!--<span class="add-on bg_lg"><i class="icon-user"></i></span>-->
                <!--<input type="text" placeholder="Username" />-->
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => "Username"])->label(FALSE) ?>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <div class="main_input_box">
                <!--<span class="add-on bg_ly"><i class="icon-lock"></i></span>-->
                <!--<input type="password" placeholder="Password" />-->
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Password"])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <!--<span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>-->
        <span class="pull-right">
            <!--<a type="submit" href="index.html" class="btn btn-success" /> Login</a>-->
            <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
        </span>
    </div>
    <?php ActiveForm::end(); ?>
    <!--</form>-->
    <!--            <form id="recoverform" action="#" class="form-vertical">
                                    <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
                                    
                        <div class="controls">
                            <div class="main_input_box">
                                <span class="add-on bg_lo"><i class="icon-envelope"></i></span>
                                <input type="text" placeholder="E-mail address" />
                            </div>
                        </div>
                   
                    <div class="form-actions">
                        <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                        <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                    </div>
                </form>-->
</div>
