<?php

class BX_Controller {

    function __construct() {
        $this->config = new Config;
        $this->mysql = new Mysql;
        $this->mysql = $this->mysql->core;
    }

    private function cURL($address, $data) {
        $ch = curl_init($address.'/bitrix/admin/main_controller.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $answer = curl_exec($ch);
        curl_close($ch);
        return $answer;
    }

    public function registerBitrix($member_id, $member_secret, $site_url, $admin_login, $admin_password) {
        $parameters = array(
            'member_id'         => $member_id,
            'member_secret_id'  => $member_secret,
            'controller_url'    => "http://".$this->config->http_host,
            'admin_login'       => $admin_login,
            'admin_password'    => $admin_password,
            'join_command'      => 
                'COption::SetOptionString("main", "controller_member", "Y");
                COption::SetOptionString("main", "controller_ticket", "");
                RegisterModuleDependences("main", "OnUserLoginExternal", "main", "CControllerClient", "OnExternalLogin", 1);
                RegisterModuleDependences("main", "OnExternalAuthList", "main", "CControllerClient", "OnExternalAuthList");',
            'disconnect_command' => '
                CControllerClient::RestoreAll();
                COption::SetOptionString("main", "controller_member", "N");
                COption::SetOptionString("main", "controller_member_id", "");
                COption::SetOptionString("main", "controller_url", "");
                UnRegisterModuleDependences("main", "OnUserLoginExternal", "main", "CControllerClient", "OnExternalLogin");
                UnRegisterModuleDependences("main", "OnExternalAuthList", "main", "CControllerClient", "OnExternalAuthList");'
        );
        $data = array(
            'operation'     => 'simple_register',
            'version'       => '',
            'session_id'    => '',
            'member_id'     => $member_id,
            'encoding'      => 'UTF-8',
            'parameters'    => base64_encode(serialize($parameters)),
            'hash'          => md5("simple_register|".serialize($parameters)."|".$member_secret)
        );
        parse_str($this->cURL($site_url, $data), $output);
        return $output;
    }

    public function pingBitrix($member_id, $member_secret, $site_url) {
        $parameters = array(
            'member_id' => $member_id,
            'secret_id' => $member_secret,
        );
        $data = array(
            'operation'     => 'ping',
            'session_id'    => '',
            'parameters'    => base64_encode(serialize($parameters)),
            'member_id'     => $member_id,
            'secret_id'     => $member_secret,
            'encoding'      => 'UTF-8',
            'hash'          => md5("ping|".serialize($parameters)."|".$member_secret)
        );
        parse_str($this->cURL($site_url, $data), $output);
        return $output;
    }

    public function getBitrixUpdateInfo($member_id, $member_secret, $site_url) {
        $reqString = '
            require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client.php");
            $update_info = CUpdateClient::GetUpdatesList($errorMessage, "ru", "");
            $info = array("update" => $update_info["CLIENT"], "error" => $update_info["ERROR"], "key" => CUpdateClient::GetLicenseKey(), "last_update" => COption::GetOptionString("main", "update_system_update", "-"));
            echo json_encode($info);
        ';
        $parameters = array(
            'member_id' => $member_id,
            'secret_id' => $member_secret,
            'command'   => $reqString
        );
        $data = array(
            'operation'    => 'run_immediate',
            'session_id' => '',
            'parameters'    => base64_encode(serialize($parameters)),
            'member_id'     => $member_id,
            'secret_id'     => $member_secret,
            'encoding'      => 'UTF-8',
            'hash'          => md5("run_immediate|".serialize($parameters)."|".$member_secret)
        );
        parse_str($this->cURL($site_url, $data), $output);
        return json_decode(urldecode($output['text']), true);
    }

    public function bitrixPhpRun($member_id, $member_secret, $site_url, $reqString) {
        $parameters = array(
            'member_id' => $member_id,
            'secret_id' => $member_secret,
            'command'   => $reqString
        );
        $data = array(
            'operation'    => 'run_immediate',
            'session_id' => '',
            'parameters'    => base64_encode(serialize($parameters)),
            'member_id'     => $member_id,
            'secret_id'     => $member_secret,
            'encoding'      => 'UTF-8',
            'hash'          => md5("run_immediate|".serialize($parameters)."|".$member_secret)
        );
        parse_str(urldecode($this->cURL($site_url, $data)), $output);
        return $output['text'];
    }

    public function getBitrixPhpRunResult($member_id, $member_secret, $site_url, $code) {
        $parameters = array(
            'member_id' => $member_id,
            'secret_id' => $member_secret,
            'command'   => $code
        );
        $data = array(
            'operation'     => 'run_immediate',
            'session_id'    => '',
            'parameters'    => base64_encode(serialize($parameters)),
            'member_id'     => $member_id,
            'secret_id'     => $member_secret,
            'encoding'      => 'UTF-8',
            'hash'          => md5("run_immediate|".serialize($parameters)."|".$member_secret)
        );
        parse_str($this->cURL($site_url, $data), $output);
        return $output['text'];
    }

    public function bitrixUnregister($member_id, $member_secret, $site_url) {
        $parameters = array();
        $data = array(
            'operation'     => 'unregister',
            'session_id'    => '',
            'parameters'    => base64_encode(serialize($parameters)),
            'member_id'     => $member_id,
            'secret_id'     => $member_secret,
            'encoding'      => 'UTF-8',
            'hash'          => md5("unregister|".serialize($parameters)."|".$member_secret)
        );
        parse_str($this->cURL($site_url, $data), $output);
        return $output['text'];
    }

    public function getCertificateInfo($domain) {
        $url = 'ssl://'.$domain.':443';
        $context = stream_context_create(array('ssl' => array('capture_peer_cert' => true,'verify_peer'       => false,'verify_peer_name'  => false)));
        $fp = stream_socket_client($url, $err_no, $err_str, 30, STREAM_CLIENT_CONNECT, $context);
        $cert = stream_context_get_params($fp);
        if (empty($err_no)) {
            $info = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
            return $info;
        } else {
            return $err_no;
        }
    }

    public function getResponceCode($url) {
        $headers = @get_headers($url);
        if (empty($headers[0])) {
           return false;
        } else {
            return substr($headers[0], 9, 3);
        }
    }

}