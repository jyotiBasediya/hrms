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
 * @package  iLinkHR - Locations
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class NewTimesheet extends MY_Controller {
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Location_model");
		$this->load->model("Hrms_model");
		$this->load->model("Project_model");
		$this->load->model("Timesheet_model");
		$this->load->model("Roles_model");
		$this->load->model("CommonModel");
        $this->load->model("Employees_model");

	}

	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}

	public function header() 
	{

		$session = $this->session->userdata('username');

		$employee_id = $session['user_id'];
        // $data['data'] = $this->CommonModel->getEmployeeMyTask($employee_id);
        $data['data'] = $this->CommonModel->getTask($employee_id);

        // print_r($data['data']);die;

		return $this->load->view('common/h',$data);

	}

	public function addNewTimeSheet()
    {

        $this->load->library('email');
        
    	// print_r($_POST);die;
    	$session = $this->session->userdata('username');
    	$employee_id = $session['user_id'];

    	$date = $this->input->post('date');
    	$hour = $this->input->post('hour');
    	// $company_id = $this->input->post('company_id');
    	// $task_id = $this->input->post('task_id');
    	$task_id = $this->input->post('taksId');
    	// $project_id = $this->input->post('project_id');


    	$check_hour_id = $this->input->post('check_hour_id');

        // if(!empty($task_id) || !empty($hour) || $hour='' || $task_id='')
        // {
        	for ($i=0; $i < count($date); $i++) 
            { 

            	if($hour[$i] != 0)
            	{

            		// if(!empty($task_id[$i]))
            		// {	
            			$task = $this->CommonModel->getsingle('hrms_task_employee',array('task_id' => $task_id[$i]));


            			$task_condition = array(
            					'task_id' 		=> 	$task_id[$i],
            					// 'employee_id' 	=> 	$employee_id,
            					'date' 			=> 	date("Y-m-d", strtotime($date[$i]))
            				);

            			$check_task_resource = $this->CommonModel->selectRowDataByCondition($task_condition,'employee_resources');

            			if($check_task_resource)
            			{
            				$id = $check_task_resource->id; 
            				$data = array(
    				            "hour"   				=>  $hour[$i],
    				             "approved_status"      =>  0,
    				        );

    				        $set = $this->CommonModel->updateRowByCondition(array('id' => $id),'employee_resources',$data);  
            			}else
            			{
            				$data = array(
    			                "company_id"        	=>  $task->client_name,
    			                "task_id"   			=>  $task_id[$i],
    			                "project_id"   			=>  $task->project_name,
    			                "employee_id"        	=>  $employee_id,
    			                "date"          		=>  date("Y-m-d", strtotime($date[$i])),
    			                "hour"                  =>  $hour[$i],
    			                "approved_status"       =>  0,
    			                "created_at"            =>  date('Y-m-d H:i:s a'),
    			            );
            				// print_r($data);
    		        		$set = $this->CommonModel->insertData($data,'employee_resources'); 
            			}
            		// }
            	}        	
            }


            if($set)
            {

             //--------------Employee Detail-------------------------------------------------------
                $last_id= $session['user_id'];
                $employe_detail = $this->Employees_model->edit_id($last_id);

                $manger_id = $employe_detail->manager_id;

                $dataV['emp_name']              =   $employe_detail->first_name.' '.$employe_detail->last_name;

                //--------------Manager Detail-------------------------------------------------------
                $last_id= $manger_id;
                $manger_detail = $this->Employees_model->edit_id($last_id);

                $dataV['manger_email']     =   $manger_detail->email;
                $dataV['name']             =   $manger_detail->first_name.' '.$manger_detail->last_name;

                $dataV['type']              =   7;
                $dataV['type_msg']          =   'Add Hour in project';
                // print_r($manger_detail);die;

               // return $this->load->view('email_templates/employee_message',$dataV);

                $view = $this->load->view('email_templates/employee_message',$dataV,TRUE );
                    
                $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                    ->to($manger_detail->email)         
                    ->subject('Add Hour in project')    
                    ->message($view)
                    ->set_mailtype('html');

                $sent = $this->email->send();

                 if($sent){
                    //--------------ALl Manger send mail-----------------------------------------------------
                    $getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');

                     foreach ($getAllMangerList as $key => $value) 
                    {

                        $last_id= $session['user_id'];
                        $employe_detail = $this->Employees_model->edit_id($last_id);

                        $manger_id = $employe_detail->manager_id;

                        $dataAllM['emp_name']              =   $employe_detail->first_name.' '.$employe_detail->last_name;


                        $dataV['type']              =   7;
                        $dataV['type_msg']          =   'Add Hour in project';


                        //--------------Manager Detail-------------------------------------------------------
                        $dataAllM['manger_email']     =   $value['email'];
                        $dataAllM['name']             =   $value['first_name'].' '.$value['last_name'];

                        $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

                        $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                            ->to($value['email'])         
                            ->subject('Add Hour in project')    
                            ->message($view)
                            ->set_mailtype('html');

                        // // send email
                         $sentAll = $this->email->send();
                    }

                 }

                $this->session->set_flashdata('success','Task added successfully');
                redirect('task/my_task'); 
            }else{
                $this->session->set_flashdata('error','Somethings went wrong');
                 redirect('task/my_task'); 
            }
        // }
        // else{
        //     $this->session->set_flashdata('error','Please select task');
        //          redirect('task/my_task'); 
        // }

    }

	public function addTimeSheet()
    {
    	// print_r($_POST);die;

    	$session = $this->session->userdata('username');
    	$employee_id = $session['user_id'];

    	// print_r($employee_id);die;

    	$date = $this->input->post('date');
    	$hour = $this->input->post('hour');
    	$company_id = $this->input->post('company_id');
    	$task_id = $this->input->post('task_id');
    	$project_id = $this->input->post('project_id');


    	$check_hour_id = $this->input->post('check_hour_id');


    	for ($i=0; $i < count($date); $i++) 
        { 


        	if($hour[$i] != 0)
        	{
        		if($check_hour_id[$i] != 0)
        		{
        			$condition = array(
			            'id' 	=> $check_hour_id[$i],
			            'date'  => $date[$i],
			        );

			        $data = array(
			            "hour"   =>  $hour[$i],
			        );

			        $set = $this->CommonModel->updateRowByCondition($condition,'employee_resources',$data);  
        		}else{
	        		$data = array(
		                "company_id"        	=>  $company_id,
		                "task_id"   			=>  $task_id[$i],
		                "project_id"   			=>  $project_id[$i],
		                "employee_id"        	=>  $employee_id,
		                // "date"          		=>  $date[$i],
		                "date"          		=>  date("Y-m-d", strtotime($date[$i])),
		                "hour"                  =>  $hour[$i],
		                "approved_status"       =>  0,
		                "created_at"            =>  date('Y-m-d H:i:s a'),
		            );
		            $set = $this->CommonModel->insertData($data,'employee_resources'); 
		        }
        	}        	
        }


        if($set)
        {
            $this->session->set_flashdata('success','Task added successfully');
             redirect('task/my_task'); 
        }else{
            $this->session->set_flashdata('error','Somethings went wrong');
             redirect('task/my_task'); 
        }
    }
}