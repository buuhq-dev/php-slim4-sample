<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\RoleController;
use App\Controllers\ProductController;

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
};