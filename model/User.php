<?php

namespace model;


class User extends Model {

    public function getUserByEmail($email) {
        return $this->getRow("SELECT * FROM users WHERE email = :email", [
            'email' => $email,
        ]);
    }

    public function getUserById($id) {
        $data = $this->getRow("SELECT * FROM users WHERE id = :id", [
            'id' => $id,
        ]);
        unset($data['password']);
        return $data;
    }

    public function editUser($newName, $newPass, $email) {
        $newPass = $this->passHash($newPass);
        return $this->query("UPDATE `users` SET `user_name` = :name, `password` = :newPass WHERE `email` = :email", [
            'name' => $newName,
            'newPass' => $newPass,
            'email' => $email

        ]);
    }

    public function deleteUser($id) {
        $this->query("UPDATE `users` SET `deleted` = '1' WHERE id = :id", [
            'id' => [$id, 'int'],
        ]);
    }


}