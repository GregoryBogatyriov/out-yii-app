<?php

namespace app\modules\reviews\models;

use Yii;
use \yii\db\ActiveRecord;
use app\modules\users\models\Users;
use app\modules\users\models\Reviews;
use app\modules\cityes\models\City;
//use yii\grid\GridView;
//use yii\data\ActiveDataProvider;

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
class Rating extends ActiveRecord
{
   
		
    public static function tableName()
    {
        return 'rating';
    }
		
		/*Связь с таблицей Users(связываемая). Вернётся объект*/
		public function getAuthor(){
			return $this-> hasOne(Users::className(), ['id'=> 'id_author']);
		}
		
		/*Связь с таблицей reviews*/
		public function getReview(){
			return $this-> hasOne(Reviews::className(), ['id'=>'id_review']);
		}
		
    
    public function rules()
    {
        return [
            [['id', 'id_review', 'id_author', 'rating'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'id_review' => 'Номер отзыва',
            'id_author' => 'Автор',
            'rating' => 'Рейтинг отзыва',
        ];
    }
		
		
	
		
		
		
}
