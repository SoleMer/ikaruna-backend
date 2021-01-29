<?php
class AuthHelper {
    static private function start()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }

    static public function login($user){
        self::start();
        $_SESSION['ID_USER'] = $user[0]->id_user;
        $_SESSION['USERNAME'] = $user[0]->userName;
        $_SESSION['ADMIN'] = $user[0]->admin;
    }

    public static function checkLoggedIn(){
        session_status();
        if(!isset($_SESSION['USERNAME'])){
            return false;
        }
        else{
            return true;
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
        $permitAdmin= $_SESSION['ADMIN'];
        return  $permitAdmin;
    }

    public static function logout()
    {
        self::start();
        unset($_SESSION['ID_USER']);
        unset($_SESSION['USERNAME']);
        unset($_SESSION['PRIORITY']);
        session_destroy();
        header('location:' . URLBASE . 'login');
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