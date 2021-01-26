<?php

class ShiftModel extends Model{
 
    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM shift');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function save($date,$time,$patient,$therapy,$therapist,$status) {
        $query = $this->db->prepare('INSERT INTO shift (date, time, patient_id, therapy_id, therapist_id, status) VALUES (?, ?, ?, ?, ?, ?)');
        return $query->execute([$date,$time,$patient,$therapy,$therapist,$status]);
    }

    public function confirmShift($id) {
        $query = $this->db->prepare('UPDATE `shift` SET `status`= ?  WHERE `id` = ?');
        return $query->execute([1,$id]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM `shift` WHERE `id`=?');
        return $query->execute([$id]);
    } 

}
?>