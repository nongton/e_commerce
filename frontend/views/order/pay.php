<?php
use app\Ui;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$baseUrl = \Yii::getAlias('@web');
$urlBackend = \Yii::$app->urlManagerBackend->baseUrl;
/* @var $this yii\web\View */
$this->title = 'Checkout';
//$this->params['breadcrumbs'][] = $this->title;
$arrTotal = [];
$oderNum = '';
?>
<style>

</style>

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> ชำระเงิน ค่าสินค้า
            <small class="pull-right">Date: <?=date("Y/m/d");?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
    
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
            <?php if($arrPending):?>
            <?php $i = 1; foreach ($arrPending as $index=>$data): ?>
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
              <td  style="text-align:right">
              <?=$qty?>
               </td>
              <td  style="text-align:right"><?php echo number_format($total, 2, '.', '');?></td>
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
      <!-- /.row -->
  	<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Credit Card</a></li>
  <li><a data-toggle="tab" href="#menu1">Direct Debit</a></li>
  <li><a data-toggle="tab" href="#menu2">Counter Payment</a></li>
	</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Credit Card</h3>
    <div class="container">
<div class="row">
<!-- You can make it whatever width you want. I'm making it full width
on <= small devices and 4/12 page width on >= medium devices -->
<div class="col-xs-12 col-md-4">


<!-- CREDIT CARD FORM STARTS HERE -->
<div class="panel panel-default credit-card-box">
<div class="panel-heading display-table" >
<div class="row display-tr" >
<h3 class="panel-title display-td" >Payment Details</h3>
<div class="display-td" >                            
<img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
</div>
</div>                    
</div>
<div class="panel-body">
<form role="form" id="payment-form">
<div class="row">
<div class="col-xs-12">
<div class="form-group">
<label for="cardNumber">CARD NUMBER</label>
<div class="input-group">
<input 
type="tel"
class="form-control"
name="cardNumber"
placeholder="Valid Card Number"
autocomplete="cc-number"
required autofocus 
/>
<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
</div>
</div>                            
</div>
</div>
<div class="row">
<div class="col-xs-7 col-md-7">
<div class="form-group">
<label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
<input 
type="tel" 
class="form-control" 
name="cardExpiry"
placeholder="MM / YY"
autocomplete="cc-exp"
required 
/>
</div>
</div>
<div class="col-xs-5 col-md-5 pull-right">
<div class="form-group">
<label for="cardCVC">CV CODE</label>
<input 
type="tel" 
class="form-control"
name="cardCVC"
placeholder="CVC"
autocomplete="cc-csc"
required
/>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12">
<div class="form-group">
<label for="couponCode">COUPON CODE</label>
<input type="text" class="form-control" name="couponCode" />
</div>
</div>                        
</div>
<div class="row">
<div class="col-xs-12">
</div>
</div>
<div class="row" style="display:none;">
<div class="col-xs-12">
<p class="payment-errors"></p>
</div>
</div>
</form>
</div>
</div>            
<!-- CREDIT CARD FORM ENDS HERE -->


</div>            



</div>
</div>

	<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	
</body>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Direct Debit</h3>
    <p>Some content in menu 1.</p>
  </div>
  <div id="menu2" class="tab-pane fade">
    <h3>Counter Payment</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
        	<a href="<?=$baseUrl?>/order/pay?oderNum=<?=$oderNum?>&op=reCart" class="btn btn-success"><i class="fa fa-print">ยกเลิกชำระเงินกลับไปตะกร้าสินค้า</i></a>
          	<a href="<?=$baseUrl?>/order/bill?oderNum=<?=$oderNum?>" class="btn btn-success pull-right"><i class="fa fa-print">เสร็จสิ้น</i></a>
        </div>
      </div>
    </section>