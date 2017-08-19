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
use common\models\Order;
use common\models\User;


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
		if ($request->isPost) {
			if(isset($_FILES["Product"]) && $_FILES["Product"]["error"]["photo"] == 0){
				$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
				$filename = $_FILES["Product"]["name"]["photo"];
				$filetype = $_FILES["Product"]["type"]["photo"];
				$filesize = $_FILES["Product"]["size"]["photo"];
				$file = $_FILES["Product"];
				$fileNameServer = time().$_FILES["Product"]["name"]["photo"];
				// Verify file extension
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
				// Verify file size - 5MB maximum
				$maxsize = 5 * 1024 * 1024;
				if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
				
				// Verify MYME type of the file
				if(in_array($filetype, $allowed)){
					// Check whether file exists before uploading it
					move_uploaded_file($_FILES["Product"]["tmp_name"]["photo"], "upload/".$fileNameServer );
					echo "Your file was uploaded successfully.";
				} else{
					echo "Error: There was a problem uploading your file. Please try again.";
				}
			} else{
				echo "Error: " . $_FILES["Product"]["error"]["photo"];
			}
			$model->photo =$fileNameServer;
			$model->productName = isset($_POST['Product']['productName'])?$_POST['Product']['productName']:'';
			$model->productDetail = isset($_POST['Product']['productDetail'])?$_POST['Product']['productDetail']:'';
			$model->productPrice = isset($_POST['Product']['productPrice'])?$_POST['Product']['productPrice']:0;
			$model->productQuantity = isset($_POST['Product']['productQuantity'])?$_POST['Product']['productQuantity']:0;
			$model->productType = isset($_POST['Product']['productType'])?$_POST['Product']['productType']:0;
			
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
	
	public function actionAddtype()
	{
		$request = \Yii::$app->request;
		$id = $request->get('id');
		
		if($id){
			$query = Producttype::find();
			$query->andWhere(['id' => $id]);
			$model = $query->one();
		}else {
			$model = new Producttype();
			
		}
		if ($request->isPost) {
			$model->typeName = isset($_POST['Producttype']['typeName'])?$_POST['Producttype']['typeName']:'';
			$model->typeDescription = isset($_POST['Producttype']['typeDescription'])?$_POST['Producttype']['typeDescription']:'';
			
			if($model->save()){
				Ui::setMessage('บันทึกข้อมูลสำเร็จ','success');
				return $this->redirect(Url::toRoute('product/listtype'));
			}
			else {
				Ui::setMessage('การบันทึกข้อมูลผิดพลาด','danger');
			}
		}
		
		echo $this->render('addtype',[
				'model' => $model,
		]);
	}

	public function actionDeletetype()
	{
		$request = \Yii::$app->request;
		
		//รับค่า id เพื่อค้นหาสินค้าในฐานจ้อมูล ให้ตรงกับ id ที่รับมา
		$id = $request->get('id');
		if($id){
			$query = Producttype::find();
			$query->andWhere(['id' => $id]);
			$model = $query->one();   // คิวรี่ สินค้า ตาม id ที่ส่งมา
			
			$name = isset($model->typeName)?$model->typeName:'';
			
		}else {
			Ui::setMessage('ลบข้อมูลผิดพลาด ไม่ได้ระบุ id','danger');
			return $this->redirect(Url::toRoute('product/listtype'));
		}
		
		//สั่งลบ
		if($model->delete()){
			Ui::setMessage('ลบข้อมูล '.$name.' สำเร็จ','success');
			return $this->redirect(Url::toRoute('product/listtype'));
		}
		else {
			Ui::setMessage('ลบข้อมูลผิดพลาด','danger');
			return $this->redirect(Url::toRoute('product/listtype'));
		}
		
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
	
	
	public function actionListorder()
	{
		$request = \Yii::$app->request;
		$type = $request->get('type','');
		
		//  query data all User
		$userQuery = User::find();
		$userQuery->orderBy(['id' => SORT_ASC]);
		$lstUser = $userQuery->all();
		$arrUser = [];
		foreach ($lstUser as $dataUser){
			$arrUser[$dataUser['id']] = $dataUser['firstName'].' '.$dataUser['lastName'];
		}
		// query data all Order frome Order table
		$orderQuery = Order::find();
		if(!empty($type)){
			$orderQuery->andWhere(['productType' => $type]);
		}
		
		$lstOrder = $orderQuery->orderBy('id ASC')->all();
		$arrOrder = [];
		foreach ($lstOrder as  $dataOrder ){
			$arrOrder[$dataOrder['oderNum']][] = $dataOrder;
		}
		
		
		return $this->render('listorder',[
				'arrOrder'=>$arrOrder,
				'arrUser'=>$arrUser,
				
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
	
	public function actionBill()
	{
		$request = \Yii::$app->request;
		$identity = \Yii::$app->user->getIdentity();
		$userId =  $request->get('uid', $request->post('uid',''));
		$op = $request->get('op', $request->post('op',''));
		$oderNum =  $request->get('id', $request->post('id',''));
		$status = $request->get('status', $request->post('status',''));
		$statusN = $request->get('statusN', $request->post('statusN',''));
 		if($op == "setStatus"){
			$orderQuery = Order::find();
			$orderQuery->andWhere(['createBy' => $userId]);
			$orderQuery->andWhere(['oderNum' => $oderNum]);
			$modelsOrders = $orderQuery->all();
			$orderCart = $this->getOderBystatus($status,$userId,$oderNum);
			
			foreach ($modelsOrders as $modelsOrder) {
				$modelsOrder->status = $statusN;
				if(isset($orderCart[0]->oderNum)){
					$modelsOrder->oderNum = $orderCart[0]->oderNum;
				}
				$modelsOrder->save();
			}
			return $this->redirect(Url::toRoute('product/listorder'));
		} 
		
		$orderCart = $this->getOderBystatus($status,$userId,$oderNum);
		$arrCart = [];
		
		$arrProduct = $this->getProduct();
		$productDetail = [];
		foreach($orderCart as $dataCart){
			if($dataCart["productId"]){
				$productDetail = $arrProduct[$dataCart["productId"]];
				$arrCart[$dataCart["productId"]]["numProduct"][] = $dataCart;
				$arrCart[$dataCart["productId"]]["productDetail"] = $productDetail;
			}
		}
		return $this->render('bill',[
				'arrCart'=>$arrCart,
				'oderNum'=>$oderNum,
				'status'=>$status,
				'statusN'=>$statusN,
		]);
	}
	
	public function getOderBystatus($status,$createBy,$oderNum){
		
		$orderQuery = Order::find();
		$orderQuery->andWhere(['createBy' => $createBy]);
		$orderQuery->andWhere(['status' => $status]);
		$orderQuery->andWhere(['oderNum' => $oderNum]);
		$order = $orderQuery->all();
		
		return $order;
	}
	
	public function getOderCreateBy($createBy){
		
		$orderQuery = Order::find();
		$orderQuery->andWhere(['createBy' => $createBy]);
		$orderQuery->orderBy('Id DESC');
		$order = $orderQuery->all();
		
		return $order;
	}
	public function getProduct(){
		
		$query = Product::find();
		$model = $query->all();
		$arrProduct = array();
		foreach ($model as $data){
			$arrProduct[$data['Id']] = $data;
		}
		
		return $arrProduct;
	}
	
	
	
}