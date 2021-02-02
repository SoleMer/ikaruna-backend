<?php

include_once('models/TherapyModel.php');
include_once('response/Response.php');

class TherapyController extends Controller{

    private $model;
    protected $response;

    public function __construct() {
        $this->model = new TherapyModel();
        $this->response= new Response();
    }

    public function getAll() {
        $therapies = $this->model->getAll();
        if ($therapies) {
            $this->response->response($therapies, 200);
        } else {
            $this->response->response(null, 404);
        }
    }

    public function add() {
        if ($this->check()) {
            $trp = json_decode(file_get_contents("php://input"));
            if (!empty($trp->name) && !empty($trp->description)) {
                $name = $trp->name;
                $description = $trp->description;
                $therapist = $trp->therapist_id;
                $this->model->save($name,$description,$therapist);
            }
        }
    }

    public function edit($params = []) {
        if ($this->check()) {
            $id = $params[':ID'];
            $trpDB = $this->model->getTherapyById($id);
            $trp = json_decode(file_get_contents("php://input"));
            if (!empty($trp->name) || !empty($trp->description) || $trp->therapist != $trpDB->therapist) {
                if (!empty($trp->name)) {
                $name = $trp->name;
            } else {
                $name = $trpDB->name;
            }
            if (!empty($trp->description)) {
                $description = $trp->description;
            } else {
                $description = $trpDB->description;
            }
            $therapist = $trp->therapist;
            
            $this->model->editTherapy($id,$name,$description,$therapist);
        }
    }
}

}

?>