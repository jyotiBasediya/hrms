<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class expense_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
 	// get all expenses
	public function get_expenses() {
	  return $this->db->get("hrms_expenses");
	}
	
	// get total number of expenses
	public function get_total_expenses() {
	  $query = $this->db->query("SELECT SUM(amount) as exp_amount FROM hrms_expenses");
  	  return $query->result();
	}
	 
	 public function read_expense_information($id) {
	
		$condition = "expense_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_expenses');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function read_expense_type_information($id) {
	
		$condition = "expense_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_expense_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get all expense types
	public function all_expense_types()
	{
	  $query = $this->db->query("SELECT * from hrms_expense_type");
  	  return $query->result();
	}
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('hrms_expenses', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('expense_id', $id);
		$this->db->delete('hrms_expenses');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('expense_id', $id);
		if( $this->db->update('hrms_expenses',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record without logo > in table
	public function update_record_no_logo($data, $id){
		$this->db->where('expense_id', $id);
		if( $this->db->update('hrms_expenses',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function all_expense_categories()
	{
	  $query = $this->db->query("SELECT * from expense_categories where is_delete=0");
  	  return $query->result_array();
	}
	
	public function addcategory($data){
		$this->db->insert('expense_categories', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
		public function getsingleexpencedata($table,$whr) {
	
		// $condition = "expense_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($whr);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
		public function updatecategory($data, $id){
		$this->db->where('expense_category_id', $id);
		if( $this->db->update('expense_categories',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function getwhrexpencedata($table,$whr) {
	
		// $condition = "expense_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($whr);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function updateemployeeexpense($data, $id){
		$this->db->where('id', $id);
		if( $this->db->update('expense_appliedby_employee',$data)) {
			return true;
		} else {
			return false;
		}		
	}


}
?>