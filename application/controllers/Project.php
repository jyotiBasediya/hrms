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
 * @package  iLinkHR - Project
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Project_model");
		$this->load->model("Hrms_model");
		$this->load->model("Company_model");
		$this->load->model("Designation_model");
		$this->load->model("Client_model");
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
 
    	$data['clients'] = $this->Client_model->getAllClient();
 		$data['employees'] = $this->Project_model->getAllemp();

 		$data['currency'] = $this->Project_model->getAllcurrency();

		      //	print_r($data['projects']);die();
		$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('project/add_project',$data);

		$this->load->view('common/footer');

		// 	} else {
		// 		redirect('');
		// 	}
		// } else {
		// 	redirect('dashboard/');
		// }		  
		$data['clients'] = $this->Project_model->getAllClient();
      }

      public function editpost($id)
	{
		$this->load->view('common/header');

		$data['clients'] = $this->Client_model->getAllClient();
		$data['employees'] = $this->Project_model->getAllemp();
		
		$data['project_detail'] = $this->Project_model->edit($id);
// print_r($data['employees_detail']);die;
		$this->load->view('project/edit_project',$data);

		$this->load->view('common/footer'); 
	}
	public function updates()
	{ 

		// print_r($_POST);die;
		$id = $this->input->post('id');

		$data = array(
			'project_manager' => $this->input->post('project_manager'),
			'project_name'=>$this->input->post('cname'),
			'short_name'=>$this->input->post('sname'),
			'project_number'=>$this->input->post('pnumber'),
			'client_id	'=>$this->input->post('cid'),
			'status'=>$this->input->post('status'),
			'notes'=>$this->input->post('notes'),
		);

		$this->db->where('id',$id);
		$this->db->update('add_project',$data);	
		redirect('add_project');
	}



     public function insert()
     {
     	$data = array(
                'first_name' => $this->input->post('fname'),
                'last_name' => $this->input->post('lname'),
                'company_name' => $this->input->post('cname'),
                'contact_no' => $this->input->post('cnumber'),
                'mail_id' => $this->input->post('email')
             );
        $this->db->insert('add_client', $data);

     }
	 
	 public function detail()
     {
		$data['title'] = $this->Hrms_model->site_title();
		//$data['all_employees'] = $this->Hrms_model->all_employees();
		//$data['all_companies'] = $this->Hrms_model->get_companies();
		//$data['breadcrumbs'] = $this->lang->line('hrms_project_detail');
		$id = $this->uri->segment(3);
		$result = $this->Project_model->read_project_information($id);
		// get user > added by
		$user = $this->Hrms_model->read_user_info($result[0]->added_by);
		// user full name
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		$data = array(
			'breadcrumbs' => $this->lang->line('hrms_project_detail'),
			'project_id' => $result[0]->project_id,
			'title' => $result[0]->title,
			'summary' => $result[0]->summary,
			'client_name' => $result[0]->client_name,
			'start_date' => $result[0]->start_date,
			'end_date' => $result[0]->end_date,
			'company_id' => $result[0]->company_id,
			'assigned_to' => $result[0]->assigned_to,
			'created_at' => $result[0]->created_at,
			'priority' => $result[0]->priority,
			'added_by' => $full_name,
			'description' => $result[0]->description,
			'progress' => $result[0]->project_progress,
			'status' => $result[0]->status,
			'path_url' => 'project_detail',
			'all_employees' => $this->Hrms_model->all_employees(),
			'all_companies' => $this->Hrms_model->get_companies()
			);

		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		//if(in_array('7',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("project/project_details", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		/*} else {
			redirect('dashboard/');
		}*/		  
     }
 
    public function project_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("project/project_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$project = $this->Project_model->get_projectsByCmp();
		
		$data = array();

          foreach($project as $r) {
			 			  
		// get user > added by
		$user = $this->Hrms_model->read_user_info($r->added_by);
		// user full name
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		// get date
		$pdate = '<i class="fa fa-calendar position-left"></i> '.$this->Hrms_model->set_date_format($r->end_date);
		
		//project_progress
		if($r->project_progress <= 20) {
			$progress_class = 'progress-danger';
		} else if($r->project_progress > 20 && $r->project_progress <= 50){
			$progress_class = 'progress-warning';
		} else if($r->project_progress > 50 && $r->project_progress <= 75){
			$progress_class = 'progress-info';
		} else {
			$progress_class = 'progress-success';
		}
		
		// progress
		
		$pbar = '<p class="m-b-0-5">Completed <span class="pull-xs-right">'.$r->project_progress.'%</span></p><progress class="progress '.$progress_class.' progress-sm" value="'.$r->project_progress.'" max="100">'.$r->project_progress.'%</progress>';
				
		//status
		if($r->status == 0) {
			$status = 'Not Started';
		} else if($r->status ==1){
			$status = 'In Progress';
		} else if($r->status ==2){
			$status = 'Completed';
		} else {
			$status = 'Deferred';
		}
		
		// priority
		if($r->priority == 1) {
			$priority = '<span class="label label-danger">Highest</span>';
		} else if($r->priority ==2){
			$priority = '<span class="label label-info">High</span>';
		} else if($r->priority ==3){
			$priority = '<span class="label label-primary">Normal</span>';
		} else {
			$priority = '<span class="label label-success">Low</span>';
		}
		
		//assigned user
		if($r->assigned_to == '') {
			$ol = 'Not Assigned';
		} else {
			$ol = '';
			foreach(explode(',',$r->assigned_to) as $desig_id) {
				$assigned_to = $this->Hrms_model->read_user_info($desig_id);
				$assigned_name = $assigned_to[0]->first_name.' '.$assigned_to[0]->last_name;
				 if($assigned_to[0]->profile_picture!='' && $assigned_to[0]->profile_picture!='no file') {
                    $ol .= '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="'.$assigned_name.'"><span class="avatar box-32"><img src="'.base_url().'uploads/profile/'.$assigned_to[0]->profile_picture.'" class="b-a-radius-circle" alt=""></span></a>';
                    } else {
                    if($assigned_to[0]->gender=='Male') { 
                    	$de_file = base_url().'uploads/profile/default_male.jpg';
                     } else {
                     	$de_file = base_url().'uploads/profile/default_female.jpg';
                     }
                    $ol .= '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="'.$assigned_name.'"><span class="avatar box-32"><img src="'.$de_file.'" class="b-a-radius-circle" alt=""></span></a>';
                    }
			 }
			 $ol .= '';
		}
		
		$project_summary = '<div class="text-semibold"><a href="'.site_url().'project/detail/'.$r->project_id . '">'.$r->title.'</a></div>
					        <div class="text-muted">'.$r->summary.'</div>';
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-project_id="'. $r->project_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->project_id . '"><i class="fa fa-trash-o"></i></button></span>',
			$project_summary,
			$priority,
			$pdate,
			$r->cost,
			$status,
			$pbar,
			$ol
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => count($project),
			 "recordsFiltered" => count($project),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 public function read()
	{
		$session = $this->session->userdata('username'); 
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('project_id');
		$result = $this->Project_model->read_project_information($id);
		$data = array(
				'project_id' => $result[0]->project_id,
				'title' => $result[0]->title,
				'client_name' => $result[0]->client_name,
				'start_date' => $result[0]->start_date,
				'end_date' => $result[0]->end_date,
				'company_id' => $result[0]->company_id,
				'priority' => $result[0]->priority,
				'summary' => $result[0]->summary,
				'assigned_to' => $result[0]->assigned_to,
				'description' => $result[0]->description,
				'project_progress' => $result[0]->project_progress,
				'employee_id'=>$result[0]->head_of_project,
				'status' => $result[0]->status,
				'all_employees' => $this->Hrms_model->all_employees_byCmpId($session['companyId']),
				'all_companies' => $this->Hrms_model->get_companies()
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('project/dialog_project', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_project() {
	
		if($this->input->post('add_type')=='project') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$description = $this->input->post('description');
		$st_date = strtotime($start_date);
		$ed_date = strtotime($end_date);
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('title')==='') {
        	$Return['error'] = $this->lang->line('hrms_error_title');
		} else if($this->input->post('client_name')==='') {
			$Return['error'] = $this->lang->line('hrms_error_client_name');
		} else if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('hrms_error_company');
		} else if($this->input->post('start_date')==='') {
			$Return['error'] = $this->lang->line('hrms_error_start_date');
		} else if($this->input->post('end_date')==='') {
			$Return['error'] = $this->lang->line('hrms_error_end_date');
		} else if($this->input->post('cost')==='') {
			$Return['error'] = "The cost field is required.";
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('hrms_error_start_end_date');
		}  else if(empty($this->input->post('assigned_to'))) {
			 $Return['error'] = $this->lang->line('hrms_error_project_manager');
		} else if($this->input->post('summary')==='') {
			$Return['error'] = $this->lang->line('hrms_error_summary');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$assigned_ids = implode(',',$this->input->post('assigned_to'));
		$employee_ids = $assigned_ids;
		$session = $this->session->userdata('username');
		$data = array(
		'title' => $this->input->post('title'),
		'client_name' => $this->input->post('client_name'),
		'company_id' => $session['companyId'],
		'start_date' => $this->input->post('start_date'),
		'end_date' => $this->input->post('end_date'),
		'summary' => $this->input->post('summary'),
		'priority' => $this->input->post('priority'),
		'cost' => $this->input->post('cost'),
		'assigned_to' => $employee_ids,
		'description' => $qt_description,
		'project_progress' => '0',
		'status' => '0',
		'head_of_project' => $this->input->post('headEmployee'),
		'added_by' => $this->input->post('user_id'),
		'created_at' => date('Y-m-d'),
		
		);
		$result = $this->Project_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_add_project');
			
			//get setting info 
			$setting = $this->Hrms_model->read_setting_info(1);
			if($setting[0]->enable_email_notification == 'yes') {
				
				// load email library
				$this->load->library('email');
				$this->email->set_mailtype("html");
				
				$to_email = array();
				foreach($this->input->post('assigned_to') as $p_employee) {
					
				$user_info = $this->Hrms_model->read_user_info($p_employee);				
					//get company info
				$cinfo = $this->Hrms_model->read_company_setting_info(1);
				//get email template
				$template = $this->Hrms_model->read_email_template(3);
				
				$subject = $template[0]->subject.' - '.$cinfo[0]->company_name;
				$logo = base_url().'uploads/logo/'.$cinfo[0]->logo;
				
				$p_date = $this->Hrms_model->set_date_format($start_date);
				
				$message = '
				<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;">
				<img src="'.$logo.'" title="'.$cinfo[0]->company_name.'"><br>'.str_replace(array("{var site_name}","{var name}","{var project_name}","{var project_start_date}"),array($cinfo[0]->company_name,'User',$this->input->post('title'),$p_date),html_entity_decode(stripslashes($template[0]->message))).'</div>';
				
				$this->email->from($cinfo[0]->email, $cinfo[0]->company_name);
				$this->email->to($user_info[0]->email);
				
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
				}
			}
			
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='project') {
			
		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$description = $this->input->post('description');
		$st_date = strtotime($start_date);
		$ed_date = strtotime($end_date);
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('title')==='') {
        	$Return['error'] = $this->lang->line('hrms_error_title');
		} else if($this->input->post('client_name')==='') {
			$Return['error'] = $this->lang->line('hrms_error_client_name');
		} else if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('hrms_error_company');
		} else if($this->input->post('start_date')==='') {
			$Return['error'] = $this->lang->line('hrms_error_start_date');
		} else if($this->input->post('end_date')==='') {
			$Return['error'] = $this->lang->line('hrms_error_end_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('hrms_error_start_end_date');
		}  else if(empty($this->input->post('assigned_to'))) {
			 $Return['error'] = $this->lang->line('hrms_error_project_manager');
		} else if($this->input->post('summary')==='') {
			$Return['error'] = $this->lang->line('hrms_error_summary');
		}else if($this->input->post('headEmployee')==='') {
			$Return['error'] = $this->lang->line('hrms_head_of_project_required');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		if(null!=$this->input->post('assigned_to')) {
			$assigned_ids = implode(',',$this->input->post('assigned_to'));
			$employee_ids = $assigned_ids;
		} else {
			$employee_ids = 'all-employees';
		}
	
		$data = array(
		'title' => $this->input->post('title'),
		'client_name' => $this->input->post('client_name'),
		'start_date' => $this->input->post('start_date'),
		'end_date' => $this->input->post('end_date'),
		'summary' => $this->input->post('summary'),
		'priority' => $this->input->post('priority'),
		'assigned_to' => $employee_ids,
		'description' => $qt_description,
		'project_progress' => $this->input->post('progres_val'),
		'status' => $this->input->post('status'),
		'head_of_project' => $this->input->post('headEmployee')		
		);
		
		$result = $this->Project_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_update_project');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database
	public function update_status() {
	
		if($this->input->post('type')=='update_status') {
			
		$id = $this->input->post('project_id');
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		$data = array(
		'priority' => $this->input->post('priority'),
		'project_progress' => $this->input->post('progres_val'),
		'status' => $this->input->post('status'),		
		);
		
		$result = $this->Project_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_update_project');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database // assign_ticket
	public function assign_project() {
	
		if($this->input->post('type')=='project_user') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');		
		
		if(null!=$this->input->post('assigned_to')) {
			$assigned_ids = implode(',',$this->input->post('assigned_to'));
			$employee_ids = $assigned_ids;
		} else {
			$employee_ids = '';
		}
	
		$data = array(
		'assigned_to' => $employee_ids
		);
		$id = $this->input->post('project_id');
		$result = $this->Project_model->update_record($data,$id);
		
		if ($result == TRUE) {
			$Return['result'] = 'Project employees has been updated.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
	
	// update task user > task details
	public function project_users() {

		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->uri->segment(3);
		
		$data = array(
			'project_id' => $id,
			'all_employees' => $this->Hrms_model->all_employees(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("project/get_project_users", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	
	public function delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Project_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = $this->lang->line('hrms_success_delete_project');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
	}
}
