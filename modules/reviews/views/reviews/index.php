<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр отзывов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>
		
		
				<?php if( Yii::$app->session->hasFlash('success') ): ?>
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?php echo Yii::$app->session->getFlash('success'); ?>
						</div>
				<?php elseif( Yii::$app->session->hasFlash('error') ): ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php echo Yii::$app->session->getFlash('error'); ?>
					</div>
				<?php endif;?>
		
		
    <p>
        <?php if (!Yii::$app->user-> isGuest):?>
					<?= Html::a('Оставить отзыв', ['create'], ['class' => 'btn btn-success']) ?>
				<?php else :?>
					<p class="btn-danger"><strong>Чтобы оставлять отзывы, а также редактировать их и удалять, вам необходимо войти в свой профиль или зарегистрироваться</strong></p>
				<?php endif;?>
    </p>
		
		
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
						/*Поля таблицы отзывов:  автор отзыва,тема отзыва, текст отзыва, иконки для просмотра, редактирования, удаления отзыва*/
            
						[
							'attribute'=> 'users.username',
							'value'=> function ($data){
								return Html::a($data->users->username, Url::to(['/reviews/reviews/authorreviews', 'id_author'=>$data->id_author]), ['class'=>'authorreviews', 'data-id_author'=> $data->id_author ]);
							},
							'format' => 'raw',
						],
						[
							'attribute'=>'city.city',
						],
            'title',
            'text:html',
            //'rating',
            'image',
						
						

						/*Поле "actions"*/
            [
							'class' => 'yii\grid\ActionColumn',
							'header'=>'Действия',
							'template' => !Yii::$app->user-> isGuest &&  Yii::$app->user->identity['id'] == '13' ? "{view}{update} {delete}{link}" :  "{view}{link}" ,
						],
						
        ],
				
    ]); ?><!--End GridView-->
		
</div>
