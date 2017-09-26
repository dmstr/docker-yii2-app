<?php

/*
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2016 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */

$this->title .= 'Home';
?>

<div class="site-index">

    <div class="jumbotron">
        <div class="container">
            <h1><?= getenv('APP_TITLE') ?></h1>
            <p>
                <?= \yii\helpers\Html::a(
                    'GitHub Project',
                    'https://github.com/dmstr/docker-yii2-app',
                    [
                        'target' => '_blank',
                        'class' => 'btn btn-primary'
                    ]) ?>

            </p>
        </div>
    </div>
    <div class="container">
        <h2>Start development bash</h2>
        <p class="well">
            <code>
                docker-compose run --rm php bash
            </code>
        </p>
        <h2>Install packages</h2>
        <p class="well">
            <code>
                $ composer require "dmstr/yii2-adminlte-asset"
            </code>
        </p>
    </div>

</div>
