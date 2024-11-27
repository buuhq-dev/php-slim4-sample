<?php
namespace App\Repositories;

use PDO;

class ProductRepository {
    public function __construct(
        private PDO $pdo,
        
    ) {}

    public function getAll(): array
    {
        // $pdo = $this->database->getConnection();
        $stmt = $this->pdo->query('SELECT * FROM product');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}