<?php

use yii\helpers\Url;
use yii\helpers\Html;

use app\Entity;
use common\models\User;

$baseUrl = \Yii::getAlias('@web');
$urlFrontend = \Yii::$app->urlManagerFrontend->baseUrl;
$user = Yii::$app->user->getIdentity();

$str = <<<EOT

EOT;
$this->registerJs($str);
?>
    <!-- Logo -->
    <a href="<?php echo $baseUrl; ?>" class="logo">
    
       <img src="<?php echo $baseUrl; ?>/img/logob.jpg">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <a href="<?php echo $urlFrontend; ?>" class="btn btn-default btn-flat" style="
    margin-top: 6px;
"> FrontEND</a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->
       
          <!-- Tasks: style can be found in dropdown.less -->
      
          <!-- User Account: style can be found in dropdown.less -->
          <?php if ($user): ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $baseUrl; ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php  echo $user->username;  ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $baseUrl; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 <?php echo $user->firstName.' '.$user->lastName; ?>  -   <?php echo User::$arrPosition[$user->position]; ?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $baseUrl; ?>/user/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                      <a href="<?php echo $baseUrl; ?>/site/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <?php endif;?>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>