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
 * @package  iLinkHR - Performance
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Performance_model");
		$this->load->model("Hrms_model");
		$this->load->model("Timesheet_model");
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
		$data['breadcrumbs'] = 'Performance';
		$data['path_url'] = 'performance';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('15',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("performance/performance_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
	}

	public function performance_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("awards/award_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$tasks = $this->Performance_model->get_performances();

		$data = array();

		foreach($tasks->result() as $r) {
			 			  
			// get user > added by
			$user = $this->Hrms_model->read_user_info($r->user_id);
			// user full name
			$performance_by = $user[0]->first_name.' '.$user[0]->last_name;

			// get tasks type
			$task_detail = $this->Timesheet_model->read_task_information($r->task_id);

			$task_employees = explode(',', $task_detail[0]->assigned_to);

			$employees = '<ol>';
			foreach ($task_employees as $task_employee) {
				$employee = $this->Hrms_model->read_user_info($task_employee);
				$employees .= '<li>'.$employee[0]->first_name.' '.$employee[0]->last_name.'</li>';
			}
			$employees .= '</ol>';

					
			$data[] = array(
				$employees,
				$task_detail[0]->task_name,
				$r->task_comments,
				$performance_by,
				date('Y-m-d h:i a', strtotime($r->created_at)),
			);
		}

		$output = array(
		   "draw" => $draw,
			 "recordsTotal" => $tasks->num_rows(),
			 "recordsFiltered" => $tasks->num_rows(),
			 "data" => $data
		);
		echo json_encode($output);
		exit();
	}
	
	public function appraisal_applications()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$data['breadcrumbs'] = 'Appraisal Application';
		$data['path_url'] = 'appraisal_application';
		$session = $this->session->userdata('username');
		$data['all_employees'] = $this->Hrms_model->all_employees();
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('15',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("performance/appraisal_applications", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
	}

	public function appraisal_applications_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("performance/appraisal_applications", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$tasks = $this->Performance_model->get_appraisal_applications();

		$data = array();

		foreach($tasks->result() as $r) {
			 			  
			// get user > added by
			$user = $this->Hrms_model->read_user_info($r->user_id);
			// user full name
			$applied_by = $user[0]->first_name.' '.$user[0]->last_name;

			$designation = $this->Hrms_model->read_designation_info($r->user_id);

			switch ($r->promotion) {
				case 1:
					$promotion = 'Yes';
					break;
				case 2:
					$promotion = 'No';
					break;				
				default:
					$promotion = 'No';
					break;
			}

			switch ($r->apply_status) {
				case 0:
					$apply_status = 'Pending';
					break;
				case 1:
					$apply_status = 'Approved';
					break;
				case 2:
					$apply_status = 'Rejected';
					break;
				default:
					$apply_status = 'Error';
					break;
			}
					
			$data[] = array(
				'<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->appraisal_id . '"><i class="fa fa-trash-o"></i></button></span>',
				$applied_by,
				$r->name,
				$designation[0]->designation_name,
				$r->last_appraisal_date,
				$r->expected_appraisal_date,
				$r->current_salary,
				$r->expected_salary,
				$promotion,
				$apply_status,
				date('Y-m-d h:i a', strtotime($r->apply_date)),
			);
		}

		$output = array(
		   "draw" => $draw,
			 "recordsTotal" => $tasks->num_rows(),
			 "recordsFiltered" => $tasks->num_rows(),
			 "data" => $data
		);
		echo json_encode($output);
		exit();
	}
	
	public function delete_performance_application() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Performance_model->delete_performance_application($id);
		if(isset($id)) {
			$Return['result'] = 'Performance Application deleted.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}

}
