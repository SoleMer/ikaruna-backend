<?php

class NotificationController extends Controller{
    
    private $model = new NotificationModel;

    public function __construct() {
        $this->__construct($this->model);
    }

    public function add($params = []) {
        $msg = $params[':MSG'];
        $user = $params[':USER'];

        $this->model->save($msg, $user);
    }

    public function getAll() {
        $userData = AuthHelper::getUserData();
        return $this->model->getNotificationsToUser($userData['id_user']);
    }
}

?>