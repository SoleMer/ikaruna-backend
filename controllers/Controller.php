<?php

include_once('response/Response.php');
include_once('cookies.php');
include_once('helpers/auth.helper.php');

class Controller {

    protected $response;
    protected $cookies;

    public function __construct()    {
        $this->response = new Response();
        $this->cookies = new Cookies();
    }
        
    
    //return true if the user logged is admin
    public function check() {
    return UserController::checkAdmin();
        /*    if(UserController::checkAdmin() == 1) {
            return true;
        } else {
        return false; 
        }
        */
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