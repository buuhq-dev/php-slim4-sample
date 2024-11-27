<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\Twig;

final class BaseUrlMiddleware implements MiddlewareInterface {
    
    private string $basePath;
    public function __construct(
        string $basePath,
        private Twig $view
    ) {
        $this->basePath = $basePath;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $baseUrl = $this->getBaseUrl($request);
        $this->view->getEnvironment()->addGlobal('base_url', $baseUrl);
        $request = $request->withAttribute('base_url', $baseUrl);

        return $handler->handle($request);
    }

    public function getBaseUrl(Request $request): string
    {
        return "";
    }


    public function getBaseUrl02(Request $request): string
    {
        $uri = $request->getUri();
        $scheme = $uri->getScheme();
        $authority = $uri->getAuthority();
        $basePath = $this->basePath;

        if ($authority !== '' && ! str_starts_with($basePath, '/')) {
            $basePath .= '/' . $basePath;
        }

        return ($scheme !== '' ? $scheme . ':' : '')
                         . ($authority ? '//' . $authority : '')
                         . rtrim($basePath, '/');
    }
}