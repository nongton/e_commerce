<?php
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\web\View;
use common\models\User;

$this->title = "User List";
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


<form  id="dataTable" action="<?php echo $baseUrl ;?>/user/list" method="POST">
<div class="row">
        <div class="col-md-3">
          <a href="<?php echo $baseUrl ;?>/user/add" class="btn btn-primary btn-block margin-bottom">ADD NEWS USER</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Userr Type</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> ADMIN <span class="label label-warning pull-right">5</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> OFFICER <span class="label label-warning pull-right">10</span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> CUSTOMER <span class="label label-warning pull-right">120</span> </a></li>
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
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" id="delete" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>

                  	<?php foreach($model as $lst):?>
                  <tr>
                    <td><input name="selectUser[]" class="checker" type="checkbox" value="<?php echo $lst['id'];?>"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="<?php echo $baseUrl ;?>/user/add?id=<?php echo $lst['id']; ?>"><?php echo  $lst['firstName'].'  '. $lst['lastName']?></a></td>
                    <td class="mailbox-subject"><?php echo $lst['email']?> </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo User::$arrPosition[$lst['position']]?></td>
                  </tr>
                 <?php endforeach;?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      
<?= Html::hiddenInput('op','',['id'=>'op']);?>
</form>     
      <!-- /.row -->
