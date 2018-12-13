<?php

namespace controller;


use includes\IpUtil;
use model\Login;

abstract class Controller  {
    protected $model;
    protected $name;
    protected $modelName;
    protected $title;
    protected $userId;

    public function __construct() {
        $model_name = preg_replace('~controller\\\(.*)Controller~is', '$1', get_called_class());
        if (class_exists("model\\$model_name")) {
            $this->modelName = "model\\$model_name";
            $this->name = strtolower($model_name);

            $this->model = new $this->modelName();
        }


        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if (!$this->userId) {
            $token = isset($_COOKIE['auth_token']) ? $_COOKIE['auth_token'] : null;
            $ip = IpUtil::getRealIpAddr();

            if ($token && $ip) {
                $login_model = new Login();
                $user_id = (int)$login_model->loginByToken($token, $ip);
                $this->userId = $user_id;
                $_SESSION['user_id'] = $user_id;
                setcookie('auth_token', $token, time() + 60 * 60 * 24 * 30, '/');
            }

        }

        $this->title = '';
    }

    protected function render($view = 'index', $params = []) {
        extract($params);
        unset($params);
        include './view/header.php';
        include './view/' . $this->name . '/' . $view . '.php';
        include './view/footer.php';
    }


    protected function renderAjax($view = 'index', $params = []) {
        extract($params);
        unset($params);
        include './view/' . $this->name . '/' . $view . '.php';
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function redirect($to, $params) {
        $q = '';
        if (!empty($params)) {
            $arr = [];
            foreach ($params as $key => $val) {
                $arr[] = $key . '=' . $val;
            }
            $q = '?' . implode('&', $arr);
        }
        header('Location: ' . SITE_URL . '/' . $to . $q);
        exit();
    }

    public static function error404() {
        include './view/404.php';
    }

    abstract function actionIndex();
}