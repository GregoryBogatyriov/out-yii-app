<?php
use app\modules\cityes\models\Base;
use app\modules\cityes\models\City;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = ' Главная';
?>
<div class="site-index">
	<div class="section">
		<div class="container">
				<?//debug($city_id);?>
				<?//var_dump($data[0]['city']);?>
				<?//var_dump($city)?>
				<?//var_dump($_SESSION['city'])?>
				
				<?	if(!empty($_SESSION['city'])):?>
					<h2>Город выбран!</h2>
					<h3>Перейдите по <?=Html::a('Ссылке',['/reviews/reviews/index'])?></h3>
					<?else:?>
						<h2>Город не выбран!</h2>
					<?endif;?>
			
						
				
		</div>
	</div>
</div>