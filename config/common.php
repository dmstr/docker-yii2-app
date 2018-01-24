<?php

/**
 * @link http://www.diemeisterei.de/
 *
 * @copyright Copyright (c) 2016 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Basic configuration, used in web and console applications
return [
    'id' => 'app',
    'language' => 'en',
    'basePath' => dirname(__DIR__).'/src',
    'vendorPath' => '@app/../vendor',
    'runtimePath' => '@app/../runtime',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // Bootstrapped modules are loaded in every request
    'bootstrap' => [
        'log',
    ],
];
