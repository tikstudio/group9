<?php

namespace model;


use includes\Date;

class Chat extends Model {


    public function getAllUsers() {
        return $this->getRows("SELECT * FROM users");
    }


    public function getMessages($user_id, $friend_id, $start_id = 0) {

        return $this->getRows(
            "SELECT * FROM chat WHERE 
                  ((`from` = :u_id AND `to` = :f_id) or (`from` = :f_id AND `to` = :u_id))
                  AND id > :start_id
                  ORDER BY date",
            [
                'start_id' => [$start_id, 'int'],
                'u_id' => [$user_id, 'int'],
                'f_id' => [$friend_id, 'int']
            ]);
    }

    public function saveMessage($from, $to, $message, $attachment) {
        return $this->query(
            "INSERT INTO `chat` (`from`, `to`, `message`, `date`, `seen`, `attachment`) 
                VALUES (:from, :to, :message, :date, '0', :attachment)",
            [
                'from' => $from,
                'to' => $to,
                'message' => $message,
                'attachment' => $attachment,
                'date' => Date::getGmDate(),
            ]
        );
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

<<<<<<< HEAD
    public function searchUser($search_val) {
            return $this->getRows("SELECT * FROM users WHERE user_name LIKE '% :search_val%'",[
                'search_val' => $search_val
            ]);

    }

=======
    public function lastVisit($id, $date) {

        return $this->query("UPDATE `users` SET `last_visit` = :date WHERE id=:user_id", [
            'user_id' => $id,
            'date' => $date
        ]);
    }

    public function search($search_user) {
        return $this->getRows("SELECT * FROM users WHERE user_name LIKE :search_user",
            [
                'search_user' => '%' . $search_user . '%',
            ]);
    }

    public function userCanSeeAttachment($id, $attachment) {
        return (bool)$this->getVar("SELECT id from chat where attachment = :attachment
                          AND (`from` = :id or `to` = :id)", [
            'id' => [$id, 'int'],
            'attachment' => $attachment,
        ]);
    }
>>>>>>> f4a5aebe55cefdd30e697314a7188b1f1bec1fbd
}