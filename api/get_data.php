<?php
// api/get_data.php
require_once '../config/database.php';

header('Content-Type: application/json');

try {
    $periode = $_GET['periode'] ?? null;
    
    if ($periode) {
        $stmt = $pdo->prepare("SELECT nama_perangkat, spec_code, reg_no, kategori, `in`, `out`, asset_planner_organization, gr_date, nbv, since, days, `range`, sub_location, grup_building, grup_rack, periode FROM assets WHERE periode_group = ?");
        $stmt->execute([$periode]);
    } else {
        $latestStmt = $pdo->query("SELECT periode_group FROM assets WHERE periode_group != 'Unknown Period' ORDER BY created_at DESC LIMIT 1");
        $latestPeriod = $latestStmt->fetchColumn();
        
        if ($latestPeriod) {
            $stmt = $pdo->prepare("SELECT nama_perangkat, spec_code, reg_no, kategori, `in`, `out`, asset_planner_organization, gr_date, nbv, since, days, `range`, sub_location, grup_building, grup_rack, periode FROM assets WHERE periode_group = ?");
            $stmt->execute([$latestPeriod]);
        } else {
            $stmt = $pdo->query("SELECT nama_perangkat, spec_code, reg_no, kategori, `in`, `out`, asset_planner_organization, gr_date, nbv, since, days, `range`, sub_location, grup_building, grup_rack, periode FROM assets");
        }
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Convert numeric fields properly if necessary, PDO might return strings for numbers
    foreach($results as &$row) {
        if (isset($row['nbv'])) {
            $row['nbv'] = (float)$row['nbv'];
        }
    }
    
    echo json_encode(['status' => 'success', 'data' => $results]);
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
