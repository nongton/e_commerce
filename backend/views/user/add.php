<?php
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\web\View;
use common\models\User;

$this->title = "ADD NEWS  USER";
$request = \Yii::$app->request;
$id = $request->get('id');
if($id){
	$disbal = "disabled";
}else {
	$disbal = "";
}
?>
<div class="row">
        <div class="col-md-3">
          <a href="list" class="btn btn-primary btn-block margin-bottom">BACK TO LIST</a>

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
              <h3 class="box-title"> <?php if (!$id): ?>เพิ่มผู้ใช้งานระบบ <?php  else :?> แก้ใขข้อมูลผู้ใช้งานระบบ <?php endif;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php $form = ActiveForm::begin();?>
			<div class="row">
											<div class="col-md-6">
												     <div class="form-group">
													<label>ชื่อ :  </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															   	<?= Html::activeInput('text', $model, 'firstName', ['id'=>'firstName','class' => 'form-control', 'required'=>'required' , 'placeholder' => 'กรอกชื่อผู้ใช้งาน..'])?>
										                </div>
										              </div>
										         </div>
											
													<div class="col-md-6">
												     <div class="form-group">
													<label>นามสกุล :    </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('text', $model, 'lastName', ['id'=>'lastName','class' => 'form-control' , 'required'=>'required', 'placeholder' => 'กรอกนามสกุลผู้ใช้งาน..'])?>
										                </div>
										              </div>
										         </div>
											
											
												<div class="col-md-6">
												     <div class="form-group">
													<label>ที่อยู่ :   </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('text', $model, 'address', ['id'=>'address','class' => 'form-control', 'required'=>'required', 'placeholder' => 'กรอกที่อยู่ผู้ใช้งาน..'])?>
										                </div>
										              </div>
										         </div>
											
												<div class="col-md-6">
												     <div class="form-group">
													<label>โทรศัพท์ :  </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('text', $model, 'phone', ['id'=>'phone','class' => 'form-control', 'placeholder' => 'กรอกเบอร์โทรศัพท์ผู้ใช้งาน..'])?>
										                </div>
										              </div>
										         </div>
											
											<div class="col-md-6">
												     <div class="form-group">
													<label>อีเมล์ : </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															<?= Html::activeInput('text', $model, 'email', ['id'=>'email','class' => 'form-control', 'placeholder' => 'กรอกอีเมลผู้ใช้งาน..'])?>
										                </div>
										              </div>
										         </div>
											
											<div class="col-md-6">
												     <div class="form-group">
													<label>ตำแหน่ง :</label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															<?= HTML::dropDownList('position',$model['position'], [''=> '---- เลือกตำแหน่งผู้ใช้ ----'] + User::$arrPosition, ['id'=>'position','class' => 'form-control input-large','required'=>'required'])?>
										                </div>
										              </div>
										         </div>
											
											
												<div class="col-md-6">
												     <div class="form-group">
													<label>UserName:</label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
														<?= Html::activeInput('text', $model, 'username', ['id'=>'username','class' => 'form-control', 'required'=>'required', 'placeholder' => 'Username...', $disbal=>$disbal])?>
										                </div>
										              </div>
										            </div>
												     
												<div class="col-md-6">
												     <div class="form-group">
													<label>Password:</label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
														<?= Html::passwordInput('password', '', ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'กรุณากรอกรหัสผ่าน', $disbal=>$disbal])?>
										                </div>
										              </div>
										           </div>
					<div class="col-md-12">
						<div class="form-actions fluid">
							<div class="text-center">
								<button type="submit" class="btn btn-primary btn-block margin-bottom">ตกลง</button> 
							</div>
						</div>
					</div>
				</div>
				
				<?php ActiveForm::end() ?>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->


<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>