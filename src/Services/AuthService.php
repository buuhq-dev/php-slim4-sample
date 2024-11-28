<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Psr\Log\LoggerInterface as Logger;
class AuthService 
{
    public function __construct(
        private UserRepository $userRepository,
        private Logger $logger
    ) {}

    public function login($username, $password) : bool
    {
        return true;
    }

    public function dbLogin($username, $password) : bool
    {
        $user = $this->userRepository->getUserByUsername($username);
        //$this->logger->info("============AuthService===========");
        //$this->logger->info($username);
        //$this->logger->info($user['password']);
        if ($user && password_verify($password, $user['password'])) {
            //$this->logger->info("============I am here===========");
            // Set user in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            //return $response->withHeader('Location', '/admin')->withStatus(302);
            return true;
        }
        return false;
    }
}