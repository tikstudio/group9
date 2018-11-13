<?php

namespace model;

use includes\DbManager;

class Model extends DbManager {


    protected function passHash($pass){
        return md5(md5($pass) . '_' . PASS_HASH);
    }
}