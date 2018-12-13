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

    public function OAuthLogin($email) {
        return $this->getVar("SELECT id FROM users WHERE email = :email AND deleted = '0'", [
            'email' => $email,
        ]);
    }

    public function setLoginData($user_id, $token = '', $ip = '') {
        return $this->query("UPDATE users set auth_token = :token, ip = :ip WHERE id = :user_id", [
            'user_id' => $user_id,
            'token' => $token,
            'ip' => $ip,
        ]);
    }

    public function loginByToken($token, $ip) {
        return $this->getVar("SELECT id FROM users WHERE auth_token = :token AND ip = :ip AND deleted = '0'", [
            'token' => $token,
            'ip' => $ip,
        ]);
    }
}