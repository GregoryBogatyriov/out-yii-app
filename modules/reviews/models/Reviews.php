<?php

namespace app\modules\reviews\models;

use Yii;
use \yii\db\ActiveRecord;
use app\modules\users\models\Users;
use app\modules\cityes\models\City;
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
    public $image;
    public $images;
		//public $id_city;
		
		public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
		
		
    public static function tableName()
    {
        return 'reviews';
    }
		
		/*Связь с таблицей Users. Вернётся объект*/
		public function getUsers(){
			return $this-> hasOne(Users::className(), ['id'=> 'id_author']);
		}
		
		/*Связь с таблицей geo_cities*/
		public function getCity(){
			return $this-> hasOne(City::className(), ['city_id'=>'id_city']);
		}
		
    
    public function rules()
    {
        return [
            [['id_city', 'title', 'text', 'rating', ], 'required'],
            [['id_city', 'rating', 'img', 'id_author'], 'integer'],
            [['text'], 'string'],
            [['date_create'], 'safe'],
            [['title'], 'string', 'max' => 255],
						[['image'], 'file', 'extensions' => 'png, jpg'],
						//[['images'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
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
            'image' => 'Картинка',
            'images' => 'Изображения',
            //'id_author' => 'Id Author',
            'date_create' => 'Отзыв написан',
						'users.username'=>'Автор отзыва',
						'reviews.id_city'=>'Номер города',
        ];
    }
		
		
		/*Метод для загрузки картинки*/
		public function upload()
    {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName .'.'. $this->image->extension ;
						
						$this->image->saveAs($path );
						
						$this->attachImage($path, true);
						
						@unlink ($path);
						
            return true;
        } else {
            return false;
        }
    }
		
		
		/*Метод для загрузки нескольких картинок*/
		public function uploadImages()
    {
        if ($this->validate()) {
            foreach ($this->images as $file){
							
							$path = 'upload/store/' . $file->baseName .'.'. $file->extension;
						
							$file->saveAs($path);
							
							$this->attachImage($path);
							
							@unlink ($path);
						}
						
						
						
            return true;
        } else {
            return false;
        }
    }
		
		/*Метод для добавления имени текущего пользователя*/
		public function addAuthor($username, $id_author){
			
		}
}
