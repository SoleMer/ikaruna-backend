<?php
 
include_once('models/QuestionModel.php');

class QuestionController extends Controller {

    private $model = new QuestionModel;

    public function __construct() {
        $this->__construct($this->model);
    }

    public function add() {
        if (AuthHelper::checkLoggedIn()) {
            $question = json_decode(file_get_contents("php://input"));
            if (!empty($question->text)) {
                $text = $question->text;
                $user = $question->user;
                $this->model->save($text,$user);
            }
        }
    }

}

?>