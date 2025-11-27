<?php

require_once __DIR__ . '/../model/financeModel.php';

class FinanceController {

    private $model;

    public function __construct() {
        $this->model = new FinanceModel();
    }

    // --------------------------------------------------------
    // 
    public function addValue($value) {
        // Insert new data in the database
        $this->model->insertValue($value);

        // ✔️ Retorno padrão JSON
        return $this->response([
            "status" => "success",
            "message" => "Value inserted successfully.",
            "data" => $value,
        ]);
    }

    // --------------------------------------------------------
    public function removeValue($date, $hour) {

        $index = $this->model->find($date, $hour);
        if ($index === -1) {
            return $this->response([
                "status"  => "failure",
                "message" => "No data found with this date and hour.",
            ]);
        }

        $this->model->removeValue($date, $hour);

        return $this->response([
            "status" => "success",
            "message" => "Value deleted successfully.",
        ]);
    }

    public function getAll() {
        $data = $this->model->readDataBase();
        $transaction = $data['transaction'] ?? [];

        return $this->response([
            "status" => "success",
            "data"   => $transaction
        ]);
    }

    public function search($date, $hour) {
        $index = $this->model->find($date, $hour);

        if ($index === -1) {
            return $this->response([
                "status"  => "failure",
                "message" => "No data found with this date and hour.",
            ]);
        }

        $all = $this->model->readDataBase();
        $transaction = $all['transaction'][$index];

        return $this->response([
            "status" => "success",
            "data"   => $transaction
        ]);
    }

    // --------------------------------------------------------
    private function response($array) {
        header('Content-Type: application/json');
        echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return true;
    }
}

?>


