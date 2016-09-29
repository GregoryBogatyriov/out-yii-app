<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\users\models\Users;

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */

$this->title = 'Create Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>
		
		<?//= Yii:: $app-> user-> identity['username']?>

		
		
		<div class="reviews-form">

				<?php $form = ActiveForm::begin(); ?>

				<?//= $form->field($model, 'id_city')->textInput(['maxlength' => true]) ?>
				
				<?= $form->field($user, 'username')->textInput(['maxlength' => true, 'value'=>Yii:: $app->user->identity['username'],  'disabled'=>true]) ?>

				<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

				<?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

				<?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'id_author')->textInput(['maxlength' => true, 'value'=> Yii:: $app->user->identity['id'], 'readonly'=>true ]) ?>

				<?= $form->field($model, 'id_city')->textInput() ?>
				
				<?//= $form->field($model, 'date_create')->textInput() ?>
				
				<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>

				<?php ActiveForm::end(); ?>

		</div>

</div>
