<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpNotFoundException;

final class AuthMiddleware implements MiddlewareInterface {
    
    // private string $publicUrls;
    public function __construct(
        private $publicUrls,
    ){}
    public function process(Request $request, RequestHandler $handler): Response
    {
        
        
        return $handler->handle($request);
    }
}