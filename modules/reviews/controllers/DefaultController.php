<?php

namespace app\modules\reviews\controllers;

use yii\web\Controller;

/**
 * Default controller for the `reviews` module
 */
class DefaultController extends AppReviewsController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
