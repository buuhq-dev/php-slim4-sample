<?php
// insert_users.php

// Database configuration
$host = '127.0.0.1';
$db   = 'slim4-api-example';
$user = 'root';
$pass = 'Password123';
$charset = 'utf8mb4';

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation
];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Define the users and their plain-text passwords
    $users = [
        [
            'username' => 'admin',
            'password' => 'adminpass',
            'role' => 'admin'
        ],
        [
            'username' => 'user',
            'password' => 'userpass',
            'role' => 'user'
        ]
    ];
    
    // Prepare the INSERT statement
    $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (:username, :password, :role)');
    
    foreach ($users as $userData) {
        // Hash the password
        $hashedPassword = password_hash($userData['password'], PASSWORD_BCRYPT);
        
        // Execute the statement with parameters
        $stmt->execute([
            ':username' => $userData['username'],
            ':password' => $hashedPassword,
            ':role'     => $userData['role']
        ]);
        
        echo "Inserted user: {$userData['username']}\n";
    }
    
    echo "All users inserted successfully.\n";
    
} catch (PDOException $e) {
    // Handle PDO exceptions (errors)
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
