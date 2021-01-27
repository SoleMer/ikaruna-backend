<?php

include_once('models/UserModel.php');
include_once('models/TherapyModel.php');

class NotificationController extends Controller{
    //class to send messages notifying users and administrators

    private $model = new UserModel;
    private $therapyModel;

    public function __construct() {
        $this->__construct($this->model);
        $this->therapyModel = new TherapyModel;
    }

    public function askShift($shift) {
        //method of notifying administrators that a user wants a shift
        $patient = $this->model->getUserById($shift->patient);
        $therapy = $this->therapyModel->getTherapyById($shift->therapy);
        
        $msg = $patient->username .' solicita un turno para '. 
            $therapy->name .' el día '. $shift->date .' a las '. 
            $shift->time .'. Email: '. $patient->email .' . Teléfono: '. 
            $patient->phone 
        ;   
        
        if ($shift->therapist != 0) {
            $therapist = $this->model->getUserById($shift->therapist);
            $addressee = $therapist->phone.'@sms.movistar.net.ar';
            mail($addressee, '', $msg);
        } else {
            $therapistOne = $this->model->getUserById(1);
            $therapistTwo = $this->model->getUserById(2);
            //TODO: edit this ugly hardcoded! (1, 2)
            $addresseeOne = $therapistOne->phone.'@sms.movistar.net.ar';
            $addresseeTwo = $therapistTwo->phone.'@sms.movistar.net.ar';
            mail($addresseeOne, '', $msg);
            mail($addresseeTwo, '', $msg);
        }
    }

    public function sendEmailQuestion($question) {
        $user = $this->model->getUserById($question->user_id);
        $msg = $user->id .', con e mail '. $user->email .', preguntó: '.
            $question->text
        ;

        $addressee = 'soledadmerino.1994@gmail.com';
        //another hardcoded
        mail($addressee, 'Ikaruna question', $msg);
        //TODO: inform the user if their question was submitted
    }
}

?>