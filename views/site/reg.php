<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;

$this->title = ' Регистрация';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reg container">
	<?php if(Yii::$app->user->isGuest):?>
		<h1><?= Html::encode($this->title) ?></h1>
		

    <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
				
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
				
        <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
				
				<?= $form->field($model, 'captcha')->widget(Captcha::className(),['captchaAction'=> '/site/captcha'] ) ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Зарегаться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
		<h4>Либо, если вы не до конца прошли процедуру регистрации через email, то перейдите по ссылке:</h4>
		
	<?php else:?>
			<div class="alert alert-danger alert-dismissible" role="alert">
					<h2>Вы уже являетесь зарегистрированным пользователем!</h2>
			</div>
	<?php endif;?>
</div>
