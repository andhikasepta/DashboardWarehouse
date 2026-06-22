<?php
// api/delete_data.php
require_once '../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    $periode = $data['periode'] ?? null;

    if ($periode) {
        try {
            $stmt = $pdo->prepare("DELETE FROM assets WHERE periode_group = ?");
            $stmt->execute([$periode]);
            
            $deletedRows = $stmt->rowCount();
            
            echo json_encode([
                'status' => 'success', 
                'message' => "Data for $periode deleted successfully.",
                'deleted_rows' => $deletedRows
            ]);
        } catch(PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No period specified for deletion.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
