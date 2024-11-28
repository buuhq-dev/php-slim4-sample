<?php
namespace App\Controllers\Auth;

use App\Controllers\Abstract\AbstractTwigController;
use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface as Logger;

class AuthController extends AbstractTwigController
{
    public function __construct(Twig $view, Logger $logger, private AuthService $service)
    {
        parent::__construct($view, $logger);    
    }   
    
    public function login(Request $request, Response $response): Response
    {
        return $this->renderHtml($response, 'auth/login.twig.html');
    }

    public function doLogin(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        
        //Logic Login
        $isSuccess = $this->service->dbLogin($username, $password);
        if($isSuccess){
            //$this->logger->info("============I am here===========");
            return $this->rendirectHtml($response, "/admin");
            //return $this->renderHtml($response, 'admin/dashboard.twig.html');
        }
        return $this->renderHtml($response, 'auth/login.twig.html');
    }

    public function logout(Request $request, Response $response): Response
    {
        session_destroy();
        return $this->rendirectHtml($response, "/auth/login");
    }

    public function forbidden(Request $request, Response $response): Response
    {
        return $this->renderHtml($response, 'auth/forbidden.twig.html');
    }
    
}