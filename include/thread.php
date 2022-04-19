<?php
include __DIR__."/../classes/autoload.php";

$main = new Main;
$controller = new BX_Controller;
$log = new Logs;

error_reporting(E_ALL);

$sites = $main->getSitesList(1, 1000000);

foreach ($sites as $site) {

    $site_data = $main->getSiteData($site['guid']);

    $upstate = @fsockopen ("localhost", ($site['protocol'] == "https" ? 443:80), $errno, $errstr, 10);
    if (!$upstate) {
        if ($site_data['status'] == 1) {
            $log->addLog($site['guid'], "Сервер недоступен", "", "");
            $main->updateSiteData($site['guid'], 0, $site_data['certificate'], $site_data['regname'], $site_data['updates_from'], $site_data['updates_to'], $site_data['last_updates'], $site_data['bitrix_licencekey'], $site_data['last_code']);
        } else {
            $site_data['status'] = 0;
        }
    } else {
        if ($site_data['status'] == 0) {
            $log->addLog($site['guid'], "Сервер вновь доступен", "", "");
            $site_data['status'] = 1;
        }

        $code = $controller->getResponceCode($site['protocol']."://".$site['url']);
        if ($site_data['last_code'] != $code && $code != "200") {
            $log->addLog($site['guid'], "Сайт недоступен или код ответа не корректный", $site_data['last_code'], $code);
            $site_data['last_code'] = $code;
        } elseif ($site_data['last_code'] != $code && $code == "200") {
            $log->addLog($site['guid'], "Сайт вновь доступен", $site_data['last_code'], $code);
            $site_data['last_code'] = $code;
        }

        if ($site['protocol'] == "https") {
            $cert_data = $controller->getCertificateInfo($site['url']);
            if (substr($cert_data['validFrom'], 0, 2) == date("y")) {
                $cert_data['validFrom']  = strtotime("20".$cert_data['validFrom']);
                $cert_data['validTo'] = strtotime("20".$cert_data['validTo']);
            } else {
                $cert_data['validFrom']  = strtotime($cert_data['validFrom']);
                $cert_data['validTo'] = strtotime($cert_data['validTo']);
            }
            $site_data['certificate'] = $cert_data['validTo'];
            if (time() >= $cert_data['validTo']) {
                echo "\r\Сертификат сдох: ".$cert_data['validTo']."\r\n";
            }
        }

        if ($site['is_bitrix'] == 1) {
            if (strlen($site['auth_data']) > 0) {
                $auth_data = unserialize($site['auth_data']);
                $registration = $controller->registerBitrix($site['client_id'], $site['client_secret'], $site['protocol']."://".$site['url']."/bitrix/admin/main_controller.php", $auth_data[0], $auth_data[1]);
                if (substr($registration['status'], 0, 3) != "200") {
                    $log->addLog($site['guid'], "Ошибка регистрации сайта в контроллере: ".$registration['status']." (".$registration['text'].")", "", "");
                } else {
                    $log->addLog($site['guid'], "Сайт успешно зарегистрирован: ".$registration['status'], "", "");
                    $main->clearSiteAuth($site['guid']);
                }
            }

            $update_info = $controller->getBitrixUpdateInfo($site['client_id'], $site['client_secret'], $site['protocol']."://".$site['url']."/bitrix/admin/main_controller.php");
            
            $update_info['update'][0]['@']['DATE_FROM'] = strtotime($update_info['update'][0]['@']['DATE_FROM']." 00:00:00");
            $update_info['update'][0]['@']['DATE_TO'] = strtotime($update_info['update'][0]['@']['DATE_TO']." 00:00:00");

            if (time() > $update_info['update'][0]['@']['DATE_TO']) {
                echo "\r\nОбновления конченые: ".$update_info['update'][0]['@']['DATE_TO']."\r\n";
            }

            $site_data['regname'] = $update_info['update'][0]['@']['NAME'];
            $site_data['updates_from'] = $update_info['update'][0]['@']['DATE_FROM'];
            $site_data['updates_to'] = $update_info['update'][0]['@']['DATE_TO'];

            $site_data['last_updates'] = strtotime($update_info['last_update']);
            $site_data['bitrix_licencekey'] = $update_info['key'];

        }

        if (!$site_data['guid']) {
            $main->setSiteData($site['guid'], $site_data['status'], $site_data['certificate'], $site_data['regname'], $site_data['updates_from'], $site_data['updates_to'], $site_data['last_updates'], $site_data['bitrix_licencekey'], $site_data['last_code']);
        } else {
            $main->updateSiteData($site['guid'], $site_data['status'], $site_data['certificate'], $site_data['regname'], $site_data['updates_from'], $site_data['updates_to'], $site_data['last_updates'], $site_data['bitrix_licencekey'], $site_data['last_code']);
        }

    }

}