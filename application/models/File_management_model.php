<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class File_management_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_files()
	{
	  return $this->db->get("hrms_file_management");
	}

	public function get_filesByCmp()
	{
		
	$session = $this->session->userdata('username'); 

	$query = $this->db->query("SELECT hrms_file_management.* from hrms_file_management inner join hrms_employees on `hrms_employees`.`user_id` = `hrms_file_management`.`employee_id` where `hrms_employees`.`company_id` =".$session['companyId']);
	return $query->result();

	}
	
	public function read_file_information($id) {
	
		$condition = "file_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_file_management');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('file_id', $id);
		$this->db->delete('hrms_file_management');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('file_id', $id);
		if( $this->db->update('hrms_file_management',$data)) {
			return true;
		} else {
			return false;
		}		
	}

}

?>