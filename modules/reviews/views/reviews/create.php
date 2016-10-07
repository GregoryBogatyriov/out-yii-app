<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\users\models\Users;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */

$this->title = 'Create Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>
		

		
		
		<div class="reviews-form">

				<?php $form = ActiveForm::begin(); ?>

				<?//= $form->field($model, 'id_city')->textInput(['maxlength' => true]) ?>
				
				<?= $form->field($user, 'username')->textInput(['maxlength' => true, 'value'=>Yii:: $app->user->identity['username'],  'disabled'=>true]) ?>

				<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

				<?
					echo $form->field($model, 'text')->widget(CKEditor::className(), [
						'editorOptions' => 
								ElFinder::ckeditorOptions('elfinder',[]),
					]);
				?>

				<?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>


				<?= $form->field($model, 'id_author')->textInput(['maxlength' => true, 'value'=> Yii:: $app->user->identity['id'], 'readonly'=>true ]) ?>

				<?= $form->field($model, 'id_city')->textInput() ?>
				
				<?= $form->field($model, 'image')->fileInput() ?>
				<!--Для нескольких картинок-->
				<?//= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
				
				<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>

				<?php ActiveForm::end(); ?>

		</div>

</div>
