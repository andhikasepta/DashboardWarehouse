<?php
require 'config/database.php';
$c1 = $pdo->query('SELECT count(*) FROM assets')->fetchColumn();
$c2 = $pdo->query('SELECT count(*) FROM rack_master')->fetchColumn();
echo "Assets: $c1, Rack: $c2\n";
