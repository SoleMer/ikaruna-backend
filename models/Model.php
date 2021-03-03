<?php

class Model {

    protected $db;

    public function __construct() {
    
    //$this->db = new PDO('mysql:host=localhost;dbname=id16264126_ikaruna;charset=utf8', 'id16264126_root', 'j9X-Gt75WaTW3LY');
  // $this->db = new PDO('mysql:host=localhost;dbname=ikaruna;charset=utf8', 'root', '');
       /*          
        $host = 'localhost';
        $userName = 'root';
        $password = '';
        $database = 'ikaruna';
        $host = 'sql210.byethost13.com';
        $userName = 'b13_28043290';
        $password = '38428046quitito';
        $database = 'b13_28043290_ikaruna';*/

        $host = 'fdb30.awardspace.net';
        $userName = '3762297_ikaruna';
        $password = '2010_PSM_2707';
        $database = '3762297_ikaruna';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $userName, $password);
        } 
        catch (Exception $e) {
            echo(var_dump($e));
        }
    }
}

?>