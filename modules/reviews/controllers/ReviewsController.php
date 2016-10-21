<?php

namespace app\modules\reviews\controllers;

use Yii;
use app\modules\reviews\models\Reviews;
use app\modules\reviews\models\Rating;
use app\modules\reviews\models\Raits;
use app\modules\cityes\models\City;
use app\modules\cityes\models\Base;
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
    

    public function actionIndex()
    {
				/*Условие, при котором будут выводиться отзывы нашего города, а при котором отзывы всех городов*/
				if (isset($_SESSION['id'])){
					$arr = ['id_city'=>$_SESSION['id']];
				}else {
					$arr = 'id';
				}
				
				/*Делаем выборку только тех отзывов город которых совпадает с городом в сессии*/
				$dataProvider = new ActiveDataProvider([
            'query' => Reviews::find()->where($arr)-> orderBy(['id_city'=> SORT_DESC]),
        ]);
				
				//$users = Users::find();
				return $this->render('index', compact('dataProvider'));
    }
		
		
    public function actionView($id)
    {
				$rating = Rating::find()-> where(['id_review'=> $id])-> all();
				
				return $this->render('view', [
            'model' => $this->findModel($id),
						'rating' => $rating,
						'page' => $page,
        ]);
    }
		
		
		
		/*Экшен для рейтинга*/
		public function actionRating(){
			
			if (!Yii::$app->user-> isGuest):
				$id_review = Yii::$app-> request-> post('id_review');
				$rate = Yii::$app-> request-> post('rating');
				
				$author_name = Yii::$app->user-> identity['username'];
				$author = Users::findOne(['username'=>$author_name]);// Имя автора
				$id_author = $author->id;
			endif;
			
			/*Ищем оценку данного автора и к данному отзыву*/
			if (isset($id_review) && isset($id_author)):
				$query = Rating::findOne(['id_author'=>$id_author, 'id_review'=>$id_review]);
			endif;
			
			
			/*Если в БД не найдено оценки автора к даннгому отзыву*/
			if (!isset($query)):
				/*Приводим к целому числу*/
				$rate = (int)$rate; 
				$id_review = (int)$id_review; 
				$id_author = (int)$id_author; 
				/*Объект модели*/
				$rating = new Rating();
				
				if (($id_review) && ($id_author) && ($id_review != 0) && ($id_author != 0) && ($rate !=0)):
				/*Сохраняем в БД*/
				$rating->id_review = $id_review;
				$rating->id_author = $id_author;
				$rating->rating = $rate;
				$rating-> save();
				endif;
				
				if (($id_review) && ($id_author) && ($id_review != 0) && ($id_author != 0) && ($rate !=0)):
					Yii::$app->session-> setFlash('success', 'Вы проголосовали!');
				else:
					Yii::$app->session-> setFlash('error', 'Вы что-то забыли указать!');
				endif;
			elseif(isset($query)):
				Yii::$app->session-> setFlash('error', 'Вы уже ставили оценку данному отзыву!');
				//$error = "<h3>Вы уже ставили оценку данному отзыву!</h3>";
			endif;
			
			return $this->renderPartial('rating', [
						'rate' => $rate,
						'id_review' => $id_review,
						'id_author' => $id_author,
						'rating' => $rating,
						'query' => $query,
						'error'=>  $error,
        ]);
		}

		
		/*Экшен для просмотра отзывов выбранного автора*/
    public function actionAuthorreviews($id_author){
			
			$id_author = Yii::$app-> request-> get('id_author');
			
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
						
						if(Yii::$app->user->identity['id'] == $model-> id_author) :
							Yii::$app->session-> setFlash('error', 'Отзыв не изменен!');
						endif;
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
        $model = $this->findModel($id);
				
				if(Yii::$app->user->identity['id'] == $model-> id_author) :
				
					$model->delete();
					Yii::$app->session-> setFlash('success', 'Отзыв удален!');

					return $this->redirect(['index']);
				else:
					Yii::$app->session-> setFlash('error', 'Чужие отзывы удалять нельзя!');
					return $this->redirect(['index']);
				endif;
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
		
		
		
}
