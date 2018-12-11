<?php

namespace controller;

use includes\IpUtil;

class LoginController extends Controller {


    public function actionIndex() {
        $this->title = 'Login';
        $errors = [];

        if ($this->isPost()) {
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

            $token = 'token_' . md5(uniqid() . '_token');
            $ip = IpUtil::getRealIpAddr();
            $user_id = $this->model->login($email, $pass);

            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                if (isset($_POST['remember-me']) && $_POST['remember-me']) {
                    $this->model->setLoginData($user_id, $token, $ip);
                    setcookie('auth_token', $token, time() + 60 * 60 * 24 * 30, '/');
                } else {
                    $this->model->setLoginData($user_id, '', $ip);
                    setcookie('auth_token', $token, -1, '/');
                }
                $this->redirect('user');
            } else {
                unset($_SESSION['user_id']);
                setcookie('auth_token', '', -1, '/');
                $errors['message'] = 'Wrong email or password';
            }
        }


        $this->render('index', [
            'errors' => $errors
        ]);
    }


    public function actionLogOut() {
        unset($_SESSION['user_id']);
        setcookie('auth_token', '', -1, '/');
        $this->redirect('login');
    }

}