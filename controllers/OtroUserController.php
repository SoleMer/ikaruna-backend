<?php

include_once('models/UserModel.php');
include_once('response/Response.php');

class OtroUserController extends Controller {
    
    private $model;
    protected $response;

    public function __construct()    {
        $this->model = new UserModel();
        $this->response = new Response();
    }

    public function login($user) {
        if (session_status() == 'PHP_SESSION_ACTIVE') {
            $reply = [
                'status' => 'error',
                'msg' => 'Ya hay una sesión activa. Cerrar sesión para iniciar una nueva',
                'token' => '0',
                'id_user' => '0',
                'isAdmin' => '0'
            ];
        } else {
            $u = json_decode(file_get_contents("php://input"));

            if(isset($u->email) && isset($u->password)) {
                $userDB = $this->model->getUserByEmail($u->email);
                if(password_verify($u->password, $userDB->password)) {

                    session_start();
                    $_SESSION['id'] = $userDB->id;
                    $_SESSION['username'] = $userDB->username;
                    $_SESSION['admin'] = $userDB->admin;

                    $reply = [
                        'status' => 'ok',
                        'msg' => 'Sesión iniciada',
                        'token' => '0',
                        'id_user' => $userDB->id,
                        'isAdmin' => $userDB->admin
                    ];

                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'El usuario o la contraseña son incorrectos',
                        'token' => '0',
                        'id_user' => '0',
                        'isAdmin' => '0'
                    ];
                }
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'Faltan datos obligatorios',
                    'token' => '0',
                    'id_user' => '0',
                    'isAdmin' => '0'
                ];
            }
        }
        $this->response->response($reply, 200);
    }
}

?>