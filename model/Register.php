<?php

namespace model;


class Register extends Model {


    public function createUser($email, $name, $pass) {
        $pass = $this->passHash($pass);

        $registrated_date = date('Y-m-d H:i:s');

        return $this->query("INSERT INTO users(email, user_name, password, registrated_date) 
                          VALUES (:email, :user_name, :password, :date)",
            [
                'email' => $email,
                'user_name' => $name,
                'password' => $pass,
                'date' => $registrated_date,
            ]);
    }

    public function getUserByEmail($email) {
        return $this->getRow("SELECT * from users where email = :email",[
            'email' => $email
        ]);
    }

    public function getUserById($id) {
        return $this->getRow("select id,user_name from users where id = :id",[
            'id' => $id

        ]);
    }


}