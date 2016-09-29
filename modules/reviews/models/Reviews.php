<?php

namespace app\modules\reviews\models;

use Yii;
use \yii\db\ActiveRecord;
use app\modules\users\models\Users;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "reviews".
 *
 * @property string $id
 * @property string $id_city
 * @property string $title
 * @property string $text
 * @property string $rating
 * @property string $img
 * @property string $id_author
 * @property string $date_create
 */
class Reviews extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }
		
		/*Связь с таблицей Users. Вернётся объект*/
		public function getUsers(){
			return $this-> hasOne(Users::className(), ['id'=> 'id_author']);
		}
		
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'title', 'text', 'rating', ], 'required'],
            [['id_city', 'rating', 'img', 'id_author'], 'integer'],
            [['text'], 'string'],
            [['date_create'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'id_city' => 'Id City',
            'title' => 'Тема отзыва',
            'text' => 'Текст',
            'rating' => 'Рейтинг',
            //'img' => 'Img',
            //'id_author' => 'Id Author',
            'date_create' => 'Отзыв написан',
						'users.username'=>'Автор отзыва'
        ];
    }
		
		/*Метод для добавления имени текущего пользователя*/
		public function addAuthor($username, $id_author){
			
		}
}
