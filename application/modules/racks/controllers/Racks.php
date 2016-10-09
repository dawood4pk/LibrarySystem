<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Racks extends MX_Controller
	{
		function __construct() {
			parent::__construct();
			$this->load->library('pagination');
			$this->load->helper('directory');
		}
		////////////////////////////////////////////
		////////////////////////////////////////////
		function delete_rack($update_id){
			Modules::run('site_security/check_is_admin');

			$submit = $this->input->post('submit', TRUE);
			if ( $submit == "No - Cancel" ){
				redirect('racks/manage');
			}

			if ( $submit == "Yes - Delete Rack" ){

				//Dawood: Delete all assignments of the rack first.
				Modules::run('book_rack_assign/_delete_rack', $update_id);

				//delete the rack
				$this->_delete($update_id);

				//add flashdata
				$value = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>The rack was successfully deleted.</div>';
				$this->session->set_flashdata('item', $value);

				redirect('racks/manage');
			}

			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$current_url = current_url();
			$data['form_location'] = $current_url;
			$data['view_file'] = "delete_conf";
			$this->load->module('templates');
			$this->templates->$template($data);						
		}

		function get_rack_name($id){
			$data = $this->get_data_from_db($id);
			$rack_name = $data['rack_name'];
			return $rack_name;
		}

		function count_all() {
			$this->load->model('mdl_racks');
			$query = $this->mdl_racks->count_all();
			return $query;
		}

		function manage(){
			
			//Modules::run('site_security/check_is_admin');
			if ( !( Modules::run('site_security/is_admin') || Modules::run('site_security/is_user') ) ){
				redirect( base_url().'users/login' );
			}

			$limit = 10;
			$config['uri_segment']  =   3;
			$config['num_links']    =   2;
			//$config['first_link']   =   '<<';
			//$config['last_link']    =   '>>';
			$config['first_link']   =   'First';
			$config['last_link']    =   'Last';
			$config['base_url']     =   base_url() . 'racks/manage';
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
			$data['query'] = $this->get_with_limit ( $limit, $offset, 'rack_name' );
			//////////////////////////////////////////////////////
			//////////////////////////////////////////////////////
			//$data['query'] = $this->get('rack_name');
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "manage";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		function get_data_from_post(){
			// addslashes | stripcslashes
			// htmlspecialchars | htmlspecialchars_decode
			$data['rack_name'] = $this->input->post('rack_name', TRUE);
			return $data;
		}

		function get_data_from_db($update_id){
			$query = $this->get_where($update_id);
			foreach($query->result() as $row){
				$data['rack_name'] = $row->rack_name;
			}

			if ( !isset( $data ) ){
				$data = "";
			}

			return $data;
		}

		function create(){
			Modules::run('site_security/check_is_admin');
			$update_id = trim( strip_tags ( $this->uri->segment(3) ) );
			$submit = $this->input->post('submit', TRUE);

			if ( $submit == "Submit" ){
				//person has submitted the form
				$data = $this->get_data_from_post();
			} else {
				if ( is_numeric( $update_id ) ){
					$data = $this->get_data_from_db( $update_id );
				}
			}

			if ( !isset( $data ) ){
				$data = $this->get_data_from_post();
			}

			$data['update_id'] = $update_id;
			$data['draw_editor'] = TRUE;

			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "create";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		function submit(){
			Modules::run('site_security/check_is_admin');
			//$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('rack_name', 'Rack Name', 'required|xss_clean');
			$update_id = $this->input->post('update_id', TRUE);

			if($this->form_validation->run($this) == FALSE)
			{
				//$this->load->view('myform');
				$this->create();
			}
			else
			{
				// addslashes | stripcslashes
				$data = $this->get_data_from_post();
				//echo '<pre>'; print_r( $data );die();

				$update_id = trim( strip_tags ( $this->uri->segment(3) ) );
				if ( is_numeric( $update_id ) ){
					$this->_update($update_id, $data);
				} else {
					$this->_insert($data);
				}

				redirect('racks/manage');
			}
		}

		////////////////////////////////////////////
		////////////////////////////////////////////

		function get($order_by) {
			$this->load->model('mdl_racks');
			$query = $this->mdl_racks->get($order_by);
			return $query;
		}

		function get_with_limit($limit, $offset, $order_by) {
			$this->load->model('mdl_racks');
			$query = $this->mdl_racks->get_with_limit($limit, $offset, $order_by);
			return $query;
		}

		function get_where($id) {
			$this->load->model('mdl_racks');
			$query = $this->mdl_racks->get_where($id);
			return $query;
		}

		function get_where_custom($col, $value) {
			$this->load->model('mdl_racks');
			$query = $this->mdl_racks->get_where_custom($col, $value);
			return $query;
		}

		function _insert($data) {
			$this->load->model('mdl_racks');
			$this->mdl_racks->_insert($data);
		}

		function _update($id, $data) {
			$this->load->model('mdl_racks');
			$this->mdl_racks->_update($id, $data);
		}

		function _delete($id) {
			$this->load->model('mdl_racks');
			$this->mdl_racks->_delete($id);
		}

		function count_where($column, $value) {
			$this->load->model('mdl_racks');
			$count = $this->mdl_racks->count_where($column, $value);
			return $count;
		}

		function get_max() {
			$this->load->model('mdl_racks');
			$max_id = $this->mdl_racks->get_max();
			return $max_id;
		}

		function _custom_query($mysql_query) {
			$this->load->model('mdl_racks');
			$query = $this->mdl_racks->_custom_query($mysql_query);
			return $query;
		}
	}