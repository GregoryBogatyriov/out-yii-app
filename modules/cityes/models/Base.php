<?php

	namespace app\modules\cityes\models;
	
	use yii\db\ActiveRecord;
	use app\modules\cityes\models\City;
	
	class Base extends ActiveRecord{
		
		/*Метод для связи модели с таблицей в БД*/
		public static function tableName(){
			return 'geo__base';
		}
		
		/**/
		public function getCity(){
			
			return $this-> hasOne(City::className(),['city_id'=>'city_id']);
		}
		
		
		
		
	}