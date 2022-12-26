<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function edit_id($id)
    {
   			$this->db->from('hrms_employees');
   			$this->db->where('user_id',$id);
   			$query = $this->db->get();
   			return $query->row();
   			//return $this->db->update($id);
 		
    }


 

    	public function update($id)
    	{
  				$this->db->where("user_id",$id);
  				$query = $this->db->get('employees');
  				if ($query) {
  					return $query->row();
  				}

    	}
    	public function getuserdetail($uid){
		$ret=$this->db->select('*')
		              ->where('id',$uid)
		              ->get('employees');
		        return $ret->row();
	}


	public function getuser ($id)
	{
		$this->db->where('id',$id);
		return $user = $this->db->get('employees')->row_array();

	}

	public function update_product($id) 
    {
        $data=array(
            'full_name' => $this->input->post('full_name'),
            'email'=> $this->input->post('mail_id')
        );
        if($id==0){
            return $this->db->insert('employees',$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update('employees',$data);
        }        
    }



 	// get all employes
	public function get_employees() {
	  return $this->db->get("hrms_employees");

	}

	public function get_employee_withCompany($cmpnyId)
	{
		 $this->db->where('company_id', $cmpnyId);
 		$query = $this->db->get('hrms_employees');
 		return $query->result();
 		return $query->num_rows();
	}
	
	// get total number of employees
	public function get_total_employees() {
		$session = $this->session->userdata('username');
		$condition = "company_id =" . "'" . $session['companyId'] . "'";
		$this->db->select('*');
		$this->db->from('hrms_employees');
		$this->db->where($condition);

	  $query = $this->db->get();
	  return $query->num_rows();
	}
		 
	 public function read_employee_information($id) {
	
		$condition = "user_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
		 
	 public function read_employee_information_by_username($username) {
	
		$condition = "username =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('hrms_employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
		 
	 public function read_new_employee_information() {
	
		$this->db->select('*');
		$this->db->from('hrms_employees');
		$this->db->limit(1);
		$this->db->order_by('user_id', 'DESC');
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}	
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('hrms_employees', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('user_id', $id);
		$this->db->delete('hrms_employees');
		
	}
	
	/*  Update Employee Record */
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > basic_info
	public function basic_info($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to update record in table > change_password
	public function change_password($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > social_info
	public function social_info($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > profile picture
	public function profile_picture($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > contact_info
	public function contact_info_add($data){
		$this->db->insert('hrms_employee_contacts', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > contact_info
	public function contact_info_update($data, $id){
		$this->db->where('contact_id', $id);
		if( $this->db->update('hrms_employee_contacts',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > document_info_update
	public function document_info_update($data, $id){
		$this->db->where('document_id', $id);
		if( $this->db->update('hrms_employee_documents',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > document_info_update
	public function img_document_info_update($data, $id){
		$this->db->where('immigration_id', $id);
		if( $this->db->update('hrms_employee_immigration',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > document info
	public function document_info_add($data){
		$this->db->insert('hrms_employee_documents', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > immigration info
	public function immigration_info_add($data){
		$this->db->insert('hrms_employee_immigration', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	// Function to add record in table > qualification_info_add
	public function qualification_info_add($data){
		$this->db->insert('hrms_employee_qualification', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > qualification_info_update
	public function qualification_info_update($data, $id){
		$this->db->where('qualification_id', $id);
		if( $this->db->update('hrms_employee_qualification',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > work_experience_info_add
	public function work_experience_info_add($data){
		$this->db->insert('hrms_employee_work_experience', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > work_experience_info_update
	public function work_experience_info_update($data, $id){
		$this->db->where('work_experience_id', $id);
		if( $this->db->update('hrms_employee_work_experience',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > bank_account_info_add
	public function bank_account_info_add($data){
		$this->db->insert('hrms_employee_bankaccount', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > bank_account_info_update
	public function bank_account_info_update($data, $id){
		$this->db->where('bankaccount_id', $id);
		if( $this->db->update('hrms_employee_bankaccount',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > contract_info_add
	public function contract_info_add($data){
		$this->db->insert('hrms_employee_contract', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	//for current contact > employee
	public function check_employee_contact_current($id) {
	
		$condition = "employee_id =" . "'" . $id . "' and contact_type ='current'";
		$this->db->select('*');
		$this->db->from('hrms_employee_contacts');
		$this->db->where($condition);
		$this->db->limit(1);
		return $query = $this->db->get();		
	}
	
	//for permanent contact > employee
	public function check_employee_contact_permanent($id) {
	
		$condition = "employee_id =" . "'" . $id . "' and contact_type ='permanent'";
		$this->db->select('*');
		$this->db->from('hrms_employee_contacts');
		$this->db->where($condition);
		$this->db->limit(1);
		return $query = $this->db->get();		
	}
	
	// get current contacts by id
	 public function read_contact_info_current($id) {
	
		$this->db->select('*');
		$this->db->where('contact_id', $id);
		$this->db->where('contact_type', 'current');
		$this->db->limit(1);// only apply if you have more than same id in your table othre wise comment this line
		$query = $this->db->get('hrms_employee_contacts');
		$row = $query->row();
		return $row;
		
	}
	
	// get permanent contacts by id
	 public function read_contact_info_permanent($id) {
	
		$this->db->select('*');
		$this->db->where('contact_id', $id);
		$this->db->where('contact_type', 'permanent');
		$this->db->limit(1);// only apply if you have more than same id in your table othre wise comment this line
		$query = $this->db->get('hrms_employee_contacts');
		$row = $query->row();
		return $row;
	}
	
	// Function to update record in table > contract_info_update
	public function contract_info_update($data, $id){
		$this->db->where('contract_id', $id);
		if( $this->db->update('hrms_employee_contract',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > leave_info_add
	public function leave_info_add($data){
		$this->db->insert('hrms_employee_leave', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table > leave_info_update
	public function leave_info_update($data, $id){
		$this->db->where('leave_id', $id);
		if( $this->db->update('hrms_employee_leave',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > shift_info_add
	public function shift_info_add($data){
		$this->db->insert('hrms_employee_shift', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > shift_info_update
	public function shift_info_update($data, $id){
		$this->db->where('emp_shift_id', $id);
		if( $this->db->update('hrms_employee_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to add record in table > location_info_add
	public function location_info_add($data){
		$this->db->insert('hrms_employee_location', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > location_info_update
	public function location_info_update($data, $id){
		$this->db->where('office_location_id', $id);
		if( $this->db->update('hrms_employee_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get all office shifts 
	public function all_office_shifts() {
		$session = $this->session->userdata('username');
	  $query = $this->db->query("SELECT * from hrms_office_shift where company_id=".$session['companyId']);
  	  return $query->result();
	}

	// get all employee type 
	public function all_employee_type() {
	  $query = $this->db->query("SELECT * from hrms_emplyee_type");
  	  return $query->result();
	}
		
	// get contacts
	public function set_employee_contacts($id) {
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_contacts');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get documents
	public function set_employee_documents($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_documents');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get immigration
	public function set_employee_immigration($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_immigration');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get employee qualification
	public function set_employee_qualification($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_qualification');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get employee work experience
	public function set_employee_experience($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_work_experience');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get employee bank account
	public function set_employee_bank_account($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_bankaccount');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	// get employee contract
	public function set_employee_contract($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_contract');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get employee office shift
	public function set_employee_shift($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_shift');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get employee leave
	public function set_employee_leave($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_leave');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	// get employee location
	public function set_employee_location($id) {
	
		$condition = "employee_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_location');
		$this->db->where($condition);
		$this->db->limit(500);
	  return $this->db->get();
	}
	
	 // get document type by id
	 public function read_document_type_information($id) {
	
		$condition = "document_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_document_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// contract type
	public function read_contract_type_information($id) {
	
		$condition = "contract_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_contract_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// contract employee
	public function read_contract_information($id) {
	
		$condition = "contract_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_contract');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// office shift
	public function read_shift_information($id) {
	
		$condition = "office_shift_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_office_shift');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get all contract types
	public function all_contract_types() {
	  $query = $this->db->query("SELECT * from hrms_contract_type");
  	  return $query->result();
	}
	
	// get all contracts
	public function all_contracts() {
	  $query = $this->db->query("SELECT * from hrms_employee_contract");
  	  return $query->result();
	}
	
	// get all contracts by employee
	public function all_employee_contracts($employee_id) {
	  $query = $this->db->query("SELECT * from hrms_employee_contract WHERE employee_id='".$employee_id."'");
  	  return $query->result();
	}
	
	// get all document types
	public function all_document_types() {
	  $query = $this->db->query("SELECT * from hrms_document_type");
  	  return $query->result();
	}
	
	// get all education level
	public function all_education_level() {
	  $query = $this->db->query("SELECT * from hrms_qualification_education_level");
  	  return $query->result();
	}
	
	// get education level by id
	 public function read_education_information($id) {
	
		$condition = "education_level_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_qualification_education_level');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get all qualification languages
	public function all_qualification_language() {
	  $query = $this->db->query("SELECT * from hrms_qualification_language");
  	  return $query->result();
	}
	
	// get languages by id
	 public function read_qualification_language_information($id) {
	
		$condition = "language_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_qualification_language');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get all qualification skills
	public function all_qualification_skill() {
	  $query = $this->db->query("SELECT * from hrms_qualification_skill");
  	  return $query->result();
	} 
	
	// get qualification by id
	 public function read_qualification_skill_information($id) {
	
		$condition = "skill_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_qualification_skill');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get contacts by id
	 public function read_contact_information($id) {
	
		$condition = "contact_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_contacts');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get documents by id
	 public function read_document_information($id) {
	
		$condition = "document_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_documents');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get documents by id
	 public function read_imgdocument_information($id) {
	
		$condition = "immigration_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_immigration');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get qualifications by id
	 public function read_qualification_information($id) {
	
		$condition = "qualification_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_qualification');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get qualifications by id
	 public function read_work_experience_information($id) {
	
		$condition = "work_experience_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_work_experience');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get bank account by id
	 public function read_bank_account_information($id) {
	
		$condition = "bankaccount_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_bankaccount');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get leave by id
	 public function read_leave_information($id) {
	
		$condition = "leave_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_leave');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
		
	// get shift by id
	 public function read_emp_shift_information($id) {
	
		$condition = "emp_shift_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_shift');
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
	public function delete_contact_record($id){
		$this->db->where('contact_id', $id);
		$this->db->delete('hrms_employee_contacts');
		
	}
	
	// Function to Delete selected record from table
	public function delete_document_record($id){
		$this->db->where('document_id', $id);
		$this->db->delete('hrms_employee_documents');
		
	}
	
	// Function to Delete selected record from table
	public function delete_imgdocument_record($id){
		$this->db->where('immigration_id', $id);
		$this->db->delete('hrms_employee_immigration');
		
	}
	
	// Function to Delete selected record from table
	public function delete_qualification_record($id){
		$this->db->where('qualification_id', $id);
		$this->db->delete('hrms_employee_qualification');
		
	}
	
	// Function to Delete selected record from table
	public function delete_work_experience_record($id){
		$this->db->where('work_experience_id', $id);
		$this->db->delete('hrms_employee_work_experience');
		
	}
	
	// Function to Delete selected record from table
	public function delete_bank_account_record($id){
		$this->db->where('bankaccount_id', $id);
		$this->db->delete('hrms_employee_bankaccount');
		
	}
	
	// Function to Delete selected record from table
	public function delete_contract_record($id){
		$this->db->where('contract_id', $id);
		$this->db->delete('hrms_employee_contract');
		
	}
	
	// Function to Delete selected record from table
	public function delete_leave_record($id){
		$this->db->where('leave_id', $id);
		$this->db->delete('hrms_employee_leave');
		
	}
	
	// Function to Delete selected record from table
	public function delete_shift_record($id){
		$this->db->where('emp_shift_id', $id);
		$this->db->delete('hrms_employee_shift');
		
	}
	
	// Function to Delete selected record from table
	public function delete_location_record($id){
		$this->db->where('office_location_id', $id);
		$this->db->delete('hrms_employee_location');
		
	}
	
	// get location by id
	 public function read_location_information($id) {
	
		$condition = "office_location_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_location');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// get employee all leaves count
	public function all_leaves_count($employee_id) {
	  $query = $this->db->query("SELECT SUM(casual_leave) AS casual_leave, SUM(medical_leave) AS medical_leave from hrms_employee_leave WHERE employee_id='".$employee_id."'");
  	  return $query->result();
	}
		 
	 public function read_employees_by_designation($id) {
	
		$condition = "designation_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employees');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
 
 	// get all employes
	public function get_no_work_reminder() {
	  return $this->db->get("hrms_employee_have_work");
	}

	// get all employes by compnay
	public function get_no_work_reminderByCmp() {
		$session = $this->session->userdata('username'); 
	  $query = $this->db->query("SELECT hrms_employee_have_work.* from hrms_employee_have_work inner join hrms_employees on `hrms_employees`.`user_id` = `hrms_employee_have_work`.`employee_id` where `hrms_employees`.`company_id` =".$session['companyId']);
	return $query->result();
	}
	
	// Function to Delete selected record from table
	public function delete_no_work_record($id){
		$this->db->where('have_word_id', $id);
		$this->db->delete('hrms_employee_have_work');
		
	}
		 
	 public function read_medical_convocation($employee_id) {
	
		$condition = "employee_id =" . "'" . $employee_id . "'";
		$this->db->select('*');
		$this->db->from('hrms_employee_medical_convocation');
		$this->db->where($condition);
		$this->db->limit(1);
		$this->db->order_by('convocation_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Function to add record in table
	public function add_medical_convocation($data){
		$this->db->insert('hrms_employee_medical_convocation', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function update_medical_convocation($data, $convocation_id){
		$this->db->where('convocation_id', $convocation_id);
		if( $this->db->update('hrms_employee_medical_convocation', $data)) {
			return true;
		} else {
			return false;
		}
	}
 
 	// get all employes
	public function get_feedback() {
	  return $this->db->get("hrms_employee_feedback");
	}
	// get all employes by company
	public function get_feedbackByCmp() {
	  $session = $this->session->userdata('username'); 

	$query = $this->db->query("SELECT hrms_employee_feedback.* from hrms_employee_feedback inner join hrms_employees on `hrms_employees`.`user_id` = `hrms_employee_feedback`.`employee_id` where `hrms_employees`.`company_id` =".$session['companyId']);
	return $query->result();
	}
	
	// Function to Delete selected record from table
	public function delete_feedback_record($id){
		$this->db->where('feedback_id', $id);
		$this->db->delete('hrms_employee_feedback');
		
	}

}

?>