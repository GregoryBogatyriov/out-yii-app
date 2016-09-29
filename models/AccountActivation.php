<?php
namespace app\models;

use yii\base\InvalidParamException;
use yii\base\Nodel;
use Yii;

class AccountActivation extends Model{
	
	private $_user;// В это свойство будем помещать объект пользователя
	
	public function __construct($key, $config=[]){
		
		if (empty($key) || !is_string($key)){
			throw new InvalidParamException('Ключ не может быть пустым');
		}
		
		/*Находим объект пользователя по ключу*/
		$this->_user = User::findBySecretKey($key);
		
		/*Если объект не найден, то вызываем исключение неверного параметра*/
		if (!$this-> _user){
			throw new InvalidParamException('Неверный ключ');
		}
		
		parent::__construct($config);// Обращение к родительскому классу и его методу
	}
	
	/*Метод для активации нового пользователя*/
	public function activateAccount(){
		
		$user = $this->_user; // Присваиваем объекту $user объект пользователя $_user
		$user->status = User::STATUS_ACTIVE; // Устанавливаем статус активированного пользователя
		$user-> removeSecretKey();// Поле secret_key у пользователя равно null
		return $user-> save(); // Сохранить и вернуть объект активированного пользователя]
	}
	
	/*Метод, который возвращает ник активированного пользователя*/
	public function getUsername(){
		
		$user = $this->_user;
		return $user-> username;
	}
}



























































































