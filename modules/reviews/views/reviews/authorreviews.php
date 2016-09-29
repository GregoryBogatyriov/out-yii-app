<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\reviews\models\Reviews;
use app\modules\users\models\Users;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр отзывов';
$this->params['breadcrumbs'][] = $this->title;
?>


<?//debug($reviews);?>
<div class="table table-responsive" style="margin-top:80px; margin-bottom: 60px">
	<table class="table table-hover table-striped" style="border: 3px #cfcfcf solid">
		<thead >
			<tr>
				<th><h4>Автор</h4></th>
				<th><h4>Тема отзыва</h4></th>
				<th><h4>Текст отзыва</h4></th>
				<th><h4>Город</h4></th>
				<th><h4>Рейтинг</h4></th>
			</tr>
		</thead>
		<tbody>
			<?foreach ($reviews as $review=>$value):?> 
			<tr>
				<th><?= $value->users-> username?></th>
				<th><?= $value->title?></th>
				<th><?= $value->text?></th>
				<th><?= $value->id_city?></th>
				<th><?= $value->rating?></th>
			</tr>
			<?endforeach;?>
		</tbody>
	</table>
</div>


