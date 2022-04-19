<?php

class Logs {

    function __construct() {
        $this->mysql = new Mysql;
        $this->mysql = $this->mysql->core;
    }

    public function addLog($guid, $message, $old_state, $new_state) {
        if (!($stmt = $this->mysql->prepare("INSERT INTO `logs` (`site_guid`,`message`,`old_state`,`new_state`,`created`) VALUES (?, ?, ?, ?, ".time().")"))) {
            return false;
        } else {
            if (!$stmt->bind_param("ssss", $guid, $message, $old_state, $new_state)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    if ($stmt->affected_rows > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
    }

}