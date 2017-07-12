<?php
namespace backend\components;

use yii\base\Widget;

class Message extends Widget {
	public function run() {
		if (\Yii::$app->session->hasFlash('message.content')) {
			$message = \Yii::$app->session->getFlash('message.content');
			$level = \Yii::$app->session->getFlash('message.level');
			if (empty($level)) $level = 'info';
		echo <<<EOT
		 <div class="alert alert-$level alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                $message
              </div>
EOT;
		}
	}	
}