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

class Task extends MY_Controller {
	
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
		  $this->load->model('Task_model');
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
	    	
		// $data['data']=$this->Task_model->getdata();
		
		// print_r($data['data']);die;

		$employee_id = '';
        // $data['data'] = $this->CommonModel->getEmployeeMyTask($employee_id);
        $data['data'] = $this->CommonModel->getTask($employee_id);

// print_r($data['data']);die;
		$this->load->view('common/header');
			
		$this->load->view('task/task_list',$data);

		$this->load->view('common/footer');
	}

	public function task_form()
	{	

		$data['clients'] = $this->Client_model->getAllClient();
	    $data['employees'] = $this->Project_model->getAllemp();
	    $data['project'] = $this->Project_model->getAllproject();
		$this->load->view('common/header');
			
		$this->load->view('task/add_task',$data);

		$this->load->view('common/footer');
	}
	public function my_task()
	{

		$session = $this->session->userdata('username');

		$employee_id = $session['user_id'];
        // $data['data'] = $this->CommonModel->getEmployeeMyTask($employee_id);
        $data['data'] = $this->CommonModel->getTask($employee_id);

        // print_r($data['data']);die;

		$this->load->view('common/header');
			
		$this->load->view('task/my_task',$data);

		$this->load->view('common/footer');
	}

	public function getProject()
	{
        $condition  = array(
            "client_name" => $this->input->post('client_name'),
            "status" => 'active',
        );
        $catData = $this->CommonModel->selectResultDataByCondition($condition,'add_project');
        
        if (!empty($catData)) {
            echo json_encode($catData);
        }else{
            echo "0";
        }
    }

    public function checkEmployeeTask()
	{
		$empid = $this->input->post('employee_id');
        $condition  = array(
            "employee" => $this->input->post('employee_id'),
        );

        $employeeData = $this->CommonModel->getsingle('hrms_employees',array('user_id'=>$empid));
        $catData = $this->CommonModel->selectResultDataByCondition($condition,'hrms_task_employee');
        
        if (!empty($catData)) {
            $result = array('status'=>1,'employeeData'=>$employeeData,'taskcount'=>count($catData));
        }else{
            $result = array('status'=>0,'employeeData'=>array());
        }

        echo json_encode($result);
        exit();
    }

    

	public function insert()
	{
		$employee_id = $this->input->post('employee_id');
		$assigned_to = implode(",",$this->input->post('employee_id'));


		$data  = array( 
			'task_name'		=> $this->input->post('task_name'),
			'client_name'	=> $this->input->post('client_name'),
			'project_name'	=> $this->input->post('project_name'),
			'task_code' 	=> $this->input->post('task_code'),
			// 'task_id' 		=> $this->input->post('task_id'),
			'task_status' 	=> $this->input->post('status'),
			'assign_to' 	=> $assigned_to,
			'task_note' 	=> $this->input->post('notes'),
			
		);
		$insert = $this->CommonModel->insertData($data,'hrms_tasks');  

		if(!empty($insert))
		{
			$task_id = $this->db->insert_id();

			foreach ($employee_id as $key => $value) 
			{
				$task_data  = array( 
					'task_id'		=> $task_id,
					'client_name'	=> $this->input->post('client_name'),
					'project_name'	=> $this->input->post('project_name'),
					'cost' 			=> 0,
					'task_id' 		=> $task_id,
					'employee' 		=> $value,
				);

				$insert =	$this->db->insert('hrms_task_employee', $task_data);
			}


			$Return['result'] = 'Project added.';
			redirect('task');
		}
		// else{


		// }
		
	}
	public function editpost($id)
	{
		$this->load->view('common/header');

		$data['task_detail'] = $this->Task_model->edit_id($id);
        // print_r($data['employees_detail']);die;
		$this->load->view('task/edit_task',$data);

		$this->load->view('common/footer'); 
	}

	public function updates()
	{ 
		
		
		$id = $this->input->post('task_id');
		
		$data  = array( 
			'task_name'=>$this->input->post('task_name'),
			'client_name'=>$this->input->post('client_name'),
			'project_name'=>$this->input->post('project_name'),
			'task_code' => $this->input->post('task_code'),
			'task_id' => $this->input->post('task_id'),
			'task_status' => $this->input->post('status'),
			'task_note' => $this->input->post('notes'),
			
		);

		$this->db->where('task_id',$id);
		$this->db->update('hrms_tasks',$data);	
		redirect('task');
	}

	public function delete_task()
	{
	    $condition = array(
	        "task_id" => $this->uri->segment(3)
	    );
	    // print_r($condition);die;
	   $data = array(
	                "is_delete"      => 1,
	            );
	            
	    $data = $this->CommonModel->updateRowByCondition($condition,'hrms_tasks',$data);  
	    
	    if ($data) 
	    {
	    	$employee_task = $this->CommonModel->selectResultDataByCondition(array('task_id' => $this->uri->segment(3)),'hrms_task_employee');
	    	
	    	foreach ($employee_task as $key => $value) 
	    	{
			   $employeeTask = array(
			                "is_delete"      => 1,
			            );     
			    // print_r($condition);exit;
			    $employeeTaskDelete = $this->CommonModel->updateRowByCondition(array('id' => $value['id']),'hrms_task_employee',$employeeTask);  
	    	}

	        $this->session->set_flashdata('success','Task deleted successfully');
	        redirect('task');  
	    }else{
	        $this->session->set_flashdata('error', 'Task not deleted');
	        redirect('task');  
	    }
	}

	public function project_resource()
	{

		$id = $this->uri->segment(3);

		$session = $this->session->userdata('username');

		$employee_id = $session['user_id'];
        $data['data'] = $this->CommonModel->getEmployeeMyTask($employee_id,$id);

        // print_r($data['data']);die;

		$this->load->view('common/header');
			
		$this->load->view('task/project_resource_list',$data);

		$this->load->view('common/footer');
	}

	public function add_project_resource()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$date                = $this->input->post('date');
            $hour = $this->input->post('hour');

            $task_id = $this->input->post('task_id');
            $project_name = $this->input->post('project_name');
            $client_name = $this->input->post('client_name');

            $session = $this->session->userdata('username');

			$employee_id = $session['user_id'];


			foreach ($date as $key => $value) 
			{
				$task_data = array (
                    "task_id"               =>  $task_id,
                    "company_id"            =>  $client_name,
                    "project_id"   			=>  $project_name,
                    "employee_id"   		=>  $employee_id,

                    "date"                  =>  $date[$key],
                    "hour"   				=>  $hour[$key],
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                );

				$insert =	$this->db->insert('employee_resources', $task_data);
			}

			$Return['result'] = 'Project resources added.';
			redirect('task/my_task');
			
		}
		else
		{
			$id = $this->uri->segment(3);

			// print_r($id);die;
			$session = $this->session->userdata('username');

			$employee_id = $session['user_id'];
	        $data['data'] = $this->CommonModel->getEmployeeMyTask($employee_id);


	        $data['clients'] = $this->Client_model->getAllClient();
		    $data['employees'] = $this->Project_model->getAllemp();
		    $data['project'] = $this->Project_model->getAllproject();

		    $data['task_detail'] = $this->Task_model->edit_id($id);

	        // print_r($data['data']);die;

			$this->load->view('common/header');
				
			$this->load->view('task/add_project_resources',$data);

			$this->load->view('common/footer');
		}
	}
}