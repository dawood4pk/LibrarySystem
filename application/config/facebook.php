<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/*
	| -------------------------------------------------------------------
	|  Facebook App details
	| -------------------------------------------------------------------
	|
	| To get an facebook app details you have to be a registered developer
	| at http://developer.facebook.com and create an app for your project.
	|
	|  facebook_app_id               string  Your facebook app ID.
	|  facebook_app_secret           string  Your facebook app secret.
	|  facebook_login_type           string  Set login type. (web, js, canvas)
	|  facebook_login_redirect_url   string  URL tor redirect back to after login. Do not include domain.
	|  facebook_logout_redirect_url  string  URL tor redirect back to after login. Do not include domain.
	|  facebook_permissions          array   The permissions you need.
	*/
	$config['facebook_app_id']              = '963997076952796';
	$config['facebook_app_secret']          = 'ab3125b221a85c019dab680e51d7e38e';
	$config['facebook_default_graph_version']          = 'v2.5';
	//$config['facebook_login_type']          = 'web';
	$config['facebook_login_type']          = 'web';
	$config['facebook_login_redirect_url']  = 'users/web_login';
	$config['facebook_logout_redirect_url'] = 'users/logout';
	$config['facebook_permissions']         = ['email', 'user_posts', 'publish_actions', 'manage_pages', 'publish_pages'];//array('public_profile');
	////////////////////////////////////////////////
	////////////////////////////////////////////////
	/*$config['appId'] = 'Your Facebook App ID';
	$config['secret'] = 'Your Facebook secret key';*/
	////////////////////////////////////////////////
	////////////////////////////////////////////////
	/*$config['facebook']['api_id']       = 'YOUR APP ID';
	$config['facebook']['app_secret']   = 'YOUR APP SECRET';
	$config['facebook']['redirect_url'] = 'https://yourdomain.com/login';
	$config['facebook']['permissions']  = array(
											'email',
											'user_location',
											'user_birthday'
										  );*/
 	////////////////////////////////////////////////
	////////////////////////////////////////////////