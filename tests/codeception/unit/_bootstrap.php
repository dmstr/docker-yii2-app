<?php
// Here you can initialize variables that will be available to your tests
$config = require(dirname(__DIR__) . '/_config/test.php');
new yii\web\Application($config);