<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class awards_model extends CI_Model {

 

    public function __construct()

    {

        parent::__construct();

        $this->load->database();

    }

 

	public function get_awards()

	{

	  return $this->db->get("hrms_awards");

	}

	 public function get_awardsByCmp()

	{
	$session = $this->session->userdata('username'); 

	$query = $this->db->query("SELECT hrms_awards.* from hrms_awards inner join hrms_employees on `hrms_employees`.`user_id` = `hrms_awards`.`employee_id` where `hrms_employees`.`company_id` =".$session['companyId']);
	return $query->result();
	 

	}

	 public function read_award_type_information($id) {

	

		$condition = "award_type_id =" . "'" . $id . "'";

		$this->db->select('*');

		$this->db->from('hrms_award_type');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();

		

		if ($query->num_rows() == 1) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	public function all_award_types()

	{

	  $query = $this->db->query("SELECT * from hrms_award_type");

  	  return $query->result();

	}

	

	public function get_employee_awards($id) {

	 	return $query = $this->db->query("SELECT * from hrms_awards where employee_id = '".$id."'");

	}

	

	public function read_award_information($id) {

	

		$condition = "award_id =" . "'" . $id . "'";

		$this->db->select('*');

		$this->db->from('hrms_awards');

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

		$this->db->insert('hrms_awards', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}

	

	// Function to Delete selected record from table

	public function delete_record($id){

		$this->db->where('award_id', $id);

		$this->db->delete('hrms_awards');

		

	}

	

	// Function to update record in table

	public function update_record($data, $id){

		$this->db->where('award_id', $id);

		if( $this->db->update('hrms_awards',$data)) {

			return true;

		} else {

			return false;

		}		

	}

}

?>