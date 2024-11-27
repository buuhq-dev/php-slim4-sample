<?php
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },
    // 'baseUrl' => function () {
    //     return __DIR__ . '/settings.php';
    // },
    LoggerInterface::class => function (ContainerInterface $c) {
        //$settings = $c->get(SettingsInterface::class);

        $loggerSettings = $c->get('settings')['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        // $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $handler = new RotatingFileHandler($loggerSettings['path'], 30, $loggerSettings['level']);

        $logger->pushHandler($handler);

        return $logger;
    },

    // Logger::class => static function (ContainerInterface $container): Logger {
    //     $settings = $container->get('settings')['logger'];
        
    //     $logger = new Logger($settings['name']);      
    //     // $processor = new UidProcessor();
    //     // $logger->pushProcessor($processor);
    //     $handler = new StreamHandler($settings['path'] . '/app.log', $settings['level']);
    //     $logger->pushHandler($handler);

    //     // $logger->pushHandler(new StreamHandler( $settings['path'] . '/app.log', Level::Debug));
    //     // $logger->info('This is a log! ^_^ ');
    //     // $logger->warning('This is a log warning! ^_^ ');
    //     // $logger->error('This is a log error! ^_^ ');

    //     return$logger;
    // },


    Twig::class => function (ContainerInterface $container) {
        $twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
        return $twig;
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['db'];
    
        $host = $settings['host'];
        $dbname = $settings['database'];
        $username = $settings['username'];
        $password = $settings['password'];
        $charset = $settings['charset'];
        $flags = $settings['flags'];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    
        return new PDO($dsn, $username, $password, $flags);
    },
];