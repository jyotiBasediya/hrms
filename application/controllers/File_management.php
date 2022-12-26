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
 * @package  iLinkHR - User File Management
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class File_management extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("File_management_model");
		$this->load->model("Employees_model");
		$this->load->model("Department_model");
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
		$session = $this->session->userdata('username');
		$data['breadcrumbs'] = 'File Management';
		$data['path_url'] = 'file_management';
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('9',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("file_management/file_management", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
     }
 
    public function files_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');

		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$files = $this->File_management_model->get_filesByCmp();
		
		$data = array();

      	foreach($files as $file) {

      		$employee = $this->Employees_model->read_employee_information($file->employee_id);
      		$department = $this->Department_model->read_department_information($file->department_id);

			switch ($file->status) {
				case 1:
					$status = 'Uploaded';
					break;
				case 2:
					$status = 'Requested';
					break;				
				default:
					$status = 'Error';
					break;
			}
			
			$data[] = array(
				'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-file_id="'. $file->file_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $file->file_id . '"><i class="fa fa-trash-o"></i></button></span>',
				$employee[0]->first_name. " ".$employee[0]->last_name,
				$department[0]->department_name,
				$status,
				'<a href="'.base_url().'uploads/files/'.$file->file_name.'" download>'.$file->file_name.'</a>',
				$file->title,
				$file->file_date,
			);
			
      	}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($files),
			"recordsFiltered" => count($files),
			"data" => $data
		);
      	echo json_encode($output);
      	exit();
	}

	public function read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('file_id');
		$result = $this->File_management_model->read_file_information($id);
		$employee = $this->Hrms_model->read_user_info($result[0]->employee_id);
		$department = $this->Hrms_model->read_department_info($result[0]->department_id);
		$data = array(
				'file_id' => $result[0]->file_id,
				'employee' => $employee[0]->first_name . ' ' . $employee[0]->last_name,
				'department' => $department[0]->department_name,
				'file_name' => $result[0]->file_name,
				'file_date' => $this->Hrms_model->set_date_format($result[0]->file_date),
				'title' => $result[0]->title,
				'status' => ($result[0]->status == 1) ? 'Uploaded' : 'Requested',
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('file_management/dialog_file_management', $data);
		} else {
			redirect('');
		}
	}
	
	public function delete() {
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->File_management_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = 'File delete.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}
	
	public function update() {

		if($this->input->post('edit_type')=='file') {
			
		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		if($_FILES['file_manage']['size'] == 0) {			 
			$result == TRUE;
		} else {
			if(is_uploaded_file($_FILES['file_manage']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','gif','pdf','doc','docx','xls','xlsx');
				$filename = $_FILES['file_manage']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["file_manage"]["tmp_name"];
					$bill_copy = "uploads/files/";
					$lname = basename($_FILES["file_manage"]["name"]);
					$newfilename = round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
				 	$data = array(
						'file_name' => $fname,
					);
					// update record > model
					$result = $this->File_management_model->update_record($data,$id);
				} else {
					$Return['error'] = 'The attachment must be a file of type: png, jpg, jpeg, gif, pdf, doc, docx. xls, xlsx';
				}
			}
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		
		if ($result == TRUE) {
			$Return['result'] = 'File uploaded.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
}
