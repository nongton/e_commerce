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

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends Controller
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
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        //  query data all product
        $productQuery = Product::find();
        $productQuery->orderBy(['id' => SORT_ASC]);
        $objProduct = $productQuery->all();
        $listproduct = [];
        foreach ($objProduct as $dataProduct){
            $listproduct[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'].' ราคา:'.$dataProduct['productPrice'].' บาท';
            $listproductName[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'];
        }
        
        return $this->render('index', [
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
    public function actionCreate()
    {
        $identity = \Yii::$app->user->getIdentity();
        $identityId =  $identity->id;
        $model = new Stock();
        
        
        //  query data all product 
		$productQuery = Product::find();
		$productQuery->orderBy(['id' => SORT_ASC]);
        $objProduct = $productQuery->all();
        $listproduct = [];
        foreach ($objProduct as $dataProduct){
			$listproduct[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'].' ราคา:'.$dataProduct['productPrice'].' บาท';
			$listproductName[$dataProduct['Id']] = 'รหัสสินค้า :'.$dataProduct['Id'].' ชื่อสินค้า:'.$dataProduct['productName'];
        }
        if ($model->load(Yii::$app->request->post())){
            
            $model->creatBy = $identityId;
            $model->creatTime = date("Y-m-d h:i:sa");
            // บันทึก สต็อคสินค้า
            if ($model->save()) {
                
                // เพิ่มจำนวน รวมสินค้า ใน table product โดยเอา จำนวนเดิม + จำนวนที่ซื้อเพิ่ม
                $productId = $model->productId;
                $productQuery->where(['id'=>$productId]);
                $myProduct = $productQuery->one();
                $oleQuantity = $myProduct->productQuantity;
                $newQuantity = $oleQuantity + $model->quantity;
                $myProduct->productQuantity = (string)$newQuantity;
                $myProduct->productType = (string)$myProduct->productType;
                
                if($myProduct->save()){
                return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    print_r($myProduct->getErrors());
                }
            }else {
                return $this->render('create', [
                    'model' => $model,
                    'listproduct' => $listproduct,
                ]);
            }

        }else {
            return $this->render('create', [
                'model' => $model,
                'listproduct' => $listproduct,
            ]);
        }
    }

    /**
     * Updates an existing Stock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //  query data all product 
		$productQuery = Product::find();
		$productQuery->orderBy(['id' => SORT_ASC]);
        $objProduct = $productQuery->all();
        $listproduct = [];
        foreach ($objProduct as $dataProduct){
			$listproduct[$dataProduct['Id']] = $dataProduct['Id'].' '.$dataProduct['productName'].' '.$dataProduct['productPrice'];
		}

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'listproduct' => $listproduct,
            ]);
        }
    }

    /**
     * Deletes an existing Stock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
