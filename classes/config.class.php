<?php

class Config {

    public $mysql = array(
        "host" => "localhost",
        "port" => 3306,
        "user" => "root",
        "pass" => "123321",
        "db" => "controller"
    );

    public $http_host = "controller.skillhost.ru";
    public $project_name = "Bitrix Controller";
    public $admin_email = "info@controller.skillhost.ru";

    public $smtp_mail = array(
        "login" => "robot@old-times.ru", 
        "password" => "ncfvmvteyhrfacse",
        "smtp_server" => "smtp.yandex.ru"
    );

}

?>