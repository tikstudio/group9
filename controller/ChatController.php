<?php

namespace controller;

use includes\Date;
use model\User;

class ChatController extends Controller {

    public function actionIndex() {
        if (!$this->userId) {
            $this->redirect('login');
        }
        $friend_id = isset($_GET['friend']) ? (int)$_GET['friend'] : null;

        $user_model = new User();

        $user = $user_model->getUserById($this->userId);

        $all_users = $this->model->getAllUsers();

        $messages = $this->model->getMessages($this->userId, $friend_id);

        $this->render('index', [
            'user' => $user,
            'all_users' => $all_users,
            'messages' => $messages,
            'friend_id' => $friend_id,
        ]);
    }

    public function actionSendMessage() {
        if ($this->isPost()) {
            $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
            $friend_id = isset($_POST['friend_id']) ? (int)$_POST['friend_id'] : null;
            $gmt_date = Date::getGmDate();
            $m_id = $this->model->saveMessage($this->userId, $friend_id, $message, $gmt_date);
            if ($m_id) {

            } else {

            }

        } else {
            return self::error404();
        }
    }
}