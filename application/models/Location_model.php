<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class location_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_locations()
	{
	  return $this->db->get("hrms_office_location");
	}
	public function get_locationsByCmy()
	{
		$session = $this->session->userdata('username'); 
		$query = $this->db->query("SELECT * from hrms_office_location where company_id =".$session['companyId']);
		return $query->result();
	}

	 
	 public function read_location_information($id) {
	
		$condition = "location_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_office_location');
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
		$this->db->insert('hrms_office_location', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('location_id', $id);
		$this->db->delete('hrms_office_location');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('location_id', $id);
		if( $this->db->update('hrms_office_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record without logo > in table
	public function update_record_no_logo($data, $id){
		$this->db->where('location_id', $id);
		if( $this->db->update('hrms_office_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get all office locations
	public function all_office_locations() {
		$session = $this->session->userdata('username'); 
	  $query = $this->db->query("SELECT * from hrms_office_location where company_id =".$session['companyId']);
  	  return $query->result();
	}


	public function get_all_location()
	{
		$session = $this->session->userdata('username'); 

		$this->db->select("hrms_office_location.*,hrms_countries.country_name,hrms_companies.name as company_name,hrms_employees.first_name,hrms_employees.last_name")
    		->from('hrms_office_location')
    		->join('hrms_countries','hrms_countries.country_id = hrms_office_location.country','left')
    		->join('hrms_companies','hrms_companies.company_id = hrms_office_location.company_id','left')
    		->join('hrms_employees','hrms_employees.user_id = hrms_office_location.added_by','left')
			->where(array("hrms_office_location.company_id" =>$session['companyId']));

			return $this->db->get()->result_array();
	
	}
}
?>