<?php
namespace App\Controllers;

use App\Controllers\Abstract\AbstractRestController;
use App\Repositories\ProductRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

class ProductController extends AbstractRestController
{
    private ProductRepository $repo;
    
    public function __construct(ProductRepository $repo, LoggerInterface $logger) 
    {
        parent::__construct($logger);
        $this->repo = $repo;
    }
    
    public function list(Request $request, Response $response): Response
    {
        // $this->logger->info('This is a log! ^_^ ');
        // $logger->warning('This is a log warning! ^_^ ');
        // $logger->error('This is a log error! ^_^ ');
        $data = $this->repo->getAll(); 
        return $this->renderJson($response, $data, 200);
    }
}