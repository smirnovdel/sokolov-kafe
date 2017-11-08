<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'language'=>'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'F88BbU_Om_mU247WdN4ut_eDRbrTOaXX',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class'  => 'yii\rest\UrlRule',
                 'controller' => ['v1/food'],
                    'tokens' => ['{id}' => '<id:\\w+>'],

                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        

        
        
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
        'i18n' => [
            'translations' => [
                'file-input*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => dirname(__FILE__).'/../vendor/2amigos/yii2-file-input-widget/src/messages/',
                ],
            ],
        ],
        
        
    ],
    
    'params' => $params,
    'modules' => [
    'rbac' => [
        'class' => 'dektrium\rbac\RbacWebModule',
        'layout'=>'/default'],

    'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => TRUE,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['admin'],
        //'defaultController'=>'user',
        'layout'=>'/default',
        //'identityClass' => 'app\models\User',
        ],
     'authManager' => [
            'class' => 'dektrium\rbac\RbacWebModule',
            'defaultRoles' => ['admin', 'waiter'],
             ],
        'v1' => [
            'class' => 'app\modules\v1\Module',
        ],

    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
