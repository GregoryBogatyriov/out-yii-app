<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;

$this->title = ' Регистрация (подтверждение)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reg container">
    <h1><?= Html::encode($this->title) ?></h1>
		
		<?php if(Yii::$app->session->hasFlash('error') ):?>
			<div class="alert alert-danger alert-dismissible" role="alert">
					<?php echo Yii::$app->session->getFlash('error'); ?>
			</div>
		<?php endif;?>
		
		
    <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'token')->textInput(['autofocus' => true]) ?>
				
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
		
</div>
