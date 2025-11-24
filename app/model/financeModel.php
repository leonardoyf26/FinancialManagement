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
        $transaction = $data['transaction'];

            echo "\n\n\n{$date}";


        for ($i=0; $i < count($data['transaction']); $i++) { 
            if($transaction[$i]['date'] == $date && $transaction[$i]['hour'] == $hour){
                return $i;
            }
        }
        
        return -1;
    }
}

?>
