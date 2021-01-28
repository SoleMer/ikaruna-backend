<?php

class NotificationController extends Controller{
    
    private $model;

    public function __construct() {
        $this->model = new NotificationModel;
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