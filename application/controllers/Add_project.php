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
 * @package  iLinkHR - Dashboard
 * @copyright  Copyright © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_project extends MY_Controller {
	
	public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the models
          $this->load->model('Login_model');
		  $this->load->model('Designation_model');
		  $this->load->model('Department_model');
		  $this->load->model('Employees_model');
		  $this->load->model('Hrms_model');
		  $this->load->model('Expense_model');
		  $this->load->model('Timesheet_model');
		  $this->load->model('Job_post_model');
		  $this->load->model('Project_model');
		  $this->load->model('Awards_model');
		  $this->load->model('Announcement_model');
		  $this->load->model('Add_model');
		  $this->load->model('Client_model');
		  $this->load->model('CommonModel');

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

		
// 		$data['clients'] = $this->Client_model->getAllClient();
// 			$data['employees'] = $this->Project_model->getAllemp();
	$data['projects'] = $this->Project_model->getAllproject();

	$data['currency'] = $this->Project_model->getAllcurrency();

		      	// print_r($data['currency']);die();
              	//print_r($data['clients']);die();
		$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('project/project_list',$data);

		$this->load->view('common/footer');


			// $this->load->view('layout_main',$data); //page load
	}


	public function getproject()
	{
		$data['projects'] = $this->Project_model->getAllproject();

		$data['employees'] = $this->Project_model->getAllemp();
		$data['currency'] = $this->Project_model->getAllcurrency();

		      	// print_r($data['currency']);die();
		$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('project/add_project',$data);

		$this->load->view('common/footer');

	}

    public function insert()
    {
    	$employee_id = $this->input->post('employee_name');
		$assigned_to = implode(",",$this->input->post('employee_name'));

     	$data = array(
                'client_name' => $this->input->post('client_name'),
                'project_manager' => $this->input->post('project_manager'),
                'project_name' => $this->input->post('cname'),
                'short_name' => $this->input->post('sname'),
                'project_number' => $this->input->post('pnumber'),
                'client_id' => $this->input->post('cid'),
                'status' => $this->input->post('status'),
                'currency' => $this->input->post('currency'),
                'assign_to' => $assigned_to,
                'notes' => $this->input->post('notes')

             );
        $this->db->insert('add_project', $data);
        redirect('add_project');
    }

    public function project_cost()
	{
		$data['project_cost'] = $this->Project_model->project_cost_list();

		$this->load->view('common/header');
		$this->load->view('project/project_cost_list',$data);
		$this->load->view('common/footer');

	}


	 public function add_project_cost()
	{
		$data['projects'] = $this->Project_model->getAllproject();

		// $data['employees'] = $this->Project_model->getAllemp();

		$this->load->view('common/header');
		$this->load->view('project/add_project_cost',$data);
		$this->load->view('common/footer');

	}

	public function edit_project_cost()
	{
		$id = $this->uri->segment(2);

		// print_r($this->uri->segment(2));

		$data['project_cost_view'] = $this->Project_model->project_cost_view($id);

		// print_r($data['project_cost_view']);die;

		// $data['employees'] = $this->Project_model->getAllemp();

		$this->load->view('common/header');
		$this->load->view('project/edit_project_cost',$data);
		$this->load->view('common/footer');

	}
	public function update_project_cost()
	{

		$condition = array('id' => $this->input->post('id'));

		$data = array(
                'cost' => $this->input->post('cost'),
                'hours' => $this->input->post('hours'),

             );
        $updateCost = $this->CommonModel->updateRowByCondition($condition,'hrms_task_employee', $data);

        if($updateCost)
        {
        		redirect('project_cost');
        }
        
	}


	public function delete_project()
	{
	    $condition = array(
	        "id" => $this->uri->segment(3)
	    );
	    // print_r($condition);die;
	   $data = array(
	                "is_delete"      => 1,
	            );
	            
	    // print_r($condition);exit;
	    $data = $this->CommonModel->updateRowByCondition($condition,'add_project',$data);  
	    
	    if ($data) {
	        $this->session->set_flashdata('success','Project deleted successfully');
	        redirect('add_project');  
	    }else{
	        $this->session->set_flashdata('error', 'Project not deleted');
	        redirect('add_project');  
	    }
	}
	
}
