<?php
require_once 'config/database.php';

$stmtAsset = $pdo->query('SELECT COUNT(*) FROM assets');
$assetCount = $stmtAsset->fetchColumn();

try {
    $stmtRack = $pdo->query('SELECT COUNT(*) FROM rack_master');
    $rackCount = $stmtRack->fetchColumn();
} catch (Exception $e) {
    $rackCount = "Error: " . $e->getMessage();
}

echo "EXACT ROW COUNTS IN DATABASE:\n";
echo "assets table: " . $assetCount . " rows\n";
echo "rack_master table: " . $rackCount . " rows\n";
