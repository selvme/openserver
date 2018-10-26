<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'thumbnail'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@adminlte/widgets'=>'@vendor/adminlte/yii2-widgets',
    ],
    'defaultRoute' => 'index',
    'language' => 'ru-RU',
    'name' => 'ROKTES Ltd.',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iYT-M_iGe2gmyBx57ahvBwCg-chfPdRG',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['appmanager'],
        ],
        'errorHandler' => [
            'errorAction' => 'page/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'roktesltd',
                'password' => 'H9P1NnYd',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'ymr' => 'main/ymr',
                'catalog/<category>/<alias:[\w-]+>' => 'page/product',
                'categories/rubriki/<alias:[\w-]+>' => 'page/category',
                'categories/<alias:[\w-]+>' => 'page/category',
                'reviews/<alias:[\w-]+>' => 'page/singlerev',
                'news/<alias:[\w-]+>' => 'page/singlenews',
                'articles/<alias:[\w-]+>' => 'page/singleart',
                '<action[\w-]+>'=>'page/<action>',
                '' => 'page/index',
            ],
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => true,
                'normalizeTrailingSlash' => true,
            ],

        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
                    ]
                ],
            ],
        ],
        'thumbnail' => [
            'class' => 'himiklab\thumbnail\EasyThumbnail',
            'cacheAlias' => 'assets/gallery_thumbnails',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LchUnIUAAAAAKB_vGewmFuY6fRWMGI-mNU9YubI',
            'secret' => '6LchUnIUAAAAAER9dqHNCJf_kTIDCE3RO4Y9MNKD',
        ],
    ],
    'modules' => [
        'ymr' => [
            'class' => 'app\modules\ymr\Module',
            'layout' => 'main',
        ],
    ],
    'params' => $params,
    
    // // обрезание обратного слэша в конце адресной строки
    // 'on beforeRequest' => function () {
    //     $pathInfo = Yii::$app->request->pathInfo;
    //     if (!empty($pathInfo) && substr($pathInfo, -1) === '/') {
    //         Yii::$app->response->redirect('/' . substr(rtrim($pathInfo), 0, -1), 301)->send();
    //     }
    // },
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
