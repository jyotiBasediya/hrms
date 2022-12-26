<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class timesheet_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	// get office shifts
	public function get_office_shifts() {
		 return $this->db->get("hrms_office_shift");
	}

	public function get_office_shiftsByCmp() {

		$session = $this->session->userdata('username'); 
		$cmpid = $session['companyId'];
		$query = $this->db->query("SELECT * from hrms_office_shift  where `company_id` =".$cmpid);
		return $query->result();
	}
	
	// get all tasks
	public function get_tasks() {
	  return $this->db->get("hrms_tasks");
	}

	// get all tasks by compny id
	public function get_tasks_byCmp() {
		$session = $this->session->userdata('username'); 
		$cmpid = $session['companyId'];
		$query = $this->db->query("SELECT * from hrms_tasks inner join hrms_projects on `hrms_projects`.`project_id` = `hrms_tasks`.`task_id` where `hrms_projects`.`company_id` =".$cmpid);
		return $query->result();
	}
		
	// get all user attentdance
	public function get_user_attendance($employee_id, $attendance_date) {
	
		$condition = "employee_id =" . "'" . $employee_id . "' and attendance_date =" . "'" . $attendance_date . "'";
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		return $query = $this->db->get()->result();
	}
		
	// check if check-in available
	public function attendance_first_in_check($employee_id,$attendance_date) {
	
		$condition = "employee_id =" . "'" . $employee_id . "' and attendance_date =" . "'" . $attendance_date . "'";
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		$this->db->limit(1);
		return $query = $this->db->get();
	}
	
	// get user attendance
	public function attendance_time_check($employee_id) {
	
		$condition = "employee_id =" . "'" . $employee_id . "'";
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// check if check-in available
	public function attendance_first_in($employee_id,$attendance_date) {
	
		//$condition = "employee_id =" . "'" . $employee_id . "' and attendance_date =" . "'" . $attendance_date . "'";
		$condition = array('employee_id' => $employee_id, 'attendance_date' => $attendance_date);
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// check if check-out available
	public function attendance_first_out_check($employee_id,$attendance_date) {
	
		$this->db->order_by("time_attendance_id","desc");
		$condition = "employee_id =" . "'" . $employee_id . "' and attendance_date =" . "'" . $attendance_date . "'";
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		
		$this->db->limit(1);
		return $query = $this->db->get();
	}
	
	// get leave types
	public function all_leave_types() {
	  $query = $this->db->get("hrms_leave_type");
	  return $query->result();
	}
	
	// check if check-out available
	public function attendance_first_out($employee_id,$attendance_date) {
	
		$this->db->order_by("time_attendance_id","desc");
		$condition = array('employee_id' => $employee_id, 'attendance_date' => $attendance_date);
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get total hours work > attendance
	public function total_hours_worked_attendance($id,$attendance_date) {
		return $query = $this->db->query("SELECT * from hrms_attendance_time where employee_id='".$id."' and attendance_date='".$attendance_date."' and total_work!=''");
	}
	
	// get total rest > attendance
	public function total_rest_attendance($id,$attendance_date) {
		return $query = $this->db->query("SELECT * from hrms_attendance_time where employee_id='".$id."' and attendance_date='".$attendance_date."' and total_rest!=''");
	}
	
	// check if holiday available
	public function holiday_date_check($attendance_date) {
	
		//$condition = "(start_date between start_date and end_date) or (start_date = '".$attendance_date."' or end_date = '".$attendance_date."')";
		$condition = "('".$attendance_date."' between start_date and end_date)";
		$this->db->select('*');
		$this->db->from('hrms_holidays');
		$this->db->where($condition);
		
		$this->db->limit(1);
		return $query = $this->db->get();
	}
	
	// get all leaves
	public function get_leaves() {
	  return $this->db->get("hrms_leave_applications");
	}
	
	// get all employee leaves
	public function get_employee_leaves($id) {
	 return $query = $this->db->query("SELECT * from hrms_leave_applications where employee_id='".$id."'");
	}
	
	// check if holiday available
	public function holiday_date($attendance_date) {
	
		$condition = "('".$attendance_date."' between start_date and end_date)";
		$this->db->select('*');
		$this->db->from('hrms_holidays');
		$this->db->where($condition);
		
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get all holidays
	public function get_holidays() {
	  return $this->db->get("hrms_holidays");
	}
	public function get_holidaysByCmp() {
		$session = $this->session->userdata('username'); 

		$condition = "company_id =" . "'" . $session['companyId'] . "'";
		$this->db->select('*');
		$this->db->from('hrms_holidays');
		$this->db->where($condition);
		
	  $query = $this->db->get();
	  return $query->result();
	}
	// check if leave available
	public function leave_date_check($emp_id,$attendance_date) {
	
		$condition = "(from_date between from_date and to_date) and employee_id = '".$emp_id."' or from_date = '".$attendance_date."' and to_date = '".$attendance_date."'";
		$this->db->select('*');
		$this->db->from('hrms_leave_applications');
		$this->db->where($condition);
		
		$this->db->limit(1);
		return $query = $this->db->get();
	}
	
	// check if leave available
	public function leave_date($emp_id,$attendance_date) {
	
		$condition = "(from_date between from_date and to_date) and employee_id = '".$emp_id."' or from_date = '".$attendance_date."' and to_date = '".$attendance_date."'";
		$this->db->select('*');
		$this->db->from('hrms_leave_applications');
		$this->db->where($condition);
		
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get total number of leave > employee
	public function count_total_leaves($leave_type_id,$employee_id) {
		return $this->db->query("SELECT * from hrms_leave_applications where employee_id = '".$employee_id."' and leave_type_id='".$leave_type_id."'")->result_array();
		//return $query->num_rows();
	}
	
	
	// get payroll templates > NOT USED
	public function attendance_employee_with_date($emp_id,$attendance_date) {
		return $query = $this->db->query("SELECT * from hrms_attendance_time where attendance_date = '".$attendance_date."' and employee_id = '".$emp_id."'");
	}
		 
	 // get record of office shift > by id
	 public function read_office_shift_information($id) {
	
		$condition = "office_shift_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_office_shift');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get record of leave > by id
	 public function read_leave_information($id) {
	
		$condition = "leave_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_leave_applications');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get leave type by id
	public function read_leave_type_information($id) {
	
		$condition = "leave_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_leave_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// Function to add record in table
	public function add_employee_attendance($data){
		$this->db->insert('hrms_attendance_time', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_leave_record($data){
		$this->db->insert('hrms_leave_applications', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_task_record($data){
		$this->db->insert('hrms_tasks', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_office_shift_record($data){
		$this->db->insert('hrms_office_shift', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to add record in table
	public function add_holiday_record($data){
		$this->db->insert('hrms_holidays', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// get record of task by id
	 public function read_task_information($id) {
	
		$condition = "task_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_tasks');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get record of holiday by id
	 public function read_holiday_information($id) {
	
		$condition = "holiday_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_holidays');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// get record of attendance by id
	 public function read_attendance_information($id) {
	
		$condition = "time_attendance_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_attendance_time');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	// Function to Delete selected record from table
	public function delete_attendance_record($id){ 
		$this->db->where('time_attendance_id', $id);
		$this->db->delete('hrms_attendance_time');
		
	}
	
	// Function to Delete selected record from table
	public function delete_task_record($id){ 
		$this->db->where('task_id', $id);
		$this->db->delete('hrms_tasks');
		
	}
	
	// Function to Delete selected record from table
	public function delete_holiday_record($id){ 
		$this->db->where('holiday_id', $id);
		$this->db->delete('hrms_holidays');
		
	}
	
	// Function to Delete selected record from table
	public function delete_shift_record($id){ 
		$this->db->where('office_shift_id', $id);
		$this->db->delete('hrms_office_shift');
		
	}
	
	// Function to Delete selected record from table
	public function delete_leave_record($id){ 
		$this->db->where('leave_id', $id);
		$this->db->delete('hrms_leave_applications');
		
	}
	
	// Function to update record in table
	public function update_task_record($data, $id){
		$this->db->where('task_id', $id);
		if( $this->db->update('hrms_tasks',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_leave_record($data, $id){
		$this->db->where('leave_id', $id);
		if( $this->db->update('hrms_leave_applications',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_holiday_record($data, $id){
		$this->db->where('holiday_id', $id);
		if( $this->db->update('hrms_holidays',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_attendance_record($data, $id){
		$this->db->where('time_attendance_id', $id);
		if( $this->db->update('hrms_attendance_time',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_shift_record($data, $id){
		$this->db->where('office_shift_id', $id);
		if( $this->db->update('hrms_office_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}	
	
	// Function to update record in table
	public function update_default_shift_record($data, $id){
		$this->db->where('office_shift_id', $id);
		if( $this->db->update('hrms_office_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function update_default_shift_zero($data){
		$this->db->where("office_shift_id!=''");
		if( $this->db->update('hrms_office_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Function to update record in table
	public function assign_task_user($data, $id){
		$this->db->where('task_id', $id);
		if( $this->db->update('hrms_tasks',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// get comments
	public function get_comments($id) {
		return $query = $this->db->query("SELECT * from hrms_tasks_comments where task_id = '".$id."'");
	}
	
	// get comments
	public function get_attachments($id) {
		return $query = $this->db->query("SELECT * from hrms_tasks_attachment where task_id = '".$id."'");
	}
	
	// Function to add record in table > add comment
	public function add_comment($data){
		$this->db->insert('hrms_tasks_comments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_comment_record($id){
		$this->db->where('comment_id', $id);
		$this->db->delete('hrms_tasks_comments');
		
	}
	
	// Function to Delete selected record from table
	public function delete_attachment_record($id){
		$this->db->where('task_attachment_id', $id);
		$this->db->delete('hrms_tasks_attachment');
		
	}
	
	// Function to add record in table > add attachment
	public function add_new_attachment($data){
		$this->db->insert('hrms_tasks_attachment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// check user attendance 
	public function check_user_attendance() {
		$today_date = date('Y-m-d');
		$session = $this->session->userdata('username');
		return $query = $this->db->query("SELECT * FROM hrms_attendance_time where `employee_id` = '".$session['user_id']."' and `attendance_date` = '".$today_date."' order by time_attendance_id desc limit 1");
	}
	
	// check user attendance 
	public function check_user_attendance_clockout() {
		$today_date = date('Y-m-d');
		$session = $this->session->userdata('username');
		return $query = $this->db->query("SELECT * FROM hrms_attendance_time where `employee_id` = '".$session['user_id']."' and `attendance_date` = '".$today_date."' and clock_out='' order by time_attendance_id desc limit 1");
	}
	
	//  set clock in- attendance > user
	public function add_new_attendance($data){
		$this->db->insert('hrms_attendance_time', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// get last user attendance 
	public function get_last_user_attendance() {

		$session = $this->session->userdata('username');
		$query = $this->db->query("SELECT * FROM hrms_attendance_time where `employee_id` = '".$session['user_id']."' order by time_attendance_id desc limit 1");
		return $query->result();
	}
	
	// get last user attendance > check if loged in-
	public function attendance_time_checks($id) {

		$session = $this->session->userdata('username');
		return $query = $this->db->query("SELECT * FROM hrms_attendance_time where `employee_id` = '".$id."' and clock_out = '' order by time_attendance_id desc limit 1");
	}
	
	// Function to update record in table > update attendace.
	public function update_attendance_clockedout($data){
		$this->db->where("time_attendance_id!=''");
		if( $this->db->update('hrms_attendance_time',$data)) {
			return true;
		} else {
			return false;
		}		
	}
		
	// get all user attentdance
	public function leaves_by_month_year($month, $year) {
	
		$condition = "(MONTH(from_date) ='" . $month . "' OR MONTH(to_date) ='" . $month . "') AND (YEAR(from_date) ='" . $year . "' OR YEAR(to_date) ='" . $year . "')";
		$this->db->select('*');
		$this->db->from('hrms_leave_applications');
		$this->db->where($condition);
		return $query = $this->db->get()->result();
	}
		
	// get all user attentdance
	public function date_wise_leave_detail($leave_date) {
	
		$condition = "'".$leave_date."' BETWEEN from_date AND to_date";
		$this->db->select('*');
		$this->db->from('hrms_leave_applications');
		$this->db->where($condition);
		return $query = $this->db->get();
	}
		
	// get all task queries
	public function get_task_queries($task_id) {
	
		$condition = "task_id = '".$task_id."'";
		$this->db->select('*');
		$this->db->from('hrms_tasks_query');
		$this->db->where($condition);
		return $query = $this->db->get();
	}
}
?>