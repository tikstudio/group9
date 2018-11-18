<?php
/**
 * Created by PhpStorm.
 * User: tik
 * Date: 11/15/18
 * Time: 8:42 PM
 */

namespace includes;


class Date {


    public static function getGmDate($time = 0) {
        $time = $time ? $time : time();
        return gmdate('Y-m-d H:i:s', $time);
    }

    public static function computeDate($date) {
        $offset = (int)date('Z');
        return date('Y-m-d H:i:s', strtotime($date) + $offset);
    }
}