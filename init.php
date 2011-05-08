<?php defined('SYSPATH') or die('No direct script access.');


Route::set('vk/xd_receiver.htm', 'xd_receiver.htm')
	->defaults(array(
		'controller' => 'vk',
		'action'     => 'xd_receiver'
	));

?>