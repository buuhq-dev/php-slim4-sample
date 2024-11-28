<?php
namespace App\Controllers\Abstract;

use Psr\Log\LoggerInterface;
abstract class AbstractController{
    protected LoggerInterface  $logger;
    public function __construct(LoggerInterface  $logger)
    {
        $this->logger = $logger;
    }
}