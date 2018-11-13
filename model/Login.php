<?php

namespace model;


class Login extends Model {

    public function login($email, $pass) {
        $pass = $this->passHash($pass);

        return $this->getVar("SELECT id FROM users WHERE email = :email AND password = :pass AND deleted = '0'", [
            'email' => $email,
            'pass' => $pass,
        ]);
    }
}