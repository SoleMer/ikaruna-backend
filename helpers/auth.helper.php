<?php
class AuthHelper {
    static private function start()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }

    static public function login($id,$username,$email,$admin, $token){
        AuthHelper::start();
        $_SESSION['ID_USER'] = $id;
        $_SESSION['USERNAME'] = $username;
        $_SESSION['EMAIL'] = $email;
        $_SESSION['ADMIN'] = $admin;
        $_SESSION['TOKEN'] = $token;
    }

    public static function checkLoggedIn(){
        self::start();
        if(!empty($_SESSION['USERNAME'])){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getUserData(){
        self::start();
        if (!isset($_SESSION['USERNAME']))
            return null;
        else {
            $userData['id_user'] = $_SESSION['ID_USER'];
            $userData['userName'] = $_SESSION['USERNAME'];
            $userData['admin'] = $_SESSION['ADMIN'];
            return  $userData;
        }
    }

    public static function checkAdmin(){
        self::start();
        if(!empty($_SESSION['ADMIN']))
            return $_SESSION['ADMIN'];
        else
        return null;
    }

    public static function logout()
    {
        self::start();
        unset($_SESSION['ID_USER']);
        unset($_SESSION['USERNAME']);
        unset($_SESSION['PRIORITY']);
        session_destroy();
    }
    
    public function getLoggedUserName() {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
        if(isset($_SESSION['USERNAME']))
            return $_SESSION['USERNAME'];
        else
            return null;
    }
    
    
}
?> 