<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

use yii\web\HttpException;
use yii\db\Query;
use app\Ui;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;

// use model frome table product 
use common\models\Product;

/**
 * Product controller
 */
class ProductController extends Controller
{
	public function actionAdd()
	{
		$request = \Yii::$app->request;
		$id = $request->get('id');
		
		if($id){
			$query = Product::find();
			$query->andWhere(['id' => $id]);
			$model = $query->one();
		}else {
			$model = new Product();
		}
		if (\Yii::$app->request->isPost)
		{
			$model->Id= NULL;
			$model->attributes= $_POST['Product'];
			if($model->save()){
				Ui::setMessage('บันทึกข้อมูลสำเร็จ','success');
				return $this->redirect(Url::toRoute('product/list'));
			}
			else {
				Ui::setMessage('การบันทึกข้อมูลผิดพลาด','danger');
			}
		}
		
		echo $this->render('add',['model' => $model]);
	}
	
	public function actionList()
	{
		
		// query data all product  frome product table 
		$productQuery = Product::find();
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
		
		return $this->render('list',[
				'lstProduct'=>$lstProduct,
				'pagination'=>$pagination,
				
		]);
	}
	public function actionListtype()
	{
		return $this->render('listtype');
	}
	
	
	
	
	
	
}