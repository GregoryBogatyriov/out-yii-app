<?php

namespace app\modules\reviews\models;

use Yii;

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
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'title', 'text', 'rating', 'img', 'id_author', 'date_create'], 'required'],
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
            'id' => 'ID',
            'id_city' => 'Id City',
            'title' => 'Title',
            'text' => 'Text',
            'rating' => 'Rating',
            //'img' => 'Img',
            //'id_author' => 'Id Author',
            //'date_create' => 'Date Create',
        ];
    }
}
