<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contract_type extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the models
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
		$data['breadcrumbs'] = $this->lang->line('contract_type');
		$data['path_url'] = 'contract';
		$data['contarct_list'] = $this->Hrms_model->select_multiple_row("select * from hrms_contract_type");
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('13',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("contract/contract_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
     }
	public function add_contract()
	{
		// //die('hii');
		// if($this->input->post('add_type')=='employee') {		
		// /* Define return | here result is used to return user data and error for error message */
		// $Return = array('result'=>'', 'error'=>'');
			
		// /* Server side PHP input validation */		
		// if($this->input->post('contract_type')==='') {
  //      		 $Return['error'] = $this->lang->line('hrms_contract_type_required');
		// } 
				
		// if($Return['error']!=''){
  //      		$this->output($Return);
  //   	}
		// $session = $this->session->userdata('username');
 
  //   	$getAdminData = $this->Hrms_model->getsingle('hrms_employees',array('user_id'=>$session['user_id']));

  //   	if (!empty($getAdminData)) {

  //   		$compny_id = $getAdminData->company_id ;
    		
		$data = array(
		'name' => $this->input->post('contract_type'),
		'created_at' => date('Y-m-d H:i:s')

		);
		$result = $this->Hrms_model->insert_entry('hrms_contract_type',$data);
		if ($result == TRUE) {
			//$Return['result'] = $this->lang->line('hrms_success_add_contract');
			redirect('contract_type');
		} else {
			//$Return['error'] = $this->lang->line('hrms_error_msg');
			redirect('contract_type');
		}
	// }else {
	// 		$Return['error'] = $this->lang->line('hrms_error_msg');
	// 	}
	// 	$this->output($Return);
	// 	exit;
	// 	}
	// }

}

public function deleteContrct()
	{

		$id = $_POST['id'];
		$Return = array('result'=>'', 'error'=>'');
		
		$result = $this->Hrms_model->delete_contract_record($id,'hrms_contract_type');
		if (!empty($result))
		{
			echo 1;
			exit;
			//redirect('contract_type');
			//$Return['result'] = $this->lang->line('hrms_success_update_employee');
		}else{
			echo 2;
			exit;
			//redirect('contract_type');
			//$Return['error'] = $this->lang->line('hrms_error_msg');
		}

		//$this->output($Return);
	}

	public function updateContract()
	{
		$id = $this->input->post('updateContract_token');
		$data = array(
		'name' => $this->input->post('contractUpdate_type'),
		'created_at' => date('Y-m-d H:i:s')

		);
		$where = array('contract_type_id'=>$id);
		$result = $this->Hrms_model->update_entry('hrms_contract_type',$data,$where);
		redirect('contract_type');
	}
}