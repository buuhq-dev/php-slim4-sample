<?php
namespace App\Controllers;

use App\Controllers\Abstract\AbstractTwigController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface as Logger;

class RoleController extends AbstractTwigController
{
    // public function __construct(
    //     private Twig $view,
        
    // ) {}
    
    public function __construct(Twig $view, Logger $logger) 
    {
        parent::__construct($view, $logger);
        
    }   
    
    public function list(Request $request, Response $response): Response
    {
        return $this->renderHtml(
            $response, 
            'role/list.twig.html', 
            ['name' => 'Admin',]);
    }

};