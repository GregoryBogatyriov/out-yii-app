<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\LtAppAsset;

AppAsset::register($this);
LtAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
		<head>
				<?= Html::csrfMetaTags();?>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
				<?= Html::csrfMetaTags() ?>
        <title>Отзывы | <?= Html::encode($this->title) ?></title>
				<?php $this->head() ?>

        
		
       
    </head>
    <body>
		<?php $this->beginBody() ?>
        

		<!-- Navigation & Logo-->
		<div class="mainmenu-wrapper">
			<div class="container">
				<nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="<?= Url::to(['/site/index']);?>"><img src="/images/mPurpose-logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li>
						<li>
							<a href="#">Пользователи</a>
						</li>
					<?php if($_SESSION['id']):?>
						<li>
							<a href="<?= Url::to(['/cityes/cityes/index']);?>"><strong>Ваш город: <?=$_SESSION['city']?></strong></a>
						</li>
					<?php else:?>	
						<li>
								<a href="<?= Url::to(['/cityes/cityes/index']);?>"><div class="alert-danger"><strong>Выберите ваш город!</strong></div></a>
						</li>
					<?php endif;?>
					
					<?php if (!Yii::$app->user-> isGuest){?>
						<li class="pull-right">
							<a href="<?= Url::to(['/reviews/reviews/index']);?>"><strong>Отзывы</strong></a>
						</li>
						<li class="pull-right">
							<a href="<?=Url::to(['/site/logout'])?>">Ваше имя: <strong><?= Yii:: $app-> user-> identity['username']?></strong>(выход)</a>
						</li>
					<?php } else {?>
						<li class="pull-right">
							<a href="<?= Url::to(['/reviews/reviews/index']);?>"><strong>Отзывы</strong></a>
						</li>
						<li class="pull-right">
							<a href="<?= Url::to(['/site/login']);?>"><strong>Залогиниться</strong></a>
						</li>
						<li class="pull-right">
							<a href="<?= Url::to(['#']);?>"><strong>Зарегиться</strong></a>
						</li>
					<?php } ?>
						
					</ul>
				</nav>
				
				
			</div>
		</div>

      <div class="container">
				
				
				
				<?= $content;?>
			</div>
			

	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Our Latest Work</h3>
		    			<div class="portfolio-item">
							<div class="portfolio-image">
								<a href="#"><img src="/images/portfolio6.jpg" alt="Project Name"></a>
							</div>
						</div>
		    		</div>
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="#">Blog</a></li>
		    				<li><a href="#">Portfolio</a></li>
		    				<li><a href="#">eShop</a></li>
		    				<li><a href="#">Services</a></li>
		    				<li><a href="#">Pricing</a></li>
		    				<li><a href="#">FAQ</a></li>
		    			</ul>
		    		</div>
		    		
		    		<div class="col-footer col-md-4 col-xs-6">
		    			<h3>Contacts</h3>
		    			<p class="contact-us-details">
	        				<b>Address:</b> 123 Fake Street, LN1 2ST, London, United Kingdom<br/>
	        				<b>Phone:</b> +44 123 654321<br/>
	        				<b>Fax:</b> +44 123 654321<br/>
	        				<b>Email:</b> <a href="#">getintoutch@yourcompanydomain.com</a>
	        			</p>
		    		</div>
		    		<div class="col-footer col-md-2 col-xs-6">
		    			<h3>Stay Connected</h3>
		    			<ul class="footer-stay-connected no-list-style">
		    				<li><a href="#" class="facebook"></a></li>
		    				<li><a href="#" class="twitter"></a></li>
		    				<li><a href="#" class="googleplus"></a></li>
		    			</ul>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2013 mPurpose. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div><!--/ Footer -->
			
			<!--Модальное окно для контактов автора-->
			<?php
				Modal::begin([
					
					'header'=> '<h2>Контакты автора отзыва</h2>',
					'id'=> 'author-contact',
					'footer'=>' <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>',
				]);
				
				Modal::end();
			?>
			
			<!--Модальное окно для вывода результата голосования-->
			<?php
				Modal::begin([
					
					'header'=> '<h2>Голосование</h2>',
					'id'=> 'rating',
					'footer'=>' <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>',
				]);
				
				Modal::end();
			?>
			
			
        
		<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>