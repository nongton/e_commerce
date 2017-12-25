<?php

namespace backend\controllers;

use Yii;
use common\models\Stock;
use common\models\Product;
use common\models\User;
use common\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ReportSearch;
use common\models\UserSearch;
/**
 * StockController implements the CRUD actions for Stock model.
 */
class ReportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        //  query data all product
        $productQuery = Product::find();
        $productQuery->orderBy(['Id' => SORT_ASC]);
        $objProduct = $productQuery->all();
        $listproduct = [];
        foreach ($objProduct as $dataProduct){
            $listproduct[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'].' ราคา:'.$dataProduct['productPrice'].' บาท';
            $listproductName[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'];
        }
        $this->layout = 'krajee';
        return $this->render('index', [
            'listproductName' => $listproductName,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionSales() {
    	$searchModel = new ReportSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	
    	//  query data all product
    	$productQuery = Product::find();
    	$productQuery->orderBy(['Id' => SORT_ASC]);
    	$objProduct = $productQuery->all();
    	$listproduct = [];
    	foreach ($objProduct as $dataProduct){
    		$listproduct[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'].' ราคา:'.$dataProduct['productPrice'].' บาท';
    		$listproductName[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'];
    	}
    	//$this->layout = 'home';
    	return $this->render('sales', [
    			'listproductName' => $listproductName,
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    	
    }
    
    
    
    public function actionCustomer() {
    	$searchModel = new UserSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	
    	//  query data all product
    	$productQuery = Product::find();
    	$productQuery->orderBy(['Id' => SORT_ASC]);
    	$objProduct = $productQuery->all();
    	$listproduct = [];
    	foreach ($objProduct as $dataProduct){
    		$listproduct[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'].' ราคา:'.$dataProduct['productPrice'].' บาท';
    		$listproductName[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'];
    	}
    	
    	
    	
    	//$this->layout = 'home';
    	return $this->render('customer', [
    			'listproductName' => $listproductName,
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }

    /**
     * Displays a single Stock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    /**
     * Updates an existing Stock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */


    /**
     * Deletes an existing Stock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    /**
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
