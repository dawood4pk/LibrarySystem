<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Mdl_books extends CI_Model {
	
		function __construct() {
			parent::__construct();
		}

		function get_table() {
			$table = "books";
			return $table;
		}
		/////////////////////////
		function search_book($limit, $offset, $search_term){
			//echo '<pre>';print_r($search_term);
			
			$table = $this->get_table();
			if ( isset( $search_term['book_title'] ) &&  trim ( $search_term['book_title'] != "" ) ){
				$this->db->like('book_title', $search_term['book_title']);
			}
			
			if ( isset( $search_term['book_author'] ) &&  trim ( $search_term['book_author'] != "" ) ){
				$this->db->or_like('book_author', $search_term['book_author']);
			}
			
			if ( isset( $search_term['book_published_year'] ) &&  trim ( $search_term['book_published_year'] != "" ) ){
				$this->db->or_like('book_published_year', $search_term['book_published_year']);
			}
			//
			$this->db->limit($limit, $offset);
			//this->db->order_by('id');
			$query = $this->db->get($table);
			return $query;
		}
		/////////////////////////
		function get($order_by) {
			$table = $this->get_table();
			$this->db->order_by($order_by);
			$query=$this->db->get($table);
			return $query;
		}

		function get_with_limit($limit, $offset, $order_by) {
			$table = $this->get_table();
			$this->db->limit($limit, $offset);
			$this->db->order_by($order_by);
			$query=$this->db->get($table);
			return $query;
		}

		function get_where($id) {
			$table = $this->get_table();
			$this->db->where('id', $id);
			$query=$this->db->get($table);
			return $query;
		}

		function get_where_custom($col, $value) {
			$table = $this->get_table();
			$this->db->where($col, $value);
			$query=$this->db->get($table);
			return $query;
		}

		function get_where_custom_array($array, $order_by, $limit) {
			$table = $this->get_table();
			$this->db->where($array);
			$this->db->order_by($order_by);
			if ($limit){
				$this->db->limit($limit);
			}
			$query=$this->db->get($table);
			return $query;
		}

		function _insert($data) {
			$table = $this->get_table();
			$this->db->insert($table, $data);
		}

		function _update($id, $data) {
			$table = $this->get_table();
			$this->db->where('id', $id);
			$this->db->update($table, $data);
		}

		function _delete($id) {
			$table = $this->get_table();
			$this->db->where('id', $id);
			$this->db->delete($table);
		}

		function count_where($column, $value) {
			$table = $this->get_table();
			$this->db->where($column, $value);
			$query=$this->db->get($table);
			$num_rows = $query->num_rows();
			return $num_rows;
		}

		function count_all() {
			$table = $this->get_table();
			$query=$this->db->get($table);
			$num_rows = $query->num_rows();
			return $num_rows;
		}

		function count_search_book($search_term) {
			$table = $this->get_table();
			if ( isset( $search_term['book_title'] ) &&  trim ( $search_term['book_title'] != "" ) ){
				$this->db->like('book_title', $search_term['book_title']);
			}

			if ( isset( $search_term['book_author'] ) &&  trim ( $search_term['book_author'] != "" ) ){
				$this->db->or_like('book_author', $search_term['book_author']);
			}

			if ( isset( $search_term['book_published_year'] ) &&  trim ( $search_term['book_published_year'] != "" ) ){
				$this->db->or_like('book_published_year', $search_term['book_published_year']);
			}
			$query=$this->db->get($table);
			$num_rows = $query->num_rows();
			return $num_rows;
		}

		function get_max() {
			$table = $this->get_table();
			$this->db->select_max('id');
			$query = $this->db->get($table);
			$row=$query->row();
			$id=$row->id;
			return $id;
		}

		function _custom_query($mysql_query) {
			$query = $this->db->query($mysql_query);
			return $query;
		}
	}