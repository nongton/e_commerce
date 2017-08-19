<?php

use yii\helpers\Url;
use yii\helpers\Html;

use app\Entity;
use common\models\User;

$baseUrl = \Yii::getAlias('@web');
$user = Yii::$app->user->getIdentity();

$str = <<<EOT

EOT;
$this->registerJs($str);
?>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $baseUrl; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
         <?php if ($user): ?>
        <div class="pull-left info">
          <p> <?php echo $user->firstName.' '.$user->lastName; ?></p>
          <a href="<?php echo $baseUrl; ?>"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <?php endif;?>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($baseUrl.'/site/index' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl;?>/site/index"><i class="fa fa-circle-o"></i>Home</a></li>
            
          </ul>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa   fa-edit "></i> <span>Customer Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/list' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/user/list"><i class="fa fa-circle-o"></i> User</a></li>
          </ul>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa   fa-edit "></i> <span>Data Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/list' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/product/list"><i class="fa fa-circle-o"></i> Product</a></li>
          </ul>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/listtype' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/product/listtype"><i class="fa fa-circle-o"></i> Product Type</a></li>
          </ul>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/list' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/user/list"><i class="fa fa-circle-o"></i> Payment</a></li>
          </ul>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/listorder' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/product/listorder"><i class="fa fa-circle-o"></i> Order</a></li>
          </ul>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa  fa-sticky-note-o"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/list' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/product/list"><i class="fa fa-circle-o"></i> Customer</a></li>
          </ul>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/list' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/product/list"><i class="fa fa-circle-o"></i>Product</a></li>
          </ul>
          <ul class="treeview-menu">
          
            <li class="<?php if($baseUrl.'/product/listtype' == Url::current() ){ echo "active"; } ?>"><a href="<?php echo $baseUrl; ?>/product/listtype"><i class="fa fa-circle-o"></i>Product Type</a></li>
          </ul>
          <ul class="treeview-menu">
         
        </li>
       
        


        
      </ul>
    </section>
    <!-- /.sidebar -->
