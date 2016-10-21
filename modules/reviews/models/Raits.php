<?php

namespace app\modules\reviews\models;

use Yii;
use \yii\db\ActiveRecord;
use app\modules\users\models\Users;
use app\modules\users\models\Reviews;
use app\modules\cityes\models\City;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
//use yii\grid\GridView;
//use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "likes".
 *
 * @property string $id
 * @property string $materialType
 * @property string $materialId
 * @property string $userId
 * @property string $rateNum
 * @property string $rateDate
 *
 */

class Raits extends ActiveRecord
{

    const TYPE_BLOGPOST = "blog_post";
    const TYPE_GEOINSTITUTIONS = "geo_institutions";

    public static function getMaterialType(){
        return[
            self::TYPE_BLOGPOST => 'Статьи блога',
            self::TYPE_GEOINSTITUTIONS => 'страница',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['materialType', 'materialId', 'userId', 'rateNum', 'rateDate'], 'safe'],
        ];
    }


    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),//устанавливаем id юзера
                'createdByAttribute' => 'userId',
                'updatedByAttribute' => null,
            ],
            'timestamp' => [//Использование поведения TimestampBehavior ActiveRecord
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['rateDate'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => null,

                ],
                'value' => new \yii\db\Expression('NOW()'),

            ],
        ];
    }


    /**
     * @inheritdoc
     * @return LikesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RaitsQuery(get_called_class());
    }
}

