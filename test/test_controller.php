<?php

require_once __DIR__ . '/../controller/controll_finance.php';

$controller = new FinanceController();

echo "=== TEST: Insert value ===\n";
$insertTest = [
    "date"  => "2025-01-01",
    "hour"  => "10:00",
    "value" => 250
];
$controller->addValue($insertTest);
echo "\n\n";

echo "=== TEST: Insert another value ===\n";
$insertTest2 = [
    "date"  => "2025-01-02",
    "hour"  => "14:30",
    "value" => 500
];
$controller->addValue($insertTest2);
echo "\n\n";

echo "=== TEST: List all element ===\n";
$controller->getAll();
echo "\n\n";

echo "=== TEST: Search ===\n";
$controller->search("2025-01-01", "10:00");
echo "\n\n";

echo "=== TEST: Remove value ===\n";
$controller->removeValue("2025-01-01", "10:00");
echo "\n\n";

echo "=== TESTE: List again ===\n";
$controller->getAll();
echo "\n\n";

?>
