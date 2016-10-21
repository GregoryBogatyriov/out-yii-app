<?php

namespace app\modules\cityes\models;

use yii\db\ActiveRecord;
use app\modules\cityes\models\Base;
use app\modules\reviews\models\Reviews;
	
	class City extends ActiveRecord{
		
			/*Метод для связи модели с таблицей в БД*/
			public static function tableName(){
				return 'geo__cities';
			}
			
			/*Связь с таблицей geo_base*/
			public function getBase(){
				return $this-> hasMany(Base::className(),['city_id'=>'city_id']);
			}
			
			/*Связь с таблицей reviews*/
			public function getReviews(){
				return $this-> hasOne(Reviews::className(), ['id_city'=>'city_id']);
			}
		
		
	}