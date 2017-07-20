<?php 
use yii\web\View;
use yii\bootstrap\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\widgets\ActiveForm;

$this->title = "Product List";
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


<form  id="dataTable" action="<?php echo $baseUrl ;?>/product/list" method="POST">
<div class="row">
        <div class="col-md-3">
          <a href="<?php echo $baseUrl ;?>/product/add" class="btn btn-primary btn-block margin-bottom">ADD NEWS PRODUCT</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Product Type</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
              <li class="<?php if($baseUrl.'/product/list' == Url::current() ){ echo "active"; }?>"><a href="<?php echo $baseUrl;?>/product/list"><i class="fa fa-inbox"></i> ALL TYPE<span class="label label-warning pull-right">5</span></a></li>
               <?php if($lstProductType):
               foreach ($lstProductType as $indexType=>$dataType): ?>
               
                <li class="<?php if($baseUrl.'/product/list?type='.$dataType['Id'] == Url::current() ){ echo "active"; }?>" ><a href="<?php echo $baseUrl;?>/product/list?type=<?php echo $dataType['Id']?>"><i class="fa fa-inbox"></i> <?php echo $dataType['typeName']?><span class="label label-warning pull-right">5</span></a></li>
               
                <?php endforeach; endif;?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">STATUS</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> ACTIVE <span class="label label-primary pull-right">120</span>  </a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> DELETE  <span class="label label-primary pull-right">20</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i>WAITING <span class="label label-primary pull-right">25</span> </a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Product List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Product Pic</th>
                  <th>Product Detail</th>
                  <th>Product Price</th>
                  <th>Product Quantity</th>
                  <th>Tool</th>
                </tr>
                
                <?php if($lstProduct):
                foreach ($lstProduct as $index=>$data):
                ?>
                <tr>
                  <td><span class="label label-success"><?php echo $data['Id']?></span></td>
                  <td><?php echo $data['productName']?></td>
                  <td> </td>
                  <td><?php echo $data['productDetail']?></td>
                  <td><?php echo $data['productPrice']?></td>
                  <td><span class="label label-success"><?php echo $data['productQuantity']?></span> </td>
                  <td>
                  
                  <a href="<?php echo $baseUrl ;?>/product/add?id=<?php echo $data['Id']; // ส่ง id ไปยัง actionDelete เพื่อลบสินค้าชิ้นนี้ ?>" class="btn btn-default btn-sm" ><i class="fa fa-edit"></i></a>
                  <a href="<?php echo $baseUrl ;?>/product/delete?id=<?php echo $data['Id']; // ส่ง id ไปยัง actionDelete เพื่อลบสินค้าชิ้นนี้ ?>" class="btn btn-default btn-sm" ><i class="fa fa-trash-o"></i></a>
                </tr>
                <?php endforeach; endif;?>
                
              </table>
              <div class="pull-right box-tools">
              	<?php echo LinkPager::widget(['pagination' => $pagination]);?>
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