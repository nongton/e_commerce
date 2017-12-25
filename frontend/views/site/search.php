<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$baseUrl = \Yii::getAlias('@web');
$urlBackend = \Yii::$app->urlManagerBackend->baseUrl;
/* @var $this yii\web\View */
$this->title =$text;
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="row">
<div class ="col-md-12">
<div class="site-about">
    <h1>ค้นหา  <?= Html::encode($this->title) ?></h1>

    <p></p>

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
			       <p><a href="<?php echo $baseUrl.'/order/add?op=cart&productId='.$data['Id'].'&price='.$data['productPrice'];?>" class="btn btn-primary" role="button">ซื้อ</a> <a href="<?php echo $baseUrl.'/order/add?productId='.$data['Id'].'&price='.$data['productPrice'];?>" class="btn btn-default" role="button">หยิบใส่ตะกร้า</a></p>
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