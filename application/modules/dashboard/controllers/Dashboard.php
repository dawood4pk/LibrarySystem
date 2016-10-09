<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Dashboard extends MX_Controller
	{
	
		function __construct() {
			parent::__construct();
			Modules::run('site_security/check_is_admin');
		}

		function home(){
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "home";
			$this->load->module('templates');
			$data['racks_count_all'] = Modules::run('racks/count_all');
			$data['books_count_all'] = Modules::run('books/count_all');
			$this->load->templates->$template( $data );
		}
	}