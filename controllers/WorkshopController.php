<?php

include_once('models/WorkshopModel.php');
include_once('response/Response.php');

class WorkshopController extends Controller{

    protected $model;
    protected $response;


    public function __construct() {
        $this->model = new WorkshopModel;
        $this->response= new Response();
    }



    public function add() {
        if(1) { //if ($this->check()) {
            $ws = json_decode(file_get_contents("php://input"));
            if (!empty($ws->name) && !empty($ws->contents) && !empty($ws->caption) && !empty($ws->modality)) {
                $name = $ws->name;
                $caption = $ws->caption;
                $contents = $ws->contents;
                $modality = $ws->modality;
                
                $success = $this->model->save($name,$caption,$contents,$modality);

                if($success) {
                    $reply = [
                        'status' => 'ok',
                        'msg' => 'Taller agregado'
                    ];
                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'No se pudo agregar'
                    ];
                }
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'Faltan datos'
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Sólo los administradores tienen permiso para agregar'
            ];
        }

        $this->response->response($reply, 200);
    }

    public function delete($params = []) {
        $deleted = $this->model->delete($params[':ID']);
        if($deleted) {
            $reply = [
                'status' => 'ok',
                'msg' => 'Taller eliminado',
            ];
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No se pudo eliminar el taller. Por favor, intente más tarde',
            ];
        }
        $this->response->response($reply, 200);
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