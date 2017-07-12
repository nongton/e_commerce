<?php
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\web\View;
use common\models\User;

$this->title = "ADD NEWS  PRODUCT";
$baseUrl = \Yii::getAlias('@web');
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
          <a href="<?php echo $baseUrl ;?>/product/list" class="btn btn-primary btn-block margin-bottom">BACK TO LIST</a>

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
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> TYPE 1<span class="label label-warning pull-right">5</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> TYPE 2 <span class="label label-warning pull-right">10</span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> TYPE 3 <span class="label label-warning pull-right">120</span> </a></li>
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
              <h3 class="box-title"> <?php if (!$id): ?>เพิ่ม <?php  else :?> แก้ใข <?php endif;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php $form = ActiveForm::begin();?>
			<div class="row">
											<div class="col-md-6">
												     <div class="form-group">
													<label>Product Name :  </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															   	<?= Html::activeInput('text', $model, 'productName', ['id'=>'firstName','class' => 'form-control', 'required'=>'required' , 'placeholder' => 'Product Name..'])?>
										                </div>
										              </div>
										         </div>
											
													<div class="col-md-6">
												     <div class="form-group">
													<label>Product Pic :    </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('file', $model, 'productPic', ['id'=>'lastName','class' => 'form-control' , 'required'=>'required', 'placeholder' => 'Product Pic..'])?>
										                </div>
										              </div>
										         </div>
											
											
												<div class="col-md-6">
												     <div class="form-group">
													<label>Product Detail :   </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('text', $model, 'productDetail', ['id'=>'address','class' => 'form-control', 'required'=>'required', 'placeholder' => 'Product Detail..'])?>
										                </div>
										              </div>
										         </div>
											
												<div class="col-md-6">
												     <div class="form-group">
													<label>Product Price :  </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('text', $model, 'productPrice', ['id'=>'phone','class' => 'form-control', 'placeholder' => 'Product Price..'])?>
										                </div>
										              </div>
										         </div>
											
											<div class="col-md-6">
												     <div class="form-group">
													<label>Product Quantity : </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															<?= Html::activeInput('text', $model, 'productQuantity', ['id'=>'email','class' => 'form-control', 'placeholder' => 'Product Quantity..'])?>
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
</div>
