<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Product;
use common\models\Producttype;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
                    'logout' => ['post'],
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
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionProduct()
    {
    	$request = \Yii::$app->request;
    	$type = $request->get('type','');
    	
    	//  query data all product Type
    	$productTypeQuery = Producttype::find();
    	$productTypeQuery->orderBy(['id' => SORT_ASC]); 
    	$lstProductType = $productTypeQuery->all();
    	
    	
    	// query data all product  frome product table
    	$productQuery = Product::find();
    	if(!empty($type)){
    	$productQuery->andWhere(['productType' => $type]);
    	}
    	$productQuery->orderBy(['id' => SORT_ASC]);  // sort by id
    	
    	// add Pagination
    	$pagination = new Pagination([
    			'defaultPageSize' => 8, // set per page
    			'totalCount' => $productQuery->count(),
    	]);
    	
    	$lstProduct= $productQuery->orderBy('id ASC')
    	->offset($pagination->offset)
    	->limit($pagination->limit)
    	->all();
    	$pagination->params = ['page'=> $pagination->page];
    	
    	//var_dump($objProduct); exit();
    	
    	return $this->render('product',[
    			'lstProduct'=>$lstProduct,
    			'lstProductType'=>$lstProductType,
    			'pagination'=>$pagination,
    			
    	]);
    }

    
    public function actionSearch()
    {
    	$request = \Yii::$app->request;
    	$text = $request->post('text','');
    	$type = $request->get('type','');
    	
    	//  query data all product Type
    	$productTypeQuery = Producttype::find();
    	$productTypeQuery->orderBy(['id' => SORT_ASC]);
    	$lstProductType = $productTypeQuery->all();
    	
    	
    	// query data all product  frome product table
    	$productQuery = Product::find();
    	if(!empty($type)){
    		$productQuery->andWhere(['productType' => $type]);
    	}
    	if(!empty($text)){
    		$productQuery->andWhere(['LIKE' ,'productName',$text]);
    		$productQuery->orWhere(['LIKE' ,'productDetail',$text]);
    	}
    	$productQuery->orderBy(['id' => SORT_ASC]);  // sort by id
    	
    	// add Pagination
    	$pagination = new Pagination([
    			'defaultPageSize' => 8, // set per page
    			'totalCount' => $productQuery->count(),
    	]);
    	
    	$lstProduct= $productQuery->orderBy('id ASC')
    	->offset($pagination->offset)
    	->limit($pagination->limit)
    	->all();
    	$pagination->params = ['page'=> $pagination->page];
    	
    	//var_dump($objProduct); exit();
    	
    	return $this->render('search',[
    			'text' => $text,
    			'lstProduct'=>$lstProduct,
    			'lstProductType'=>$lstProductType,
    			'pagination'=>$pagination,
    			
    	]);
    }
    
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
            	
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
