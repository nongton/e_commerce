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


<form  id="dataTable" action="<?php echo $baseUrl ;?>/product/listtype" method="POST">
<div class="row">
        <div class="col-md-3">
          <a href="<?php echo $baseUrl ;?>/product/addtype" class="btn btn-primary btn-block margin-bottom">ADD NEWS PRODUCT TYPE</a>
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
                  <th>ProductType Name</th>
                  <th>ProductType Detail</th>
                  <th>Tool</th>
                </tr>
                
                <?php if($lstProductType):
                foreach ($lstProductType as $index=>$data):
                ?>
                <tr>
                  <td><span class="label label-success"><?php echo $data['Id']?></span></td>
                  <td><?php echo $data['typeName']?></td>
                  <td><?php echo $data['typeDescription']?></td>

                  <td>
                  <a href="<?php echo $baseUrl ;?>/product/deletetype?id=<?php echo $data['Id']; // ส่ง id ไปยัง actionDelete เพื่อลบสินค้าชิ้นนี้ ?>" class="btn btn-default btn-sm" ><i class="fa fa-trash-o"></i></a>
                
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