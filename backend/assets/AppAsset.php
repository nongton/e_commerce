<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
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
	    	// <!-- Morris chart -->
	    	'plugins/morris/morris.css',
	    	//<!-- jvectormap -->
    		'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
    		// <!-- Date Picker -->
    		'plugins/datepicker/datepicker3.css',
    		//<!-- Daterange picker -->
    		'plugins/daterangepicker/daterangepicker.css',
    		// <!-- Daterange picker -->
    		'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    		// <!-- bootstrap wysihtml5 - text editor -->
    		'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    		
    	
    ];
    public $js = [
    		//<!-- jQuery 2.2.3 -->
    		'plugins/jQuery/jquery-2.2.3.min.js',
    		//<!-- jQuery UI 1.11.4 -->
    		'jquery-ui.min.js',
    		//<!-- Bootstrap 3.3.6 -->
    		'bootstrap/js/bootstrap.min.js',
    		//<!-- Morris.js charts -->
    		'raphael-min.js',
    		'plugins/morris/morris.min.js',
    		//<!-- Sparkline -->
    		'plugins/sparkline/jquery.sparkline.min.js',
    		//<!-- jvectormap -->
    		'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    		'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    		//<!-- jQuery Knob Chart -->
    		'plugins/knob/jquery.knob.js',
    		//<!-- daterangepicker -->
    		'moment.min.js',
    		'plugins/daterangepicker/daterangepicker.js',
    		//<!-- datepicker -->
    		'plugins/datepicker/bootstrap-datepicker.js',
    		//<!-- Bootstrap WYSIHTML5 -->
    		'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    		//<!-- Slimscroll -->
    		'plugins/slimScroll/jquery.slimscroll.min.js',
    		//<!-- FastClick -->
    		'plugins/fastclick/fastclick.js',
    		
    		//<!-- AdminLTE App -->
    		'dist/js/app.min.js',
    		//<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    		'dist/js/pages/dashboard.js',
    		//<!-- AdminLTE for demo purposes -->
    		'dist/js/demo.js',
    		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
