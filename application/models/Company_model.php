<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class company_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_companies() {
	  return $this->db->get("hrms_companies");
	}

	public function get_companiesWithoutSuperAdmin() {

		$condition = "company_id !=" . "'17'";
		$this->db->select('*');
		$this->db->from('hrms_companies');
		$this->db->where($condition);
		$this->db->order_by("company_id", "desc");
		return  $this->db->get();
		//return $query->result();
	}
	// company types
	public function get_company_types() {
		$query = $this->db->get("hrms_company_type");
		return $query->result();
	}
	
	public function get_all_companies() {
	  $query = $this->db->get("hrms_companies");
	  return $query->result();
	}
	 
	public function read_company_information($id) {
	
		$condition = "company_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_companies');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('hrms_companies', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('company_id', $id);
		$this->db->delete('hrms_companies');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('company_id', $id);
		if( $this->db->update('hrms_companies',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record without logo > in table
	public function update_record_no_logo($data, $id){
		$this->db->where('company_id', $id);
		if( $this->db->update('hrms_companies',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>
