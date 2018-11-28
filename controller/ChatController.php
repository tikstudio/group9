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
            $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
            $friend_id = isset($_POST['friend_id']) ? (int)$_POST['friend_id'] : null;
            $all_users = $this->model->getAllUsers();
            $image = '';
            if ($all_users) {
                foreach ($all_users as $user) {
                    if ($this->userId == $user['id']) {
                        $image = $user['image'];
                    }
                }
            }
            $file_name = '';
            if (isset($_FILES["file"])) {
                if ($_FILES["file"]["error"] === 0) {
                    $file_types = [
                        "image/png" => '.png',
                        "image/jpeg" => '.jpg',
                        "application/pdf" => '.pdf',
                        "video/webm" => '.webm',
                        "video/mp4" => '.mp4',
                        "video/ogv" => '.ogv',
                    ];
                    $file_type = $_FILES["file"]['type'];

                    if (isset($file_types[$file_type])) {
                        $file_name = uniqid() . $file_types[$file_type];
                        move_uploaded_file(
                            $_FILES["file"]["tmp_name"],
                            "assets/images/uploads/" . $file_name);
                    }
                }
            }

            $m_id = $this->model->saveMessage($this->userId, $friend_id, $message, $file_name);
            if ($m_id) {
                $this->renderAjax('sender-message', [
                    'm' => [
                        'message' => $message,
                        'date' => date('Y-m-d H:i:s'),
                        'attachment' => $file_name,
                        'seen' => '0',
                        'id' => $m_id,
                    ],
                    'user' => [
                        'image' => $image,
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
        $last_message_id = isset($_GET['last_message_id']) ? (int)$_GET['last_message_id'] : 0;

        $messages = $this->model->getMessages($this->userId, $friend_id, $last_message_id);

        $user_model = new \model\User();
        $user = $user_model->getUserById($this->userId);
        $date = date("Y-m-d H:i:s");
        $this->model->lastVisit($this->userId, $date);

        $friend = $user_model->getUserById($friend_id);

        $all_users = $this->model->getAllUsers();


        $user_list = [];
        foreach ($all_users as $u) {
            $user_list[$u['id']] = strtotime($u['last_visit']) + 60 > time();
        }

        ob_start();
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
        $html = ob_get_clean();

        $res = [
            'new_message_html' => $html,
            'user_list' => $user_list,
        ];

        exit(json_encode($res));


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


?>




