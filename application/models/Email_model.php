<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }	
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('hrms_email_history', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}
?>