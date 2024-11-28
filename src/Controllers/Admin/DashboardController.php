<?php
namespace App\Controllers\Admin;

use App\Controllers\Abstract\AbstractTwigController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface as Logger;

class DashboardController extends AbstractTwigController
{
    public function __construct(Twig $view, Logger $logger) 
    {
        parent::__construct($view, $logger);
        
    }

    public function __invoke (Request $request, Response $response) : Response
    {
        return $this->renderHtml($response, 'admin/dashboard.twig.html');
    }
}
