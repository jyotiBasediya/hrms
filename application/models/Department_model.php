<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class department_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_departments()
	{
	  return $this->db->get("hrms_departments");
	}

	public function get_departmentsByCmy()
	{
	  	$session = $this->session->userdata('username'); 
		$query = $this->db->query("SELECT * from hrms_departments where company_id =".$session['companyId']);
		return $query->result();
	}
	 
	 public function read_department_information($id) {
	
		$condition = "department_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_departments');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	 public function read_department_informationByRow($id) {
	
		$condition = "department_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_departments');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->row();
	}
	

	
	// Function to add record in table
	public function add($data){
		$this->db->insert('hrms_departments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('department_id', $id);
		$this->db->delete('hrms_departments');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('department_id', $id);
		if( $this->db->update('hrms_departments',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get all departments
	public function all_departments()
	{
	  $query = $this->db->query("SELECT * from hrms_departments");
  	  return $query->result();
	}
	public function all_departmentsBycmp()
	{
		$session = $this->session->userdata('username'); 
		$query = $this->db->query("SELECT * from hrms_departments where company_id =".$session['companyId']);
		return $query->result();
	}
}
?>