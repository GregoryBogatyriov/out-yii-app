<?php

namespace app\modules\cityes\controllers;

use Yii;
use yii\filters\AccessControl;
use app\modules\cityes\models\Base;
use app\modules\cityes\models\City;
use app\modules\reviews\models\Reviews;
use app\modules\users\models\Users;
//use app\modules\cityes\models\Sess;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class CityesController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
												'allow' => true,
                        'roles' => ['@'],
												'actions'=> [
													'index', 'confirm', 'negative'
												],
												
                    ],
                    [
                        'actions'=> ['index', 'confirm', 'negative'],
												'allow' => true,
                        'roles' => ['?'],
                    ],
										
                ],
            ],
        ];
    }

    
    public function actionIndex()
    {
				//$ip = Yii::$app->request->userIP; // получаем ip адрес
				$ip = '78.85.6.10';// Если Вставляем готовый ip

				$data = get_data1($ip); // запускаем функцию и получем данные
				
				
				/*Условие, по которому уничтожаются данные из сессии*/
				$new = $_SESSION['time'] + 30;// Через 30 секунд
				
				if(isset($_SESSION['city']) && time()>= $new){
							$session = Yii::$app->session;
							$session->open();
							//$session->remove('city');
							//$session->remove('time');
							//$session->remove('id');
							$session-> destroy();
				}
				
				return $this->render('index', compact( 'data', 'new', 'ip'));
    }
		
		
		
		
		public function actionConfirm()
    {
				
				$city = Yii::$app-> request-> get('city');
				
				/*Создаём объект запроса, чтобы найти id города по его названию, которое нам летит сюда как get-параметр из формы или из index */
				$city_id = City::find()->where(['city'=>$city])->one();
				
				//if ($city){
					$session = Yii::$app->session;
					$session-> open();
					$session->set('city', $city);
					$session->set('id', $city_id);
					$_SESSION['time'] = time();
					
					//$session->remove('city');
					
				//}
					
				$this-> layout = false;
				return $this->render('confirm', compact('city_id'));
				
    }
		
		
		
		public function actionNegative()
    {
				
				$reviews = Reviews::find()-> all();
				$cityes = City::find()-> orderBy(['city'=>SORT_ASC])-> all();
				
				$this-> layout = false;
				return $this->render('negative', compact('reviews', 'cityes'));
				
    }
		
		
		
		
		
}
