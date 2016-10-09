<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Site_settings extends MX_Controller
	{
		function __construct() {
			parent::__construct();
			//$this->load->helper('file');
		}

		function index(){
			Modules::run('site_security/check_is_admin');
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = Modules::run('site_settings/get_public_theme');
			$data['headline'] = "Site Settings";
			//$data['content'] = "For site settings, edit following file: application\modules\site_settings\controllers -> site_settings.php";
			//$data['content'] = read_file('./application/modules/site_settings/controllers/Site_settings.php');
			//$data['content'] = file_get_contents('./application/modules/site_settings/controllers/Site_settings.php');
			$data['content'] = "";
			$data['view_file'] = "view_settings";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		function get_site_name(){
			$site_name = "Library Management System.";
			return $site_name;
		}

		function get_default_page_title(){
			$default_page_title = "Library's Page.";
			return $default_page_title;
		}

		function get_default_keywords(){
			$keywords = "library, management, system";
			return $keywords;
		}

		function get_default_description(){
			$description = "Library System.";
			return $description;
		}

		function get_designer_url(){
			$site_url = "#";
			return $site_url;
		}

		function get_fb_url(){
			$fb_url = "https://www.facebook.com/dawood.butt";
			return $fb_url;
		}

		function get_designer_name(){
			$site_name = "#";
			return $site_name;
		}

		function get_owner_name(){
			$name = "Dawood";
			return $name;
		}

		function get_owner_email(){
			$email = "dawood4pk@gmail.com";
			return $email;
		}

		function get_currency(){
			//$currency = "&pound;";
			$currency = "PKR";
			return $currency;
		}

		function get_public_theme(){
			//$public_theme = "public_one_col";
			$public_theme = "public_xxx";
			return $public_theme;
		}

		function get_admin_theme(){
			$admin_theme = "start_bootstrap_sb_admin_2";
			return $admin_theme;
		}

		function get_admin_theme_navigation(){
			$admin_navigation = "start_bootstrap_sb_admin_2_navigation";
			return $admin_navigation;
		}

		function ga_tracking_id(){
			$ga_tracking_id = "UA-xxxxxxxx-x";
			return $ga_tracking_id;
		}

		function get_rack_limit(){
			$rack_limit = 10;
			return $rack_limit;
		}
	}