<?php
// api/save_rack_data.php
require_once '../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (is_array($data)) {
        try {
            $pdo->beginTransaction();
            
            // Clear existing rack data since we are uploading a new master layout
            $pdo->exec("TRUNCATE TABLE rack_master");

            $stmt = $pdo->prepare("INSERT INTO rack_master (label, rack, category) VALUES (?, ?, ?)");
            
            foreach ($data as $row) {
                // Find keys ignoring case
                $label = null;
                $rack = null;
                $category = null;

                foreach ($row as $k => $v) {
                    if (strcasecmp($k, 'label') === 0) $label = $v;
                    else if (strcasecmp($k, 'rack') === 0) $rack = $v;
                    else if (strcasecmp($k, 'category') === 0) $category = $v;
                }

                if ($label && $rack) {
                    $stmt->execute([$label, $rack, $category]);
                }
            }
            
            $pdo->commit();
            
            echo json_encode(['status' => 'success', 'message' => 'Rack Master data saved successfully']);
        } catch(PDOException $e) {
            $pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
         echo json_encode(['status' => 'error', 'message' => 'Invalid data format']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
