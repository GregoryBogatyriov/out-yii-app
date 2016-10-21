<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\reviews\models\Reviews;
use app\modules\users\models\Users;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?php

//debug ($users);


?> 
<?php if (!Yii::$app->user-> isGuest):?>
	<div class="table table-responsive" style="margin-top:80px; margin-bottom: 60px">
		<table class="table table-hover table-striped" style="border: 3px #cfcfcf solid">
			<thead>
		<? foreach ($reviews as $review=>$value):?>
			<tbody>	
					<tr>
						<th><h3>Контакты пользователя <?= $value->users-> username?> </h3></th>
						<th></th>
					</tr>
					<tr>
						<th><h4>Почта</h4></th>
						<th><h4><?= $value->users-> email?></h4></th>
					</tr>
					<tr>
						<th><h4>Телефон</h4></th>
						<th><h4><?= $value->users-> phone?></h4></th>
					</tr>
			</tbody>
		</table>
		
		<a href="/reviews/reviews/authorreviews?id_author=<?=$value-> users->id?>">Посмотреть все отзывы</a>
		<?die;?>
		<?endforeach;?>
		
	</div>
<?php else:?>
	<p><h3 class="text-center text-danger">Чтобы видеть контакты автора отзыва, вам необходимо авторизоваться!<h3></p>
<?php endif;?> 


















