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
 * @package  iLinkHR - Faq
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Faq_model");
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
		$data['all_companies'] = $this->Hrms_model->get_companies();
		$data['breadcrumbs'] = 'FAQ';
		$data['path_url'] = 'faq';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('9',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("faq/faq_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
     }
 
    public function faq_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("faq/faq_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$faq = $this->Faq_model->get_policies();
		
		$data = array();

          foreach($faq->result() as $r) {
			 			  
		// get user > added by
		$user = $this->Hrms_model->read_user_info($r->added_by);
		// user full name
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		// get date
		$pdate = $this->Hrms_model->set_date_format($r->created_at);
		// get company
		if($r->company_id=='0'){
			$company = $this->lang->line('hrms_all_companies');
		} else {
			$p_company = $this->Hrms_model->read_company_info($r->company_id);
			$company = $p_company[0]->name;
		}
		
				
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-faq_id="'. $r->faq_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-faq_id="'. $r->faq_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->faq_id . '"><i class="fa fa-trash-o"></i></button></span>',
			$r->title,
			$company,
			$pdate,
			$full_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $faq->num_rows(),
			 "recordsFiltered" => $faq->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }

	 public function read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('faq_id');
		$result = $this->Faq_model->read_faq_information($id);
		$data = array(
				'faq_id' => $result[0]->faq_id,
				'company_id' => $result[0]->company_id,
				'title' => $result[0]->title,
				'description' => $result[0]->description,
				'all_companies' => $this->Hrms_model->get_companies()
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('faq/dialog_faq', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_faq() {
	
		if($this->input->post('add_type')=='faq') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('company')==='') {
       		$Return['error'] = $this->lang->line('hrms_error_company');
		} else if($this->input->post('title')==='') {
			$Return['error'] = $this->lang->line('hrms_error_title');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_id' => $this->input->post('company'),
		'title' => $this->input->post('title'),
		'description' => $qt_description,
		'added_by' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		
		);
		$result = $this->Faq_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_add_faq');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='faq') {
			
		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('company')==='') {
       		$Return['error'] = $this->lang->line('hrms_error_company');
		} else if($this->input->post('title')==='') {
			$Return['error'] = $this->lang->line('hrms_error_title');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_id' => $this->input->post('company'),
		'title' => $this->input->post('title'),
		'description' => $qt_description,		
		);
		
		$result = $this->Faq_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_update_faq');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Faq_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = $this->lang->line('hrms_success_delete_faq');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
	}
}
