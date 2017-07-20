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
use common\models\Producttype;

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
			$model->photo = $model->upload($model,'photo');
			$model->attributes= $_POST['Product'];
			if($model->save()){
				Ui::setMessage('บันทึกข้อมูลสำเร็จ','success');
				return $this->redirect(Url::toRoute('product/list'));
			}
			else {
				Ui::setMessage('การบันทึกข้อมูลผิดพลาด','danger');
			}
		}
		
		$lstProductType = Producttype::find()->all();
		$arrType = [];
		foreach ($lstProductType As $index=>$data){
			$arrType[$data['Id']] = $data['typeName'];
		}
		
		echo $this->render('add',[
				'model' => $model,
				'arrType' => $arrType,
		]);
	}
	
	
	public function actionDelete()
	{
		$request = \Yii::$app->request;
		
		//รับค่า id เพื่อค้นหาสินค้าในฐานจ้อมูล ให้ตรงกับ id ที่รับมา 
		$id = $request->get('id');
		
		if($id){
			$query = Product::find();
			$query->andWhere(['id' => $id]);
			$model = $query->one();   // คิวรี่ สินค้า ตาม id ที่ส่งมา
			
			$name = isset($model->productName)?$model->productName:'';
			
		}else {
			Ui::setMessage('ลบข้อมูลผิดพลาด ไม่ได้ระบุ id','danger');
			return $this->redirect(Url::toRoute('product/list'));
		}
		
		//สั่งลบ
		if($model->delete()){
			Ui::setMessage('ลบข้อมูล '.$name.' สำเร็จ','success');
			return $this->redirect(Url::toRoute('product/list'));
		}
		else {
			Ui::setMessage('ลบข้อมูลผิดพลาด','danger');
			return $this->redirect(Url::toRoute('product/list'));
		}
		
	}
	
	
	public function actionList()
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
		
		return $this->render('list',[
				'lstProduct'=>$lstProduct,
				'pagination'=>$pagination,
				'lstProductType'=>$lstProductType,
				
		]);
	}
	
	public function actionListtype()
	{
		
		// query data all product  frome product table
		$productTypeQuery = Producttype::find();
		$productTypeQuery->orderBy(['id' => SORT_ASC]);  // sort by id
		
		// add Pagination
		$pagination = new Pagination([
				'defaultPageSize' => 8, // set per page
				'totalCount' => $productTypeQuery->count(),
		]);
		
		$lstProductType= $productTypeQuery->orderBy('id ASC')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		$pagination->params = ['page'=> $pagination->page];
		
		//var_dump($objProduct); exit();
		
		return $this->render('listtype',[
				'lstProductType'=>$lstProductType,
				'pagination'=>$pagination,
				
		]);
	}
	
	
	
	
	
}