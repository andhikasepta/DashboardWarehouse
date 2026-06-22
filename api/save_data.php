<?php
// api/save_data.php
require_once '../config/database.php';

// Set timezone to match local time so UTC dates from JS are formatted correctly
date_default_timezone_set('Asia/Jakarta');

header('Content-Type: application/json');

function formatPeriode($rawDate) {
    if (!$rawDate) return 'Unknown Period';
    
    // Try to parse standard formats or ISO dates
    $timestamp = strtotime($rawDate);
    
    if (!$timestamp) {
        // If it's something like 12/06/2026 (DD/MM/YYYY)
        $parts = explode('/', $rawDate);
        if (count($parts) === 3) {
            $timestamp = strtotime($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
        }
    }
    
    if ($timestamp) {
        return date('F Y', $timestamp); // e.g. "June 2026"
    }
    return (string)$rawDate;
}

function getValCI($row, $key) {
    foreach ($row as $k => $v) {
        if (strcasecmp($k, $key) === 0) {
            return $v;
        }
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (is_array($data)) {
        try {
            $pdo->beginTransaction();
            
            // First pass: identify unique periods in the uploaded data
            $uploadedPeriods = [];
            foreach ($data as $row) {
                // look for 'periode' key ignoring case
                $periodeRaw = null;
                foreach ($row as $k => $v) {
                    if (strcasecmp($k, 'periode') === 0) {
                        $periodeRaw = $v;
                        break;
                    }
                }
                
                $periodeGroup = formatPeriode($periodeRaw);
                $uploadedPeriods[$periodeGroup] = true;
            }
            
            // Delete existing records for these periods to avoid duplicates
            if (!empty($uploadedPeriods)) {
                $placeholders = implode(',', array_fill(0, count($uploadedPeriods), '?'));
                $delStmt = $pdo->prepare("DELETE FROM assets WHERE periode_group IN ($placeholders)");
                $delStmt->execute(array_keys($uploadedPeriods));
            }

            $stmt = $pdo->prepare("INSERT INTO assets 
                (nama_perangkat, spec_code, reg_no, kategori, `in`, `out`, asset_planner_organization, gr_date, nbv, since, days, `range`, sub_location, grup_building, grup_rack, periode, periode_group, raw_data) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            foreach ($data as $row) {
                $periodeRaw = getValCI($row, 'periode');
                $periodeGroup = formatPeriode($periodeRaw);
                $rawData = json_encode($row);

                $nbv = getValCI($row, 'nbv');
                $nbv = is_numeric($nbv) ? (float)$nbv : 0;

                $stmt->execute([
                    getValCI($row, 'nama_perangkat'),
                    getValCI($row, 'spec_code'),
                    getValCI($row, 'reg_no'),
                    getValCI($row, 'kategori'),
                    getValCI($row, 'in'),
                    getValCI($row, 'out'),
                    getValCI($row, 'asset_planner_organization'),
                    getValCI($row, 'gr_date'),
                    $nbv,
                    getValCI($row, 'since'),
                    getValCI($row, 'days'),
                    getValCI($row, 'range'),
                    getValCI($row, 'sub_location'),
                    getValCI($row, 'grup_building'),
                    getValCI($row, 'grup_rack'),
                    $periodeRaw,
                    $periodeGroup,
                    $rawData
                ]);
            }
            $pdo->commit();
            
            // Now that data is inserted, run the rebuild logic
            require_once 'rebuild_in_out.php';
            rebuildInOutStatus($pdo);
            
            // Get all periods for response
            $periodStmt = $pdo->query("SELECT DISTINCT periode_group FROM assets ORDER BY created_at DESC");
            $periods = $periodStmt->fetchAll(PDO::FETCH_COLUMN);

            echo json_encode([
                'status' => 'success', 
                'message' => 'Data saved successfully',
                'periods' => $periods
            ]);
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
