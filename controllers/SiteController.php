<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\ContactForm;
use app\models\ConfirmForm;
use app\models\Reviews;
use app\models\User;
use app\modules\users\models\Users;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
								'backColor'=>111222,
								'foreColor'=>99,
								'offset'=>2,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Users::findOne(['username'=>Yii::$app->user-> identity['username']]);
				
				
				return $this->render('index', compact('user'));
    }
		
		
		
		
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
				if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app-> session->setFlash('success', "<h4>Вы зашли в свой профиль</h4>");
						return $this->goBack();
        }elseif($model->load(Yii::$app->request->post()) && !$model->login()){
						Yii::$app-> session->setFlash('error', "<h4>Произошла неизвестная ошибка. Возможно вы не до конца прошли процедуру регистрации</h4>");
				}
				
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
		
		public function actionReviews()
    {
        /*ActiveDataProvider - специальный провайдер данных, который обеспечивает данными виджет GridView::widget (см. файл modules\admin\views\order\index.php)*/
				$reviews = new ActiveDataProvider([
            /*Выборка из БД*/
						'query' => Reviews::find(),
						'pagination'=> [
							'pageSize'=> 5,
						],
						'sort'=> [
							'defaultOrder'=>[
								'status'=> SORT_ASC,
							],
						],
        ]);

        return $this->render('reviews', compact('reviews'));
				
				
    }
		
		/*Экшен для регистрации (шаг 1)*/
		public function actionReg(){
			$model = new RegForm();
			
			if ($model-> load(Yii::$app->request -> post()) && $model-> validate()){
				if ($user = $model-> reg()){
					$message = "<h4>{$model->username}, Вы успешно зарегистрировались! Чтобы окончательно пройти регистрацию, скопируйте текст {$user->token} и вставьте его в поле подтверждения</h4>";
					
					/*Отправка почты*/
					Yii::$app-> mailer-> compose('mailmessage', ['message'=> $message])
											->setFrom('test@mail.ru')
											->setTo($model->email)
											->setSubject('Подтверждение регистрации')
											->send();
											
					Yii::$app->session-> setFlash('success', "<h4>{$model->username}, чтобы окончательно пройти регистрацию, скопируйте текст, который мы отправили Вам на почту и вставьте его в поле: $message</h4>");
					return $this-> redirect('/site/confirm');
				}else {
					Yii::$app-> session-> setFlash('error','Возникла ошибка при регистрации');
					return $this-> refresh();
				}
			}
			
			return $this-> render('reg', [
				'model'=> $model,
			]);
				
		}
		
		
		/*Подтверждение регистрации (шаг 2)*/
		public function actionConfirm()
		{
				$model = new ConfirmForm();
				
				if ($model-> load(Yii::$app->request -> post()) && $model-> validate()){
					if ($user = $model-> confirm()){
						Yii::$app->session-> setFlash('success', "<h4>Вы  окончательно прошли регистрацию! Войдите под своим логином.</h4>");
						return $this-> redirect('/site/index');
					}else {
						Yii::$app->session-> setFlash('error', "<h4>Произошла неизвестная ошибка. Возможно вы ввели неверный ключ</h4>");
						return $this-> redirect('/site/confirm');
					}
				}
				
				return $this-> render('confirm', [
					'model'=> $model,
				]);
		}
		
		
		
		
		
		
		
		
		
		
		
		
}
