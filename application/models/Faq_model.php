<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_policies()
	{
	  return $this->db->get("hrms_faq");
	}
	 
	 public function read_faq_information($id) {
	
		$condition = "faq_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_faq');
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
		$this->db->insert('hrms_faq', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('faq_id', $id);
		$this->db->delete('hrms_faq');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('faq_id', $id);
		if( $this->db->update('hrms_faq',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>