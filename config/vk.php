<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
    'auth_group' => 'default',
    'default' =>array(
        /*'token' => array(
            'access_token'=>'', //as returned by vk oauth
            'expires_in'=>'', //returned as well. =0 in case 'offline' flag was specified
            'expire_time'=>'', //computed timestamp as of login time() + expire_in
        ),*/
        //or just specify data to get token emulating user auth
        'app_id'           => 0,
        'app_secret'       => '',

        'user_email'    => '',
        'user_pass'     => '',
    ),
);
