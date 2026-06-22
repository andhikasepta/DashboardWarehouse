<?php
// config/database.php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'dashboard_db';

try {
    // Connect without dbname first to create it if it doesn't exist
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    $pdo->exec("USE `$dbname`");
    
    // Ensure rack_master table exists for Rack Utilization feature
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
