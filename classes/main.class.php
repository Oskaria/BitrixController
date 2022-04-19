<?php

class Main {
    
    private $config;

    public $last_error = "";

    public function __construct() {
        $this->config = new Config;
        $this->mysql = new Mysql;
        $this->mysql = $this->mysql->core;
    }

    public function getConfig() {
        return $this->config;
    }

    public function isAuth() {
        if (isset($_SESSION['user_id'])) {
            $user = $this->mysql->query("SELECT * FROM `users` WHERE id=".$_SESSION['user_id']);
            if ($user) {
                if ($user->num_rows > 0) {
                    return true;
                } else return false;
            } else return false;
        } else return false;
    }

    public function getCurrentUser() {
        if ($this->isAuth()) {
            if (isset($_SESSION['user_id'])) {
                $user = $this->mysql->query("SELECT * FROM `users` WHERE id=".$_SESSION['user_id']);
                if ($user) {
                    if ($user->num_rows > 0) {
                        return $user->fetch_assoc();
                    } else return false;
                } else return false;
            } else return false;
        } else return false;
    }

    public function getUserById($user_id) {
        $user = $this->mysql->query("SELECT * FROM `users` WHERE id=".$user_id);
        if ($user) {
            if ($user->num_rows > 0) {
                return $user->fetch_assoc();
            } else return false;
        } else return false;
    }

    public function authorize($email, $password) {
        if ($password != addslashes($password)) {
            return false;
        } else {
            if (!($stmt = $this->mysql->prepare("SELECT * FROM `users` WHERE `email`=?"))) {
                return false;
            } else {
                if (!$stmt->bind_param("s", $email)) {
                    return false;
                } else {
                    if (!$stmt->execute()) {
                        return false;
                    } else {
                        $res = $stmt->get_result();
                        $row = $res->fetch_assoc();
                        if ($res->num_rows < 1) {
                            return false;
                        } else {
                            if (md5($row['salt'].$password.$row['salt']) == $row['password']) {
                                $_SESSION['user_id'] = $row['id'];
                                $stmt->close();
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            }
        }
    }

    public function sendNewPass($email) {
        if (!($stmt = $this->mysql->prepare("SELECT * FROM `users` WHERE `email`=?"))) {
            return false;
        } else {
            if (!$stmt->bind_param("s", $email)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                    if ($res->num_rows < 1) {
                        return false;
                    } else {
                        $stmt->close();
                        $newpass = substr(md5(time()), 0, 10);
                        $newdbpass = md5($row['salt'].$newpass.$row['salt']);
                        $stmt = $this->mysql->prepare("UPDATE `users` SET `password`=? WHERE `id`=?");
                        $stmt->bind_param("si", $newdbpass, $row['id']);
                        $stmt->execute();
                        if ($stmt->affected_rows > 0) {
                            require_once __DIR__."/../templates/langs/ru.php";
                            $mailSMTP = new SendMailSmtpClass($this->config->smtp_mail['login'], $this->config->smtp_mail['password'], $this->config->smtp_mail['smtp_server'], $this->config->smtp_mail['login']);
                            $headers= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-type: text/html; charset=utf-8\r\n";
                            $headers .= "From: <".$this->config->smtp_mail['login'].">\r\n";
                            $result = $mailSMTP->send($email, $this->config->project_name.": Восстановление пароля", sprintf($lang['ru']['mail_remind'], $newpass, $this->config->http_host, $this->config->http_host), $headers);
                            $stmt->close();
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }

    public function findUserById($user_id) {
        if (!($stmt = $this->mysql->prepare("SELECT * FROM `users` WHERE `id`=?"))) {
            return false;
        } else {
            if (!$stmt->bind_param("i", $user_id)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                    $stmt->close();
                    return $row;
                }
            }
        }
    }

    public function findUserByEmail($email) {
        if (!($stmt = $this->mysql->prepare("SELECT * FROM `users` WHERE `email`=?"))) {
            return false;
        } else {
            if (!$stmt->bind_param("s", $email)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                    $stmt->close();
                    return $row;
                }
            }
        }
    }

    public function getSitesList($page = 1, $count = 10, $sort = "ASC") {
        if (!($stmt = $this->mysql->prepare("SELECT * FROM `sites` ORDER BY `created` ".($sort == "ASC" ? "ASC":"DESC")." LIMIT ?,?"))) {
            return array();
        } else {
            $i = $count*$page-$count;
            $k = $count*$page;
            if (!$stmt->bind_param("ii", $i, $k)) {
                return array();
            } else {
                if (!$stmt->execute()) {
                    return array();
                } else {
                    $res = $stmt->get_result();
                    $row = $res->fetch_all(MYSQLI_ASSOC);
                    if ($res->num_rows < 1) {
                        return array();
                    } else {
                        $stmt->close();
                        foreach ($row as $k=>$site) {
                            $additionals_ = $this->mysql->query("SELECT `status`,`certificate`,`last_code`,`updates_to` FROM `sites_data` WHERE `guid`='".$site['guid']."'");
                            if ($additionals_->num_rows > 0) {
                                $additionals = $additionals_->fetch_assoc();
                                $row[$k]['workstatus'] = $additionals['status'];
                                $row[$k]['certificate'] = $additionals['certificate'];
                                $row[$k]['last_code'] = $additionals['last_code'];
                                $row[$k]['updates_to'] = $additionals['updates_to'];
                                if ($additionals['last_code'] != "200" && $additionals['last_code'] != "301") {
                                    $row[$k]['status'] = 2;
                                }
                                if ($additionals['certificate'] < time()) {
                                    $row[$k]['status'] = 2;
                                }
                            }
                        }
                        return $row;
                    }
                }
            }
        }
    }

    public function addNewSite($protocol, $url, $name, $isBitrix, $admin_login = "", $admin_password = "") {
        if (!$this->isAuth()) {
            $this->last_error = "Вы не авторизованы!";
            return false;
        }
        if (strlen($url) < 4 || filter_var($url, FILTER_VALIDATE_DOMAIN) != $url) {
            $this->last_error = "URL не указан или указан некорректно.";
            return false;
        }
        if ($isBitrix && ($admin_login == "" || $admin_password == "")) {
            $this->last_error = "Не указан логин или пароль пользователя администратора. Эти поля обязательны для заполнения, для сайтов на Битриксе.";
            return false;
        }
        if ($protocol != "http" || $protocol != "https") {
            $protocol = "https";
        }
        if (strlen($name) < 1) {
            $name = $url;
        }
        $new_guid = $this->guid();
        if ($isBitrix) {
            $client_id = md5(time().md5($url));
            $client_secret = md5(rand(0,100).time().md5($url).rand(0,100));
            $auth_data = serialize(array($admin_login, $admin_password));
        } else {
            $client_id = "";
            $client_secret = "";
            $auth_data = "";
        }
        if (!($stmt = $this->mysql->prepare("INSERT INTO `sites` (`guid`, `name`, `protocol`, `url`, `status`, `is_bitrix`, `client_id`, `client_secret`, `auth_data`, `owner`, `created`) VALUES (?, ?, ?, ?, 1, ?, ?, ?, ?, ?, ".time().")"))) {
            return false;
        } else {
            if (!$stmt->bind_param("ssssisssi", $new_guid, $name, $protocol, $url, $isBitrix, $client_id, $client_secret, $auth_data, $this->getCurrentUser()['id'])) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    if ($stmt->affected_rows > 0) {
                        return $new_guid;
                    } else {
                        return false;
                    }
                }
            }
        }
    }

    public function getSite($guid) {
        if (!($stmt = $this->mysql->prepare("SELECT * FROM `sites` WHERE `guid`=?"))) {
            return false;
        } else {
            if (!$stmt->bind_param("s", $guid)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                    $stmt->close();
                    return $row;
                }
            }
        }
    }

    public function clearSiteAuth($guid) {
        if (!($stmt = $this->mysql->prepare("UPDATE `sites` SET `auth_data` ='' WHERE `guid`=?"))) {
            return false;
        } else {
            if (!$stmt->bind_param("s", $guid)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    $stmt->close();
                    return true;
                }
            }
        }
    }

    public function getSiteData($guid) {
        if (!($stmt = $this->mysql->prepare("SELECT * FROM `sites_data` WHERE `guid`=?"))) {
            return false;
        } else {
            if (!$stmt->bind_param("s", $guid)) {
                return false;
            } else {
                if (!$stmt->execute()) {
                    return false;
                } else {
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                    $stmt->close();
                    return $row;
                }
            }
        }
    }

    public function setSiteData($guid, $status, $certificate, $regname, $updates_from, $updates_to, $last_updates, $bitrix_licencekey, $last_code) {
        if (!($stmt = $this->mysql->prepare("INSERT INTO `sites_data` (`guid`, `status`, `certificate`, `regname`, `updates_from`, `updates_to`, `last_updates`, `bitrix_licencekey`, `last_code`, `updated`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ".time().")"))) {
            return false;
        } else {
            if (!$stmt->bind_param("siisiiiss", $guid, $status, $certificate, $regname, $updates_from, $updates_to, $last_updates, $bitrix_licencekey, $last_code)) {
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

    public function updateSiteData($guid, $status, $certificate, $regname, $updates_from, $updates_to, $last_updates, $bitrix_licencekey, $last_code) {
        if (!($stmt = $this->mysql->prepare("UPDATE `sites_data` SET `status`=?, `certificate`=?, `regname`=?, `updates_from`=?, `updates_to`=?, `last_updates`=?, `bitrix_licencekey`=?, `last_code`=?, `updated`=".time()." WHERE `guid`=?"))) {
            echo $this->mysql->error;
            return false;
        } else {
            if (!$stmt->bind_param("iisiiisss", $status, $certificate, $regname, $updates_from, $updates_to, $last_updates, $bitrix_licencekey, $last_code, $guid)) {
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

    public function translit($value, $file = false) {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya'
        );
    
        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        if ($file == true) {
            $value = mb_ereg_replace('[^-0-9a-z.]', '-', $value);
        } else {
            $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        }
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');	
    
        return $value;
    }

    private function guid() {
        if (function_exists('com_create_guid') === true) {
            return strtolower(trim(com_create_guid(), '{}'));
        }

        return strtolower(sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)));
    }


    
}

?>