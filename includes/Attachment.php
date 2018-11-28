<?php
/**
 * Created by PhpStorm.
 * User: tik
 * Date: 27/11/18
 * Time: 19:00
 */

namespace includes;


class Attachment {

    public function __construct($attachment) {
        $data = self::getMimType($attachment);
        $url = SITE_URL . '/attachment?file=' . $attachment;
        if ($data['type']) {
            if (in_array($data['type'], ['image/jpeg', 'image/png'])) {
                ?>
                <div class="uploads">
                    <img src="<?= $url ?>" alt="">
                </div>
                <?php
            } else if ($data['type'] == 'application/pdf') {
                ?>
                <a href="<?= $url ?>" target="_blank"><?= $attachment ?></a>
                <?php
            } else if (in_array($data['type'], ['video/webm', 'video/mp4', 'video/ogv'])) {
                ?>
                <video width="320" height="240" controls>
                    <source src="<?= $url ?>" type="<?= $data['type'] ?>">
                    Your browser does not support the video tag.
                </video>
                <?php
            }
        }

    }

    public static function getMimType($attachment) {
        $file_types = [
            "image/png" => '.png',
            "image/jpeg" => '.jpg',
            "application/pdf" => '.pdf',
            "video/webm" => '.webm',
            "video/mp4" => '.mp4',
            "video/ogv" => '.ogv',
        ];

        if (preg_match('/\.\w+$/', $attachment, $m)) {
            $file_type = array_search($m[0], $file_types);
            return [
                'type' => $file_type,
                'ext' => $m[0],
            ];
        }
    }
}