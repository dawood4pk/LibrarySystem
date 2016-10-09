<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Users extends MX_Controller
	{
	
		function __construct() {
			parent::__construct();
			//$this->load->helper('url'); //Dawood: Already added at autoload.
		}

		function delete_user($update_id){
			Modules::run('site_security/check_is_admin');

			$submit = $this->input->post('submit', TRUE);
			if ( $submit == "No - Cancel" ){
				redirect('users/manage');
			}

			if ( $submit == "Yes - Delete User" ){
				// 1: Super administrator
				if ( $update_id != 1 ){
					//delete the menu
					$this->_delete($update_id);
					$value = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>The user was successfully deleted.</div>';
				}else{
					$value = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Default admin user cannot be deleted.</div>';
				}
				//add flashdata

				$this->session->set_flashdata('item', $value);

				redirect('users/manage');
			}

			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$current_url = current_url();
			$data['form_location'] = $current_url;
			$data['view_file'] = "delete_conf";
			$this->load->module('templates');
			$this->templates->$template($data);
		}

		function count_all() {
			$this->load->model('mdl_users');
			$query = $this->mdl_users->count_all();
			return $query;
		}

		function manage(){
			Modules::run('site_security/check_is_admin');
			$limit = 10;
			$config['uri_segment']  =   3;
			$config['num_links']    =   2;
			//$config['first_link']   =   '<<';
			//$config['last_link']    =   '>>';
			$config['first_link']   =   'First';
			$config['last_link']    =   'Last';
			$config['base_url']     =   base_url() . 'users/manage';
			$config['total_rows']   =  $this->count_all();
			$config['per_page']     =   $limit;
			////////////////
			////////////////
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';

			$config['first_tag_open'] = ' <li class="paginate_button" aria-controls="dataTables-example" tabindex="0">';
			$config['first_tag_close'] = '</li>';

			$config['last_tag_open'] = '<li class="paginate_button" aria-controls="dataTables-example" tabindex="0">';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="paginate_button" aria-controls="dataTables-example" tabindex="0">';
			$config['next_tag_close'] = '</li>';

			//$config['prev_link'] = '&lt;';
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="paginate_button" aria-controls="dataTables-example" tabindex="0">';
			$config['prev_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['num_tag_open'] = '<li class="paginate_button" aria-controls="dataTables-example" tabindex="0">';
			$config['num_tag_close'] = '</li>';

			////////////////
			////////////////
			$offset = trim( strip_tags ( $this->uri->segment(3) ) );
			if( $offset == "" )
				$offset=0;
			$this->pagination->initialize( $config );
			$data["paging_links"] = $this->pagination->create_links();
			$data['query'] = $this->_get_with_limit ( $limit, $offset, 'username' );
			//////////////////////////////////////////////////////
			$flash = $this->session->flashdata('item');
			if ( $flash != "" ){
				$data['flash'] = $flash;
			}
			//////////////////////////////////////////////////////
			//$data['query'] = $this->_get('username');
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "manage";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		function create(){
			Modules::run('site_security/check_is_admin');
			$update_id = trim( strip_tags ( $this->uri->segment(3) ) );
			$submit = $this->input->post('submit', TRUE);
			////////////////////////////////////////////////////////
			if ( $submit == "Submit" ){
				//person has submitted the form
				$data = $this->get_data_from_post();
				$data['headline'] = "Edit User";
				
			} else {
				if ( is_numeric( $update_id ) ){
					$data = $this->get_data_from_db( $update_id );
					$data['headline'] = "Edit User";
				}
			}

			if ( !isset( $data ) ){
				$data = $this->get_data_from_post();
				$data['headline'] = "Create New User";
			}

			//$data['headline'] = "Create New User";

			$data['update_id'] = $update_id;
			$flash = $this->session->flashdata('item');
			if ( $flash != "" ){
				$data['flash'] = $flash;
			}
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "create";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		function get_data_from_post(){
			$data['username'] = $this->input->post('username', TRUE);
			$data['pword'] = $this->input->post('pword', TRUE);
			$data['usertype'] = $this->input->post('usertype', TRUE);
			$data['hidden_username'] = $this->input->post('hidden_username', TRUE);
			return $data;
		}

		function get_data_from_db($update_id){
			$query = $this->_get_where($update_id);
			foreach($query->result() as $row){
				$data['username'] = $row->username;
				$data['hidden_username'] = $row->username;
				$data['usertype'] = $row->usertype;
				//$data['pword'] = $row->pword;
			}

			if ( !isset( $data ) ){
				$data = "";
			}
			return $data;
		}

		function admin_submit(){
			Modules::run('site_security/check_is_admin');
			$update_id = trim( strip_tags ( $this->uri->segment(3) ) );
			//$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[30]|xss_clean|callback_username_check');

			if ( is_numeric( $update_id ) ){
				$this->form_validation->set_rules('pword', 'Password', 'max_length[30]|xss_clean');
			}else{
				$this->form_validation->set_rules('pword', 'Password', 'required|max_length[30]|xss_clean');
			}

			$this->form_validation->set_rules('pword2', 'Confirm Password', 'max_length[30]|xss_clean|callback_pword2_check');
			$this->form_validation->set_rules('usertype', 'User Type', 'required|xss_clean');

			//$update_id = $this->input->post('update_id', TRUE);

			if($this->form_validation->run($this) == FALSE)
			{
				//$this->load->view('myform');
				$this->create();
			}
			else
			{
				$data = $this->get_data_from_post();
				if ( ( trim ( $data['pword'] ) === "" ) && ( trim ( $data['pword2'] ) === "" ) ){
					unset($data['pword']);
				} else{
					$data['pword'] = Modules::run('site_security/_make_hash', $data['pword']);
				}
				unset($data['pword2']);
				unset($data['hidden_username']);
				//figure out what the page_url should be

				if ( is_numeric( $update_id ) ){

					if ( $update_id == 1 ){
						//unset($data['pword']); // Dawood: This unset is temporary.
						unset($data['usertype']); //special user, don't change the TYPE.
					}

					//echo '<pre>';print_r($data);die();

					$this->_update($update_id, $data);
					$value = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>The user was successfully updated.</div>';
				} else {
					$this->_insert($data);
					$value = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>The user was successfully created.</div>';
				}
				$this->session->set_flashdata('item', $value);
				redirect('users/manage');
			}
		}

		function username_check($username){
			$hidden_username = $this->input->post('hidden_username', TRUE);
			//$username = $this->input->post('username', TRUE);
			//$pword = Modules::run('site_security/_make_hash', $pword);

			//$this->load->model('mdl_users');
			//$result = $this->mdl_users->pword_check($username, $pword);
			//echo 'hidden_username:('.$hidden_username.') | username:('.$username.')';
			//echo 'yes';die();
			if ( trim( $hidden_username ) != trim ( $username ) )
			{
				$count_result = $this->count_where( 'username', $username );

				if ( $count_result >= 1 )
				{
					$this->form_validation->set_message('username_check', 'The username is already in use. Enter a different username.');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}

		function pword2_check($pword2){
			$pword = $this->input->post('pword', TRUE);

			if ( trim ( $pword ) != trim ( $pword2 ) )
			{
				$this->form_validation->set_message('pword2_check', 'Passwords do not match, please retype.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		////

		function logout()
		{
			$this->session->sess_destroy();
			//redirect( base_url(),'refresh' );
			redirect('users/login', 'refresh' );
			//$this->facebook->destroy_token();
			redirect('users/web_login', redirect);
		}

		function _in_you_go($username){
			//give them a session variable and sent them to the admin panel if admin other wise send non admin user to the home page.
			$query = $this->_get_where_custom('username', $username);

			foreach($query->result() as $row){
				$sess_array = array(
						 'id' => $row->id,
						 'username' => $row->username,
						 'usertype' => $row->usertype,
					   );
			}

			$this->session->set_userdata('logged_in', $sess_array);
			redirect ('dashboard/home');
		}

		function login(){
			if( $this->session->userdata('logged_in') )
			{
				$sess = $this->session->userdata('logged_in');
				if ( $sess['usertype'] == 1 )
				{
					redirect( base_url().'dashboard/home' );
				}else if ( $sess['usertype'] == 2 ){

					redirect( base_url().'racks/manage' );
				}else{
					redirect( base_url() );
				}
			}
			//$data['module'] = "users";

			$template = Modules::run('site_settings/get_admin_theme');
			//$template = Modules::run('site_settings/get_public_theme');
			$data['view_file'] = "loginform";
			$this->load->module('templates');
			$this->load->templates->$template( $data );

			/*$public_theme = Modules::run('site_settings/get_public_theme');
			echo Modules::run('templates/'.$public_theme, $data);*/
		}
		
		function submit(){
			//$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[30]|xss_clean');
			$this->form_validation->set_rules('pword', 'Password', 'required|max_length[30]|xss_clean|callback_pword_check');

			$update_id = $this->input->post('update_id', TRUE);
			sleep(1);
			if($this->form_validation->run($this) == FALSE)
			{
				//$this->load->view('myform');
				$this->login();
			}
			else
			{
				//echo "success";die();
				$username = $this->input->post('username', TRUE);
				$this->_in_you_go($username);
			}
		}

		function pword_check($pword){
			$username = $this->input->post('username', TRUE);
			$pword = Modules::run('site_security/_make_hash', $pword);

			$this->load->model('mdl_users');
			$result = $this->mdl_users->pword_check($username, $pword);

			if ($result == FALSE)
			{
				$this->form_validation->set_message('pword_check', 'You did not enter a correct username and/or password');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		////////////////////////////////////////////
		////////////////////////////////////////////

		function _get($order_by) {
			$this->load->model('mdl_users');
			$query = $this->mdl_users->get($order_by);
			return $query;
		}

		function _get_with_limit($limit, $offset, $order_by) {
			$this->load->model('mdl_users');
			$query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
			return $query;
		}

		function _get_where($id) {
			$this->load->model('mdl_users');
			$query = $this->mdl_users->get_where($id);
			return $query;
		}

		function _get_where_custom($col, $value) {
			$this->load->model('mdl_users');
			$query = $this->mdl_users->get_where_custom($col, $value);
			return $query;
		}

		function _insert($data) {
			$this->load->model('mdl_users');
			$this->mdl_users->_insert($data);
		}

		function _update($id, $data) {
			$this->load->model('mdl_users');
			$this->mdl_users->_update($id, $data);
		}

		function _delete($id) {
			$this->load->model('mdl_users');
			$this->mdl_users->_delete($id);
		}

		function count_where($column, $value) {
			$this->load->model('mdl_users');
			$count = $this->mdl_users->count_where($column, $value);
			return $count;
		}

		function get_max() {
			$this->load->model('mdl_users');
			$max_id = $this->mdl_users->get_max();
			return $max_id;
		}

		function _custom_query($mysql_query) {
			$this->load->model('mdl_users');
			$query = $this->mdl_users->_custom_query($mysql_query);
			return $query;
		}
	}