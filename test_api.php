<?php
ini_set('memory_limit', '1024M');
set_time_limit(0);
require_once 'config/database.php';

$stmt = $pdo->query("SELECT id, spec_code, spec_name, reg_no, asset_planner_organization, nbv, so_result, so_location, `range`, sub_location, category, periode, periode_group, created_at FROM assets ORDER BY periode ASC");
$rawResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Raw rows fetched: " . count($rawResults) . "\n";
echo "Memory usage: " . round(memory_get_usage(true) / 1024 / 1024, 2) . " MB\n";

// Simulate the grouping/status logic
$groupedByPeriod = [];
foreach ($rawResults as $row) {
    $p = $row['periode'];
    if (!isset($groupedByPeriod[$p])) {
        $groupedByPeriod[$p] = [];
    }
    $groupedByPeriod[$p][$row['reg_no']] = $row;
}
unset($rawResults);

$sortedPeriods = array_keys($groupedByPeriod);
echo "Distinct periods: " . count($sortedPeriods) . "\n";
foreach ($sortedPeriods as $p) {
    echo "  Period '$p': " . count($groupedByPeriod[$p]) . " assets\n";
}

// Count final results
$finalCount = 0;
for ($i = 0; $i < count($sortedPeriods); $i++) {
    $currentAssets = $groupedByPeriod[$sortedPeriods[$i]];
    $prevAssets = $i > 0 ? $groupedByPeriod[$sortedPeriods[$i - 1]] : [];
    
    $finalCount += count($currentAssets);
    
    // OUT assets
    if ($i > 0) {
        foreach ($prevAssets as $reg_no => $prevAsset) {
            if (!isset($currentAssets[$reg_no])) {
                $finalCount++;
            }
        }
    }
}
echo "Final result count: $finalCount\n";
echo "Memory after processing: " . round(memory_get_usage(true) / 1024 / 1024, 2) . " MB\n";

// Try encoding
echo "Attempting JSON encode...\n";
// Don't actually build the full array, just estimate size
echo "Estimated JSON size per row ~500 bytes => " . round($finalCount * 500 / 1024 / 1024, 2) . " MB\n";
