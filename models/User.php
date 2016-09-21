<?php

namespace app\models;

use Yii;
use \yii\web\IdentityInterface;
use \yii\behaviors\TimestampBehavior;

//use app\db\ActiveRecord;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
		public static function tableName(){
			return 'users';
		}

    /* private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ]; */

		/*Поведение, заполняет текущее время*/
		public function behaviors(){
			return [
				TimestampBehavior::className()
			];
		}
		
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
					'id' => $id,
				]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
			
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username'=> $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app-> security-> validatePassword($password, $this-> password);
    }
		
		/*Метод для хэширования пароля в БД (при регистрации)*/
		public function setPassword($password){
			
			$this->password = Yii::$app->security-> generatePasswordHash($password);
			
			$this->password = Yii::$app->getSecurity()-> generatePasswordHash($password);
		}
		
		/*Метод для генерации случайного ключа ("Запомнить")*/
		public function generateAuthKey(){
			$this->auth_key = Yii::$app->security-> generateRandomString();
		}
		
		
		/*Метод для сравнения введённого пароля с паролем в БД*/
		public function generatePassword($password){
			return Yii::$app->security-> validatePassword($password, $this-> password);
		}
}
