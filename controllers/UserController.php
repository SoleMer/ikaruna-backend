<?php
include_once('controllers/Controller.php');
include_once('models/UserModel.php');
include_once('response/Response.php');
include_once('helpers/auth.helper.php');

class UserController extends Controller{

    private $model;
    protected $response;

    public function __construct() {
        $this->model = new UserModel;
        $this->response = new Response();
    }

    public function login($user) {
        $logged = AuthHelper::checkLoggedIn();
        if ($logged) {
            $reply = [
                'status' => 'error',
                'msg' => 'Ya hay una sesión activa. Cerrar sesión para iniciar una nueva'
            ];
        } else {
            session_start();
            $_SESSION['ID_USER'] = $user->id;
            $_SESSION['USERNAME'] = $user->username;
            $_SESSION['EMAIL'] = $user->email;
            $_SESSION['ADMIN'] = $user->admin;
            
            $reply = [
                'status' => 'ok',
                'msg' => 'Sesión iniciada',
            ];
        }
        return $reply;
    }
    
    public function logout() {
        session_start();
        session_destroy();
    }

    public function verify(){
        $user = json_decode(file_get_contents("php://input"));
        if(!empty($user->email) && !empty($user->password)){
            $email = $user->email;
            $pass = $user->password;
            $userDb = $this->model->getUserByEmail($email);

            $hash = $userDb->password;
            $match = password_verify($pass, $hash);
        
            if($match){
                $reply = $this->login($userDb);
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'El usuario o la contraseña son incorrectos.'
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Faltan datos obligatorios'
            ];
        }
        $this->response->response($reply, 200);
    }

    public function add(){
        $user = json_decode(file_get_contents("php://input"));
        if(!empty($user->username) && !empty($user->email) && !empty($user->phone) && !empty($user->password) && !empty($user->repassword)){
            if(($user->password) != ($user->repassword)){
                $reply = [
                    'status' => 'error',
                    'msg' => 'Las contraseñas no coinciden',
                ];
            }
            else{
                $email = $user->email;
                $existente = $this->model->getUserByEmail($email);
                if ($existente == null) {
                    $username = $user->username; 
                    $phone = $user->phone;
                    $pass = $user->password;    
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
            
                    $success = $this->model->save($username,$email,$phone,$hash);
                    if ($success) {
                        $userDb = $this->model->getUserByEmail($email);
                        $reply = $this->login($userDb);
                    }else {
                        $reply = [
                            'status' => 'error',
                            'msg' => 'No se pudo registrar el usuario. Por favor, intente más tarde',
                        ];
                    }
                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'El usuario ya existe en la base de datos. Iniciar sesión',
                    ];
                }
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Faltan datos obligatorios',
            ];
        }
        $this->response->response($reply, 200);
    }

    public function edit($params = []) {
        $user = json_decode(file_get_contents("php://input"));
        if (!empty($user->password)) {
            $hash = $user->password;
            $userDb = $this->model->getUserById($params[':ID']);
            $response = password_verify($userDb->password, $hash);

            if ($response) {
                if (!empty($user->email)) {
                    $email = $user->email;
                }else {
                    $email = $userDb->email;
                }
                if (!empty($user->phone)) {
                    $phone = $user->phone;
                }else {
                    $phone = $userDb->phone;
                }

                $this->model->editUser($userDb->id, $email, $phone);
            }
        }
    }
}

?>