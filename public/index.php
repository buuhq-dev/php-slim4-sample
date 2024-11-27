<?php
// $rootPath = realpath(__DIR__ . '/..');
$rootPath = __DIR__ . '/..';
require_once $rootPath . '/vendor/autoload.php';

$app = (require __DIR__ . '/../config/bootstrap.php')($rootPath);
$app->run();