<?php
$content = file_get_contents('test_output.json');
json_decode($content);
if (json_last_error() === JSON_ERROR_NONE) {
    echo "Valid JSON\n";
} else {
    echo "Invalid JSON: " . json_last_error_msg() . "\n";
}
