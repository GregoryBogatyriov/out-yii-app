<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\reviews\models\Reviews */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
				<?php if (!Yii::$app-> user-> isGuest){?> 
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
				<?php }else{?>
				<p class="btn-danger"><strong>Чтобы оставлять отзывы, а также редактировать их и удалять, вам необходимо войти в свой профиль или зарегистрироваться</strong></p>
				<?php }?>
   
		<?php $img = $model->getImage();?>
		<?php $gallery = $model->getImages();
		//debug($gallery);?>
		
		<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'users.username',
						[
							'attribute'=> 'users.username',
							'value'=> Html::a($model->users->username, Url::to(['/reviews/reviews/authorreviews', 'id_author'=>$model->id_author])),
							'format' => 'raw',
						],
            'title',
            'text:html',
            //'image',
						[
							'attribute'=> 'image',
							'value'=> "<img src='{$img->getUrl()}'>",
							'format'=>'html',
						],
						'users.email',
						'users.phone',
            'date_create',
        ],
    ]) ?>

</div>
