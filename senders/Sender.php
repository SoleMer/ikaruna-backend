<?php


include_once('models/UserModel.php');
include_once('models/TherapyModel.php');
require_once('PHPMailer/PHPMailerAutoload.php');
require_once('PHPMailer/class.phpmailer.php');
require_once('PHPMailer/class.smtp.php');

class Sender{
    //class to send messages notifying users and administrators

    private $model;
    private $therapyModel;

    public function __construct() {
        $this->model = new UserModel;
        $this->therapyModel = new TherapyModel;
    }

    public function askShift($msg) {
        //method of notifying administrators that a user wants a shift
        $gri = $this->model->getByUsername("Gri");
        $sole = $this->model->getByUsername("Sole");
        $addresseeGri = $gri->phone.'@sms.movistar.net.ar';
        $addresseeSole = $sole->phone.'@sms.movistar.net.ar';
        mail($addresseeGri, '', $msg);
        mail($addresseeSole, '', $msg);
    }

    public function sendEmailQuestion($question, $user) {
        $msg = $user->username . ' preguntó: ' . $question->text . '. Su email es :' . 
        $user->email . ' y su número de teléfono es: ' . $user->phone;

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '456';
        $mail->isHTML();
        $mail->Username = 'soledadmerino.1994@gmail.com';
        $mail->SetFrom('no-reply@howcode.org');
        $mail->Subject = 'Question Ikaruna';
        $mail->Body = $msg;
        $mail->addAddress('griseldadelcastello@gmail.com');

        $mail->Send();
    }
}

?>

