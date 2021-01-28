<?php

class Controller {
        
    
    //return true if the user logged is admin
    public function check() {
        $admin = AuthHelper::checkAdmin();
        if($admin == 1) {
            return true;
        }
        return false;
    }

    public function getAllToAdmmin() {
        if ($this->check()) {
            return $this->model->getAll();
        }
    }
/*
    public function getAll() {
        $objs = $this->model->getAll();
        echo('Estoy en el controlador');
        return $objs;
    }
*/
    public function delete($params = []) {
        if ($this->check()) {
            $this->model->delete($params[':ID']);
        }
    }

}

?>