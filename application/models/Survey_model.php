<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class survey_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_survey()
	{
	  return $this->db->get("hrms_survey");
	}
	
	public function read_survey_information($id) {
	
		$condition = "survey_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_survey');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function all_survey_questions($id) {
	
		$condition = "survey_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_survey_question');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function read_last_survey_information() {

		$this->db->select('*');
		$this->db->from('hrms_survey');
		$this->db->order_by('survey_id', 'desc');
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
		$this->db->insert('hrms_survey', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	// Function to add record in table
	public function add_question($data){
		$this->db->insert('hrms_survey_question', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('survey_id', $id);
		$this->db->delete('hrms_survey');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('survey_id', $id);
		if( $this->db->update('hrms_survey',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_questions($data, $id){
		$this->db->where('question_id', $id);
		if( $this->db->update('hrms_survey_question',$data)) {
			return true;
		} else {
			return false;
		}		
	}
 
	public function get_employee_survey()
	{
		$this->db->select('*');
		$this->db->from('hrms_survey_answers');
		$this->db->group_by('employee_id');
		$this->db->group_by('survey_id');
		return $this->db->get();
	}
	
	public function read_survey_answer_information($survey_id, $employee_id) {
	
		$condition = "survey_id =" . "'" . $survey_id . "' AND employee_id = '".$employee_id."'";
		$this->db->select('*');
		$this->db->from('hrms_survey_answers');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function read_survey_question($id) {
	
		$condition = "question_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_survey_question');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
}

?>