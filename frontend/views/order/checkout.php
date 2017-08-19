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

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> CHECK OUT 
            <small class="pull-right">Date: <?=date("Y/m/d");?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          ที่อยู่สำหรับ จัดส่งสินค้า
          <div class="form-group">
                  <label>ชื่อ ที่อยู</label>
                  <input type="text" class="form-control" placeholder="ชื่อ ...">
                  <textarea class="form-control" rows="3" placeholder="ที่อยู่ ..."></textarea>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          ที่อยู่สำหรับ ออกใบกำกับภาษี
        <div class="form-group">
                  <label>ชื่อ ที่อยู</label>
                  <input type="text" class="form-control" placeholder="ชื่อ ...">
                  <textarea class="form-control" rows="3" placeholder="ที่อยู่ ..."></textarea>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    
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
            <?php if($arrCheckout):?>
            <?php $i = 1; foreach ($arrCheckout as $index=>$data): ?>
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
        <p class="lead text-green ">Oder Number : <?=$oderNum?></p>
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

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
        	<a href="<?=$baseUrl?>/order/cart?oderNum=<?=$oderNum?>&op=reCart" class="btn btn-success"><i class="fa fa-print">กลับไปตะกร้าสินค้า</i></a>
          	<a href="<?=$baseUrl?>/order/pay?oderNum=<?=$oderNum?>&op=pay" class="btn btn-success pull-right"><i class="fa fa-print">ชำระเงิน</i></a>
        </div>
      </div>
    </section>