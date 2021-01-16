<?php
use frontend\cart\storage\SessionStorage;
use kartik\datecontrol\Module;
Yii::$container->setSingleton('frontend\cart\ShoppingCart');

Yii::$container->set('frontend\cart\storage\StorageInterface', function() {
    return new SessionStorage(Yii::$app->session, 'primary-cart');
});
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
'defaultRoute' => 'site/index',

'modules' => [
     'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd-M-yyyy',
                Module::FORMAT_TIME => 'hh:mm',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
            ],
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['pluginOptions' => [
                                                 'autoclose' => true,
                                                 'todayHighlight' => true,
                                                 'startDate' => 'current',
                                       ],
                                        'readonly' => true],
                Module::FORMAT_TIME => ['readonly' => true]
            ],
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:U',
               // Module::FORMAT_TIME => 'php:u'
            ],
            'ajaxConversion' => false,
        ],

 'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'upload/store', //path to origin images
            'imagesCachePath' => 'upload/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/upload/store/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],


    ],


    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
			 'baseUrl'=> '/testzad3',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
		

		'errorHandler' => [

	            'errorAction' => 'site/error',

	            'maxSourceLines' => 20,

	        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
//'index' => 'site/index',
	'home' => 'website/index', 
	//<alias:about>' => 'website/page',
//	'page/<alias>' => 'website/page',
 'post/<alias:[-a-z]+>1' => 'post/view',
 '(posts | archive)' => 'post/index',
 '(posts | archive)/<order:(DESCIASC)>' => 'post/index', 
'site/index/<id:\d+>/page/<page:\d+>' => 'site/index',
                'site/index/<id:\d+>' => 'site/index',
	
            ],
        ],
       
    ],
    'params' => $params,
];
