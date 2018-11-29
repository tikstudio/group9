<?php

namespace controller;


use includes\Attachment;
use model\Chat;

class AttachmentController extends Controller {

    function actionIndex() {
        $chat_model = new Chat();
        $file = isset($_GET['file']) ? $_GET['file'] : null;
        $file_dir = 'assets/images/uploads/';
        if (!$chat_model->userCanSeeAttachment($this->userId, $file)) {
            $this->redirect('');
        }
        if ($file && file_exists($file_dir . $file)) {
            $type = Attachment::getMimType($file);
            if (isset($type['type'])) {
                header('Content-type: ' . $type['type']);
                if (in_array($type['type'], ['video/webm', 'video/mp4', 'video/ogv'])) {
                    header('Accept-Ranges: bytes');
                    header("Content-Disposition: inline;");
                    header("Content-Transfer-Encoding: binary\n");
                    header('Connection: close');
                }
                echo file_get_contents($file_dir . $file);
            }
        }
    }
}