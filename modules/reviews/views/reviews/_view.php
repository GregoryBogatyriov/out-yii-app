<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */


$this->title = $review->title;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
				<?php if (!Yii::$app-> user-> isGuest){?> 
			 <p>
					<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('Delete', ['delete', 'id' => $model->id], [
							'class' => 'btn btn-danger',
							'data' => [
									'confirm' => 'Are you sure you want to delete this item?',
									'method' => 'post',
							],
					]) ?>
				</p>
				<?php }else{?>
				<p class="btn-danger"><strong>Чтобы оставлять отзывы, а также редактировать их и удалять, вам необходимо войти в свой профиль или зарегистрироваться</strong></p>
				<?php }?>
   
			<h1>Здесь должен быть отзыв</h1>
			<?debug ($review)?> 
			<?echo $review->title. '<br>';?>
			<?echo $review->text. '<br>';?>
			<?echo $review->users-> username. '<br>';?>
			<?echo $review->users-> email. '<br>';?>
			<?= $review->users-> phone ? $review->users-> phone. '<br>' : 'Телефон не указан <br>'?>
			<?debug ($review->users) ;?>

</div>
