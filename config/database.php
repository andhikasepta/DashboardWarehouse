<?php
// config/database.php

// Laragon
$host = '127.0.0.1'; 
$port = '3306';      
$user = 'root';
$password = '';      
$dbname = 'dashboard_db';

// Mac (MAMP)
if (strtoupper(substr(PHP_OS, 0, 3)) === 'MAC' || PHP_OS === 'Darwin') {
    $port = '8889';      
    $password = 'root'; 
}

try {
    // Koneksi menggunakan host dan port yang sudah dideteksi otomatis
    $pdo = new PDO("mysql:host=$host;port=$port", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    $pdo->exec("USE `$dbname`");
    
    // Memastikan tabel rack_master tersedia
    $pdo->exec("CREATE TABLE IF NOT EXISTS `rack_master` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `label` VARCHAR(255) NOT NULL UNIQUE,
        `rack` VARCHAR(255) NOT NULL,
        `category` VARCHAR(255)
    )");
} catch(PDOException $e) {
    die(json_encode(['status' => 'error', 'message' => "Connection failed: " . $e->getMessage()]));
}
?>