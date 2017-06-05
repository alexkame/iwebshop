<?php
return array(
	'logs'=>array(
		'path'=>'backup/logs',
		'type'=>'file'
	),
	'DB'=>array(
		'type'=>'mysqli',
        'tablePre'=>'iwebshop_',
		'read'=>array(
			array('host'=>'59.110.142.51','user'=>'daj','passwd'=>'root','name'=>'iwebshop'),
		),

		'write'=>array(
			'host'=>'59.110.142.51','user'=>'daj','passwd'=>'root','name'=>'iwebshop',
		),
	),
	'interceptor' => array('themeroute@onCreateController','layoutroute@onCreateView','plugin'),
	'langPath' => 'language',
	'viewPath' => 'views',
	'skinPath' => 'skin',
    'classes' => 'classes.*',
    'rewriteRule' =>'url',
	'theme' => array('pc' => array('default' => 'default','sysdefault' => 'green','sysseller' => 'green'),'mobile' => array('mobile' => 'default','sysdefault' => 'default','sysseller' => 'default')),
	'timezone'	=> 'Etc/GMT-8',
	'upload' => 'upload',
	'dbbackup' => 'backup/database',
	'safe' => 'cookie',
	'lang' => 'zh_sc',
	'debug'=> '1',
	'configExt'=> array('site_config'=>'config/site_config.php','diy'=>'config/diy.php'),
	'encryptKey'=>'f180ae7d5ff4f02b82ae903ed945abd6',
	'authorizeCode' => '',
);
?>