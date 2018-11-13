<?php

namespace controller;


class UserController extends Controller {

    function actionIndex() {
        if (!$this->userId) {
            $this->redirect('login');
        }

        $this->title = 'User page';
        $errors = [];

        if ($this->isPost()) {
            $email = isset($_POST["email"]) ? $_POST["email"] : null;
            $newName = isset($_POST["new_name"]) ? $_POST["new_name"] : null;
            $newPass = isset($_POST["new_pass"]) ? $_POST["new_pass"] : null;
            $newRePass = isset($_POST['new_re_pass']) ? $_POST['new_re_pass'] : null;


            if (!$email) {
                $errors["email"] = "Email is required";
            } elseif (!preg_match("/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", htmlspecialchars($email))) {
                $errors["email"] = "Invalid email format";
            }

            if (!$newName) {
                $errors["new_name"] = "Name is required";
            } elseif (!preg_match("/^[a-zA-Z]{3,10}/", htmlspecialchars($newName))) {
                $errors["new_name"] = "Only letters and white space allowed";
            }

            if (!$newPass) {
                $errors["new_pass"] = "Password is required";
            } elseif (!preg_match("/^[A-Za-z\d]{6,}$/", $newPass)) {
                $errors["new_pass"] = "Invalid password format";
            }

            if ($newRePass !== $newPass) {
                $errors['new_re_pass'] = "Passwords do not match";
            }


            if (empty($errors)) {
                $this->model->editUser($newName, $newPass, $email);
            }
        }

        $user = $this->model->getUserById($this->userId);

        $this->render('profile', [
            'errors' => $errors,
            'user' => $user,
        ]);

    }

    function actionDelete() {
        if (!$this->userId) {
            $this->redirect('login');
        }
        $this->model->deleteUser($this->userId);
        unset($_SESSION['user_id']);
        $this->redirect('login');
    }

}
