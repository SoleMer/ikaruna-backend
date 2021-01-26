<?php

class QuestionModel extends Model{
 
    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM question');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function save($text,$user) {
        $query = $this->db->prepare('INSERT INTO question (text, user_id) VALUES (?,?)');
        $query->execute([$text,$user]);
    }

}

?>