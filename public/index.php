<?php

//ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookie
//ini_set('session.cookie_secure', 1);   // Ensure cookie is sent over HTTPS
//ini_set('session.use_strict_mode', 1); // Reject uninitialized session IDs
session_start();

// $rootPath = realpath(__DIR__ . '/..');
$rootPath = __DIR__ . '/..';
require_once $rootPath . '/vendor/autoload.php';

$app = (require __DIR__ . '/../config/bootstrap.php')($rootPath);
$app->run();