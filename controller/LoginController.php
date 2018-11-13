<?php

namespace controller;

class LoginController extends Controller {


    public function actionIndex() {
        $this->title = 'Login';
        $errors = [];

        if ($this->isPost()) {
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;


            $user_id = $this->model->login($email, $pass);

            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                $this->redirect('user');
            } else {
                unset($_SESSION['user_id']);
                $errors['message'] = 'Wrong email or password';
            }
        }


        $this->render('index', [
            'errors' => $errors
        ]);
    }


    public function actionLogOut() {
        echo 'actionLogOut';
    }

}