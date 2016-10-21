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
    public $phone;
    public $captcha;
		
		public $backColor;


    /* public function actions(){
			return [
				['captcha', ['backColor'=> 'black']],
			];
		} */
		
		
    public function rules()
    {
        return [
            [['username','email', 'password', 'captcha'], 'filter', 'filter'=> trim],
            [['username','email', 'password', 'phone', 'captcha'], 'required'],
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
						['phone', 'string', 'min'=>4, 'max'=> 20],
						['phone', 'unique', 
							'targetClass'=> User::className(),
							'message'=> 'Такой телефон уже занят!',
						],
						['captcha', 'captcha'],
        ];
    }
		
		public function attributeLabels(){
			return [
				'username'=> 'Логин',
				'email'=> 'Эл. почта',
				'phone'=> 'Телефон',
				'password'=> 'Пароль',
				'captcha'=> 'Подтвердите код',
			];
			
		}
		
		public function reg(){
			
			$user = new User();
			$user-> username = $this->username;
			$user-> email = $this-> email;
			$user-> phone = $this-> phone;
			
			$user->setPassword($this->password);
			$user->generateAuthKey();
			
			return $user-> save() ? $user : null;
			
		}

} 
