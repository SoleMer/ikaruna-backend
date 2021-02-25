<?php

class WorkshopModel extends Model{
    
    public function save($name,$caption,$contents,$modality){
        $query = $this->db->prepare('INSERT INTO workshop (name, caption, contents, modality) VALUES (?, ?, ?,?)');
        return $query->execute([$name, $caption, $contents, $modality]);
    }

    public function addImg($id, $image, $img_name){
        $pathImage = null;
        if($image){
            $pathImage = $this->uploadImage($image, $img_name);
        }
        $query = $this->db->prepare('UPDATE `workshop` SET `image`= ? WHERE `id` = ?');
        return $query->execute([$pathImage,$id]);
    }

    private function uploadImage($image, $img_name){
        $target = 'uploads/workshops/' . $img_name . ".jpg";
        //$path = BASE_URL . $target ;
        //file_put_contents($path, $image);
        move_uploaded_file($image, $target);
        return $target;
     /*   $target = 'assets/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;
        */
    }
    
    public function delete($id){
        $query = $this->db->prepare('DELETE FROM `workshop` WHERE `id`= ?');
        return $query->execute([$id]);
    }

    public function editWorkshop($id, $name, $caption, $contents,$modality){
        $query = $this->db->prepare('UPDATE `workshop` SET `name`= ? , `caption`= ? , `contents`= ? , `modality`= ?  WHERE `id` = ?');
        return $query->execute([$name,$caption,$contents,$modality,$id]);
    }
    
    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM workshop');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getWorkshopById($id) {
        $query = $this->db->prepare('SELECT * FROM `workshop` WHERE id = ?');
        $query->execute(array(($id)));
        return $query->fetch(PDO::FETCH_OBJ);      
    }
}


?>