<?php
// api/get_periods.php
require_once '../config/database.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT DISTINCT periode_group FROM assets WHERE periode_group IS NOT NULL");
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Sort periods nicely if possible, but distinct string might suffice.
    // Assuming format "June 2026"
    usort($results, function($a, $b) {
        if ($a === 'Unknown Period') return 1;
        if ($b === 'Unknown Period') return -1;
        return strtotime($b) - strtotime($a); // Descending order
    });

    echo json_encode(['status' => 'success', 'data' => $results]);
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
