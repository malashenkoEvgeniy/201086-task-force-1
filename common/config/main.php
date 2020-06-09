<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
				'authManager' => [
					'class' => 'yii\rbac\DbManager',
				],
				'urlManager' => [
				'enablePrettyUrl' => true,
				'showScriptName' => false,
				'enableStrictParsing' => false,
				'rules' => [
					'users/view/1' => 'users/view',
					'users'=>'users/index',

				],
			],
			'request' => [

				//'baseUrl' => '',
			]
    ],
];
