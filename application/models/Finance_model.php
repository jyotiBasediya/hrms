<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function all_project_cost_sum($year, $month)
	{
		$condition = "YEAR(created_at) = '".$year."' AND MONTH(created_at)='".$month."'";
		$this->db->select('SUM(cost) AS cost');
		$this->db->from('hrms_projects');
		$this->db->where($condition);
		return $this->db->get()->result();
	}
 
	public function all_salary_paid_sum($year, $month)
	{
		$condition = "SUBSTRING_INDEX(payment_date, '-', 1) = '".$year."' AND SUBSTRING_INDEX(payment_date, '-', -1)='".$month."'";
		$this->db->select('SUM(net_salary) AS salary');
		$this->db->from('hrms_make_payment');
		$this->db->where($condition);
		return $this->db->get()->result();
	}
 
	public function all_benefits_paid_sum($year, $month)
	{
		$condition = "SUBSTRING_INDEX(start_date, '-', 1)='".$year."' AND SUBSTRING_INDEX(SUBSTRING_INDEX(start_date,'-',2),'-',-1)='".$month."'";
		$this->db->select('SUM(amount) AS benefit');
		$this->db->from('hrms_benefits');
		$this->db->where($condition);
		return $this->db->get()->result();
	}
 
	public function all_traveling_paid_sum($year, $month)
	{
		$condition = "SUBSTRING_INDEX(start_date, '-', 1)='".$year."' AND SUBSTRING_INDEX(SUBSTRING_INDEX(start_date,'-',2),'-',-1)='".$month."'";
		$this->db->select('SUM(actual_budget) AS travel');
		$this->db->from('hrms_employee_travels');
		$this->db->where($condition);
		return $this->db->get()->result();
	}
 
	public function all_award_paid_sum($year, $month)
	{
		$condition = " SUBSTRING_INDEX(award_month_year, '-', 1)='".$year."' AND SUBSTRING_INDEX(SUBSTRING_INDEX(award_month_year,'-',2),'-',-1)='".$month."'";
		$this->db->select('SUM(cash_price) AS award');
		$this->db->from('hrms_awards');
		$this->db->where($condition);
		return $this->db->get()->result();
	}

}
?>