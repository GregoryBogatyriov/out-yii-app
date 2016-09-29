<?php
namespace app\modules\reviews\views\reviews;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\SerialColumn;


$this->title = 'Просмотр отзывов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>
		
		<div class="table table-responsive">
			<table class= "table table-hover table-striped">
				<thead>
					<tr>
						<th>Номер</th>
						<th>Автор</th>
						<th>Почта</th>
						<th>Телефон</th>
						<th>Тема отзыва</th>
						<th>Текст отзыва</th>
						<th>Иконки</th>
					</tr>
				</thead>
				<tbody>
					<?foreach ($users as $user):?>
							<?$reviews = $user->reviews;?>
							<?foreach ($reviews as $review):?>
							<tr>
								<td><?=$review->id;?></td>
								<td><a href="<?=Url::to(['/reviews/reviews/_view', 'id'=> $review->id])?>"><?=$user->username;?></a></td>
								<td><?=$user->email;?></td>
								<td><?=$user->phone;?></td>
								<td><?=$review->title;?></td>
								<td><?=$review->text;?></td>
								<td>
								<a href="<?=Url::to(['/reviews/reviews/view'])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
								<a><span class="glyphicon glyphicon-pencil"></span></a>
								<a><span class="glyphicon glyphicon-trash"></span></a>
								</td>
							</tr>
							<?endforeach;?>
					<?endforeach;?>
				</tbody>
			</table>
		</div>
		
		
		<? foreach ($users as $user):?>
			<?$reviews = $user->reviews;?>
			<?foreach ($reviews as $review){
				echo '<br>';
				echo $user->username;
				echo $review->text ;
				echo $review->title ;
			}?>
		<? endforeach;?>
		
		
		
		
		
		
</div>
