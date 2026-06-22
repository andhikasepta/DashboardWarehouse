<?php
// api/get_master_assets.php
require_once '../config/database.php';

header('Content-Type: application/json');

try {
    // We want to fetch all raw data for the Master Data table.
    // For large tables, server-side DataTables processing is better, but since it's currently small, we fetch everything.
    $stmt = $pdo->query("SELECT * FROM assets ORDER BY created_at DESC");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // We need to output it in a format DataTables likes. 'data' is the default key.
    echo json_encode(['data' => $results]);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
