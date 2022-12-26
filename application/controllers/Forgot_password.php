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
 * @package  iLinkHR - Forgot Password
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Payroll_model");
		$this->load->model("Hrms_model");
		$this->load->model("Employees_model");
		$this->load->model("Designation_model");
		$this->load->model("Department_model");
		$this->load->model("Location_model");
		$this->load->model("CommonModel");
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
		$data['title'] = '::Arrow::';
		$this->load->view('user/forgot_password', $data);
	}
	
	public function send_mail()
	{
		

		$data['title'] = '::Arrow::';
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		/* Server side PHP input validation */
		if($this->input->post('iemail')==='') {
			$Return['error'] = "Please enter your email.";
		} else if (!filter_var($this->input->post('iemail'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = "Invalid email format";
		}
		
		if($Return['error']!=''){
			$this->output($Return);
		}
		
		if($this->input->post('iemail')) {
	
			$this->load->library('email');
			$this->email->set_mailtype("html");
			//get company info
			$cinfo = $this->Hrms_model->read_company_setting_info(1);
			//get email template
			$template = $this->Hrms_model->read_email_template(2);
			//get employee info
			$query = $this->Hrms_model->read_user_info_byemail($this->input->post('iemail'));
			
			$user = $query->num_rows();
			if($user > 0) {
				
				$user_info = $query->result();

				// print_r($user_info);die;
				$full_name = $user_info[0]->first_name.' '.$user_info[0]->last_name;
				
				$subject = $template[0]->subject.' - '.$cinfo[0]->company_name;
				$logo = base_url().'uploads/logo/'.$cinfo[0]->logo;
				//$cid = $this->email->attachment_cid($logo);
				
				// $message = '
				// 	<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;">
				// 	<img src="'.$logo.'" title="'.$cinfo[0]->company_name.'"><br>'.str_replace(array("{var site_name}","{var username}","{var email}","{var password}"),array($cinfo[0]->company_name,$user_info[0]->username,$user_info[0]->email,$user_info[0]->password),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';
				
				// $this->email->from($cinfo[0]->email, $cinfo[0]->company_name);
				// $this->email->to($this->input->post('iemail'));
				
				// $this->email->subject($subject);
				// $this->email->message($message);
				// $this->email->send();

				$data['company_name'] = $cinfo[0]->company_name;
				$data['username'] = $user_info[0]->username;
				$data['email'] = $user_info[0]->email;
				$data['id'] = $user_info[0]->user_id;

				$view = $this->load->view('forgot_password_email',$data,TRUE );
            
	            // print_r($view);die;

	             $this->email->from('info@sliceledger.com', 'HRMS')
						->to($user_info[0]->email)          
						->subject('Forgot Password')    
						->message($view)
						->set_mailtype('html');
				
	            // send email
	            $sent = $this->email->send();
            
				$Return['result'] = 'Password has been sent to your email address.';
			} else {
				/* Unsuccessful attempt: Set error message */
				$Return['error'] = "Email address doesn't exist.";
			}

			
			$this->output($Return);
			exit;
		}
	}

	public function reset_verify()
    {
    	$id = $this->input->get('token');

    	$condition = array(
            // "email_id"      => $email_id,
			"user_id"  	=> $id,
		);	
		$userDetail = $this->CommonModel->selectRowDataByCondition($condition,'hrms_employees');

        if($userDetail === FALSE)
        {	          
            redirect('admin/login');
        }
        if($userDetail)
        {

            $email_id = $userDetail->email;
        	$user_id  = $userDetail->user_id;
        	// print_r($id);die;
            $this->load->view('reset_password',
            	array(
                    'email_id'  =>  $email_id,
            		'id'		=>	$user_id,
	            	'name'		=>	$userDetail->first_name.' '.$userDetail->last_name
	            ));
		}
	} 

	public function verify_resetpassword()
	{
        // echo "string";die;
        $condition  = array("user_id" => $this->input->get('user_id'));

        if ($this->input->post('npwd') == $this->input->post('cpwd')) 
        {
            $data       = array(
				"password" => $this->input->post('npwd'),
				"check_change_password" => 1
			);

            $updateData = $this->CommonModel->updateRowByCondition($condition,'hrms_employees',$data);

            if($updateData) 
            { 
            	$Return['result'] = 'Password reset Successfully';

            	redirect(base_url());
            }
            else
            {
            	$Return['error'] = "Password not reset";

                $this->session->set_flashdata('error', 'Password not reset');
                $this->load->view('forgot_password');
            }
        }
        else 
        { 
        	$Return['error'] = "Your new Password and confirm Password not match!";

            // $this->session->set_flashdata('error', 'Your new Password and confirm Password not match!');
            redirect('Forgot_password/reset_verify?id='.$this->input->post('email'));
        } 


   //      $this->output($Return);
			// exit;
		
	} 

	public function registration()
	{
		$data['title'] = 'Registration';

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('email');
			$this->email->set_mailtype("html");
			
			$data = array(
                'first_name' => $this->input->post('fname'),
                'last_name' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'company_name' => $this->input->post('company_name'),
                'mobile_no' => $this->input->post('number'),
                'user_role_id' => '18',
                'company_id' => '0',
             
             );
        	$insertData = $this->CommonModel->insertData($data,' hrms_employees');

        	if($insertData){
	        	$last_id 		= $this->db->insert_id();

				$fetchCondition = array(
					"user_id" 	=> $last_id
				);
				$Detail = $this->CommonModel->selectRowDataByCondition($fetchCondition,'hrms_employees');


				// print_r($Detail);die;

				$otp        = rand(999,10000);


				 $dataa = array(
	                "password" => $otp,
	            );
	            $updateData = $this->CommonModel->updateRowByCondition($fetchCondition,'hrms_employees',$dataa); 


				$data['company_name'] = $Detail->company_name;
				$data['fullname'] = $Detail->first_name.' '.$Detail->last_name;
				$data['password'] = $otp;
				$data['email'] = $Detail->email;
				$data['id'] = $Detail->user_id;

				$view = $this->load->view('verification',$data,TRUE );
            
	            // print_r($view);die;

	             $this->email->from('info@sliceledger.com', 'HRMS')
						->to($Detail->email)          
						->subject('Verification Mail')    
						->message($view)
						->set_mailtype('html');
				
	            // send email
	            $sent = $this->email->send();

	            redirect(base_url());
			}

		}else{
			$this->load->view('sign_up', $data);
		}
	}


}
