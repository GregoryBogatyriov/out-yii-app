<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-view">

    <h1><?= Html::encode($this->title) ?></h1>

				<!--Пропишем условие, при котором будет выводиться флэш-сообщение -->
				<?php if( Yii::$app->session->hasFlash('success') ): ?>
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?php echo Yii::$app->session->getFlash('success'); ?>
						</div>
				<?php endif;?>
				
				<?php if( Yii::$app->session->hasFlash('error') ): ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php echo Yii::$app->session->getFlash('error'); ?>
					</div>
				<?php endif;?>
		
			 <?php if (!Yii::$app-> user-> isGuest):?> 
				 <?php if(Yii::$app->user->identity['id'] == $model-> id_author):?>
				 <p>
						<?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
						<?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-primary'], [
								'class' => 'btn btn-danger',
								'data' => [
										'confirm' => 'Are you sure you want to delete this item?',
										'method' => 'post',
								],
						]) ?>
					</p>
					<?endif;?>
				<?php else:?>
				<p class="btn-danger"><strong>Чтобы оставлять отзывы, а также редактировать их и удалять, вам необходимо войти в свой профиль или зарегистрироваться</strong></p>
				<?php endif;?>
   
				<?php $img = $model->getImage();?>
				<?php $gallery = $model->getImages();
				//debug($gallery);?>
				
				<?= DetailView::widget([
						'model' => $model,
						'attributes' => [
								[
									'attribute'=> 'users.username',
									'value'=> Html::a($model->users->username, Url::to(['/reviews/reviews/authorreviews', 'id_author'=>$model->id_author])),
									'format' => 'raw',
								],
								'title',
								'text:html',
								[
									'attribute'=> 'image',
									'value'=> "<img src='{$img->getUrl()}'>",
									'format'=>'html',
								],
								'users.email',
								'users.phone',
								//'date_create',
								
						],
				]) ?>
				
				
				
				<?//debug ($rating)?>
				
				 
				<?$count = 0; $sum = 0 ; foreach ($rating as $rate):?>
				
				<?$sum = $sum + $rate->rating?>
				<?$count = $count+1;?>
				<?endforeach;?> 
				<?if ($count !== 0):?>
					<h3>Количество оценок: <?=$count?></h3>
					<h3>Средний рейтинг отзыва: <?= round($sum / $count, 2) ?> из 5</h3>
				<?else:?>
					<div id="novotes"><h3> Оценок ещё не поставлено!</h3></div>
				<?endif;?>
				
				
				
				
				
				<?if (!Yii::$app->user->isGuest):?>
				
				<div id="voterating"><h3> Поставьте оценку отзыву</h3></div>
				
				<!--Радио-кнопки. В обработчик идут переменные id_review и rating-->
				<div id="form-wrapper">
					<form style="margin-top: 40px;" id="vote" method="post" action="/reviews/reviews/rating" review-id="<?=$model->id?>">
						
						 <input type="radio" class="rating-vote"  name="rating" value="1">1
						 <input type="radio" class="rating-vote"  name="rating" value="2">2
						 <input type="radio" class="rating-vote"  name="rating" value="3">3
						 <input type="radio" class="rating-vote"  name="rating" value="4">4
						 <input type="radio" class="rating-vote"  name="rating" value="5">5
						 
						 <input type="submit" id="send-vote"  name="id_review" value="Оценить"></p>
					</form>
				</div>
				<!--/ Радио кнопки-->
				<?else:?>
					<h3> Поставьте оценку отзыву</h3>
					<div class="alert alert-danger alert-dismissible" role="alert">
									<p><h3>Гости не могут ставить оценки</h3></p>
					</div>
				<?endif?>
				
				



				
										
				
				

</div>
