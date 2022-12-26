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
 * @package  iLinkHR - Probations
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Probations extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Probations_model");
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
        $session = $this->session->userdata('username'); 

		$data['title'] = $this->Hrms_model->site_title();
		$data['all_employees'] = $this->Hrms_model->all_employees_byCmpId($session['companyId']);
		$data['breadcrumbs'] = 'Probations';
		$data['path_url'] = 'probations';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('15',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("probations/probations_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
	}
 
    public function probation_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');

		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		// $probation = $this->Probations_model->get_probations();
		$probation = $this->Probations_model->get_probationsByCmpId();
		
		$data = array();

          foreach($probation as $p) {
			 			  
		// get user > added by
		$user = $this->Hrms_model->read_user_info($p->employee_id);
		// user full name
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;

		switch ($p->result) {
			case 0:
				$result = 'Pending';
				break;
			case 1:
				$result = 'Pass';
				break;
			case 2:
				$result = 'Fail';
				break;
			default:
				$result = 'Error';
				break;
		}
				
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-probation_id="'. $p->probation_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $p->probation_id . '"><i class="fa fa-trash-o"></i></button></span>',
			$user[0]->employee_id,
			$full_name,
			$p->start_date,
			$p->end_date,
			$result,
			$p->description,
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => count($probation),
			 "recordsFiltered" => count($probation),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	public function read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('probation_id');
		$result = $this->Probations_model->read_probation_information($id);
		$data = array(
				'probation_id' => $result[0]->probation_id,
				'employee_id' => $result[0]->employee_id,
				'start_date' => $result[0]->start_date,
				'end_date' => $result[0]->end_date,
				'result' => $result[0]->result,
				'description' => $result[0]->description,
				'created_at' => $result[0]->created_at,
				'all_employees' => $this->Hrms_model->all_employees(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('probations/dialog_probation', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_probation() {

		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('employee_id')==='') {
			$Return['error'] = "The employee field is required.";
		} else if($this->input->post('start_date')==='') {
			$Return['error'] = "The start date field is required.";
		} else if($this->input->post('end_date')==='') {
			$Return['error'] = "The end date field is required.";
		} else if($this->input->post('description')==='') {
			$Return['error'] = "The probation description field is required.";
		} else {

 		$session = $this->session->userdata('username'); 
			$data = array(
				'employee_id' => $this->input->post('employee_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'description' => $this->input->post('description'),
				'result' => 0,
				'compnay_id' => $session['companyId'],
				'created_at' => date('Y-m-d H:i:s'),
			);
			
			$result = $this->Probations_model->add($data);
			
			if ($result == TRUE) {
				$Return['result'] = 'Probation added.';
			} else {
				$Return['error'] = 'Bug. Something went wrong, please try again.';
			}

			$this->output($Return);
			exit;	

		}
			
		if($Return['error']!=''){
			$this->output($Return);
		}

	}
	
	// Validate and update info in database
	public function update() {

		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('employee_id')==='') {
        $Return['error'] = "The employee field is required.";
		} else if($this->input->post('start_date')==='') {
			$Return['error'] = "The start date field is required.";
		} else if($this->input->post('end_date')==='') {
			$Return['error'] = "The end date field is required.";
		} else if($this->input->post('description')==='') {
			$Return['error'] = "The description field is required.";
		} else {

			$data = array(
				'employee_id' => $this->input->post('employee_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'description' => $this->input->post('description'),
				'result' => $this->input->post('result'),
			);

			$result = $this->Probations_model->update_record($data,$id);
			 
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		
		if ($result == TRUE) {
			$Return['result'] = 'Probation updated.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}

		$this->output($Return);
		exit;

	}
	
	public function delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Probations_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = 'Probation deleted.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}
}
