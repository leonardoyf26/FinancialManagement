<?php

require_once __DIR__ . '/../app/model/financeModel.php';

$model = new FinanceModel();

// Read the database
$data = $model->readDatabase();

// Extract the transaction list
$transaction = $data['transaction'];

echo "<pre>Banco antes:\n";
foreach($transaction as $t){
    echo "{$t['value']}\n"; 
}

// -----------------------------------------
// Add a new entry to 'transaction'
$transaction[] = [
    "value" => 123.45,
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

echo "\nBanco depois:\n";
foreach($transaction_after as $t){
    echo "{$t['value']}\n";
}

?>
