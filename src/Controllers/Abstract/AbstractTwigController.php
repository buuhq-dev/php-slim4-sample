<?php
namespace App\Controllers\Abstract;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

abstract class AbstractTwigController extends AbstractController{
    
    protected $view;
    public function __construct(Twig $view, LoggerInterface $logger)
    {
        parent::__construct($logger);
        $this->view = $view;
    }

    protected function renderHtml(Response $response, string $template, array $data = []): Response
    {
        return $this->view->render($response, $template, $data);
    }

    protected function rendirectHtml(Response $response, string $route): Response
    {
        return $response->withHeader('Location', $route)
                        ->withStatus(302);
    }
}