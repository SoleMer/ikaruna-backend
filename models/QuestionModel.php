<?php

class QuestionModel extends Model{
 
    public function getAll() {
        $query = $this->db->prepare('SELECT question.*, user.email  FROM question LEFT JOIN user ON question.user_id = user.id');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function save($text,$user) {
        $query = $this->db->prepare('INSERT INTO question (text, user_id) VALUES (?,?)');
        $query->execute([$text,$user]);
        return $query;
    }

}

?>