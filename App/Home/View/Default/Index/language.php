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


$lang['lang_var1'] = 'en_us';
$lang['lang_var2'] = 'zh_cn';
//$lang['lang_var3'] = '语言定义3';
L($lang);

//获取语言变量
$langVar = L('LANG_VAR');
//如果参数为空，表示获取当前定义的全部语言变量（包括语言定义文件中的）：
//$lang = L();


?>



