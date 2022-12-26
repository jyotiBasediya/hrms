<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Probations_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_probations()
	{
	  return $this->db->get("hrms_employee_probations");
	}
	public function get_probationsByCmpId()
	{
		$session = $this->session->userdata('username'); 
		$query = $this->db->query("SELECT * from hrms_employee_probations where compnay_id =".$session['companyId']);
  	  return $query->result();
	}
	
	public function get_employee_probations($id) {
	 	return $query = $this->db->query("SELECT * from hrms_employee_probations where employee_id = '".$id."'");
	}
	
	public function read_probation_information($id) {
	
		$condition = "probation_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_probations');
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
		$this->db->insert('hrms_employee_probations', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('probation_id', $id);
		$this->db->delete('hrms_employee_probations');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('probation_id', $id);
		if( $this->db->update('hrms_employee_probations',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>