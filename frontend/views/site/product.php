<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$baseUrl = \Yii::getAlias('@web');
$urlBackend = \Yii::$app->urlManagerBackend->baseUrl;
/* @var $this yii\web\View */
$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="row">
<div class ="col-md-2">
<h3>ประเภทสินค้า</h3>
<ul class="nav nav-pills nav-stacked">
<li role="presentation" class="<?php if($baseUrl.'/site/product' == Url::current() ){ echo "active"; }?>" ><a href="<?php echo $baseUrl;?>/site/product">all Type</a></li>
<?php if($lstProductType):
	foreach ($lstProductType as $indexType=>$dataType): ?>
  <li role="presentation" class="<?php if($baseUrl.'/site/product?type='.$dataType['Id'] == Url::current() ){ echo "active"; }?>" ><a href="<?php echo $baseUrl;?>/site/product?type=<?php echo $dataType['Id']?>"><?php echo $dataType['typeName']?></a></li>
  <?php endforeach; endif;?>
</ul>
</div>
<div class ="col-md-10">
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

     <div class="row">
     <?php if($lstProduct):
                foreach ($lstProduct as $index=>$data):
                ?>
           <div class="col-sm-6 col-md-3">
			    <div class="thumbnail">
			     	<?php	if($data['photo']){ ?>
							<img src="<?php echo $urlBackend;?>/upload/<?php echo $data['photo'];?>" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
					<?php	}else { ?>
							<img src="<?php echo $urlBackend;?>/img/none.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
					<?php } ?>
			      <div class="caption">
			        <h3><?php echo $data['Id']?> - <?php echo $data['productName']?></h3>
			        <p><?php echo $data['productDetail']?></p>
			        <p><?php echo $data['productPrice']?></p>
			        <p><a href="#" class="btn btn-primary" role="button">ซื้อ</a> <a href="#" class="btn btn-default" role="button">หยิบใส่ตะกร้า</a></p>
			      </div>
			    </div>
			  </div>
   <?php endforeach; endif;?>
                 
</div>
<div class=" row">
              	<?php echo LinkPager::widget(['pagination' => $pagination]);?>
              </div>
</div>
</div>
</div>