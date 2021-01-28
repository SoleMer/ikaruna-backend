<?php

include_once('Model.php');
class UserModel extends Model {

    public function save($username,$email,$phone,$password){
        $query = $this->db->prepare('INSERT INTO user (username, email, phone, password, admin) VALUES (?, ?, ?, ?, ?)');
        return $query->execute([$username, $email, $phone, $password, 0]);
    }
    
    public function delete($id){
        $query = $this->db->prepare('DELETE FROM `user` WHERE `id`= ?');
        return $query->execute([$id]);
    }

    public function editUser($id, $email, $phone){
        $query = $this->db->prepare('UPDATE `user` SET `email`= ? , `phone`= ?  WHERE `id` = ?');
        return $query->execute([$email,$phone,$id]);
    }
    
    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM user');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserById($id) {
        $query = $this->db->prepare('SELECT * FROM `user` WHERE id = ?');
        $query->execute(array(($id)));
        return $query->fetch(PDO::FETCH_OBJ);      
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM `user` WHERE email = ?');
        $query->execute(array(($email)));
        return $query->fetch(PDO::FETCH_OBJ);      
    }
}

?>