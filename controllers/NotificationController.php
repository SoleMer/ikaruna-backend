<?php

include_once('models/NotificationModel.php');
include_once('models/UserModel.php');
include_once('models/TherapyModel.php');
include_once('response/Response.php');
include_once('models/ShiftModel.php');

class NotificationController extends Controller{
    
    private $model;
    private $userModel;
    private $trpModel;
    protected $response;
    private $shiftModel;

    public function __construct() {
        $this->model = new NotificationModel;
        $this->userModel = new UserModel;
        $this->trpModel = new TherapyModel;
        $this->response = new Response;
        $this->shiftModel = new ShiftModel;
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
        //TODO: enviar msj de texto a admins
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
        $nots = $this->model->getAll($params[':ID']);

        if($nots) {
            $this->response->response($nots, 200);
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No hay notifcaciones.'
            ];
            $this->response->response($reply, 200);
        }
    }
}
    
?>