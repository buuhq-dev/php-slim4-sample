<?php
declare(strict_types=1);
namespace App\Middlewares;

use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

final class PermissionMiddleware implements Middleware {
    
    
    public function process(Request $request, RequestHandler $handler) : Response
    {
        //ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookie
        //ini_set('session.cookie_secure', 1);   // Ensure cookie is sent over HTTPS
        //ini_set('session.use_strict_mode', 1); // Reject uninitialized session IDs

        //session_start();
        // Ensure the user is authenticated
        if (!isset($_SESSION['user'])) {
            $response = new SlimResponse();
            return $response
                ->withHeader('Location', '/auth/login')
                ->withStatus(302);
        }
        // Check if the user has the admin role
        if (!$this->checkPermisson()) {
            $response = new SlimResponse();
            return $response
                ->withHeader('Location', '/auth/forbidden')
                ->withStatus(403);
        }

        return $handler->handle($request);
    }

    private function checkPermisson() : bool
    {
        return $_SESSION['user']['role'] == 'admin';
    }
}