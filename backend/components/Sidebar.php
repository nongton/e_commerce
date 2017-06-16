<?php
namespace backend\components;

use yii;
use common\models\User;
use yii\base\Widget;

$identity = \Yii::$app->user->getIdentity();
$baseUrl = \Yii::getAlias('@web');
$user = \Yii::$app->user;

class Sidebar extends Widget {
	public $_isWide = false;
	public function run() {
		
		echo $this->render('sidebar',["isWide"=>$this->_isWide]);
		
	}
}