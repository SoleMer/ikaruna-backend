<?php

include_once('models/TherapyModel.php');

class TherapyController extends Controller{

    private $model = new TherapyModel;

    public function __construct() {
        $this->__construct($this->model);
    }

    public function addTherapy() {
        if ($this->check()) {
            $trp = json_decode(file_get_contents("php://input"));
            if (!empty($trp->name) && !empty($trp->description)) {
                $name = $trp->name;
                $description = $trp->description;
                if (!empty($trp->therapist)) {
                    $therapist = $trp->therapist;
                } else {
                    $therapist = 0;
                }
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