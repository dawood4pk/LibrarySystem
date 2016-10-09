<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Site_security extends MX_Controller
	{
	
		function __construct() {
			parent::__construct();
		}

		function _make_hash($password){
			//$password = "hello";
			$safe_pass = $this->_awesome_unbreakable_super_mega_hash($password);
			echo $safe_pass;
		}

		function _awesome_unbreakable_super_mega_hash($password){
			$new_pass = $password.="puReL0@1cS";
			//$new_pass = sha1($password);
			return $new_pass;
		}

		//make_sure_is_admin | check_is_admin
		function check_is_admin(){
			if( $this->session->userdata('logged_in') )
			{
				$sess = $this->session->userdata('logged_in');
				if ( $sess['usertype'] != 1 )
				{
					redirect( base_url().'users/login' );
				}
			}else{
				redirect( base_url().'users/login' );
			}
		}
		function is_admin(){
			if( $this->session->userdata('logged_in') )
			{
				$sess = $this->session->userdata('logged_in');
				if ( $sess['usertype'] == 1 )
				{
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		function is_user(){
			if( $this->session->userdata('logged_in') )
			{
				$sess = $this->session->userdata('logged_in');
				if ( $sess['usertype'] == 2 )
				{
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}