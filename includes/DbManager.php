<?php

namespace includes;

use \PDO;

class DbManager {
    protected static $con;
    private $error;

    public function __construct() {
        if (!self::$con) {
            self::$con = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
//            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
    }

    private function _query($sql, $params = []) {
        $stmt = self::$con->prepare($sql);
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $const = 'PDO::PARAM_' . strtoupper($value[1]);
                $stmt->bindParam($key, $params[$key][0], constant($const));
            } else {
                $stmt->bindParam($key, $params[$key]);
            }
        }
        if ($stmt->execute()) {
            return $stmt;
        }
        $this->error = $stmt->errorInfo();
        return false;
    }

    public function query($sql, $params = []) {
        $stmt = $this->_query($sql, $params);
        if (!$stmt) {
            return null;
        }
        return self::$con->lastInsertId();
    }

    public function getRow($sql, $params = []) {
        $stmt = $this->_query($sql, $params);
        if (!$stmt) {
            return null;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRows($sql, $params = []) {
        $stmt = $this->_query($sql, $params);

        if (!$stmt) {
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVar($sql, $params = []) {
        $data = $this->getRow($sql, $params);
        if (!$data) {
            return null;
        }
        return array_shift($data);
    }

    public function getCol($sql, $params = []) {
        $data = $this->getRows($sql, $params);
        if (!$data) {
            return null;
        }
        $res = [];
        foreach ($data as $val) {
            $res[] = array_shift($val);
        }
        return $res;
    }

    public function getError() {
        return $this->error;
    }

    public function getErrorMessage() {
        return $this->getError()[2];
    }

    public function __destruct() {
        self::$con = null;
    }
}