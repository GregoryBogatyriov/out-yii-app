<?php
//use app\modules\cityes\models\Base;
//use app\modules\cityes\models\City;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = ' Главная';
?>
<div class="site-index">
	<div class="section">
		<div class="container">
				
			
			
			<form action="confirm" method="GET">		
			<select style="width:250px;" name="city">
				<?php  foreach ($cityes as $city):?>
						<?
							echo isset($city->reviews-> title) ? "<option>" .$city->city . "</option>" : "";
						?>
				<?php endforeach;?>
			</select>
			<p><input type="submit" class="btn btn-success city-select" value="Выбрать!" style="margin-top: 20px;"></p>
			</form>
			
				     
			
			
			
			
			
				
				
				
						
				
		</div>
	</div>
</div>
