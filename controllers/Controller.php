<?php

include_once('response/Response.php');

class Controller {

    protected $response;

    public function __construct()    {
        $this->response = new Response();
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
        $objs = $this->model->getAll();
        if ($objs) {
            $this->response->response($objs, 200);
        } else {
            $this->response->response(null, 404);
        }
    }

    public function delete($params = []) {
        if ($this->check()) {
            $this->model->delete($params[':ID']);
        }
    }

}

?>