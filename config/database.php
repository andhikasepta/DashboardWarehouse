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
} catch(PDOException $e) {
    die(json_encode(['status' => 'error', 'message' => "Connection failed: " . $e->getMessage()]));
}
?>
