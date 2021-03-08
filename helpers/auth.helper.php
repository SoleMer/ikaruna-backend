<?php
/*
session_save_path("tmp/files");
ini_set('session.gc_probability', 1);
if (session_status() != PHP_SESSION_ACTIVE) {
    session_name('PSPSESSID');
    session_start();
}

class Auth {
    
    private static $user_id;
    private static $is_admin;
    private static $username;
    private static $email;

    static private function start(){
        if (session_status() != 'PHP_SESSION_ACTIVE') {
            session_start();
        }
    }
    
    public static function login($id,$username,$email,$admin, $token){
        //self::start();
        //session_start();
        $_SESSION['ID_USER'] = $id;
        $_SESSION['USERNAME'] = $username;
        $_SESSION['EMAIL'] = $email;
        $_SESSION['ADMIN'] = $admin;
        $_SESSION['TOKEN'] = $token;    
        /*self::$user_id = $id;
        self::$username = $username;
        self::$email = $email;
        self::$is_admin = $admin;
        $_SESSION['ADMIN'] = $admin;
    }

    public static function checkLoggedIn(){
        //self::start();
        //session_start();
        if(!empty($_SESSION['USERNAME'])){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getUserData(){
        //self::start();
        //session_start();
        if (!isset($_SESSION['USERNAME']))
            return null;
        else {
            /*$userData['id_user'] = $_SESSION['ID_USER'];
            $userData['userName'] = $_SESSION['USERNAME'];
            $userData['admin'] = $_SESSION['ADMIN'];
            $userData['id_user'] = self::$user_id;
            $userData['userName'] = self::$username;
            $userData['admin'] = self::$is_admin;
            return  $userData;
        }
    }

    public static function checkAdmin(){
        //self::start();
        session_start();
        /*if(!empty(self::$is_admin))
            return self::$is_admin;
        else
        return null;
        return $_SESSION['ADMIN'];
    }

    public static function logout()
    {
        //self::start();
        session_start();
        unset($_SESSION['ID_USER']);
        unset($_SESSION['USERNAME']);
        unset($_SESSION['ADMIN']);
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
    
    
}*/
?> 

<?php
include_once('models/Model.php');

class AuthHelper extends Model{

    private static function getIP(){
        if($_SERVER['HTTP_CLIENT_IP'])
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if($_SERVER['HTTP_X_FORWARDED'])
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if($_SERVER['HTTP_FORWARDED_FOR'])
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if($_SERVER['HTTP_FORWARDED'])
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if($_SERVER['REMOTE_ADDR'])
            $ip = $_SERVER['REMOTE_ADDR'];  

        return $ip;
    }

    private static function getHost() {
        if($_SERVER['REMOTE_HOST'])
            $host = $_SERVER['REMOTE_HOST'];  

        return $host;
    }

    private static function getPort() {
        if($_SERVER['REMOTE_PORT'])
            $port = $_SERVER['REMOTE_PORT'];  

        return $port;
    }

    public function login($user) {
        $ip = self::getIP();
        //$host = self::getHost();
        $port = self::getPort();
        $user_id = $user->id;
        $is_admin = $user->admin;

        $query = $this->db->prepare('INSERT INTO session (ip, port, user, admin) VALUES (?, ?, ?, ?)');
        return $query->execute([$ip, $port, $user_id, $is_admin]);
    }

    public function checkLoggedIn() {
        $ip = self::getIP();

        $query = $this->db->prepare('SELECT * FROM `session` WHERE ip = ?');
        $query->execute(array(($ip)));
        return $query->fetch(PDO::FETCH_OBJ);

    }

    public function checkAdmin() {
        $ip = self::getIP();

        $query = $this->db->prepare('SELECT * FROM `session` WHERE ip = ?');
        $query->execute(array(($ip)));
        $session = $query->fetch(PDO::FETCH_OBJ);

        if($session) {
            return $session->admin;
        }
        return null;
    }

    public function getUserId() {
        $ip = self::getIP();

        $query = $this->db->prepare('SELECT * FROM `session` WHERE ip = ?');
        $query->execute(array(($ip)));
        $session = $query->fetch(PDO::FETCH_OBJ);

        if($session) {
            return $session->user;
        }
        return null;
    }

    public function getSession($ip) {
        $query = $this->db->prepare('SELECT * FROM `session` WHERE ip = ?');
        $query->execute(array(($ip)));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function logout($idUser){
        $ip = self::getIP();
        $session = $this->getSession($ip);
        $id = $session->id;

        if($idUser = $session->user) {
            $query = $this->db->prepare('DELETE FROM `session` WHERE `id`= ?');
            return $query->execute([$id]);
        }
        return null;
    }
}

?>