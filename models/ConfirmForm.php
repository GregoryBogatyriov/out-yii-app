<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ConfirmForm extends Model
{
    
    public $token;
		
		
		
    public function rules()
    {
        return [
            [['token'], 'filter', 'filter'=> trim],
            [['token'], 'required'],
            ['token', 'string', 'min'=> 10, 'max'=> 40],
        ];
    }
		
		public function attributeLabels(){
			return [
				//'username'=> 'Логин',
				'token'=> 'Секретный пароль',
			];
			
		}
		
		
		/*Функция для окончательной регистрации БД*/
		public function confirm(){
			
			$user = User::find()->where(['token'=>$this->token])->one();
			
			if(isset($user)):
				$user->token_confirm = $this->token;
				$user-> status = "Зареган";
			else:
				return false;
			endif;
			
			return $user-> save() ? $user : null;
			
		}
		
		
		
		
		
		
		
		
} 











