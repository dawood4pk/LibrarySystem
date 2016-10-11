<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Book_rack_assign extends MX_Controller
	{
	
		function __construct() {
			parent::__construct();
		}

		////////////////////////////////////////////
		////////////////////////////////////////////
		function get_rack_name($book_id){
			$query = $this->get_where_custom( 'book_id', $book_id );
			foreach($query->result() as $row){
				$data['id'] = $row->id;
				$data['rack_id'] = $row->rack_id;
				$data['book_id'] = $row->book_id;
			}

			if ( !isset( $data ) ){
				return "Not Set";
			}
			$rack_id = $data['rack_id'];
			$this->load->module('racks');
			return $this->racks->get_rack_name( $rack_id );
		}
		function manage(){
			//Modules::run('site_security/check_is_admin');
			$rack_id = trim( strip_tags ( $this->uri->segment(3) ) );
			if ( is_numeric( $rack_id ) &&  $rack_id > 0 ){

				/*$this->load->module('books');
				$book_title= $this->books->get_book_title( $book_id );
				echo $book_title;*/

				$flash = $this->session->flashdata('item');
				if ( $flash != "" ){
					$data['flash'] = $flash;
				}

				$data['query'] = $this->get_where_custom( 'rack_id', $rack_id );

				$template = Modules::run('site_settings/get_admin_theme');
				//$template = "admin";
				$this->load->module('racks');
				$data['headline'] = $this->racks->get_rack_name( $rack_id );
				$data['view_file'] = "manage";
				$this->load->module('templates');
				$this->load->templates->$template( $data );
			}
		}

		function ditch(){
			Modules::run('site_security/check_is_admin');
			$id = trim( strip_tags ( $this->uri->segment(3) ) );
			$book_id = trim( strip_tags ( $this->uri->segment(4) ) );
			$this->_delete( $id );
			redirect ('book_rack_assign/assign/'.$book_id);
		}

		function _draw_assigned_rack ( $book_id ){
			$data['query'] = $this->get_where_custom( 'book_id', $book_id );
			//echo $this->db->last_query();
			$num_rows = $data['query']->num_rows();
			//echo $num_rows;
			if ( $num_rows > 0 ){
				$this->load->view('assigned_rack', $data);
			}
		}

		function assign(){
			Modules::run('site_security/check_is_admin');
			$book_id = trim( strip_tags ( $this->uri->segment(3) ) );
			$submit = $this->input->post('submit', TRUE);

			if ( $submit == "Finished" ){
				redirect('books/create/'.$book_id);
			}

			if ( $submit == "Submit" ){

					$this->load->library('form_validation');
					$this->form_validation->set_rules('rack_id', 'Rack', 'required|xss_clean|callback_rack_check|callback_is_rack_available|callback_book_check');
					if($this->form_validation->run($this) == TRUE)
					{
						$data['book_id'] = $book_id;
						$data['rack_id'] = $this->input->post('rack_id', TRUE);
						$this->_insert( $data );
					}
				//redirect('store_items/create/'.$book_id);
			}

			$data['book_id'] = $book_id;
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$current_url = current_url();
			$data['form_location'] = $current_url;
			$data['view_file'] = "assign";
			$template = Modules::run('site_settings/get_admin_theme');
			$this->load->module('templates');
			$this->templates->$template($data);
		}

		function rack_check($rack_id){
			$book_id = trim( strip_tags ( $this->uri->segment(3) ) );

			$this->load->model('mdl_book_rack_assign');
			$result = $this->mdl_book_rack_assign->rack_check($book_id, $rack_id);

			if ($result == TRUE)
			{
				$this->form_validation->set_message('rack_check', 'Selected rack already assigned to the selected book.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}

		function is_rack_available($rack_id){
			$rack_limit = Modules::run('site_settings/get_rack_limit'); // 10
			$rack_count = $this->count_where('rack_id', $rack_id);

			if ($rack_count >= $rack_limit)
			{
				$this->form_validation->set_message('is_rack_available', 'Selected rack is full.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}

		function book_check($rack_id){
			$book_id = trim( strip_tags ( $this->uri->segment(3) ) );

			$this->load->model('mdl_book_rack_assign');
			$result = $this->mdl_book_rack_assign->book_check($book_id);

			if ($result == TRUE)
			{
				$this->form_validation->set_message('book_check', 'Selected book already assigned to the the rack.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		////////////////////////////////////////////
		////////////////////////////////////////////

		function get($order_by) {
			$this->load->model('mdl_book_rack_assign');
			$query = $this->mdl_book_rack_assign->get($order_by);
			return $query;
		}

		function get_with_limit($limit, $offset, $order_by) {
			$this->load->model('mdl_book_rack_assign');
			$query = $this->mdl_book_rack_assign->get_with_limit($limit, $offset, $order_by);
			return $query;
		}

		function get_where($id) {
			$this->load->model('mdl_book_rack_assign');
			$query = $this->mdl_book_rack_assign->get_where($id);
			return $query;
		}

		function get_where_custom($col, $value) {
			$this->load->model('mdl_book_rack_assign');
			$query = $this->mdl_book_rack_assign->get_where_custom($col, $value);
			return $query;
		}

		function _insert($data) {
			$this->load->model('mdl_book_rack_assign');
			$this->mdl_book_rack_assign->_insert($data);
		}

		function _update($id, $data) {
			$this->load->model('mdl_book_rack_assign');
			$this->mdl_book_rack_assign->_update($id, $data);
		}

		function _delete($id) {
			$this->load->model('mdl_book_rack_assign');
			$this->mdl_book_rack_assign->_delete($id);
		}

		function _delete_book($book_id) {
			$this->load->model('mdl_book_rack_assign');
			$this->mdl_book_rack_assign->_delete_book($book_id);
		}

		function _delete_rack($rack_id) {
			$this->load->model('mdl_book_rack_assign');
			$this->mdl_book_rack_assign->_delete_rack($rack_id);
		}

		function count_where($column, $value) {
			$this->load->model('mdl_book_rack_assign');
			$count = $this->mdl_book_rack_assign->count_where($column, $value);
			return $count;
		}

		function get_max() {
			$this->load->model('mdl_book_rack_assign');
			$max_id = $this->mdl_book_rack_assign->get_max();
			return $max_id;
		}

		function _custom_query($mysql_query) {
			$this->load->model('mdl_book_rack_assign');
			$query = $this->mdl_book_rack_assign->_custom_query($mysql_query);
			return $query;
		}
	}