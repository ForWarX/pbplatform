<?php
return array(
    //'������'=>'����ֵ'

    // ��ֹ���ʵ�ģ��
    'MODULE_DENY_LIST'       => array('Common', 'Runtime', 'Upload'),

    // ���ݿ�
    'DB_TYPE'                => 'mysql',
    'DB_HOST'                => 'localhost',
    'DB_NAME'                => 'pbplatform',
    'DB_USER'                => 'root',
    'DB_PWD'                 => '',
    'DB_PORT'                => '3306',
    'DB_PREFIX'              => 'pb_',

    // ģ������
    'DEFAULT_THEME'          => 'Default',
    'TMPL_LOAD_DEFAULTTHEME' => true,

    // session
    'SESSION_OPTIONS'        => array(
        'expire' =>3600,
    ),
);