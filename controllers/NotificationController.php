<?php

include_once('models/NotificationModel.php');
include_once('models/UserModel.php');
include_once('models/TherapyModel.php');
include_once('response/Response.php');
include_once('models/ShiftModel.php');
include_once('models/WorkshopModel.php');
include_once('helpers/auth.helper.php');

class NotificationController extends Controller{
    
    private $model;
    private $userModel;
    private $trpModel;
    protected $response;
    private $shiftModel;
    private $wsModel;
    private $auth;

    public function __construct() {
        $this->model = new NotificationModel;
        $this->userModel = new UserModel;
        $this->trpModel = new TherapyModel;
        $this->response = new Response;
        $this->shiftModel = new ShiftModel;
        $this->wsModel = new WorkshopModel;
        $this->auth = new AuthHelper;
    }

    public function notifyShiftRequest($shift, $date) {
        $subject = 'shift';
        $patient = $this->userModel->getUserById($shift->patient);
        $therapy = $this->trpModel->getTherapyById($shift->therapy);
        $msg = $patient->username . ' solicita un turno para ' . $therapy->name . 
        ', con fecha y hora: ' . $date . '. Su número de contacto es: ' . $patient->phone . '.' ;

        $admins = $this->userModel->getUsersAdmin(1);
        foreach ($admins as $a) {
            $this->model->save($subject, $msg, $a->id);
        }
    }

    public function notifyShiftAccepted($shift_id) {
        $subject = 'shift';
        $shift = $this->shiftModel->getById($shift_id); 
        $patient = $this->userModel->getUserById($shift->patient_id);
        $therapy = $this->trpModel->getTherapyById($shift->therapy_id);
        $msg = $patient->username . ': se confirmó tu turno para ' . $therapy->name . 
        ', con fecha y hora: ' . $shift->date . '. Te esperamos en 9 de Julio 250. Gracias!' ;

        $this->model->save($subject, $msg, $patient->id);

    }

    public function notifyNewQuestion($question) {
        $subject = 'question';
        $user = $this->userModel->getUserById($question->user_id);
        $msg = $user->username . ' hizo una pregunta.';

        $admins = $this->userModel->getUsersAdmin(1);
        foreach ($admins as $a) {
            $this->model->save($subject, $msg, $a->id);
        }

    }

    public function getAll($params = []) {
        $userData = $this->auth->getUserId();
        if($userData == $params[':ID']) {
            $nots = $this->model->getAll($params[':ID']);
            if($nots) {
                $this->response->response($nots, 200);
            } else {
                $this->response->response(null, 200);
            }
        }  else {
            $this->response->response(null, 200);
        }   
    }

    public function delete($params = []) {
        $deleted = $this->model->delete($params[':ID']);
        if($deleted) {
            $reply = [
                'status' => 'ok',
                'msg' => 'Notificación eliminada',
            ];
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No se pudo eliminar la notificación. Por favor, intente más tarde',
            ];
        }
        $this->response->response($reply, 200);
    }

    public function deleteAll($params = []) {
        $userData = $this->auth->getUserId();
        if($params[':ID'] == $userData) {
            $deleted = $this->model->deleteAll($params[':ID']);
            if($deleted) {
                $reply = [
                    'status' => 'ok',
                    'msg' => 'Notificaciones eliminadas',
                ];
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No se pudieron eliminar las notificaciones. Por favor, intente más tarde',
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Acción no permitida',
            ];
        }
        $this->response->response($reply, 200);
    }

    public function add() {
        $subject = 'workshop';
        $request = json_decode(file_get_contents("php://input")) ;
        $user_id = $request->user;
        $ws_id = $request->ws;

        $user = $this->userModel->getUserById($user_id);
        $workshop = $this->wsModel->getWorkshopById($ws_id);

        $msg = $user->username . ' desea hacer el taller ' . $workshop->name . 
        '. Su email es: ' . $user->email . ', y su número de teléfono es: ' . 
        $user->phone . '.';

        $admins = $this->userModel->getUsersAdmin(1);
        foreach ($admins as $a) {
            $this->model->save($subject, $msg, $a->id);
        }

        $reply = [
            'status' => 'ok',
            'msg' => 'Notificación guardada'
        ];

        $this->response->response($reply,200);
    }
}
    
?>