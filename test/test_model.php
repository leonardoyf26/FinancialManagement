<?php

require_once __DIR__ . '/../app/model/financeModel.php';

$model = new FinanceModel();

// Read the database
$data = $model->readDatabase();

// Extract the transaction list
$transaction = $data['transaction'];

echo "<pre>Data base:\n";
foreach($transaction as $t){
    echo "{$t['value']}\n"; 
}

// -----------------------------------------
// Add a new entry to 'transaction'
$transaction[] = [
    "value" => 1000.87,
    "date"  => date("Y-m-d"),
    "hour"  => date("H:i:s")
];

// Put modified transaction back into the main array
$data['transaction'] = $transaction;

// Write updated data back to database
$model->writeDatabase($data);

// Read again for confirmation
$data_after = $model->readDatabase();
$transaction_after = $data_after['transaction'];

echo "\nData base after first update:\n";
foreach($transaction_after as $t){
    echo "{$t['value']}\n";
}

// -----------------------------------------
// Using function insert()

$model->insertValue([
    "value" => 84.1,
    "date"  => date("Y-m-d"),
    "hour"  => date("H:i:s")
]);

// -----------------------------------------

// Read again for confirmation
$data_after = $model->readDatabase();
$transaction_after = $data_after['transaction'];

echo "\nData base after second update:\n";
foreach($transaction_after as $t){
    echo "{$t['value']}\n";
}


// Testing find() function
$j = $model->find("2025-11-20", "14:32:10");
echo "\n\n\n\n{$transaction_after[$j]['value']}";

?>

