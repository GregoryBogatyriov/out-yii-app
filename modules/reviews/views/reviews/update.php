<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */

$this->title = 'Update Reviews: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'id_city')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($user, 'username')->textInput(['maxlength' => true, 'value'=>Yii:: $app->user->identity['username'],  'disabled'=>true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'disabled'=>true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_author')->textInput(['maxlength' => true,  'disabled'=>true]) ?>

		<?= $form->field($model, 'id_city')->textInput([ 'disabled'=>true]) ?>
		
    <?//= $form->field($model, 'date_create')->textInput() ?>
		
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
