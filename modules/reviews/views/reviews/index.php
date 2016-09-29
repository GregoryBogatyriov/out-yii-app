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
		
		
		
		<?php /* foreach ($reviews as $review){
			echo $review->title . '<br>';
		} */?>
		
		<?//debug ($reviews)?>
		
    <p>
        <?php if (!Yii::$app->user-> isGuest){?>
					<?= Html::a('Оставить отзыв', ['create'], ['class' => 'btn btn-success']) ?>
				<?php }else {?>
					<p class="btn-danger"><strong>Чтобы оставлять отзывы, а также редактировать их и удалять, вам необходимо войти в свой профиль или зарегистрироваться</strong></p>
				<?php }?>
    </p>
		
		
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
						/*Поля таблицы отзывов:  автор отзыва,тема отзыва, текст отзыва, иконки для просмотра, редактирования, удаления отзыва*/
            
						//'id',
						//'id_author',
						[
							'attribute'=> 'users.username',
							'value'=> function ($data){
								return Html::a($data->users->username, Url::to(['/reviews/reviews/authorreviews', 'id_author'=>$data->id_author]), ['class'=>'authorreviews', 'data-id_author'=> $data->id_author ]);
							},
							'format' => 'raw',
						],
						//'users.username',
            'id_city',
            'title',
            'text:ntext',
            'rating',
						
						

						/*Поле "actions"*/
            [
							'class' => 'yii\grid\ActionColumn',
							'header'=>'Действия',
							'template' => !Yii::$app->user-> isGuest ? "{view}{update} {delete}{link}" :  "{view}{link}" ,
						],
						
        ],
				
    ]); ?>
		
		
</div>
