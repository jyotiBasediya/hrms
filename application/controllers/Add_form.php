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

class Add_form extends MY_Controller {
	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}
	
	public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->helper('email');
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
		   $this->load->model("Roles_model");
		   $this->load->model("CommonModel");
     }
	
	
	public function index()
 	{  

		$data['groups'] = $this->Add_model->getAllGroups();

		$data['all_roles'] = $this->Roles_model->all_user_roles();

		$data['all_division'] = $this->CommonModel->selectResultDataByCondition(array('status' => 1),'division');

		$data['employees'] = $this->Project_model->getAllemp();
              	// print_r($data['all_division']);die();
		$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('employees/add_form',$data);

		$this->load->view('common/footer');


			// $this->load->view('layout_main',$data); //page load
	}

	public function register ()
	{
// 		echo "string";

// 			$dataV['name'] = 'Apeksha Mazumdar';

// // 			$dataV['name'] = $employe_detail->full_name;
// 			$dataV['email'] = 'apeksha@yopmail.com';
// 			$dataV['password'] = '123456';
// 			return $this->load->view('email_templates/employee_registration',$dataV);






		// print_r($_FILES);
		// echo "<br>";
		$this->load->library('email');

			$full_name = $this->input->post('full_name');
		$a = explode(' ', $full_name);
		$f_name = $a[0];
		if(!empty($a[1])){
		    $l_name = $a[1];
		}else{
		    $l_name = "";
		}


		if(!empty($_FILES['picture']['name'])){
            $config['upload_path'] = 'uploads/gst/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['picture']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('picture')){
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            }else{
                $picture = '';
            }
        }else{
            $picture = '';
        }
		
		// print_r($picture);die;
		$data  = array( 
			'level'=>$this->input->post('level'),
			'first_name'=>$f_name,
			'last_name'=>$l_name,
			'email' => $this->input->post('email'),
			'date_of_joining' => $this->input->post('sdate'),
			'date_of_leaving' => $this->input->post('edate'),
			'role' => $this->input->post('role'),
			'empType' => $this->input->post('employment'),
			'division' => $this->input->post('division'),
			'default_task'=> $this->input->post('task'),
			'employee_id'=> $this->input->post('enumuber'),
			'accounting_id' => $this->input->post('account'),
			'status' => $this->input->post('status'),
			'assign_to' => $this->input->post('employee_id'),
			'notes' => $this->input->post('note'),
			'password' => $this->input->post('password'),
			'confirm_password' => $this->input->post('cpass'),

			'check_timesheat' => $this->input->post('check_timesheat'),
			'timesheet' => $this->input->post('timesheet'),
			'check_timeoff' => $this->input->post('check_timeoff'),
			'time_off' => $this->input->post('time_off'),
			'expense_check' => $this->input->post('check_expense'),
			'expenses' => $this->input->post('expenses'),

			'desk_number' => $this->input->post('desk_number'),
			'location' => $this->input->post('location'),
			'time_zone' => $this->input->post('time_zone'),

			'user_role_id' => $this->input->post('user_role_id'),

			'date_of_birth' => $this->input->post('date_of_birth'),
			'mobile_no' => $this->input->post('mobile_no'),
			'manager_id' => $this->input->post('manager_id'),

			'profile_picture'=>$picture,
		);


		$insert =	$this->db->insert('hrms_employees', $data);
		if ($insert) {
			$last_id= $this->db->insert_id();
			//print_r($last_id);
			$employe_detail = $this->Employees_model->edit_id($last_id);
		    		$dataV['name'] = $employe_detail->first_name.' '.$employe_detail->last_name;

// 			$dataV['name'] = $employe_detail->full_name;
			$dataV['email'] = $employe_detail->email;
			$dataV['password'] = $employe_detail->password;
			$view = $this->load->view('email_templates/employee_registration',$dataV,TRUE );
			
			      $this->email->from('info@sliceledger.com', 'HRMS')
			            ->to($employe_detail->email)         
    					->subject('Registration Confirmation')    
    					->message($view)
    					->set_mailtype('html');
    
			// // send email
			 $sent = $this->email->send();
			 $this->session->set_flashdata('success','Employee added Successfully');
			 redirect('add_form');
		}else{
				$this->session->set_flashdata('error','Something went wrong');
			redirect('add_form');
		}
	}


	public function delete_employee()
	  {
	      $condition = array(
	          "user_id" => $this->uri->segment(3)
	      );
	      // print_r($condition);die;
	     $data = array(
	                  "is_delete"      => 1,
	              );
	              
	      // print_r($condition);exit;
	      $data = $this->CommonModel->updateRowByCondition($condition,'hrms_employees',$data);  
	      
	      if ($data) {
	          $this->session->set_flashdata('success','Employee deleted successfully');
	          redirect('employees');  
	      }else{
	          $this->session->set_flashdata('error', 'Employee not deleted');
	          redirect('employees');  
	      }
	  }
	


    // public function update_item($id) 
    // {
    //     $data=array(
    //         'title' => $this->input->post('title'),
    //         'description'=> $this->input->post('description')
    //     );
    //     if($id==0){
    //         return $this->db->insert('items',$data);
    //     }else{
    //         $this->db->where('id',$id);
    //         return $this->db->update('items',$data);
    //     }        
    // }



	}