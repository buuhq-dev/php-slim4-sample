<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\RoleController;
use App\Controllers\ProductController;
use App\Controllers\Auth\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Middlewares\PermissionMiddleware;


return function (App $app) {
    // Define app routes
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });


    $app->get('/hello/{name}', function (Request $request, Response $response, $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });

    $app->group('/roles', function (Group $group) {
        $group->get('', RoleController::class . ':list');
        
    });

    $app->group('/products', function (Group $group) {
        $group->get('', ProductController::class . ':list');
        
    });

    
    //Auth Page
    $app->group('/auth', function (Group $group) {
        $group->get('/login', AuthController::class . ':login');
        $group->post('/login', AuthController::class . ':doLogin');
        $group->get('/logout', AuthController::class . ':logout');
        $group->get('/forbidden', AuthController::class . ':forbidden');
        
    });
    //Admin Page
    $app->group('/admin', function (Group $group) {
        //$group->get('/dashboard', DashboardController::class);
        $group->get('', DashboardController::class);
        
    })->add(new PermissionMiddleware());;

    // Not Found
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.*}',
        static function (Request $request): void {
            throw new Slim\Exception\HttpNotFoundException($request);
        }
    );
};