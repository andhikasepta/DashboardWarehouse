<?php
// setup.php
require_once 'config/database.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS assets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    
    $columns = [
        'nama_perangkat' => 'VARCHAR(255)',
        'spec_code' => 'VARCHAR(255)',
        'reg_no' => 'VARCHAR(255)',
        'kategori' => 'VARCHAR(255)',
        '`in`' => 'VARCHAR(255)',
        '`out`' => 'VARCHAR(255)',
        'asset_planner_organization' => 'VARCHAR(255)',
        'gr_date' => 'VARCHAR(255)',
        'nbv' => 'DOUBLE',
        'since' => 'VARCHAR(255)',
        'days' => 'VARCHAR(255)',
        '`range`' => 'VARCHAR(255)',
        'sub_location' => 'VARCHAR(255)',
        'grup_building' => 'VARCHAR(255)',
        'grup_rack' => 'VARCHAR(255)',
        'periode' => 'VARCHAR(255)',
        'periode_group' => 'VARCHAR(255)',
        'raw_data' => 'JSON'
    ];

    foreach ($columns as $col => $type) {
        try {
            $pdo->exec("ALTER TABLE assets ADD COLUMN $col $type");
        } catch(PDOException $e) {
            // Ignore if column already exists
        }
    }

    echo "Database and table 'assets' updated successfully with all requested columns.";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
