<?php
require_once __DIR__ . '/../app/controller/FinanceController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['value']) && is_numeric($_POST['value'])) {
        $controller = new FinanceController();
        $value = $_POST['value'];
        $signal = $_POST['signal'];

        if($signal == 0){
            $value *= -1;
        }

        $insert = ([
            "value" => $value,
            "date"  => date("Y-m-d"),
            "hour"  => date("H:i:s")
        ]);

        $response = $controller->addValue($insert);
    } else {
        echo json_encode([
            'status' => 'failure',
            'message' => 'Invalid or missing value.',
        ]);
    }
} else {
    // Caso não seja uma requisição POST
    echo json_encode([
        'status' => 'failure',
        'message' => 'Invalid request method.',
    ]);
}

?>