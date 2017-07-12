<?php

namespace backend\assets;

use yii\web\AssetBundle;
use backend\assets\AppAsset;

/**
 * Asset สำหรับ หน้า login
 */
class LoginAsset extends AssetBundle
{
  public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	//AdminLTE
        'css/site.css',
	    	//	<!-- Bootstrap 3.3.6 -->
	    	'bootstrap/css/bootstrap.min.css',
	    	// <!-- Font Awesome -->
	    	'font-awesome.min.css',
	    	//<!-- Ionicons -->
	    	'ionicons.min.css',
	    	// <!-- Theme style -->
	    	'dist/css/AdminLTE.min.css',
	    	// <!-- AdminLTE Skins. Choose a skin from the css/skins
	    	//	folder instead of downloading all of them to reduce the load. -->
	    	'dist/css/skins/_all-skins.min.css',
	    	//  <!-- iCheck -->
	    	'plugins/iCheck/flat/blue.css',
    ];
    public $js = [
    		//<!-- jQuery 2.2.3 -->
    		'plugins/jQuery/jquery-2.2.3.min.js',
    		//<!-- Bootstrap 3.3.6 -->
    		'bootstrap/js/bootstrap.min.js',
    		//<!-- iCheck -->
    		'plugins/iCheck/icheck.min.js',
    		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

