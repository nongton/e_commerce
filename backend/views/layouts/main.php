<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\components\Topbar;
use backend\components\Sidebar;

/* @var $this \yii\web\View */
/* @var $content string */

// assets\AppAsset.php
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
	<div class="wrapper">
      <!-- Top header colum -->
	  <header class="main-header">
	  <?php echo Topbar::widget();?>
	  </header>
	  
	  <!-- Left side column. contains the logo and sidebar -->
	   <aside class="main-sidebar">
	    <?php echo Sidebar::widget();?>
	   </aside>
	    
	    
	   <!-- Content Wrapper. Contains page content --> 
	   <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
		    <section class="content-header">
		      <h1>
		      	  ทดสอบ หน้าหลัก
		        <small>Control panel</small>
		      </h1>
		      <?= Breadcrumbs::widget([
		            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		        ]) ?>
		        <?= $content ?>
		    </section>
	  
	   </div>
	   <!-- /.content-wrapper -->

	   <!-- footer -->
	   <footer class="main-footer">
	   
	   </footer>

	    <div class="control-sidebar-bg"></div>
	   </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
