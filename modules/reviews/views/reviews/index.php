<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр отзывов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>

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

            'id',
            'id_city',
            'title',
            'text:ntext',
            'rating',
            // 'img',
            // 'id_author',
            // 'date_create',

						/*Поле "actions"*/
            [
							'class' => 'yii\grid\ActionColumn',
							'header'=>'Действия',
							'template' => !Yii::$app->user-> isGuest ? "{view}{update} {delete}{link}" :  "{view}{link}" ,
						],
						
        ],
    ]); ?>
</div>
