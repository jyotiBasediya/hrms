<?php
 /**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the iLinkHR License
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.ilinkhr.com/license.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ilinkhr@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * versions in the future. If you wish to customize this extension for your
 * needs please contact us at ilinkhr@gmail.com for more information.
 *
 * @author   Mian Abdullah Jan - iLinkHR
 * @package  iLinkHR - Finance
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Finance_model");
		$this->load->model("Hrms_model");
	}
	
	/*Function to set JSON output*/
	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}
	
	public function index()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$data['all_employees'] = $this->Hrms_model->all_employees();
		$data['breadcrumbs'] = 'Finance';
		$data['path_url'] = 'finance';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('15',$role_resources_ids)) {
			if(!empty($session)){ 			

				for ($t = 12; $t >= 1; $t--) {
					$months[] = date("Y-m", strtotime( date( 'Y-m-1' )." -$t months"));
				}

				$graph = [];

				foreach ($months as $m) {
					$date = explode('-', $m);

					$project_credit = $this->Finance_model->all_project_cost_sum($date[0], $date[1]);
					$project = ($project_credit[0]->cost != '') ? $project_credit[0]->cost : 0;
					//echo $this->db->last_query();

					$salary_paid = $this->Finance_model->all_salary_paid_sum($date[0], $date[1]);
					$salary = ($salary_paid[0]->salary != '') ? $salary_paid[0]->salary : 0;

					$benefits_paid = $this->Finance_model->all_benefits_paid_sum($date[0], $date[1]);
					$benefit = ($benefits_paid[0]->benefit != '') ? $benefits_paid[0]->benefit : 0;

					$travel_paid = $this->Finance_model->all_traveling_paid_sum($date[0], $date[1]);
					$travel = ($travel_paid[0]->travel != '') ? $travel_paid[0]->travel : 0;

					$award_paid = $this->Finance_model->all_award_paid_sum($date[0], $date[1]);
					$award = ($award_paid[0]->award != '') ? $award_paid[0]->award : 0;

					$pnl = $project - ($salary + $benefit + $travel + $award);

					$graph[] = $pnl;

				}

				//print_r($graph);

				$data['pnlGraphData'] = $graph;

				$data['subview'] = $this->load->view("finance/finance_list", $data, TRUE);	

				$this->load->view('layout_main', $data);
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
	}

	public function finance_history()
	{
		if($this->input->post()){
			$finance_month = $this->input->post('finance_month');
		} else {
			$finance_month = date('Y-m');
		}

		$finance_date = explode('-', $finance_month);

		$project_credit = $this->Finance_model->all_project_cost_sum($finance_date[0], $finance_date[1]);
		$project = ($project_credit[0]->cost != '') ? $project_credit[0]->cost : 0;
		$data['project'] = $this->Hrms_model->currency_sign(number_format($project));

		$salary_paid = $this->Finance_model->all_salary_paid_sum($finance_date[0], $finance_date[1]);
		$salary = ($salary_paid[0]->salary != '') ? $salary_paid[0]->salary : 0;
		$data['salary'] = $this->Hrms_model->currency_sign(number_format($salary));

		$benefits_paid = $this->Finance_model->all_benefits_paid_sum($finance_date[0], $finance_date[1]);
		$benefit = ($benefits_paid[0]->benefit != '') ? $benefits_paid[0]->benefit : 0;
		$data['benefit'] = $this->Hrms_model->currency_sign(number_format($benefit));

		$travel_paid = $this->Finance_model->all_traveling_paid_sum($finance_date[0], $finance_date[1]);
		$travel = ($travel_paid[0]->travel != '') ? $travel_paid[0]->travel : 0;
		$data['travel'] = $this->Hrms_model->currency_sign(number_format($travel));

		$award_paid = $this->Finance_model->all_award_paid_sum($finance_date[0], $finance_date[1]);
		$award = ($award_paid[0]->award != '') ? $award_paid[0]->award : 0;
		$data['award'] = $this->Hrms_model->currency_sign(number_format($award));

		$pnl = $project - ($salary + $benefit + $travel + $award);
		$data['pnl'] = $this->Hrms_model->currency_sign(number_format($pnl));

		$data['month'] = date('M Y', strtotime($finance_month));

		echo json_encode($data);
		exit();
	}
}