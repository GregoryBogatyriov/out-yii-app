<?php

/* @var $this yii\web\View 
	 @var $user \app\models\User 
*/

use yii\helpers\Html;


/*Создаём содержание письма*/
echo 'Привет'.Html::encode($user-> username).'!';
echo Html::a('Для активации аккаунта перейдите по данной ссылке', 
	Yii::$app->urlManager-> createAbsoluteUrl([
		'/main/activate-account',
		'key'=> $user->secret_key
	]));
	/*Это ссылка с ключом, перейдя по которой пользователь перейдёт в действие в контроллере SiteController, которое передаст $key - секретный ключ через GET*/
