<?php

class MyCmsAdmin {
    var $mycms;
    function __construct($mycms) {
        $this->mycms = $mycms;
    }
    function header() {
        include_once "{$this->mycms->appDir}/admin/includes/header.php";
    }
    function footer() {
        include_once "{$this->mycms->appDir}/admin/includes/footer.php";
    }
}

class MyCmsApp {
    var $settings = [
        "appName" => "MyCMS",
        "appDescription" => "A simple CMS",
    ];

    var $db = [
        "hostname" => "localhost",
        "username" => "zemian",
        "password" => "test123",
        "dbname" => "mycmsdb",
    ];

    var $conn;
    var $admin;
    var $appDir;

    function __construct($autoConnDB = true) {
        $this->init($autoConnDB);
    }

    function __destruct() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }

    function init($autoConnDB) {
        if ($autoConnDB) {
            $this->conn = $this->create_conn();
        }
        $this->admin = new MyCmsAdmin($this);
        $this->appDir = realpath(dirname(__FILE__) . '/..');
    }

    function create_conn() {
        $config = $this->db;
        $ret = new mysqli($config["hostname"],
            $config["username"],
            $config["password"],
            $config["dbname"]);
        if ($ret->connect_error) {
            throw new Excpetion("Connection failed: " . $ret->connect_error);
        }
        return $ret;
    }

    function header() {
        include_once "{$this->appDir}/includes/header.php";
    }
    function footer() {
        include_once "{$this->appDir}/includes/footer.php";
    }
}

// Let's conveniently create a global instance of CmsApp
$mycms = new MyCmsApp(true);
