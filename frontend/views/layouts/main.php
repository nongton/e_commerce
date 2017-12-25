<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\controllers\OrderController;
use common\models\Order;

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <style>
#searchform{
	    float: right;
}
</style>
    
    
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/img/ntf.jpg',['alt' => Yii::$app->name]),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            	['label' => 'New',],
            	['label' => 'Product', 'url' => ['/site/product']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $identity = \Yii::$app->user->getIdentity();
                $userId =  $identity->id;
                $cartNum = 0;
                $orderCart = [];
                $arrCart = [];
                $orderCart = OrderController::getOderBystatus(Order::STATUS_CART,$userId);
                $arrProduct = OrderController::getProduct();
                $productDetail = [];
                foreach($orderCart as $dataCart){
                    if($dataCart["productId"]){
                    	
                    	$productDetail = isset($arrProduct[$dataCart["productId"]])?$arrProduct[$dataCart["productId"]]:'ไม่มีสินค้า';
                        $arrCart[$dataCart["productId"]]["numProduct"][] = $dataCart;
                        $arrCart[$dataCart["productId"]]["productDetail"] = $productDetail;
                    }
                }
                $cartNum = count($orderCart); 
                if($arrCart){
                $menuItemsCart = "";
                foreach ($arrCart as $index=>$data){
                    $qty = count($data['numProduct']);
                    $price = isset($data['productDetail']["productPrice"])?$data['productDetail']["productPrice"]:'ไม่มีสินค้า';
                    $total = $qty * $price;
                    $arrTotal[] = $total;
                    $arrQty[] = $qty;
                    $oderNum = $data['numProduct'][0]["oderNum"];
                    $menuItemsCart .='<li class="dropdown-header " style="text-align:right">'.$data['productDetail']["productName"].' * '.$qty.' = '.number_format($total, 2, '.', '').' บาท </li>';
                }
                $sumTotal =  array_sum($arrTotal); 
                $menuItemsCart.='<li class="dropdown-header"  style="text-align:right"> รวม '.number_format($sumTotal, 2, '.', '').' บาท </li>';
                
                }else {
                    $menuItemsCart = '<li class="dropdown-header "style="text-align:right">ไม่มีสินค้าในตะกร้า</li>';
                }
                
                
                $menuItems[] = [
                    'label' => 'Cart (' .$cartNum . ')',
                    'items' => [
                        $menuItemsCart,
                        '<li class="divider"></li>',
                        ['label' => 'ไปยังตะกร้าสินค้า', 'url' => ['/order/cart'], 'options' => ['style' => 'background-color: #e3f2fd;'],],
                        ['label' => 'ไปยังหน้า Checkout', 'url' => ['/order/checkout'], 'options' => ['style' => 'background-color: #e3f2fd;'],],
                    ],
                ];
                
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        
        <div class="container">
        <div class="row">
        <div class="span12">
             <?php $form =  ActiveForm::begin(['id' => 'searchform' ,'class' => 'form-search form-horizontal pull-right', 'method' => 'post','action' => ['site/search'],'options' => ['enctype' => 'multipart/form-data']]);

     		 ?>
     		 <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" name = "text" class="form-control input-sm" placeholder="Search" value="<?php  isset($text)?$text:' '; ?>">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
            <?php ActiveForm::end() ?>
        </div>
	</div>
	<br />
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; XXX Company <?= date('Y') ?></p>
        <p class="pull-right">XXX</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
