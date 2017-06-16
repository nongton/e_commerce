<?php
namespace backend\components;

use yii;
use common\models\User;
use yii\base\Widget;

$identity = \Yii::$app->user->getIdentity();
$baseUrl = \Yii::getAlias('@web');
$user = \Yii::$app->user;

class Topbar extends Widget {
	public $_isWide = false;
	public function run() {
		
		echo $this->render('topbar',["isWide"=>$this->_isWide]);
		
	}
}