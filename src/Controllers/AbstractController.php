<?php
namespace App\Controllers;

use Psr\Log\LoggerInterface;
abstract class AbstractController{
    protected LoggerInterface  $logger;
    public function __construct(LoggerInterface  $logger)
    {
        $this->logger = $logger;
    }
}