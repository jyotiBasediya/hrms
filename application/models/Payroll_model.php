<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class payroll_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	// get payroll templates
	public function get_templates() {
	  return $this->db->get("hrms_salary_templates");
	}
 // get payroll templates
	public function get_templatesByCmp() {

		$session = $this->session->userdata('username'); 
		$this->db->where('company_id', $session['companyId']);
 		$query = $this->db->get('hrms_salary_templates');
 		return $query->result();
 		return $query->num_rows();
	}
	// get payroll templates
	public function get_benefits() {
	  return $this->db->get("hrms_benefits");
	}
	
	// get payroll templates
	public function get_benefitsByCmp() {
	$session = $this->session->userdata('username');
	$sql = "select hrms_benefits.* from hrms_benefits inner join hrms_employees on hrms_employees.user_id = hrms_benefits.employee_id where hrms_employees.company_id =".$session['companyId']; 

	   $query = $this->db->query($sql);
	  return $query->result();
	}

	// get payroll templates
	public function get_employee_template($id) {

		$this->db->where('user_id', $id);
 		$query = $this->db->get('hrms_employees');
 		return $query->result();
 		return $query->num_rows();
	}
	
	// get total hours work > hourly template > payroll generate
	public function total_hours_worked($id,$attendance_date) {
		return $query = $this->db->query("SELECT * from hrms_attendance_time where employee_id='".$id."' and attendance_date='".$attendance_date."'");
	}
	
	// get payment history > all payslips
	public function all_payment_history() {
	  return $this->db->get("hrms_make_payment");
	}
	// get payment history > all payslips
	public function all_payment_historyByCmp() {
		$session = $this->session->userdata('username');
		$sql = "select hrms_make_payment.* from hrms_make_payment inner join hrms_employees on hrms_employees.user_id = hrms_make_payment.employee_id where hrms_employees.company_id =".$session['companyId'];
	  
	   $query = $this->db->query($sql);
	  return $query->result();
	}
	
	// get payslips of single employee
	public function get_payroll_slip($id) {
		return $query = $this->db->query("SELECT * from hrms_make_payment where employee_id='".$id."'");
	}
	
	// get hourly wages
	public function get_hourly_wages()
	{
	  return $this->db->get("hrms_hourly_templates");
	}
	 public function get_hourly_wagesByCmp()
	{
	  $session = $this->session->userdata('username'); 
		$this->db->where('company_id', $session['companyId']);
 		$query = $this->db->get('hrms_hourly_templates');
 		return $query->result();
 		return $query->num_rows();
	}
	 public function read_template_information($id) {
	
		$condition = "salary_template_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_salary_templates');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	 
	 public function read_benefit_information($id) {
	
		$condition = "benefit_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_benefits');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function read_hourly_wage_information($id) {
	
		$condition = "hourly_rate_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_hourly_templates');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function read_make_payment_information($id) {
	
		$condition = "make_payment_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_make_payment');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
	// Function to add record in table
	public function add_template($data){
		$this->db->insert('hrms_salary_templates', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	// Function to add record in table
	public function add_benefit($data){
		$this->db->insert('hrms_benefits', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_hourly_wages($data){
		$this->db->insert('hrms_hourly_templates', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_monthly_payment_payslip($data){
		$this->db->insert('hrms_make_payment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_hourly_payment_payslip($data){
		$this->db->insert('hrms_make_payment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_template_record($id){
		$this->db->where('salary_template_id', $id);
		$this->db->delete('hrms_salary_templates');
		
	}
	
	// Function to Delete selected record from table
	public function delete_benefit_record($id){
		$this->db->where('benefit_id', $id);
		$this->db->delete('hrms_benefits');
		
	}
	
	// Function to Delete selected record from table
	public function delete_hourly_wage_record($id){
		$this->db->where('hourly_rate_id', $id);
		$this->db->delete('hrms_hourly_templates');
		
	}
	
	// Function to update record in table
	public function update_template_record($data, $id){
		$this->db->where('salary_template_id', $id);
		if( $this->db->update('hrms_salary_templates',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_benefit_record($data, $id){
		$this->db->where('benefit_id', $id);
		if( $this->db->update('hrms_benefits',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get all hourly templates
	public function all_hourly_templates()
	{
	  $query = $this->db->query("SELECT * from hrms_hourly_templates");
  	  return $query->result();
	}

	// get all hourly templates
	public function all_hourly_templatesByCmp()
	{
	  $session = $this->session->userdata('username'); 
	  $query = $this->db->query("SELECT * from hrms_hourly_templates where company_id =".$session['companyId']);
  	  return $query->result();
	}
	
	// get all salary tempaltes > payroll templates
	public function all_salary_templates()
	{
		$session = $this->session->userdata('username'); 
	  $query = $this->db->query("SELECT * from hrms_salary_templates where company_id =".$session['companyId']);
  	  return $query->result();
	}

	// get all salary tempaltes > payroll templates
	public function all_salary_templatesByCmp()
	{
	  $query = $this->db->query("SELECT * from hrms_salary_templates");
  	  return $query->result();
	}
	
	// get all benefit types
	public function all_benefit_types()
	{
	  $query = $this->db->query("SELECT * from hrms_benefits_type");
  	  return $query->result();
	}
	
	// Function to update record in table
	public function update_hourly_wages_record($data, $id){
		$this->db->where('hourly_rate_id', $id);
		if( $this->db->update('hrms_hourly_templates',$data)) {
			return true;
		} else {
			return false;
		}		
	}	
	
	// Function to update record in table > manage salary
	public function update_salary_template($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > empty grade status
	public function update_empty_salary_template($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > set hourly grade
	public function update_hourlygrade_salary_template($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > set monthly grade
	public function update_monthlygrade_salary_template($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table > zero hourly grade
	public function update_hourlygrade_zero($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	// Function to update record in table > zero monthly grade
	public function update_monthlygrade_zero($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('hrms_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function read_make_payment_payslip_check($employee_id,$p_date) {
	
		$condition = "employee_id =" . "'" . $employee_id . "' and payment_date =" . "'" . $p_date . "'";
		$this->db->select('*');
		$this->db->from('hrms_make_payment');
		$this->db->where($condition);
		$this->db->limit(10000);
		return $query = $this->db->get();
		
		//return $query->result();
	}
	
	public function read_make_payment_payslip($employee_id,$p_date) {
	
		$condition = "employee_id =" . "'" . $employee_id . "' and payment_date =" . "'" . $p_date . "'";
		$this->db->select('*');
		$this->db->from('hrms_make_payment');
		$this->db->where($condition);
		$this->db->limit(10000);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function read_benefit_type($benefit_type_id) {
	
		$condition = "benefit_type_id =" . "'" . $benefit_type_id . "'";
		$this->db->select('*');
		$this->db->from('hrms_benefits_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

}

?>