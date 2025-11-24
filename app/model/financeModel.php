<?php

class FinanceModel{
    private $json_dir;

    //Declares the database path.
    public function __construct(){
        $this->json_dir = __DIR__ . '/../../data/database.json';
    }

    //Function that reads the database and returns its data.
    public function readDataBase(){
        if(!file_exists($this->json_dir)){
            return [];
        }

        $json = file_get_contents($this->json_dir);
        $data = json_decode($json, true);

        return $data ?: [];
    }
    
    //Function that writes to the database.
    public function writeDataBase($data){
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->json_dir, $json);
    }

    //Function that formats the received data and adds it to the database.
    public function insertValue($newValue){
        $section = 'transaction';
        $data = $this->readDataBase();

        if (!isset($data[$section]) || !is_array($data[$section])) {
            $data[$section] = [];
        }

        $data[$section][] = $newValue;

        $this->writeDataBase($data);
    }

    //Function that searches for an element in the database and returns its index.
    public function find($date, $hour){
        $data = $this->readDatabase();
        $transaction = $data['transaction'] ?? [];

        for ($i=0; $i < count($transaction); $i++) { 
            if($transaction[$i]['date'] == $date && $transaction[$i]['hour'] == $hour){
                return $i;
            }
        }

        return -1;
    }

    //Function that removes an element in the database.
    public function removeValue($date, $hour){
        $section = 'transaction';
        $data = $this->readDataBase();

        if (!isset($data[$section]) || !is_array($data[$section])) {
            $data[$section] = [];
        }

        $remove_index = $this->find($date, $hour);  
        array_splice($data[$section], $remove_index, 1);
        $this->writeDataBase($data);
    }
}

?>
