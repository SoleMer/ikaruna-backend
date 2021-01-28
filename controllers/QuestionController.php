<?php
 
include_once('models/QuestionModel.php');
include_once('senders/Sender.php');

class QuestionController extends Controller {

    private $model;
    private $sender;

    public function __construct() {
        $this->model = new QuestionModel;
        $this->sender = new Sender;
    }

    public function add() {
        if (AuthHelper::checkLoggedIn()) {
            $question = json_decode(file_get_contents("php://input"));
            if (!empty($question->text)) {
                $text = $question->text;
                $user = $question->user_id;
                $this->model->save($text,$user);
                $this->sender->sendEmailQuestion($question);
            }
        }
    }

}

?>