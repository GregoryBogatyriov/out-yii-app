<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegForm extends Model
{
    public $username;
    public $email;
    public $password;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username','email', 'password'], 'filter', 'filter'=> trim],
            [['username','email', 'password'], 'required'],
            ['username', 'string', 'min'=> 2, 'max'=> 255],
            ['password', 'string', 'min'=> 6, 'max'=> 255],
            ['username', 'unique',
							'targetClass'=> User::className(),
							'message'=> 'Это имя уже занято!',
						],
						['email', 'email'],
						['email', 'unique',
							'targetClass'=> User::className(),
							'message'=> 'Эта почта уже занята!',	
						],
        ];
    }
		
		public function attributeLabels(){
			return [
				'username'=> 'Логин',
				'email'=> 'Эл. почта',
				'password'=> 'Пароль',
			];
			
		}
		
		public function reg(){
			
			$user = new User();
			$user-> username = $this->username;
			$user-> email = $this-> email;
			
			$user->setPassword($this->password);
			$user->generateAuthKey();
			
			return $user-> save() ? $user : null;
			
		}

} 
