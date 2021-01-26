<?php

class Model {

    private $db;

    public function __construct() {
    
    $this->db = new PDO('mysql:host=localhost;dbname=ikaruna;charset=utf8', 'root', '');
        $host = 'localhost';
        $userName = 'root';
        $password = '';
        $database = 'ikaruna';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $userName, $password);
        } 
        catch (Exception $e) {
            echo(var_dump($e));
        }
    }
}

?>