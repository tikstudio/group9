<?php

namespace model;


use includes\Date;

class Chat extends Model {


    public function getAllUsers() {
        return $this->getRows("SELECT * FROM users");
    }


    public function getMessages($user_id, $friend_id) {
        return $this->getRows(
            "SELECT * FROM chat WHERE 
                  (`from` = :u_id AND `to` = :f_id) or (`from` = :f_id AND `to` = :u_id)
                  ORDER BY date",
            [
                'u_id' => [$user_id, 'int'],
                'f_id' => [$friend_id, 'int']
            ]);
    }

    public function saveMessage($from, $to, $message, $date) {
        return $this->query(
            "INSERT INTO `chat` (`from`, `to`, `message`, `date`, `seen`) 
                VALUES (:from, :to, :message, :date, '0')",
            [
                'from' => $from,
                'to' => $to,
                'message' => $message,
                'date' => Date::getGmDate($date),
            ]
        );
    }
    public function getLastId(){

    }

    public function seen($user_id, $friend_id) {
        return $this->query(
            "UPDATE `chat` SET `seen` = '1' 
                  WHERE `to` = :user_id and `from` = :friend_id and `seen` = '0'",
            [
                'user_id' => $user_id,
                'friend_id' => $friend_id,
            ]
        );
    }

}