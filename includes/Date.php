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
        $timestamp = time()+date("Z");
        $gmt_date = gmdate("Y/m/d H:i:s",$timestamp);
        return $gmt_date;
    }

    public static function computeDate($date) {
        $offset = (int)date('Z');
        return date('Y-m-d H:i:s', strtotime($date) + $offset);
    }
}