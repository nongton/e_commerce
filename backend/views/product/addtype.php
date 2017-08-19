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
          <a href="<?php echo $baseUrl ;?>/product/listtype" class="btn btn-primary btn-block margin-bottom">BACK TO LIST</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Product Type</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
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
													<label>Type Name :  </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															   	<?= Html::activeInput('text', $model, 'typeName', ['id'=>'typeName','class' => 'form-control', 'required'=>'required' , 'placeholder' => 'type Name..'])?>
										                </div>
										              </div>
										         </div>
											
											
												<div class="col-md-6">
												     <div class="form-group">
													<label>typeDescription :   </label>
													      <div class="input-group">
										                  <div class="input-group-addon">
										                    <i class="fa fa-clock-o"></i>
										                  </div>
															     <?= Html::activeInput('text', $model, 'typeDescription', ['id'=>'typeDescription','class' => 'form-control', 'required'=>'required', 'placeholder' => 'type Description ..'])?>
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
