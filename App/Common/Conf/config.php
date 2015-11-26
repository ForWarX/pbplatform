<?php
return array(
    //'配置项'=>'配置值'

    // 禁止访问的模块
    'MODULE_DENY_LIST'       => array('Common', 'Runtime', 'Upload'),

    // 数据库
    'DB_TYPE'                => 'mysql',
    'DB_HOST'                => 'localhost',
    'DB_NAME'                => 'pbplatform',
    'DB_USER'                => 'root',
    'DB_PWD'                 => '',
    'DB_PORT'                => '3306',
    'DB_PREFIX'              => 'pb_',

    // 模板主题
    'DEFAULT_THEME'          => 'Default',
    'TMPL_LOAD_DEFAULTTHEME' => true,

    // session
    'SESSION_OPTIONS'        => array(
        'expire' =>3600,
    ),
);