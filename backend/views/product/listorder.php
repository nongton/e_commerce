<?php 
use yii\web\View;
use yii\bootstrap\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\widgets\ActiveForm;
use common\models\Order;

$this->title = "Order List";
$baseUrl = \Yii::getAlias('@web');
$user = Yii::$app->user->getIdentity();

$str = <<<EOT
$(document).ready(function() {
debugger;
	$('#delete').click(function() {
debugger;
		   postAction('delete');
	});

	$('#search').click(function() {
	
			postAction('search');
	});
});

function postAction(action) {
debugger;
	$( "#dataTable-form" ).removeAttr("target");
	$('#op').val(action);
debugger;
	if(action == 'delete'){
	
		if(! confirm("คุณแน่ใจว่าต้องการจะลบรายการที่เลือกไว้ ?")){
			$('div.checker span').removeClass('checked');
		}
	}
	
	$('#dataTable').submit();
}



EOT;

$this->registerJs($str, View::POS_LOAD, 'form-js');
?>


<form  id="dataTable" action="<?php echo $baseUrl ;?>/product/listorder" method="POST">
<div class="row">

        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Order ID</th>
                  <th>ผู้สั่งซื้อ</th>
                  <th>จำนวนสินค้า</th>
                  <th>ราคา รวม</th>
                  <th>สถาณะ</th>
                  <th>จัดการ</th>
                </tr>
                
                <?php if($arrOrder):
                foreach ($arrOrder as $index=>$data):
                $arrPrice = [];
                foreach ($data as $lstOrder){
                	$status = $lstOrder['status'];
                	$user =  $lstOrder['createBy'];
                	$arrPrice[] =  $lstOrder['price'];
                }
                
                $sumPrice = array_sum($arrPrice);
                $tax = $sumPrice * (7/100);
                $sumAll = $sumPrice + $tax;
                $statusOrder =  Order::$arrOrderStatus[$status];
                $statusLabel = Order::$arrOrderStatusLabel[$status];
                ?>
                <tr>
                  <td><span class="label label-success"><?php echo $index;?></span></td>
                  <td><?=$arrUser[$user]?></td>
                  <td><?=count($data);?> ชิ้น</td>
                  <td ><?=$sumAll?> บาท</td>

                  <td><span class="label <?=$statusLabel?>"><?=$statusOrder?> </span> </td>
                  <td><a href="<?=$baseUrl?>/product/bill?id=<?=$index?>&uid=<?=$user?>&status=<?=$status?>" class="btn"><i class="fa fa-print">จัดการรายการสั่งซื้อ</i></a></td>
                   </tr>
                <?php endforeach; endif;?>
                
              </table>
              <div class="pull-right box-tools">
              	
              </div>
            </div>
              <!-- /.mail-box-messages -->
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      
<?= Html::hiddenInput('op','',['id'=>'op']);?>
</form>     