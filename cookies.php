<?php

class Cookies {

    public function saveCookie($name, $value) {
        setcookie($name, $value, time()+(60*90),"/");
    }
    
    public function checkCookie($name, $value) {
        return $_COOKIE[$name] == $value;
    }
    
    public function getCookie($name) {
        return $_COOKIE[$name];
    }
    
    
    public function deleteCookie($name) {}
    public function updateCookie($name) {}

}


?>