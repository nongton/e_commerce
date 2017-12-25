<?php
use app\Ui;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$baseUrl = \Yii::getAlias('@web');
$urlBackend = \Yii::$app->urlManagerBackend->baseUrl;
/* @var $this yii\web\View */
$this->title = 'Bill';
//$this->params['breadcrumbs'][] = $this->title;
$arrTotal = [];
$oderNum = '';
?>
<style>
invoice-head td {
  padding: 0 8px;
}
container {
  padding-top:30px;
}
invoice-body{
  background-color:transparent;
}
invoice-thank{
  margin-top: 60px;
  padding: 5px;
}
address{
  margin-top:15px;
}
</style>

<input class="btn right" style="float: right;" type='button' id='btn' value='Print' onclick='printDiv();'>
<div class="container" id='DivIdToPrint'>
    	<div class="row">
    		<div class="span4">
                <i mg src="//placehold.it/170x40" class="img-rounded logo">
                <br>
    			<address>
			        <strong>NTF</strong><br>
			        Bangkok <br>
			        Thailand<br>
		    	</address>
    		</div>
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
    			<h2>Invoice</h2>
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
              <td><?=$index?></td>
              <td><?=$data['productDetail']["productName"]?></td>
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
  		<div class="row">
  			<div class="span8 well invoice-thank">
  				<h5 style="text-align:center;">Thank You!</h5>
  			</div>
  		</div>
  		<div class="row">
  	    	<div class="span3">
  		        <strong>Phone:</strong> <a href="tel:555-555-5555">555-555-5555</a>
  	    	</div>
  	    	<div class="span3">
  		        <strong>Email:</strong> <a href="mailto:hello@5marks.co">ntf@hotmail.com</a>
  	    	</div>
  	    	<div class="span3">
  		        <strong>Website:</strong> <a href="http://5marks.co">www.ntf.com</a>
  	    	</div>
  		</div>
    </div>
    
<script>
function printDiv() 
	{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>