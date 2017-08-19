<?php
namespace frontend\controllers;

use Yii;

use yii\helpers\Url;
use yii\helpers\Html;
use app\Ui;
use common\models\Product;
use common\models\Producttype;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\models\Order;
/**
 * Site controller
 */
class OrderController extends Controller
{

  
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
    
    public function actionAdd()
    {
        
        $request = \Yii::$app->request;
        $productId = $request->get('productId','');
        $op = $request->get('op','');
        $price = $request->get('price','');
        $identity = \Yii::$app->user->getIdentity();
        $userId =  $identity->id;
        $num = 1;
        $oderNum = date('Ymd').'_'.$userId.'00'.$num;
        $arrOderNum = [];
        if(isset($productId)){
            $order = $this->getOderCreateBy($userId);
            if(isset($order)){
            	if(!empty($order[0])){ //เช็คว่า order มี สินค้าอยู่ มั้ย
                if($order[0]->status == Order::STATUS_CART){
                    $oderNum = isset($order[0]->oderNum)?$order[0]->oderNum:$oderNum; 
                }else {
                    $arrOderNum = explode("_", $order[0]->oderNum);
                    $newsOderNum = $arrOderNum[1]+1;
                    if($arrOderNum[0] ==  date('Ymd')){
                        $oderNum = $arrOderNum[0].'_'.$newsOderNum;
                    }else{
                        $oderNum = date('Ymd').'_'.$userId.'00'.$num;
                    }
                }
            	}
            }
            $model = new Order();
            $model->oderNum = (string)$oderNum ;
            $model->createBy = $userId;
            $model->createTime = date("Y-m-d H:i:s");
            $model->quantity = 1;
            $model->price = $price;
            $model->status = Order::STATUS_CART;
            $model->productId = $productId;
            if($model->save()){
                Ui::setMessage('บันทึกข้อมูลสำเร็จ','success');
                if($op == "cart"){
                return $this->redirect(Url::toRoute('order/cart'));
                }else {
                return $this->redirect(Yii::$app->request->referrer);
                }  
            }
            else {
                Ui::setMessage('การบันทึกข้อมูลผิดพลาด','danger');
            }
            
        }else{
            Ui::setMessage('ไม่มีสินค้า','danger');
            
        }

        return $this->redirect(Url::toRoute('order/cart'));
        
    }
    
    public function actionDelete(){
        $request = \Yii::$app->request;
        $productId =  $request->get('productId', $request->post('productId',''));
        $op = $request->get('op', $request->post('op',''));
        $oderNum =  $request->get('oderNum', $request->post('oderNum',''));
        $identity = \Yii::$app->user->getIdentity();
        $userId =  $identity->id;
        
        $orderQuery = Order::find();
        $orderQuery->andWhere(['createBy' => $userId]);
        $orderQuery->andWhere(['oderNum' => $oderNum]);
        $orderQuery->andWhere(['productId' => $productId]);
        if($op == 'all'){
            $modelsOrders = $orderQuery->all();
            foreach ($modelsOrders as $modelsOrder) {
                $modelsOrder->delete();
            }
        }elseif ($op == 'one'){
            $modelsOrder = $orderQuery->one();
            $modelsOrder->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
        
    }

    public function actionCart()
    {
        $request = \Yii::$app->request;
        $identity = \Yii::$app->user->getIdentity();
        $userId =  $identity->id;
        $op = $request->get('op', $request->post('op',''));
        $oderNum =  $request->get('oderNum', $request->post('oderNum',''));
        if($op == "reCart"){
            $orderQuery = Order::find();
            $orderQuery->andWhere(['createBy' => $userId]);
            $orderQuery->andWhere(['oderNum' => $oderNum]);
            $modelsOrders = $orderQuery->all();
            $orderCart = $this->getOderBystatus(Order::STATUS_CART,$userId);
            
            foreach ($modelsOrders as $modelsOrder) {
                $modelsOrder->status = Order::STATUS_CART;
                if(isset($orderCart[0]->oderNum)){
                $modelsOrder->oderNum = $orderCart[0]->oderNum;
                }
                $modelsOrder->save();
            }
        }
        
        $orderCart = $this->getOderBystatus(Order::STATUS_CART,$userId);
        $orderCheckout = $this->getOderBystatus(Order::STATUS_CHECKOUT,$userId);
        $orderPending = $this->getOderBystatus(Order::STATUS_PENDING,$userId);
        $orderComplete = $this->getOderBystatus(Order::STATUS_COMPLETE,$userId);
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
        return $this->render('cart',[
            'arrCart'=>$arrCart,
        ]);
    }
    
    public function actionCheckout()
    {
        $request = \Yii::$app->request;
        $oderNum =  $request->get('oderNum', $request->post('oderNum',''));
        $identity = \Yii::$app->user->getIdentity();
        $userId =  $identity->id;
        
        $orderQuery = Order::find();
        $orderQuery->andWhere(['createBy' => $userId]);
        $orderQuery->andWhere(['oderNum' => $oderNum]);
        
        $modelsOrders = $orderQuery->all();
            foreach ($modelsOrders as $modelsOrder) {
                $modelsOrder->status = Order::STATUS_CHECKOUT;
                $modelsOrder->save();
            }
        
        $orderCart = $this->getOderBystatus(Order::STATUS_CART,$userId);
        $orderCheckout = $this->getOderBystatus(Order::STATUS_CHECKOUT,$userId);
        $orderPending = $this->getOderBystatus(Order::STATUS_PENDING,$userId);
        $orderComplete = $this->getOderBystatus(Order::STATUS_COMPLETE,$userId);
        $arrCheckout = [];
        
        $arrProduct = $this->getProduct();
        $productDetail = [];
        foreach($orderCheckout as $dataCheckout){
            if($dataCheckout["productId"]){
                $productDetail = $arrProduct[$dataCheckout["productId"]];
                $arrCheckout[$dataCheckout["productId"]]["numProduct"][] = $dataCheckout;
                $arrCheckout[$dataCheckout["productId"]]["productDetail"] = $productDetail;
            }
        }
        return $this->render('checkout',[
            'arrCheckout'=>$arrCheckout,
        ]);
    }
    
    public function actionPay()
    {
    	$request = \Yii::$app->request;
    	$oderNum =  $request->get('oderNum', $request->post('oderNum',''));
    	$identity = \Yii::$app->user->getIdentity();
    	$userId =  $identity->id;
    	
    	$orderQuery = Order::find();
    	$orderQuery->andWhere(['createBy' => $userId]);
    	$orderQuery->andWhere(['oderNum' => $oderNum]);
    	
    	$modelsOrders = $orderQuery->all();
    	foreach ($modelsOrders as $modelsOrder) {
    		$modelsOrder->status = Order::STATUS_PENDING;
    		$modelsOrder->save();
    	}
    	
    	$orderCart = $this->getOderBystatus(Order::STATUS_CART,$userId);
    	$orderCheckout = $this->getOderBystatus(Order::STATUS_CHECKOUT,$userId);
    	$orderPending = $this->getOderBystatus(Order::STATUS_PENDING,$userId);
    	$orderComplete = $this->getOderBystatus(Order::STATUS_COMPLETE,$userId);
    	$arrPending= [];
    	
    	$arrProduct = $this->getProduct();
    	$productDetail = [];
    	foreach($orderPending as $dataPending){
    		if($dataPending["productId"]){
    			$productDetail = $arrProduct[$dataPending["productId"]];
    			$arrPending[$dataPending["productId"]]["numProduct"][] = $dataPending;
    			$arrPending[$dataPending["productId"]]["productDetail"] = $productDetail;
    		}
    	}
    	return $this->render('pay',[
    			'arrPending'=>$arrPending,
    	]);
    }
    
    public function actionBill()
    {
    	$request = \Yii::$app->request;
    	$oderNum =  $request->get('oderNum', $request->post('oderNum',''));
    	$identity = \Yii::$app->user->getIdentity();
    	$userId =  $identity->id;
    	
    	$orderQuery = Order::find();
    	$orderQuery->andWhere(['createBy' => $userId]);
    	$orderQuery->andWhere(['oderNum' => $oderNum]);
    	
    	$modelsOrders = $orderQuery->all();
    	foreach ($modelsOrders as $modelsOrder) {
    		$modelsOrder->status = Order::STATUS_COMPLETE;
    		$modelsOrder->save();
    	}
    	
    	$orderCart = $this->getOderBystatus(Order::STATUS_CART,$userId);
    	$orderCheckout = $this->getOderBystatus(Order::STATUS_CHECKOUT,$userId);
    	$orderPending = $this->getOderBystatus(Order::STATUS_PENDING,$userId);
    	$orderComplete = $this->getOderBystatus(Order::STATUS_COMPLETE,$userId);
    	$arrPending= [];
    	
    	$arrProduct = $this->getProduct();
    	$productDetail = [];
    	foreach($orderComplete as $dataPending){
    		if($dataPending["productId"]){
    			$productDetail = $arrProduct[$dataPending["productId"]];
    			$arrPending[$dataPending["productId"]]["numProduct"][] = $dataPending;
    			$arrPending[$dataPending["productId"]]["productDetail"] = $productDetail;
    		}
    	}
    	return $this->render('bill',[
    			'arrPending'=>$arrPending,
    	]);
    }
    
    
    public function getOderBystatus($status,$createBy){
        
        $orderQuery = Order::find();
        $orderQuery->andWhere(['createBy' => $createBy]);
        $orderQuery->andWhere(['status' => $status]);
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
