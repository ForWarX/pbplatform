<?php
require_once('');
function language(){
	showr($_REQUEST);
		if (isset($_REQUEST['language']) === false || $_REQUEST['language'] == '' || $_REQUEST['language'] == 'ch'){$_REQUEST['language'] = '';}
		//else {$_REQUEST['language'] = 'en';}
		$pre_uri = $_REQUEST['pre'];

		language_handler($_REQUEST['language'],true);

		ecs_header("Location: ".$pre_uri."");
}

language();

<!---->
/* {$lang.login}*/

/* 用户登录语言项 */
$_LANG['index_username'] = "用户名";
$_LANG['index_login'] = "登录";
$_LANG['index_userpassword'] = "用户密码";
$_LANG['index_remeberme'] = "记住我";


/* 公共语言项 */



?>