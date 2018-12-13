<?php

namespace controller;

use includes\IpUtil;

class LoginController extends Controller {


    public function actionIndex() {
        $this->title = 'Login';
        $errors = [];

        if (isset($_GET['fb_token'])) {

            $user_details = "https://graph.facebook.com/me?fields=email,name,picture.type(large)&access_token=" . $_GET['fb_token'];
            $response = file_get_contents($user_details);
            $response = json_decode($response, true);
            if ($response['email']) {
                $user_id = $this->model->OAuthLogin($response['email']);
                if ($user_id) {
                    $_SESSION['user_id'] = $user_id;
                    $this->redirect('user');
                } else {
                    $_SESSION['upload_image'] = $response['picture']['data']['url'];
                    $this->redirect('register', [
                        'email' => $response['email'],
                        'name' => $response['name'],
                        'oauth' => '',
                    ]);

                }

            }

        }

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