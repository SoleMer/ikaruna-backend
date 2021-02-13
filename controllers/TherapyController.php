<?php

include_once('models/TherapyModel.php');
include_once('response/Response.php');
include_once('helpers/auth.helper.php');

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
        if(1) { //if (AuthHelper::checkAdmin()) {
            $trp = json_decode(file_get_contents("php://input"));
            if (!empty($trp->name) && !empty($trp->description)) {
                $name = $trp->name;
                $description = $trp->description;
                $therapist = $trp->therapist_id;
                $succes =$this->model->save($name,$description,$therapist);

                if($succes) {
                    $trp = $this->model->getTherapyByName($name);
                    $reply = [
                        'status' => 'ok',
                        'msg' => 'Terapia guardada',
                        'id' => $trp->id
                    ];
                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'No se pudo guardar',
                    ];
                }
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'Faltan datos',
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => session_status(),
            ];
        }
        $this->response->response(json_encode($reply), 200);
    }

    public function getById($params = []) {
        $id = $params[':ID'];
        $trp = $this->model->getTherapyById($id);
        $this->response->response($trp, 200);
    }

    public function delete($params = []) {
        $deleted = $this->model->delete($params[':ID']);
        if($deleted) {
            $reply = [
                'status' => 'ok',
                'msg' => 'Terapia eliminada',
            ];
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No se pudo eliminar la terapia. Por favor, intente más tarde',
            ];
        }
        $this->response->response($reply, 200);
    }

    public function edit($params = []) {
        if(1) {//if (AuthHelper::checkAdmin()) {
            $id = $params[':ID'];
            $trpDB = $this->model->getTherapyById($id);
            $trp = json_decode(file_get_contents("php://input"));
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
            if($trp->therapist_id != $trpDB->therapist_id) {
                $therapist = $trp->therapist_id;
            } else {
                $therapist = $trpDB->therapist_id;
            }
            $edited = $this->model->editTherapy($id,$name,$description,$therapist);

            if($edited) {
                $reply = [
                    'status' => 'ok',
                    'msg' => 'Cambios guardados'
                ];
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No se pudieron guardar los cambios'
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Sólo los administradores pueden editar'
            ];
        }
        $this->response->response($reply, 200);
    }
}

?>