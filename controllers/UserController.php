<?php

include_once('models/UserModel.php');

class UserController {

    private $model;

    public function __construct(){
        $this->model = new UserModel;
    }

    public function login($user) {
        session_start();
        $_SESSION['ID_USER'] = $user->id;
        $_SESSION['USERNAME'] = $user->username;
        $_SESSION['EMAIL'] = $user->email;
        $_SESSION['ADMIN'] = $user->admin;
    }
    
    public function logout() {
        session_start();
        session_destroy();
    }

    public function verify($params = []){
        $user = json_decode(file_get_contents("php://input"));
        if(!empty($user->email) && !empty($user->password)){
            $email = $user->email;
            $pass = $user->password;
            $userDb = $this->model->getUserByEmail($email);

        }
        $hash = $userDb->password;
        $response = password_verify($pass, $hash);
        
        if($response == true){
            login($userDb);
        }
        return $response;
    }

    public function add(){
        $user = json_decode(file_get_contents("php://input"));
        if(!empty($user->username) && !empty($user->email) && !empty($user->phone) && !empty($user->password) && !empty($user->repassword)){
            if(($user->password) != ($user->repassword)){
                return "Las contraseñas no coinciden";
            }
            else{
                $user = $user->username; 
                $email = $user->email;
                $phone = $user->phone;
                $pass = $user->password;    
                $hash = password_hash($pass, PASSWORD_DEFAULT);
            }
        }
        $this->model->save($user,$email,$phone,$hash);
        
        $userDb = $this->model->getUserByEmail($email);
        login($userDb);

        return true;
    }  

    public function delete($params = []){
        $this->model->deleteUser($params[':ID']);
        getAll();
    }

    public function edit($params = []) {
        $user = json_decode(file_get_contents("php://input"));
        if (!empty($user->password)) {
            $hash = $user->password;
            $userDb = this->model->getUserById($params[':ID']);
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

    public function getAll(){
        $users = $this->model->getUsers();
        return $users;
    }
}

?>