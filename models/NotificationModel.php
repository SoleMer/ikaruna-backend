<?php

class NotificationModel extends Model {
    
    public function save($subject, $msg, $user) {
        $query = $this->db->prepare('INSERT INTO notification (subject, message, user_id) VALUES (?, ?, ?)');
        $query->execute([$subject,$msg,$user]);
    }

    public function getAll($id_user) {
        $query = $this->db->prepare('SELECT * FROM `notification` WHERE user_id = ? ORDER BY id DESC');
        $query->execute(array(($id_user)));
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM `notification` WHERE `id`=?');
        return $query->execute([$id]);
    } 

    public function deleteAll($id) {
        $query = $this->db->prepare('DELETE FROM `notification` WHERE `user_id`=?');
        return $query->execute(array(($id)));
    } 
}

?>