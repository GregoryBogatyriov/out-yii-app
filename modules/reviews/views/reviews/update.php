<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */

$this->title = 'Update Reviews: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reviews-update">
    <h1><?= Html::encode($this->title) ?></h1>

<? if(Yii::$app->user->identity['id'] == $model-> id_author) :?>			
		
		<div class="reviews-form">

			<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

			<?//= $form->field($model, 'id_city')->textInput(['maxlength' => true]) ?>
			
			<?= $form->field($user, 'username')->textInput(['maxlength' => true, 'value'=>Yii:: $app->user->identity['username'],  'disabled'=>true]) ?>

			<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'disabled'=>true]) ?>

				
			<?
				echo $form->field($model, 'text')->widget(CKEditor::className(), [
					'editorOptions' => 
							ElFinder::ckeditorOptions('elfinder',[]),
				]);
			?>

			<?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>


			<?= $form->field($model, 'id_author')->textInput(['maxlength' => true,  'disabled'=>true]) ?>

			<?= $form->field($model, 'id_city')->textInput([ 'disabled'=>true]) ?>
			
			
			<?= $form->field($model, 'image')->fileInput() ?>
			<!--Для нескольких картинок-->
			<?//= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
			
			
			<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
		
<?else :?>
<h3>Вы не можете изменять отзывы других авторов!</h3>		
<?endif;?>		

</div>
