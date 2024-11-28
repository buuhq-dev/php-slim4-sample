<?php
namespace App\Controllers\Abstract;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class AbstractRestController extends AbstractController{

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
       
    }

    protected function renderJson(Response $response, $data, int $status): Response
    {
        $body = json_encode($data);
        $response->getBody()->write($body);
    
        // return $response;
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($status);
    }
}