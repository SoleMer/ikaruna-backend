<?php
include_once('controllers/Controller.php');
include_once('models/UserModel.php');
include_once('response/Response.php');
include_once('cookies.php');

class UserController extends Controller{

    private $model;
    protected $response;

    public function __construct() {
        $this->model = new UserModel;
        $this->response = new Response();
    }

    public function login($user) {
            session_set_cookie_params(time()+(60*60*24*31), "/", "http://localhost", false, false);
            session_start();
            $token = sha1(uniqid(rand(),true));
            //   AuthHelper::login($user->id, $user->username, $user->email, $user->admin, $token);
            $_SESSION['ID_USER'] = $user->id;
            $_SESSION['USERNAME'] = $user->username;
            $_SESSION['EMAIL'] = $user->email;
            $_SESSION['ADMIN'] = $user->admin;
            $_SESSION['TOKEN'] = $token;
            setcookie("token", $token, time()+(60*60*24*31),"/");
            setcookie("id", $user->id, time()+(60*60*24*31),"/");
            setcookie("admin", $user->admin, time()+(60*60*24*31),"/");
            
            
            $reply = [
                'status' => 'ok',
                'msg' => session_status(),
                'token' => $token,
                'id_user' => $_SESSION['ID_USER'],
                'isAdmin' => $_SESSION['ADMIN']
            ];
        return $reply;
    }
    
    public function logout() {
        session_start();
        session_destroy();
    }

    public function verify(){
        if (session_status() == 'PHP_SESSION_ACTIVE') {
            $reply = [
                'status' => 'error',
                'msg' => 'Ya hay una sesión activa. Cerrar sesión para iniciar una nueva',
                'token' => '0',
                'id_user' => '0',
                'isAdmin' => '0'
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

    public function getTherapist() {
        $admins = $this->model->getUsersAdmin(1);
        if ($admins) {
            $this->response->response($admins, 200);
        } else {
            $this->response->response(null, 404);
        }
    }

    public static function checkAdmin(){
        session_start();
        return $_SESSION['ADMIN'];
        /*
        if(isset($_SESSION['ADMIN']))
            return $_SESSION['ADMIN'];
        else
        return null;
        */
    }

    static private function start()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }
}

?>