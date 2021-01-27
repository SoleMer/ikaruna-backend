<?php

class NotificationModel extends Model {
    
    public function save($msg, $user) {
        $query = $this->db->prepare('INSERT INTO notification (message, user_id) VALUES (?, ?)');
        $query->execute([$msg,$user]);
    }

    public function getNotificationsToUser($id_user) {
        $query = $this->db->prepare('SELECT * FROM `question` WHERE user_id=?');
        $query->execute(array(($id_user)));
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}

?>