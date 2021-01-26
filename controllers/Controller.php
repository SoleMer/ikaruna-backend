<?php

class Controller {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
        
    
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

    public function getAll() {
        $therapies = $this->model->getTherapies();
        return $therapies;
    }

    public function delete($params = []) {
        if ($this->check()) {
            $this->model->delete($params[':ID']);
        }
    }

}

?>