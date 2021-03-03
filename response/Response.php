<?php

class Response {

    public function __construct() {
        
    }
     // Devuelve un arreglo en formato JSON y maneja el codigo respuesta
     
     public function response($data, $status) {
        
        /*header("Content-Type: application/json; charset=UTF-8");
        header("Content-Type: application/javascript");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        header("Cookies': _test=31be990d9a58de15e0bc20f93d197d02; expires=Thu, 31-Dec- 2037 20:55:55 GTM; path=/");*/
        echo json_encode($data);
    }

    
     // Asocia un codigo de respuesta a un mensaje HTTP
     
    private function _requestStatus($code){
        $status = array(
            200 => "OK",
            404 => "Not found",
            500 => "Internal Server Error"
        );
        return (isset($status[$code]))? $status[$code] : $status[500];
    }
}
?>