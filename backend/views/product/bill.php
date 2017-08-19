<?php
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


use yii\web\View;
use common\models\User;
use common\models\Product;

use kartik\file\FileInput;
use common\models\Order;

$this->title = "Order ID = ".$oderNum;
$baseUrl = \Yii::getAlias('@web');
$request = \Yii::$app->request;
$id = $request->get('id');
if($id){
	$disbal = "disabled";
}else {
	$disbal = "";
}
$arrTotal = [];
$oderNum = '';
?>
    	<div class="row">
    		
    		<div class="span4 well">
    			<table class="invoice-head">
    				<tbody>
    					<tr>
    						<td class="pull-right"><strong>Customer #</strong></td>
    						<td>21398324797234</td>
    					</tr>
    					<tr>
    						<td class="pull-right"><strong>Invoice #</strong></td>
    						<td>2340</td>
    					</tr>
    					<tr>
    						<td class="pull-right"><strong>Date</strong></td>
    						<td>10-08-2013</td>
    					</tr>
    					<tr>
    						<td class="pull-right"><strong>Period</strong></td>
                          <td>9/1/2103 - 9/30/2013</td>
    					</tr>
    				</tbody>
    			</table>
    		</div>
    	</div>
    	<div class="row">
    		<div class="span8">
    			<h2>Order</h2>
    		</div>
    	</div>
    	      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th width="10%">รหัสสินค้า #</th>
              <th width="50%">สินค้า</th>
              <th width="10%" style="text-align:right">ราคาต่อชิ้น</th>
              <th width="20%" style="text-align:right">จำนวน</th>
              <th width="10%" style="text-align:right">ราคารวม</th>
            </tr>
            </thead>
            <tbody>
            <?php if($arrCart):?>
            <?php $i = 1; foreach ($arrCart as $index=>$data): ?>
            <?php 
            $qty = count($data['numProduct']);
            $price = $data['productDetail']["productPrice"];
            $total = $qty * $price;
            $arrTotal[] = $total;
            $arrQty[] = $qty;
            $oderNum = $data['numProduct'][0]["oderNum"];
            ?>
            <tr>
              <td><a href="<?=$baseUrl?>/product/detail?id=<?=$index?>"><?=$index?></a></td>
              <td><a href="<?=$baseUrl?>/product/detail?id=<?=$index?>"><?=$data['productDetail']["productName"]?></a></td>
              <td  style="text-align:right"><?php echo number_format($price, 2, '.', '');?></td>
              <td  style="text-align:right"><?=$qty?> </td>
              <td  style="text-align:right"><?php echo number_format($total, 2, '.', '');?></td>
              <td></td>
            </tr>
            <?php $i++; endforeach; else :?>
            <tr>
            <td>
            <h3>ไม่มีสินค้า ในตะกร้าสินค้า </h3>
            </td>
            </tr>
            <?php endif;
            $sumTotal =  array_sum($arrTotal); 
            $tax = (7/100)*$sumTotal;
            $sumTotalTax = $tax + $sumTotal;
            $shipping = 0;
            $sumall = $sumTotalTax + $shipping;
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        <p class="lead text-green ">Oder Number : <?=$oderNum?></p>
          <?php $form = ActiveForm::begin();?>
        		<div class="form-group">
					<label>ปรับ Status : </label>
					<div class="input-group">
						<div class="input-group-addon">
					<i class="fa fa-clock-o"></i>
					</div>
					<?= Html::dropDownList('statusN', $status,Order::$arrOrderStatus,['id'=>'status','class' => 'form-control select2 ', 'placeholder' => 'Product Quantity..'])?>
					</div>
					<button type="submit" class="btn btn-primary btn-block margin-bottom">ตกลง</button> 
			 </div>
			 
			 <?php
			 echo Html::hiddenInput('op', 'setStatus');
			 ActiveForm::end() ?>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td style="text-align:right"><?php echo number_format($sumTotal, 2, '.', '');?></td>
              </tr>
              <tr>
                <th>Tax (7%)</th>
                <td style="text-align:right"><?php echo number_format($tax, 2, '.', '');?></td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td style="text-align:right"><?php echo number_format($shipping, 2, '.', '');?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td style="text-align:right"><?php echo number_format($sumall, 2, '.', '');?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      
  		