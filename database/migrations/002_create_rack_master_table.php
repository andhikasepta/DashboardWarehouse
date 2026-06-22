<?php
return function ($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `rack_master` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `label` VARCHAR(255) NOT NULL UNIQUE,
        `rack` VARCHAR(255) NOT NULL,
        `category` VARCHAR(255)
    )";
    $pdo->exec($sql);
};
