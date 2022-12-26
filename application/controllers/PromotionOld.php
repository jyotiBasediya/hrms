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
 * @package  iLinkHR - Promotion
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Promotion_model");
		$this->load->model("Hrms_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		
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
		$data['all_locations'] = $this->Hrms_model->get_locationsByCmy();
		$data['all_departments'] = $this->Department_model->all_departmentsBycmp();
		$data['breadcrumbs'] = 'Promotions';
		$data['path_url'] = 'promotion';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('20',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("promotion/promotion_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
     }
 
    public function promotion_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("promotion/promotion_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$promotion = $this->Promotion_model->get_promotionsByCmp();
		
		$data = array();

          foreach($promotion as $r) {
			 			  
		// get user > added by
		$user = $this->Hrms_model->read_user_info($r->added_by);
		// user full name
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		
		// get user > employee_
		$employee = $this->Hrms_model->read_user_info($r->employee_id);
		// employee full name
		$employee_name = $employee[0]->first_name.' '.$employee[0]->last_name;
		// get promotion date
		$promotion_date = $this->Hrms_model->set_date_format($r->promotion_date);
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-promotion_id="'. $r->promotion_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-promotion_id="'. $r->promotion_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->promotion_id . '"><i class="fa fa-trash-o"></i></button></span>',
			$employee_name,
			$r->title,
			$promotion_date,
			$full_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => count($promotion),
			 "recordsFiltered" => count($promotion),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 public function read()
	{
		$session = $this->session->userdata('username');
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('promotion_id');
		$result = $this->Promotion_model->read_promotion_information($id);
		$data = array(
				'promotion_id' => $result[0]->promotion_id,
				'employee_id' => $result[0]->employee_id,
				'title' => $result[0]->title,
				'promotion_date' => $result[0]->promotion_date,
				'description' => $result[0]->description,

				'transferfrom' => $result[0]->location_from,
				'transfer_location' => $result[0]->location_To,
				'transfer_department' => $result[0]->department_to,
				'department_from' => $result[0]->department_from,
				'designation_to' => $result[0]->designation_to,
				'designation_from' => $result[0]->designation_from,
				

				'all_employees' => $this->Hrms_model->all_employees_byCmpId($session['companyId']),
				'all_locations' => $this->Hrms_model->get_locationsByCmy(),
				'all_departments' => $this->Department_model->all_departmentsBycmp(),
				'all_designationFrom' => $this->Designation_model->designation_byDept($result[0]->location_from),
				'all_designationTo' => $this->Designation_model->designation_byDept($result[0]->department_to),
				);
			
		if(!empty($session)){ 
			$this->load->view('promotion/dialog_promotion', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_promotion() {
	
		if($this->input->post('add_type')=='promotion') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('employee_id')==='') {
       		 $Return['error'] = "The employee field is required.";
		} else if($this->input->post('title')==='') {
			$Return['error'] = "The title field is required.";
		} else if($this->input->post('promotion_date')==='') {
			 $Return['error'] = "The promotion date field is required.";
		}else if($this->input->post('transfer_department')==='') {
			 $Return['error'] = "The department field is required.";
		} else if($this->input->post('transfer_location')==='') {
       		$Return['error'] = "The location field is required.";
		}else if($this->input->post('transfer_fromlocation')==='') {
       		$Return['error'] = "The location from field is required.";
		}else if($this->input->post('transfer_department_from')==='') {
       		$Return['error'] = "The department from field is required.";
		}else if($this->input->post('transfer_designation_to')==='') {
       		$Return['error'] = "The designation to field is required.";
		}else if($this->input->post('transfer_designation_from')==='') {
       		$Return['error'] = "The designation from field is required.";
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	$session = $this->session->userdata('username');
		$data = array(
		'employee_id' => $this->input->post('employee_id'),
		'company_id' => $session['companyId'],
		'title' => $this->input->post('title'),
		'promotion_date' => $this->input->post('promotion_date'),
		'description' => $qt_description,

		'location_To' => $this->input->post('transfer_location'),
		'location_from' => $this->input->post('transfer_fromlocation'),
		'department_to' => $this->input->post('transfer_department'),
		'department_from' => $this->input->post('transfer_department_from'),
		'designation_to' => $this->input->post('transfer_designation_to'),
		'designation_from' => $this->input->post('transfer_designation_from'),

		'added_by' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		
		);
		$result = $this->Promotion_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = 'Promotion added.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='promotion') {
			
		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('employee_id')==='') {
       		 $Return['error'] = "The employee field is required.";
		} else if($this->input->post('title')==='') {
			$Return['error'] = "The title field is required.";
		} else if($this->input->post('promotion_date')==='') {
			 $Return['error'] = "The promotion date field is required.";
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'employee_id' => $this->input->post('employee_id'),
		'title' => $this->input->post('title'),
		'promotion_date' => $this->input->post('promotion_date'),
		'description' => $qt_description,	
		
		'location_To' => $this->input->post('transfer_location'),
		'location_from' => $this->input->post('transfer_fromlocation'),
		'department_to' => $this->input->post('transfer_department'),
		'department_from' => $this->input->post('transfer_department_from'),
		'designation_to' => $this->input->post('transfer_designation_to'),
		'designation_from' => $this->input->post('transfer_designation_from'),	
		);
		
		$result = $this->Promotion_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = 'Promotion updated.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Promotion_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = 'Promotion deleted.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}
}
