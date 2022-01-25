<?php

class  Mysql {
    public function __construct() {
        $this->config = new Config;
        $this->core = new mysqli($this->config->mysql['host'].":".$this->config->mysql['port'], $this->config->mysql['user'], $this->config->mysql['pass'], $this->config->mysql['db']);
        if (mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s\n", mysqli_connect_error());
            exit();
        }
    }
}

?>