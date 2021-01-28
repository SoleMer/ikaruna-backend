<?php

include_once('models/WorkshopModel.php');

class WorkshopController extends Controller{

    private $model;

    public function __construct() {
        $this->model = new WorkshopModel;
    }

    public function add() {
        if ($this->check()) {
            $ws = json_decode(file_get_contents("php://input"));
            if (!empty($ws->name) && !empty($ws->contents) && !empty($ws->modality)) {
                $name = $ws->name;
                $contents = $ws->contents;
                $modality = $ws->modality;
                
                $this->model->save($name,$contents,$modality);
            }
        }
    }

    public function edit($params = []) {
        if ($this->check()) {
            $id = $params[':ID'];
            $ws = json_decode(file_get_contents("php://input"));
            $wsDb= $this->model->getWorkshopById($id);
            if (!empty($ws->name) || !empty($ws->contents) || !empty($ws->modality)) {
                if (!empty($ws->name)) {
                    $name = $ws->name;
                }else {
                    $name = $wsDb->name;
                }
                if (!empty($ws->contents)) {
                    $contents = $ws->contents;
                }else {
                    $contents = $wsDb->contents;
                }
                if (!empty($ws->modality)) {
                    $modality = $ws->modality;
                }else {
                    $modality = $wsDb->modality;
                }
                
                $this->model->editWorkshop($id,$name,$contents,$modality);
            }
        }
    }
}

?>