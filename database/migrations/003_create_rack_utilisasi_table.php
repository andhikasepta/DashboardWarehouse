<?php
return function ($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `rack_utilisasi` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `label` VARCHAR(255) NOT NULL,
        `month` VARCHAR(20) NOT NULL,
        `year` VARCHAR(10) NOT NULL,
        `qty` INT NOT NULL DEFAULT 0,
        `capacity` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY `unique_label_period` (`label`, `month`, `year`)
    )";
    $pdo->exec($sql);
};
