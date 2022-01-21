<?php
/* 
// регистрация клиента в контроллере

$parameters = array(

    "member_id" => "mdn5kzr98i4fy1a21vf500p6kclhekc5",
    "member_secret_id" => "mdg25w2wqsz5hniykkvfs5rlx0uk1efg",
    "controller_url" => "http://controller.skillhost.ru",
    "admin_login" => "",
    "admin_password" => "",
    "join_command" => 
				'COption::SetOptionString("main", "controller_member", "Y");
				COption::SetOptionString("main", "controller_ticket", "");
				RegisterModuleDependences("main", "OnUserLoginExternal", "main", "CControllerClient", "OnExternalLogin", 1);
				RegisterModuleDependences("main", "OnExternalAuthList", "main", "CControllerClient", "OnExternalAuthList");',
			
    "disconnect_command" => '
				CControllerClient::RestoreAll();
				COption::SetOptionString("main", "controller_member", "N");
				COption::SetOptionString("main", "controller_member_id", "");
				COption::SetOptionString("main", "controller_url", "");
				UnRegisterModuleDependences("main", "OnUserLoginExternal", "main", "CControllerClient", "OnExternalLogin");
				UnRegisterModuleDependences("main", "OnExternalAuthList", "main", "CControllerClient", "OnExternalAuthList");'
			
);

$array = array(
	'operation'    => 'simple_register',
	'version' => '',
	'session_id' => 'bi89qimche00d1vpkx22abk70zm121ho',
	'member_id' => 'mdn5kzr98i4fy1a21vf500p6kclhekc5',
	'encoding' => 'UTF-8',
	'parameters' => base64_encode(serialize($parameters)),
	'hash' => md5(base64_encode(serialize($parameters)))
);		

 

$ch = curl_init('/bitrix/admin/main_controller.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);	

echo $html;
*/




/* для отправки последующих команд необходимо собрать хеш:

$hash = $this->operation."|".$this->strParameters."|".$this->secret_id;

base64_decode($_REQUEST['parameters']);

*/
/* 
// пример пинга

$parameters = array(
    "member_id" => "mdn5kzr98i4fy1a21vf500p6kclhekc5",
    "secret_id" => "mdg25w2wqsz5hniykkvfs5rlx0uk1efg",
);

$array = array(
	'operation'    => 'ping',
    "session_id" => "bi89qimche00d1vpkx22abk70zm121ho",

	'parameters' => base64_encode(serialize($parameters)),
    "member_id" => "mdn5kzr98i4fy1a21vf500p6kclhekc5",
    "secret_id" => "mdg25w2wqsz5hniykkvfs5rlx0uk1efg",
	'encoding' => 'UTF-8',

    "hash" => md5("ping|".serialize($parameters)."|mdg25w2wqsz5hniykkvfs5rlx0uk1efg")
);

 

$ch = curl_init('/bitrix/admin/main_controller.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);	

echo $html;
*/

/*
// выполнение команд на той стороне, для примера - получение инфы о лицензии и обновлениях

$reqString = '
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client.php");
$update_info = CUpdateClient::GetUpdatesList($errorMessage, "ru", "");
$info = array("update" => $update_info["CLIENT"], "error" => $update_info["ERROR"], "key" => CUpdateClient::GetLicenseKey(), "last_update" => COption::GetOptionString("main", "update_system_update", "-"));
echo json_encode($info);
';

$parameters = array(
    "member_id" => "mdn5kzr98i4fy1a21vf500p6kclhekc5",
    "secret_id" => "mdg25w2wqsz5hniykkvfs5rlx0uk1efg",
    "command" => $reqString
);

$array = array(
	'operation'    => 'run_immediate',
    "session_id" => "bi89qimche00d1vpkx22abk70zm121ho",

	'parameters' => base64_encode(serialize($parameters)),
    "member_id" => "mdn5kzr98i4fy1a21vf500p6kclhekc5",
    "secret_id" => "mdg25w2wqsz5hniykkvfs5rlx0uk1efg",
	'encoding' => 'UTF-8',

    "hash" => md5("run_immediate|".serialize($parameters)."|mdg25w2wqsz5hniykkvfs5rlx0uk1efg")
);

 

$ch = curl_init('/bitrix/admin/main_controller.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);	

//echo $html;

parse_str($html, $output);

echo "<pre>";
var_export(json_decode(urldecode($output['text']), true));
*/


/*
// разрегистрация

$parameters = array();

$array = array(
	'operation'    => 'unregister',
    "session_id" => "bi89qimche00d1vpkx22abk70zm121ho",

	'parameters' => base64_encode(serialize($parameters)),
    "member_id" => "mdn5kzr98i4fy1a21vf500p6kclhekc5",
    "secret_id" => "mdg25w2wqsz5hniykkvfs5rlx0uk1efg",
	'encoding' => 'UTF-8',

    "hash" => md5("unregister|".serialize($parameters)."|mdg25w2wqsz5hniykkvfs5rlx0uk1efg")
);

 

$ch = curl_init('/bitrix/admin/main_controller.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);	

echo $html;
*/
?>