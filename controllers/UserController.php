<?php
include_once('controllers/Controller.php');
include_once('models/UserModel.php');
include_once('response/Response.php');
include_once('cookies.php');
include_once('helpers/auth.helper.php');

class UserController extends Controller{

    private $model;
    protected $response;
    private $auth;

    public function __construct() {
        $this->model = new UserModel;
        $this->response = new Response();
        $this->auth = new AuthHelper;
    }

    public function checkSession() {
        if ($this->auth->checkLoggedIn()) {
            $id = $this->auth->getUserId();
            $admin = $this->auth->checkAdmin();
            $reply = [
                'status' => 'ok',
                'msg' => 'Session activa',
                'token' => '0',
                'id_user' => $id,
                'isAdmin' => $admin
            ];
        } else {
            $reply = [
                'status' => 'not',
                'msg' => 'No hay session iniciada',
                'token' => '0',
                'id_user' => '0',
                'isAdmin' => '0'
            ];
        }
        $this->response->response($reply, 200);
    }

    public function login($user) {
         //   session_set_cookie_params(time()+(60*60*24*31), "/", "http://localhost", false, false);
            $token = sha1(uniqid(rand(),true));
            $this->auth->login($user);
            
            $reply = [
                'status' => 'ok',
                'msg' => "Sesion iniciada",
                'token' => $token,
                'id_user' => $user->id,
                'isAdmin' => $user->admin     
            ];
        return $reply;
    }
    
    public function logout($params = []) {
        $id = $params[':ID'];
        $deleted = $this->auth->logout($id);

        if($deleted) {
            $reply = [
                'status' => 'closed',
                'msg' => "Cierre de session exitoso",
                'token' => 0,
                'id_user' => 0,
                'isAdmin' => 0     
            ];
        } else {
            $reply = [
                'status' => 'error',
                'msg' => "No se pudo cerrar la session"
            ];
        }
        $this->response->response($reply, 200);
    }

    public function verify(){
        $logged = $this->auth->checkLoggedIn();
        if ($logged) {
            $reply = [
                'status' => 'ok',
                'msg' => 'Ya hay una sesión activa. Cerrar sesión para iniciar una nueva',
                'token' => '0',
                'id_user' => $logged->user,
                'isAdmin' => $logged->admin
            ];
        } else {

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
            $userDb = $this->model->getUserById($params[':ID']);
            $hash = $userDb->password;
            $match = password_verify($user->password, $hash);

            if ($match) {
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

                $success = $this->model->editUser($userDb->id, $email, $phone);

                if($success) {
                    $reply = [
                        'status' => 'ok',
                        'msg' => 'Datos actualizados'
                    ];
                } else {
                    $reply = [
                        'status' => 'error',
                        'msg' => 'No se pudieron guardar los cambios. Intente más tarde.'
                    ];
                }
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'Contraseña incorrecta.'
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'Debe ingresar la contraseña para confirmar su identidad'
            ];
        }

        $this->response->response($reply, 200);
    }

    public function getTherapist() {
        $admins = $this->model->getUsersAdmin(1);
        if ($admins) {
            $this->response->response($admins, 200);
        } else {
            $this->response->response(null, 404);
        }
    }

    public function getAll() {
        if ($this->auth->checkAdmin()) {
            $users = $this->model->getAll();
            if($users) {
                $this->response->response($users, 200);
            } else {
                $this->response->response(null, 404);
            }

        } else {
            $this->response->response(null, 404);
        }
    }

    public function getById($params = []) {
        $userData = $this->auth->getUserId();
        $id = $params[':ID'];
        if($userData == $id) {
            $user = $this->model->getUserById($id);
            if($user) {
                $this->response->response($user, 200);
            } else {
                $this->response->response(null, 404);
            }
        }
    }

    public function delete($params = []) {
        if($this->auth->checkAdmin()) {
            $deleted = $this->model->delete($params[':ID']);
            if($deleted) {
                $reply = [
                    'status' => 'ok',
                    'msg' => 'Usuario eliminado',
                ];
            } else {
                $reply = [
                    'status' => 'error',
                    'msg' => 'No se pudo eliminar el usuario. Por favor, intente más tarde',
                ];
            }
        } else {
            $reply = [
                'status' => 'error',
                'msg' => 'No es posible eliminar usuarios.',
            ];
        }
        $this->response->response($reply, 200);
    }
}

?>