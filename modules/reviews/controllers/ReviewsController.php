<?php

namespace app\modules\reviews\controllers;

use Yii;
use app\modules\reviews\models\Reviews;
use app\modules\users\models\Users;
use app\modules\reviews\views\reviews\ViewForm;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\reviews\controllers\AppReviewsController;
use yii\web\UploadedFile;

/**
 * ReviewsController implements the CRUD actions for Reviews model.
 */
class ReviewsController extends AppReviewsController
{
    /*Закомменторованный behaviors*/
    /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    } */

    public function actionIndex()
    {
				/*Условие, при котором будут выводиться отзывы нашего города, а при котором отзывы всех городов*/
				if (isset($_SESSION['id'])){
					$arr = ['id_city'=>$_SESSION['id']];
				}else {
					$arr = 'id';
				}
				
				$dataProvider = new ActiveDataProvider([
            'query' => Reviews::find()->where($arr),
        ]);
				
				$users = Users::find();
				return $this->render('index', compact('dataProvider', 'users'));
    }
		
		
    public function actionView($id)
    {
        
				//$reviews = Reviews::find()-> all();
				
				return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAuthorreviews($id_author){
			
			$id_author = Yii::$app-> request-> get('id_author');
			//$reviews = Reviews::findOne($id_author);
			$reviews = Reviews::find()-> where(['id_author'=>$id_author])-> all();
			
			return $this->render('authorreviews', compact('reviews', 'dataProvider'));
        
		}
		
		
		
    public function actionCreate()
    {
        $model = new Reviews();
				$user = new Users();
				
				
				
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
						
						Yii::$app->session-> setFlash('success', 'Отзыв оставлен!');
						
						/*Загружаем картинку отзыва*/
						$model->image = UploadedFile::getInstance($model, 'image');
						if (isset($model-> image)){
							$model->upload();
						}
						
						/*Загружаем несколько картинок*/
						unset ($model-> image);
						$model->images = UploadedFile::getInstances($model, 'images');
						if (isset($model-> images)){
							$model->uploadImages();
						}
						
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
						Yii::$app->session-> setFlash('error', 'Отзыв не оставлен!');
						return $this->render('create', [
                'model' => $model,
								'user'=> $user,
            ]);
        }
    }

    
		
		
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
				$user = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
						Yii::$app->session-> setFlash('success', 'Отзыв изменен!');
						
						/*Загружаем картинку отзыва*/
						$model->image = UploadedFile::getInstance($model, 'image');
						if (isset($model-> image)){
							$model->upload();
						}
						
						/*Загружаем несколько картинок*/
						unset ($model-> image);
						$model->images = UploadedFile::getInstances($model, 'images');
						if (isset($model-> images)){
							$model->uploadImages();
						}
						
						return $this->redirect(['view', 'id' => $model->id]);
        } else {
						Yii::$app->session-> setFlash('error', 'Отзыв не изменен!');
            return $this->render('update', [
                'model' => $model,
								'user'=> $user,
            ]);
        }
    }

    /**
     * Deletes an existing Reviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
				Yii::$app->session-> setFlash('success', 'Отзыв удален!');

        return $this->redirect(['index']);
    }
		
		
		
		
		/*Экшен для модального окна*/
		public function actionContactmodal(){
			
			$id_author = Yii::$app-> request-> get('id_author'); 
			
			$reviews = Reviews::find()-> where(['id_author'=>$id_author])-> all();
			$users = Users::find()-> where(['id'=> $id_author])-> all();
			
			
			if (empty($reviews))
				return false;
			else
				$this->layout = false;
				
				return $this-> render('contactmodal', compact('reviews', 'users', 'id_author'));
			
		}
		
		

    /**
     * Finds the Reviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Reviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
		
		
		
		/*Свои собственные экшены*/
		 public function action_index()
    {
				$dataProvider = new ActiveDataProvider([
            'query' => Reviews::find(),
        ]);
				
				
				return $this->render('_index', [
            'dataProvider' => $dataProvider,
						
        ]);
    }
		
		  public function action_view($id)
		 {
					
					$id = Yii::$app->request-> get('id');
					
					$review = Reviews::findOne($id);// Ленивая загруз
					
					//$reviews = Reviews::find()-> with('id_author')-> where(['id'=> $id])-> one();// Жадная загрузка
					
					return $this->render('_view', [
							'review' => $review,
					]);
			}
}
