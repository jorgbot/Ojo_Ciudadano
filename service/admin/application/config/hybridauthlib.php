<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
    array(
        // set on "base_url" the relative url that point to HybridAuth Endpoint
        'base_url' => '/hauth/endpoint',

        'providers' => array(
            // openid providers
            'OpenID' => array(
                'enabled' => false,
            ),

            'Yahoo' => array(
                'enabled' => false,
                'keys' => array('id' => '', 'secret' => ''),
            ),

            'AOL' => array(
                'enabled' => false,
            ),
            //google
'Google' => array (
				'enabled' => true,
				'keys'    => array ( 'id' => '', 'secret' => '' )
			),//google

            //facebook
'Facebook' => array (
				'enabled' => true,
				'keys'    => array ( 'id' => '', 'secret' => '' ),
                'scope'   => 'email, user_about_me, user_birthday, user_hometown, user_website,publish_actions'
			),
//facebook

            //twitter
'Twitter' => array (
				'enabled' => true,
				'keys'    => array ( 'key' => '', 'secret' =>'' )
			),
//twitter

            // windows live
            'Live' => array(
                'enabled' => false,
                'keys' => array('id' => '', 'secret' => ''),
            ),

            'MySpace' => array(
                'enabled' => false,
                'keys' => array('key' => '', 'secret' => ''),
            ),

            'LinkedIn' => array(
                'enabled' => false,
                'keys' => array('key' => '', 'secret' => ''),
            ),

            'Foursquare' => array(
                'enabled' => false,
                'keys' => array('id' => '', 'secret' => ''),
            ),
            //instagram
'Instagram' => array (
				'enabled' => true,
				'keys'    => array ( 'id' => '', 'secret' => '' )
			),
//instagram
        ),

        // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
        'debug_mode' => false,

        'debug_file' => APPPATH.'/logs/hybridauth.log',
    );

/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */
