<?php
use Monolog\Level;
// Settings
$settings = [];


// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => $_ENV['DB_HOST'],
    'username' => $_ENV['DB_USER'],
    'database' => $_ENV['DB_NAME'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];


// Logger settings
$settings['logger'] = [
    // Log file location
    'name' => 'slim-app',
    'path' => __DIR__ . '/../logs/slim-app.log',
    //'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
    
    // Default log level
    // 'level' => Psr\Log\LogLevel::DEBUG,
    'level' => Level::Debug,
];

$settings['error'] = [
    'display_error_details' => false,
    'log_errors' => true,
];

return $settings;