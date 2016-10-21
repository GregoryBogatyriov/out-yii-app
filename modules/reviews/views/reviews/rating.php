<?php

namespace app\modules\reviews\views\reviews;

use yii\base\Model;
use Yii;


		if( Yii::$app->session->hasFlash('success') ): ?>
				<div class="alert alert-success alert-dismissible" role="alert">
						<?php echo Yii::$app->session->getFlash('success'); ?>
				</div>
		<?php endif;?>
		
		<?php if( Yii::$app->session->hasFlash('error') ): ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
					<?php echo Yii::$app->session->getFlash('error'); ?>
			</div>
		<?php endif;?>


















	



