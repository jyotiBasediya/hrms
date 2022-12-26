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
 * @package  iLinkHR - Transfers
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Transfers_model");
		$this->load->model("Hrms_model");
		$this->load->model("Department_model");
		$this->load->model("Location_model");
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
		$data['all_employees'] =  $this->Hrms_model->all_employees_byCmpId($session['companyId']);
		$data['all_locations'] = $this->Hrms_model->get_locationsByCmy();
		$data['all_departments'] = $this->Department_model->all_departmentsBycmp();
		$data['breadcrumbs'] = 'Transfers';
		$data['path_url'] = 'transfers';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('16',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("transfers/transfer_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
     }
 
    public function transfer_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("transfers/transfer_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$transfer = $this->Transfers_model->get_transfersByComp();
		
		$data = array();

          foreach($transfer as $r) {
			 			  
		// get user > added by
		$user = $this->Hrms_model->read_user_info($r->added_by);
		// user full name
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		
		// get user > employee_
		$employee = $this->Hrms_model->read_user_info($r->employee_id);
		// employee full name
		$employee_name = $employee[0]->first_name.' '.$employee[0]->last_name;
		// get date
		$transfer_date = $this->Hrms_model->set_date_format($r->transfer_date);
		// get department by id
		$department_data = $this->Department_model->read_department_information($r->transfer_department);

		if(!empty($department_data[0]->department_name))
		{
			$department_name = $department_data[0]->department_name; 
		}
		else
		{
			$department_name = '';
		}

		//print_r($department);die();
		// get location by id

		$location = $this->Location_model->read_location_information($r->transfer_location);

		if(!empty($location[0]->location_name))
		{
			$location_name = $location[0]->location_name;
		}
		else
		{	
			$location_name = '';
		}

		// get status
		if($r->status==0): $status = 'Pending';
		elseif($r->status==1): $status = 'Accepted'; else: $status = 'Rejected'; endif;
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-transfer_id="'. $r->transfer_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-transfer_id="'. $r->transfer_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->transfer_id . '"><i class="fa fa-trash-o"></i></button></span>',
			$employee_name,
			$transfer_date,
			$department_name,
			$location_name,
			$status,
			$full_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => count($transfer),
			 "recordsFiltered" => count($transfer),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 public function read()
	{
		$session = $this->session->userdata('username');
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('transfer_id');
		$result = $this->Transfers_model->read_transfer_information($id);
		$data = array(
				'transfer_id' => $result[0]->transfer_id,
				'employee_id' => $result[0]->employee_id,
				'transfer_date' => $result[0]->transfer_date,
				'transfer_department' => $result[0]->transfer_department,
				'transfer_location' => $result[0]->transfer_location,
				'description' => $result[0]->description,
				'status' => $result[0]->status,
				'transferfrom' => $result[0]->transferfrom,
				'department_from' => $result[0]->department_from,
				'designation_to' => $result[0]->designation_to,
				'designation_from' => $result[0]->designation_from,
				'comment' => $result[0]->comment,

				'all_employees' => $this->Hrms_model->all_employees_byCmpId($session['companyId']),
				'all_locations' => $this->Hrms_model->get_locationsByCmy(),
				'all_departments' => $this->Department_model->all_departmentsBycmp(),
				'all_designationFrom' => $this->Designation_model->designation_byDept($result[0]->department_from),
				'all_designationTo' => $this->Designation_model->designation_byDept($result[0]->transfer_department),
				);
			
		if(!empty($session)){ 
			$this->load->view('transfers/dialog_transfer', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_transfer() {
	
		if($this->input->post('add_type')=='transfer') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('employee_id')==='') {
       		 $Return['error'] = "The employee field is required.";
		} else if($this->input->post('transfer_date')==='') {
			$Return['error'] = "The date field is required.";
		} else if($this->input->post('transfer_department')==='') {
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
		'transfer_date' => $this->input->post('transfer_date'),
		'transfer_department' => $this->input->post('transfer_department'),
		'description' => $qt_description,
		'transfer_location' => $this->input->post('transfer_location'),
		'transferfrom' => $this->input->post('transfer_fromlocation'),
		'department_from' => $this->input->post('transfer_department_from'),
		'designation_to' => $this->input->post('transfer_designation_to'),
		'designation_from' => $this->input->post('transfer_designation_from'),
		'added_by' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		
		);
		$result = $this->Transfers_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = 'Transfer added.';
			
			//get setting info 
			$setting = $this->Hrms_model->read_setting_info(1);
			if($setting[0]->enable_email_notification == 'yes') {
				
				// load email library
				$this->load->library('email');
				$this->email->set_mailtype("html");
				
				//get company info
				$cinfo = $this->Hrms_model->read_company_setting_info(1);
				//get email template
				$template = $this->Hrms_model->read_email_template(9);
				//get employee info
				$user_info = $this->Hrms_model->read_user_info($this->input->post('employee_id'));
				
				$full_name = $user_info[0]->first_name.' '.$user_info[0]->last_name;
						
				$subject = $template[0]->subject.' - '.$cinfo[0]->company_name;
				$logo = base_url().'uploads/logo/'.$cinfo[0]->logo;
				
				$message = '
			<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;">
			<img src="'.$logo.'" title="'.$cinfo[0]->company_name.'"><br>'.str_replace(array("{var site_name}","{var site_url}","{var employee_name}"),array($cinfo[0]->company_name,site_url(),$full_name),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';
				
				$this->email->from($cinfo[0]->email, $cinfo[0]->company_name);
				$this->email->to($user_info[0]->email);
				
				$this->email->subject($subject);
				$this->email->message($message);
				
				$this->email->send();
			}
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='transfer') {
			
		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('descriptionnew');
		
		//$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('employee_id')==='') {
       		 $Return['error'] = "The employee field is required.";
		} else if($this->input->post('transfer_date')==='') {
			$Return['error'] = "The date field is required.";
		} else if($this->input->post('transfer_department')==='') {
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
	
		$data = array(
		'employee_id' => $this->input->post('employee_id'),
		'transfer_date' => $this->input->post('transfer_date'),
		'transfer_department' => $this->input->post('transfer_department'),
		'description' => $description,
		'department_from' => $this->input->post('transfer_department_from'),
		'designation_to' => $this->input->post('transfer_designation_to'),
		'designation_from' => $this->input->post('transfer_designation_from'),
		'transfer_location' => $this->input->post('transfer_location'),
		'transferfrom' => $this->input->post('transfer_fromlocation'),
		'status' => $this->input->post('status'),
		'comment' => $this->input->post('remark'),
		);
		
		$result = $this->Transfers_model->update_record($data,$id);	

		if ($result == TRUE) {
			$Return['result'] = 'Transfer updated.';
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
		$result = $this->Transfers_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = 'Transfer deleted.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}

	public function getDesignation()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            header("Content-Type: application/json");

            $ID = $this->input->post('id');
            $q = $this->Hrms_model->getDesignationDept($ID);
           
            $output = [];

            if( $q->num_rows() )
            {
                foreach ($q->result() as $one)
                {
                    $output[] = [
                        'id'    => $one->designation_id,
                        'name'  => $one->designation_name
                    ];
                }
            }
            
            echo json_encode(['data' => @$output]);
        }
	}
}
