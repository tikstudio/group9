<?php

namespace controller;


abstract class Controller {
    protected $model;
    protected $name;
    protected $modelName;
    protected $title;
    protected $userId;

    public function __construct() {
        $model_name = preg_replace('~controller\\\(.*)Controller~is', '$1', get_called_class());
        $this->modelName = "model\\$model_name";
        $this->name = strtolower($model_name);

        $this->model = new $this->modelName();

        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        $this->title = '';
    }

    protected function render($view = 'index', $params = []) {
        extract($params);
        unset($params);
        include './view/header.php';
        include './view/' . $this->name . '/' . $view . '.php';
        include './view/footer.php';
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function redirect($to) {
        header('Location: ' . SITE_URL . '/' . $to);
        exit();
    }

    public static function error404() {
        include './view/404.php';
    }

    abstract function actionIndex();
}