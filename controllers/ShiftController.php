<?php

include_once('models/ShiftModel.php');
include_once('senders/Sender.php');
include_once('controllers/Controller.php');

class ShiftController extends Controller {

    private $model; 
    private $sender;

    public function __construct() {
        $this->model = new ShiftModel;
        $this->sender = new Sender;
    }

    public function add() {
        $shift = json_decode(file_get_contents("php://input"));
            if(!empty($shift->date) && !empty($shift->time) && !empty($shift->patient) && !empty($shift->therapy) && !empty($shift->therapist)){
                $date = $shift->date; 
                $time = $shift->time;
                $patient = $shift->patient;
                $therapy = $shift->therapy;  
                $therapist = $shift->therapist;  
                $status = AuthHelper::checkAdmin();
                //checkAdmin() return 1 if user is admin, and 0 if he isn't.
                //the status of the shift is 0 if it wasn't confirmed by an admin yet,
                //and 1 if the shift was confirmed or added by an admin.

                $this->model->save($date,$time,$patient,$therapy,$therapist,$status);

                if ($status == 0) {
                    $this->sender->askShift($shift);
                }
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