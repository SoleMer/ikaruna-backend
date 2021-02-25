<?php

include_once('models/ShiftModel.php');
include_once('senders/Sender.php');
include_once('controllers/Controller.php');
include_once('response/response.php');
include_once('models/UserModel.php');
include_once('controllers/NotificationController.php');
include_once('helpers/auth.helper.php');

class ShiftController extends Controller {

    private $model; 
    protected $response;
    private $sender;
    private $userModel;
    private $notifications;

    public function __construct() {
        $this->model = new ShiftModel;
        $this->response = new response();
        $this->sender = new Sender;
        $this->userModel = new UserModel;
        $this->notifications = new NotificationController;
    }

    public function add() {
        $shift = json_decode(file_get_contents("php://input"));
        if(!empty($shift->date) && !empty($shift->time)){
            $therapy = $shift->therapy; 
            $dateTime = $shift->date . ' ' . $shift->time . ':00' ;
            $status = $shift->status;
            //$status = AuthHelper::checkAdmin();
            //checkAdmin() return 1 if user is admin, and 0 if he isn't.
            //the status of the shift is 0 if it wasn't confirmed by an admin yet,
            //and 1 if the shift was confirmed or added by an admin.
            $patient = $shift->patient;
            if($patient == 0) {
                $username = $shift->patient_name;
            } else {
                $username = $this->userModel->getUserById($patient)->username;
            }
            $success = $this->model->save($dateTime,$patient,$username,$therapy,$status);
            if($success) {
                if($status == 0) {
                    $this->notifications->notifyShiftRequest($shift, $dateTime);
                }
                $reply = [
                    'status' => 'ok',
                    'msg' => 'Turno guardado'
                ];
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No se pudo guardar el turno. Intente más tarde'
                ];
            }
                /*
                if ($status == 0) {
                    $this->sender->askShift($shift);
                } 
                */
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Datos incompletos'
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
                    'msg' => 'Turno eliminado',
                ];
            } else {
                $reply = [
                        'status' => 'error',
                'msg' => 'No se pudo eliminar el turno. Por favor, intente más tarde',
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

    public function confirm($params = []) {
        if(AuthHelper::checkAdmin()){
            $id = $params[':ID'];
            $success = $this->model->confirmShift($params[':ID']);

            if($success) {
                $this->notifications->notifyShiftAccepted($id);
                $reply = [
                    'status' => 'ok',
                    'msg' => 'Turno confirmado.',
                ];
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No se pudo confirmar.',
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Sólo los admin pueden confirmar turnos.',
            ];
        }
        $this->response->response($reply, 200);
    }

    public function getAll() {
        if (AuthHelper::checkAdmin()) {
            $shifts = $this->model->getAll();
            if($shifts) {
                $this->response->response($shifts, 200);
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No hay turnos guardados.'
                ];
                $this->response->response($reply, 200);
            }

        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Sólo los admin pueden acceder al listado de turnos.'
            ];
            $this->response->response($reply, 200);
        }
    }

    public function getUserShifts($params = []) {
        $userData = AuthHelper::getUserData();
        if ($params[':ID'] == $userData['id_user']) { //CHEQUEAR QUE EL USER QUE SOLICITA SEA EL QUE TIENELA SESION INICIADA
            $shifts = $this->model->getByUserId($params[':ID']);
            if($shifts) {
                $this->response->response($shifts, 200);
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No hay turnos registrados para este usuario.'
                ];
                $this->response->response($reply, 200);
            }

        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No se pueden visualizar los turnos de otro usuario.'
            ];
            $this->response->response($reply, 200);
        }
    }

}

?>