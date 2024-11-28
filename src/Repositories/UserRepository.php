<?php
namespace App\Repositories;

use PDO;

class UserRepository {
    
    public function __construct(
        private PDO $pdo,     
    ) {}

    public function getUserByUsername($username)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

}