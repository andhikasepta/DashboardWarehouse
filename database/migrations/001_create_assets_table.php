<?php
return function ($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `assets` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `spec_code` VARCHAR(255),
        `spec_name` VARCHAR(255),
        `reg_no` VARCHAR(255),
        `asset_planner_organization` VARCHAR(255),
        `nbv` DOUBLE DEFAULT 0,
        `so_result` VARCHAR(255),
        `so_location` VARCHAR(255),
        `range` VARCHAR(255),
        `sub_location` VARCHAR(255),
        `category` VARCHAR(255),
        `periode` VARCHAR(255),
        `periode_group` VARCHAR(255),
        `raw_data` JSON,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
};
