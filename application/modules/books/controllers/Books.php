<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Books extends MX_Controller
	{
	
		function __construct() {
			parent::__construct();
			$this->load->library('pagination');
			$this->load->helper('directory');
		}

		function search(){

			$data['book_title'] = trim( strip_tags ( $this->input->get('book_title', TRUE) ) );
			$data['book_author'] = trim( strip_tags ( $this->input->get('book_author', TRUE) ) );
			$data['book_published_year'] = trim( strip_tags ( $this->input->get('book_published_year', TRUE) ) );

			$Query_String = "?book_title=".$data['book_title']."&book_author=".$data['book_author']."&book_published_year=".$data['book_published_year'];

			/*$array = array('id' => $id);
			$book = $this->get_where_custom_array( $array, 'book_title' );*/

			$limit = 10;
			$config['page_query_string'] = TRUE;
			//$config['uri_segment']  =   3;
			$config['num_links']    =   2;
			//$config['first_link']   =   '<<';
			//$config['last_link']    =   '>>';
			$config['first_link']   =   'First';
			$config['last_link']    =   'Last';
			$config['base_url']     =   base_url() . 'books/search'.$Query_String;
			//$config['base_url']     =   current_url();
			$config['total_rows']   =  $this->count_search_book($data);;
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
			$offset = trim( strip_tags ( $this->input->get('per_page', TRUE) ) );
					if( $offset == "" )
						$offset=0;

			$this->pagination->initialize( $config );
			//////////////////////////////////////////////////
			//////////////////////////////////////////////////
			//$mysql_query = "SELECT * FROM books WHERE book_title like '%{$data['book_title']}%' limit $limit offset $offset";
			//$data['query'] = $this->_custom_query($mysql_query);
			$data['query'] = $this->search_book ( $limit, $offset, $data );
			//////////////////////////////////////////////////
			//////////////////////////////////////////////////
			//$data['query'] = $this->get_with_limit ( $limit, $offset, 'book_title' );
			$data["paging_links"] = $this->pagination->create_links();			
			//////////////////////////////////////////////////////
			//////////////////////////////////////////////////////
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "search";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		////////////////////////////////////////////
		////////////////////////////////////////////
		function get_book_title($id){
			$data = $this->get_data_from_db($id);
			$book_title = $data['book_title'];
			return $book_title;
		}

		function get_book_author($id){
			$data = $this->get_data_from_db($id);
			$book_author = $data['book_author'];
			return $book_author;
		}

		function get_book_published_year($id){
			$data = $this->get_data_from_db($id);
			$book_published_year = $data['book_published_year'];
			return $book_published_year;
		}

		function delete_book($update_id){
			Modules::run('site_security/check_is_admin');

			$submit = $this->input->post('submit', TRUE);
			if ( $submit == "No - Cancel" ){
				redirect('books/manage');
			}

			if ( $submit == "Yes - Delete Book" ){

				//Dawood: Delete all assignments of the book first.
				Modules::run('book_rack_assign/_delete_book', $update_id);

				//delete the book
				$this->_delete($update_id);

				//add flashdata
				$value = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>The book was successfully deleted.</div>';
				$this->session->set_flashdata('item', $value);

				redirect('books/manage');
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
			$this->load->model('mdl_books');
			$query = $this->mdl_books->count_all();
			return $query;
		}

		function count_search_book($search_term) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->count_search_book($search_term);
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
			$config['base_url']     =   base_url() . 'books/manage';
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
			$data['query'] = $this->get_with_limit ( $limit, $offset, 'book_title' );
			//////////////////////////////////////////////////////
			//////////////////////////////////////////////////////
			$template = Modules::run('site_settings/get_admin_theme');
			//$template = "admin";
			$data['view_file'] = "manage";
			$this->load->module('templates');
			$this->load->templates->$template( $data );
		}

		function get_data_from_post(){
			// addslashes | stripcslashes
			// htmlspecialchars | htmlspecialchars_decode
			$data['book_title'] = $this->input->post('book_title', TRUE);
			$data['book_author'] = $this->input->post('book_author', TRUE);
			$data['book_published_year'] = $this->input->post('book_published_year', TRUE);

			return $data;
		}

		function get_data_from_db($update_id){
			$query = $this->get_where($update_id);
			foreach($query->result() as $row){
				$data['book_title'] = $row->book_title;
				$data['book_author'] = $row->book_author;
				$data['book_published_year'] = $row->book_published_year;
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

		function validateDate($date, $format = 'Y-m-d H:i:s')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}

		function check_date_format( $date ) {
			if( $this->validateDate($date, 'd-m-Y') ){
			//if( $this->validateDate($date, 'd/m/Y') ){
				return TRUE;
			}else{
				$this->form_validation->set_message('check_date_format', 'The Date Of Published Year is not in the correct format.');
				return FALSE;
			}
		}

		function submit(){
			Modules::run('site_security/check_is_admin');
			//$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('book_title', 'Book Title', 'required|xss_clean');
			$this->form_validation->set_rules('book_author', 'Book Author', 'required|xss_clean');
			$this->form_validation->set_rules('book_published_year', 'Book Published Year', 'required|xss_clean|callback_check_date_format');
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

				redirect('books/manage');
			}
		}

		////////////////////////////////////////////
		////////////////////////////////////////////
		function search_book($limit, $offset, $search_term) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->search_book($limit, $offset, $search_term);
			return $query;
		}

		function get($order_by) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->get($order_by);
			return $query;
		}

		function get_with_limit($limit, $offset, $order_by) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->get_with_limit($limit, $offset, $order_by);
			return $query;
		}

		function get_where($id) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->get_where($id);
			return $query;
		}

		function get_where_custom($col, $value) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->get_where_custom($col, $value);
			return $query;
		}

		function get_where_custom_array($array, $order_by, $limit) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->get_where_custom_array($array, $order_by, $limit);
			return $query;
		}

		function _insert($data) {
			$this->load->model('mdl_books');
			$this->mdl_books->_insert($data);
		}

		function _update($id, $data) {
			$this->load->model('mdl_books');
			$this->mdl_books->_update($id, $data);
		}

		function _delete($id) {
			$this->load->model('mdl_books');
			$this->mdl_books->_delete($id);
		}

		function count_where($column, $value) {
			$this->load->model('mdl_books');
			$count = $this->mdl_books->count_where($column, $value);
			return $count;
		}

		function get_max() {
			$this->load->model('mdl_books');
			$max_id = $this->mdl_books->get_max();
			return $max_id;
		}

		function _custom_query($mysql_query) {
			$this->load->model('mdl_books');
			$query = $this->mdl_books->_custom_query($mysql_query);
			return $query;
		}
	}