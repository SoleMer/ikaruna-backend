<?php

class ShiftModel extends Model{
 
    public function getAll() {
        $query = $this->db->prepare('SELECT shift.*, therapy.name FROM shift LEFT JOIN therapy ON shift.therapy_id = therapy.id ORDER BY date ASC');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getByUserId($id) {
        $query = $this->db->prepare('SELECT shift.*, therapy.name FROM shift LEFT JOIN therapy ON shift.therapy_id = therapy.id WHERE patient_id = ? ORDER BY status DESC');
        $query->execute(array(($id)));
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function save($date,$patient,$username,$therapy,$status) {
        $query = $this->db->prepare('INSERT INTO shift (date, patient_id, patient_name, therapy_id, status) VALUES (?, ?, ?, ?, ?)');
        return $query->execute([$date,$patient,$username,$therapy,$status]);
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