<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    	
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    	'urlManager' => [
    			'enablePrettyUrl' => true,
    			'showScriptName' => false,
    			'rules' => [
    					'product/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'product/<controller>/<action>',
    					'<controller:\w+>/<id:\d+>' => '<controller>/view',
    					'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    					'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    					'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
    			],
    	],
    		//can name it whatever you want as it is custom
    		'urlManagerFrontend' => [
    				'class' => 'yii\web\urlManager',
    				'baseUrl' => '/ecommerce/frontend/web/',//i.e. $_SERVER['DOCUMENT_ROOT'] .'/yiiapp/web/'
    				'enablePrettyUrl' => true,
    				'showScriptName' => false,
    		],
    
    ],
    'params' => $params,
];
