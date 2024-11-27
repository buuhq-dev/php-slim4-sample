<?php

use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Psr\Log\LoggerInterface;
use App\Middleware\BaseUrlMiddleware;
use App\Middleware\SessionMiddleware;
use App\Middleware\AuthMiddleware;

return function (App $app) {
    /** @var Psr\Container\ContainerInterface $container */
    $container = $app->getContainer();
    $app->getBasePath();
    
    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();
    
    // Add Twig-View Middleware
    //$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
    //$app->add(TwigMiddleware::create($app, $twig));

    /**
     * Add Error Middleware
     *
     * @param bool                  $displayErrorDetails -> Should be set to false in production
     * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
     * @param bool                  $logErrorDetails -> Display error details in error log
     * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger  
     *
     * Note: This middleware should be added last. It will not handle any exceptions/errors
     * for middleware added after it.
     */
    //$app->addErrorMiddleware(true, true, true);
    // Add Error Middleware with Logger
    //$errorMiddleware = $app->addErrorMiddleware(true, true, true, $logger);
    
    $errorSettings = $container->get('settings')['error'];
    $app->addErrorMiddleware(
        displayErrorDetails: $errorSettings['display_error_details'],
        logErrors: $errorSettings['log_errors'],
        logErrorDetails: true,
        logger: $container->get(LoggerInterface::class),
    );

    $baseUrlMiddleware = new BaseUrlMiddleware($app->getBasePath(), $container->get(Twig::class));
    $app->add($baseUrlMiddleware);
    $app->add(SessionMiddleware::class);

    $publicUrls = [];
    $app->add(new AuthMiddleware($publicUrls));

};