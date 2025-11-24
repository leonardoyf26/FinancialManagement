<?php

class FinanceModel{
    private $json_dir;

    public function __construct(){
        // Sets the path to the JSON database file
        $this->json_dir = __DIR__ . '/../../data/database.json';
    }

    public function readDataBase(){
        // Checks if the JSON file exists
        if(!file_exists($this->json_dir)){
            return [];
        }

        // Reads the content of the JSON file
        $json = file_get_contents($this->json_dir);

        // Decodes the JSON into an associative array
        $data = json_decode($json, true);

        // Returns the decoded data, or an empty array if decoding fails
        return $data ?: [];
    }
    
    public function writeDataBase($data){
        // Encodes the data array back to JSON format
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Writes the encoded JSON back to the file
        file_put_contents($this->json_dir, $json);
    }
}

?>
