<?php

use common\components\LanguageHelper;
use yii\web\Application;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'menumanager' => [
            'class' => 'backend\modules\menumanager\Module'
        ],

    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'telegram' => [
            'class' => 'aki\telegram\Telegram',
            'botToken' => '5453818304:AAFIzLd8IFFcfEyZlAwyD8_aCJKX3lpOMq8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'common\components\UrlManager'
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                ]
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'on beforeAction' => function ($event) {

        if (Yii::$app instanceof Application) {
            LanguageHelper::setLanguage();
        }
    }
];
