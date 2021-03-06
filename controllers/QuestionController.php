<?php
 
include_once('models/QuestionModel.php');
include_once('response/Response.php');
include_once('controllers/NotificationController.php');
include_once('helpers/auth.helper.php');

class QuestionController extends Controller {

    private $model;
    protected $response;
    private $notification;
    private $auth;

    public function __construct() {
        $this->model = new QuestionModel;
        $this->response = new Response();
        $this->notification = new NotificationController;
        $this->auth = new AuthHelper;
    }

    public function add() {
        if ($this->auth->checkLoggedIn()) {
            $question = json_decode(file_get_contents("php://input"));
            if (!empty($question->text)) {
                $text = $question->text;
                $user = $question->user_id;
                $success = $this->model->save($text,$user);

                if($success) {
                    $this->notification->notifyNewQuestion($question);
                    $reply = [
                        'status' => 'ok',
                        'msg' => 'Pregunta guardada'
                    ];
                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'No se pudo guardar la pregunta'
                    ];
                }
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No se puede guardar una pregunta vacía'
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Debe iniciar sesión para hacer una pregunta'
            ];
        }
        $this->response->response($reply, 200);
    }

    public function getAllToAdmin() {
        if ($this->auth->checkAdmin()) {
            $questions = $this->model->getAll();
            if($questions) {
                $this->response->response($questions, 200);
            } else {
                $this->response->response(null, 404);
            }

        } else {
            $this->response->response(null, 404);
        }
    }

}

?>