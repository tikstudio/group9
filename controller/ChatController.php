<?php

namespace controller;

use includes\Date;
use model\User;

class ChatController extends Controller
{

    public function actionIndex()
    {
        if (!$this->userId) {
            $this->redirect('login');
        }
        $friend_id = isset($_GET['friend']) ? (int)$_GET['friend'] : null;

        $user_model = new User();

        $user = $user_model->getUserById($this->userId);

        $all_users = $this->model->getAllUsers();

        $messages = $this->model->getMessages($this->userId, $friend_id);

        $last_id = $this->model->getLastId();



        $friend_img = [];
        foreach ($all_users as $u) {
            if ($u['id'] == $friend_id) {
                $friend_img = $u['image'];
                break;
            }
        }

        $this->render('index', [
            'user' => $user,
            'all_users' => $all_users,
            'messages' => $messages,
            'friend_id' => $friend_id,
            'last_id' => $last_id,
            'friend_img' => $friend_img,

        ]);
    }
//send-message
    public function actionSendMessage()
    {
        if ($this->isPost()) {
            $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
            $friend_id = isset($_POST['friend_id']) ? (int)$_POST['friend_id'] : null;



            $gmt_date = Date::computeDate(['date']);
            $m_id = $this->model->saveMessage($this->userId, $friend_id, $message, $gmt_date);
            if ($m_id) {
                $this->renderAjax('sender-message', [
                    'm' => [
                        'message' => $message,
                        'date' => $gmt_date,
                        'image' => [],//todo user image
                        'seen' => '0'
                    ]
                ]);
            } else {
                echo 'error';
            }
            exit;
        } else {
            return self::error404();
        }
    }

    public function actionSeen()
    {
        $friend_id = isset($_GET['friend_id']) ? (int)$_GET['friend_id'] : null;
        if ($friend_id) {
            $this->model->seen($this->userId, $friend_id);
        }
    }

    public function actionNewMessages()
    {
        $friend_id = isset($_GET['friend_id']) ? (int)$_GET['friend_id'] : null;

        $messages = $this->model->getMessages($this->userId, $friend_id);

        foreach ($messages as $m) {
            if ($this->userId === $m['from']) {
                $this->renderAjax('sender-message', [
                    'm' => $m,
                    'user' => '', //todo
                ]);
            } else {
                $this->renderAjax('friend-message', [
                    'm' => $m,
                    'friend_img' => [],//todo
                ]);
            }
        }


    }

    public function actionSearch()
    {
        $search_user = $_POST['search'];

        $search_result = $this->model->search($search_user);
        if ($search_result) {

            $this->renderAjax('search-friends',[
                'search_result' => $search_result,
            ]);
        }
    }


}