<?php

$lang['lang_var1'] = 'en_us';
$lang['lang_var2'] = 'zh_cn';
//$lang['lang_var3'] = '语言定义3';
L($lang);

//获取语言变量
$langVar = L('LANG_VAR');
//如果参数为空，表示获取当前定义的全部语言变量（包括语言定义文件中的）：
//$lang = L();


?>



