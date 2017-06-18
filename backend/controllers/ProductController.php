<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Product controller
 */
class ProductController extends Controller
{
	public function actionList()
	{
		return $this->render('list');
	}
	
	
	
	
	
	
}