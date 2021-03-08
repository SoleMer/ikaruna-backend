<?php

class Model {

    protected $db;

    public function __construct() {

    /*    $host = 'fdb30.awardspace.net';
        $userName = '3762297_ikaruna';
        $password = '2010_PSM_2707';
        $database = '3762297_ikaruna'; */

        $host = 'sql103.epizy.com';
        $userName = 'epiz_28108452';
        $password = '38428046quitito';
        $database = 'epiz_28108452_ikaruna';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $userName, $password);
        } 
        catch (Exception $e) {
            echo(var_dump($e));
        }
    }
}

?>