<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

return function ($rootPath) {
    $dotenv = Dotenv\Dotenv::createImmutable($rootPath);
    $dotenv->load();
    
    $containerBuilder = new ContainerBuilder();
    //Definitions
    $containerBuilder->addDefinitions($rootPath . '/config/di.php');
    // Build PHP-DI Container instance
    $container = $containerBuilder->build();
    AppFactory::setContainer($container);
    
    $app = AppFactory::create();
    
    (require $rootPath . '/config/middleware.php')($app);
    (require $rootPath . '/config/routes.php')($app);
    
    return $app;

};