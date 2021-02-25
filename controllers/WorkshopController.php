<?php

include_once('models/WorkshopModel.php');
include_once('response/Response.php');
include_once('helpers/auth.helper.php');

class WorkshopController extends Controller{

    protected $model;
    protected $response;


    public function __construct() {
        $this->model = new WorkshopModel;
        $this->response= new Response();
    }



    public function add() {
        if (AuthHelper::checkAdmin()) {
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
                'msg' => 'Acción no permitida'
            ];
        }

        $this->response->response($reply, 200);
    }

    public function delete($params = []) {
        if(AuthHelper::checkAdmin()) {
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
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Acción no permitda',
            ];
        }
        $this->response->response($reply, 200);
    }

    public function edit($params = []) {
        if (AuthHelper::checkAdmin()) {
            $id = $params[':ID'];
            $ws = json_decode(file_get_contents("php://input"));
            $wsDb= $this->model->getWorkshopById($id);
                if (!empty($ws->name)) {
                    $name = $ws->name;
                }else {
                    $name = $wsDb->name;
                }
                if (!empty($ws->caption)) {
                    $caption = $ws->caption;
                }else {
                    $caption = $wsDb->caption;
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
                
                $edited = $this->model->editWorkshop($id,$name,$caption,$contents,$modality);

                if($edited) {
                    $reply = [
                        'status' => 'ok',
                        'msg' => 'Cambios guardados.'
                    ];
                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'No se pudo editar, intente más tarde.'
                    ];
                }
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'Sólo los administradores pueden editar.'
                ];
            }
            $this->response->response($reply, 200);
    }

   /* public function addImg($params = []) {
        $ws_id = $params[':ID'];
        //$img = $_FILES['input_name']['tmp_name'];
        $archive = json_decode(file_get_contents("php://input"));
        $img = $archive->file;
        $img_name =  'ws-' . uniqid();

       /* $reply = [
            'status' => 'file',
            'msg' => $img
        ]; 

        $success = $this->model->addImg($ws_id, $img, $img_name);
        
        if($success) {
            $reply = [
                'status' => 'ok',
                'msg' => 'Imagen guardada.'
            ];
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No se pudo guardar la imagen.'
            ];
        } 

        $this->response->response($reply,200);
    } */
}

?>