<?php
return [
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
  ],
  'modules' => [
    'api' => [
      'class' => 'modules\api\Module'
    ]
  ],
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'components' => [
    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'enableStrictParsing' => false,
      'rules' => [
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/messages']
      ]
      ],

      'authManager' => [
        'class' => 'yii\rbac\DbManager',
      ],


  ],
];
