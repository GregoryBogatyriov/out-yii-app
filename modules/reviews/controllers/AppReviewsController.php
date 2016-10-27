<?php

namespace app\modules\reviews\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
//use yii\base\Behavior;

/**
 * Default controller for the `reviews` module
 */
class AppReviewsController extends Controller
{
		public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
												'allow' => true,
                        'roles' => ['@'],
												'actions'=> [
													'delete'=> ['POST'],
													'index', 'view', '_view', 'view_index', 'update', '_index', 'delete', 'authorreviews', 'create', 'contactmodal', 'rating', 'stars'
												],
												
                    ],
                    [
                        'actions'=> ['index', 'view', '_view','view_index', '_index', 'authorreviews', 'contactmodal', 'rating'],
												'allow' => true,
                        'roles' => ['?'],
                    ],
										
                ],
            ],
        ];
    }
}
