<?php

/* @var $this yii\web\View */

$this->title = ' Главная';
?>
<div class="container">
	<?php if( Yii::$app->session->hasFlash('success') ): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo Yii::$app->session->getFlash('success'); ?>
			</div>
	<?php endif;?>
	
	<?php if (Yii::$app-> user-> isGuest):?>
	<div class="site-index">
			<div class="section">
				<div class="container" style="margin-top: 40px; margin-bottom: 40px;">
					<h2>Зайдите в свой профиль или зарегистрируйтесь на сайте</h2>
				</div>
			</div>
	</div>
	<?php else:?>
	
	<h2>Ваши данные:</h2>
	<table class="table table-hover table-striped" style="border: 3px #cfcfcf solid">
			<thead>
			<tbody>	
					<tr>
						<th><h3>Ваш логин </h3></th>
						<th><h3><?= $user->username?> </h3></th>
					</tr>
					<tr>
						<th><h4>Электронная почта</h4></th>
						<th><h4><?= $user->email?></h4></th>
					</tr>
					<tr>
						<th><h4>Ваш контактный телефон</h4></th>
						<th><h4><?=$user-> phone?></h4></th>
					</tr>
			</tbody>
		</table>
	<?php endif;?>
</div>
