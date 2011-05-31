<?php defined('SYSPATH') OR die('No direct access allowed.');

$basedomain = 'vkontakte.ru';

return array(
    'VK_DESKTOP'        =>array(
		'default' =>array(
			'group_id'      => 0,
			'group_name'	=>'',
			
			'app_id'        => 0,
			'app_secret'    => '',

			'user_email'    => '',
			'user_pass'     => '',

			//won't be any need to touch it
			'site_url'      => 'http://'.$basedomain.'/',
			'api_url'       => 'http://api.'.$basedomain .'/api.php',
			'applogin_url'  => 'http://'.$basedomain .'/login.php',
			'userlogin_url' => 'http://login.vk.com/?act=login&amp;to=&amp;from_host=m.vkontakte.ru&amp;pda=1',
			'userlogin2_url'=> 'http://m.'.$basedomain .'/login'
		),
    ),

	'VK_API_PATH'		=> 'http://api.'.$basedomain .'/api.php',
	'VK_API_ID'		=> 'YOUR_ID',
	'VK_API_PASSWORD'	=> 'YOUR_PASS',
	'VK_API_SECRET'		=> 'YOUR_SECRET',

	'VK_API_FILEDS'		=> array(
		'photo',
		'nickname',
		'first_name',
		'last_name',
		'city',
		'sex',
		'bdate',
		'country',
		'photo_medium',
		'photo_big',
		'has_mobile',
		'rate',
		'contacts',
		'education'
	),

	'VK_SESSION_KEY'	=> 'vk',
);
