<?php

namespace app\modules\users\models;

use Yii;
use \yii\db\ActiveRecord;
use app\modules\reviews\models\Reviews;
use app\modules\reviews\models\Rating;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property string $password
 * @property string $auth_key
 * @property integer $status
 * @property string $secret_key
 */
class Users extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
		
		/*Связь с моделью Reviews. Возвращает массив отзывов*/
		public function getReviews(){
			return $this->hasMany(Reviews::className(), ['id_author'=>'id']);
		}
		
		
		/*Связь с моделью Rating. Возвращает массив*/
		public function getRating(){
			return $this-> hasMany(Rating::className(), ['id_author'=>'id']);
		}
		
		

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'phone', 'created_at', 'updated_at', 'password', 'status', 'secret_key'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['username', 'email', 'phone', 'password', 'auth_key', 'secret_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Автор отзыва',
            'email' => 'Почта',
            'phone' => 'Телефон',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'secret_key' => 'Secret Key',
        ];
    }
}
