<?php

include_once('models/ShiftModel.php');
include_once('senders/Sender.php');
include_once('controllers/Controller.php');
include_once('response/response.php');

class ShiftController extends Controller {

    private $model; 
    protected $response;
    private $sender;

    public function __construct() {
        $this->model = new ShiftModel;
        $this->response = new response();
        $this->sender = new Sender;
    }

    public function add() {
        $shift = json_decode(file_get_contents("php://input"));
            if(!empty($shift->date) && !empty($shift->time) && !empty($shift->patient)){
                $date = $shift->date; 
                $time = $shift->time;
                $patient = $shift->patient;
                $therapy = $shift->therapy;  
                $therapist = 5;  
                $status = $shift->status;
                //$status = AuthHelper::checkAdmin();
                //checkAdmin() return 1 if user is admin, and 0 if he isn't.
                //the status of the shift is 0 if it wasn't confirmed by an admin yet,
                //and 1 if the shift was confirmed or added by an admin.

                $success = $this->model->save($date,$time,$patient,$therapy,$therapist,$status);
                if($success) {
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
                $this->response->response($reply, 200);
            }
    }

    public function confirm($params = []) {
        if($this->check()){
            $id = $params[':ID'];
            $this->model->confirmShift($id);
        }
    }

}

?>