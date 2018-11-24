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



        $friend = [];
        foreach ($all_users as $u) {
            if ($u['id'] == $friend_id) {
                $friend = $u;
                break;
            }
        }

        $this->render('index', [
            'user' => $user,
            'all_users' => $all_users,
            'messages' => $messages,
            'friend_id' => $friend_id,
            'friend' => $friend,

        ]);
    }

    public function actionSendMessage() {
        if ($this->isPost()) {
            var_dump($_FILES);exit;//todo
            $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
            $friend_id = isset($_POST['friend_id']) ? (int)$_POST['friend_id'] : null;
            $all_users = $this->model->getAllUsers();
            if ($all_users) {
                foreach ($all_users as $user) {
                    if ($this->userId) {
                        $image = $user['image'];
                    }
                }
            }
            $uploads = isset($_POST['uploads']) ? $_POST['uploads'] : '';

            if (isset($_FILES["uploads"])) {
                if ($_FILES["uploads"]["error"] === 0) {
                    $file_types = [
                        "image/png" => '.png',
                        "image/jpeg" => '.jpg',
                        "application/pdf" => '.pdf',
//                        "video/webm" => '.webm',
//                        "video/mp4" => '.mp4',
//                        "video/ogv" => '.ogv',
                    ];
                    $file_type = $_FILES["uploads"]['type'];
                    if (isset($file_types[$file_type])) {
                        move_uploaded_file($_FILES["file"]["tmp_name"], "assets/images/uploads/" . $_FILES["uploads"]["name"]);
                        $uploads = $_FILES["uploads"]["name"];
                    }
                }
            }

            $gmt_date = Date::computeDate(['date']);
            $m_id = $this->model->saveMessage($this->userId, $friend_id, $message, $gmt_date, $image,$uploads);
            if ($m_id) {
                var_dump($m_id);
                $this->renderAjax('sender-message', [
                    'm' => [
                        'message' => $message,
                        'date' => $gmt_date,
                        'image' => $image,
                        'uploads'=> $uploads,
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

    public function actionSeen() {
        $friend_id = isset($_GET['friend_id']) ? (int)$_GET['friend_id'] : null;
        if ($friend_id) {
            $this->model->seen($this->userId, $friend_id);
        }
    }

    public function actionNewMessages() {
        $friend_id = isset($_GET['friend_id']) ? (int)$_GET['friend_id'] : null;


        $messages = $this->model->getMessages($this->userId, $friend_id);

        $user_model = new \model\User();
        $user = $user_model->getUserById($this->userId);
        $last = ($user['id']);
        $date = strtotime(date("Y-m-d H:i:s"));
        $active_user = $this->model->lastVisit($last, $date);

        $friend = $user_model->getUserById($friend_id);

        foreach ($messages as $m) {
            if ($this->userId === $m['from']) {
                $this->renderAjax('sender-message', [
                    'm' => $m,
                    'user' => $user,
                ]);
            } else {
                $this->renderAjax('friend-message', [
                    'm' => $m,
                    'friend' => $friend,
                ]);
            }
        }


    }

    public function actionSearch() {
        if (!$this->userId) {
            return;
        }
        $search_user = isset($_POST['search']) ? $_POST['search'] : '';

        $search_result = $this->model->search($search_user);

        $this->renderAjax('search-friends', [
            'search_result' => $search_result,
        ]);
    }


}