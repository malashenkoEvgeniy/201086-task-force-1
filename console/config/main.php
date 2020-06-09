<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
					'class' => 'yii\faker\FixtureController',
					'templatePath' => '@common/fixtures/templates',
					'fixtureDataPath' => '@common/fixtures/data',
					'namespace' => 'common\fixtures',
          ],
			'migrate' => [
				'class' => 'yii\console\controllers\MigrateController',
				'migrationPath' => [
					'@console/migrations',
					'@yii/rbac/migrations',

				],
			],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
