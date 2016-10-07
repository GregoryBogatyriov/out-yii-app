<?
use app\modules\cityes\models\City;
use app\modules\cityes\models\Base;
?>

<?php
	
	/*Функция для распечатки массива*/
	function debug($arr){
			echo '<pre>'.print_r($arr, true).'</pre>';
	}

		
	
	/*Функции для определения ip*/
	function get_data1($ip){

			

			//$long_ip = ip2long('78.85.5.78');
			$long_ip = ip2long($ip);

			$q1 = Base::find()-> where("long_ip1<={$long_ip} and long_ip2>={$long_ip}")-> asArray()-> one();
				
				if (isset($q1)){
					$q2 = City::find()-> where("city_id={$q1[city_id]}")->asArray()->all();
					
					if (isset($q2)){
						$data = array_merge($q1, $q2);
						//$data = array_merge($q2, $q1);
					}
				}
			
			return $data;// Вернёт массив из полей Base и City
		}