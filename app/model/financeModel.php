<?php

class FinanceModel{
    private $json_dir;

    public function __construct(){
        $this->json_dir = __DIR__ . '/../../data/database.json';
    }

    public function readDataBase(){
        if(!file_exists($this->json_dir)){
            return [];
        }

        $json = file_get_contents($this->json_dir);
        $data = json_decode($json, true);

        return $data ?: [];
    }
    
    public function writeDataBase($data){
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->json_dir, $json);
    }

    // NOVA FUNÇÃO PEDIDA
    public function insertValue($section, $newValue){
        // Lê os dados
        $data = $this->readDataBase();

        // Garante que a seção exista
        if (!isset($data[$section]) || !is_array($data[$section])) {
            $data[$section] = [];
        }

        // Insere o valor na seção desejada (ex: 'transaction')
        $data[$section][] = $newValue;

        // Salva no arquivo
        $this->writeDataBase($data);

        return true;
    }
}

?>
