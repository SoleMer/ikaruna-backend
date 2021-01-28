<?php

include_once('Model.php');

class TherapyModel extends Model {
    
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

    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM therapy');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTherapyById($id){
        $query = $this->db->prepare('SELECT * FROM `therapy` WHERE id = ?');
        $query->execute(array(($id)));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save($name,$description,$therapist) {
        $query = $this->db->prepare('INSERT INTO therapy (name, description, therapist_id) VALUES (?, ?, ?)');
        return $query->execute([$name, $description, $therapist]);
    }

    public function editTherapy($id,$name,$description,$therapist) {
        $query = $this->db->prepare('UPDATE `therapy` SET `name`= ? , `description= ? , `therapist= ?  WHERE `id` = ?');
        return $query->execute([$name,$description,$therapist,$id]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM `therapy` WHERE `id`=?');
        return $query->execute([$id]);
    } 
}

?>