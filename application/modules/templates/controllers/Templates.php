<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends MX_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function error_404(){
		$this->output->set_status_header('404');
		$this->load->view('error_404');
	}

	function admin($data){
		//Modules::run('site_security/check_is_admin');
		if ( Modules::run('site_security/is_admin') || Modules::run('site_security/is_user') ){
			$this->load->view('admin', $data);
		}
	}

	function start_bootstrap_sb_admin_2($data){
		//Modules::run('site_security/check_is_admin');
		$this->load->view('start_bootstrap_sb_admin_2', $data);
	}

	function start_bootstrap_sb_admin_2_navigation(){
		//Modules::run('site_security/check_is_admin');
		if ( Modules::run('site_security/is_admin') || Modules::run('site_security/is_user') ){
			$this->load->view('start_bootstrap_sb_admin_2_navigation');
		}
	}
}