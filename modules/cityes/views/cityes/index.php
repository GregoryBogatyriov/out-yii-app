<?php
use app\modules\cityes\models\Base;
use app\modules\cityes\models\City;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
//require '../functions.php';
/* @var $this yii\web\View */

$this->title = ' Главная';
?>
<div class="site-index">
	<div class="section">
		<div class="container">
			<h2>Выберите ваш город</h2>
				<?//debug($data);?>
				<?// debug($_SESSION);?>
				<?// debug($_SESSION['id']);?>
				
				
				<?php if (isset ($data)):?>
					<?php if (!isset ($_SESSION['city'])):?>
						<h5>Ваш ip адрес:<?= $ip;?> </h5>	
						
						<div>
							<h5>Ваш город:  <?=$data[0]['city'] ?> ? </h5>
							<a href="<?= Url::to(['/cityes/cityes/confirm', 'city'=>$data[0]["city"]])?>" class="btn btn-success confirm-button" style="background: #008000;" data-city="<?=$data[0]['city']?>">Да</a>
							<a href="<?= Url::to(['/cityes/cityes/negative'])?>" class="btn btn-success negative-button" style="background: #ff4d00;" >Нет</a>
						</div>
						
					<?php else:?>
						<h3>Ваш город: <?= $_SESSION['city']?></h3>
						<a href="<?= Url::to(['/cityes/cityes/negative'])?>" class="btn btn-success negative-button" style="background: #ff4d00;" >Я нахожусь в другом месте!</a>
					<?php endif;?>
				<?php else:?>
					<div class="alert alert-danger alert-dismissible" role="alert">
							<h3>Не представляется возможным определить ваш город</h3>
					</div>
				<?php endif;?>
				
				
				<?//var_dump ($ip);?>
		
		
				
			
			
			
		</div>
	</div>
</div>
