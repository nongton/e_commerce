<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
		'aliases' => [
				'@app' => '@common/libs/app',
				'@app' => '@common/libs/app/ui'
		],
		'basePath' => dirname(__DIR__),
		'modules' => [
				'gridview' =>  [
						'class' => '\kartik\grid\Module'
						// enter optional module parameters below - only if you need to
						// use your own export download action or custom translation
						// message source
						// 'downloadAction' => 'gridview/export/download',
						// 'i18n' => []
				]
				
		
		],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    		'mailer' => [
    				'class' => 'yii\swiftmailer\Mailer',
    				'viewPath' => '@backend/mail',
    				'useFileTransport' => false,
    				'transport' => [
    						'class' => 'Swift_SmtpTransport',
    						'host' => 'smtp-relay.gmail.com',
    						'username' => 'junctionaof@gmail.com',
    						'password' => 'l6fmujiyd08052530',
    						'port' => '465',
    						'encryption' => 'tls',
    				],
    		],
    ],
];
