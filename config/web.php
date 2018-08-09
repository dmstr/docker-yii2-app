<?php

/**
 * @link http://www.diemeisterei.de/
 *
 * @copyright Copyright (c) 2016 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Settings for web-application only
return [
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => require 'db.php',
        'log' => [
            'targets' => [
                // writes to php-fpm output stream
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stdout',
                    'levels' => ['info', 'trace'],
                    'logVars' => [],
                    'enabled' => YII_DEBUG,
                ],
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stderr',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'Y-MM-dd',
            'datetimeFormat' => 'Y-MM-dd HH:mm:ss',
            'timeFormat' => 'H:i:s',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            'cookieValidationKey' => getenv('APP_COOKIE_VALIDATION_KEY'),
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => getenv('APP_PRETTY_URLS'),
            'enableStrictParsing' => true,
            'rules' => [
                ['class' => \yii\rest\UrlRule::class, 'controller' => 'rates'],
                ['class' => \yii\rest\UrlRule::class, 'controller' => 'payment'],
                ['class' => \yii\rest\UrlRule::class, 'controller' => 'refill'],
                ['class' => \yii\rest\UrlRule::class, 'controller' => 'user'],
            ],
        ]
    ],
];
