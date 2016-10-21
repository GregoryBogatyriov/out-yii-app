<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\reviews\models\Reviews;
use app\modules\users\models\Users;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр отзывов';
$this->params['breadcrumbs'][] = $this->title;
?>


<h2>Все отзывы автора</h2>
<div class="table table-responsive" style="margin-top:80px; margin-bottom: 60px">
	<table class="table table-hover table-striped" style="border: 3px #cfcfcf solid">
		<thead >
			<tr>
				<th><h4>Автор</h4></th>
				<th><h4>Тема отзыва</h4></th>
				<th><h4>Текст отзыва</h4></th>
				<th><h4>Город</h4></th>
			</tr>
		</thead>
		<tbody>
			<?foreach ($reviews as $review=>$value):?> 
			<tr>
				<!--<th><?//=Html::a($value->title, [/])?></th>-->
				<th><?=Html::a($value->users-> username, Url::to(['/reviews/reviews/authorreviews', 'id_author'=>$value->id_author]), ['class'=>'authorreviews', 'data-id_author'=> $value->id_author ])?></th>
				<th><?= Html::a($value->title, ['/reviews/reviews/view', 'id'=>$value->id])?></th>
				<th><?= $value->text?></th>
				<th><?= $value->city-> city?></th>
			</tr>
			<?endforeach;?>
		</tbody>
	</table>
</div>


