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
 * @package  iLinkHR - Login
 * @copyright  Copyright © ilinkhr.com. All Rights Reserved
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

   /*Function to set JSON output*/
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
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('Login_model');
		  $this->load->model('Employees_model');
     }
	 
	public function login() 
	{
		// echo "string";die;
	
		$this->form_validation->set_rules('iusername', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ipassword', 'Password', 'trim|required|xss_clean');
		$Return = array('result'=>'', 'error'=>'');
		
		$username = $this->input->post('iusername');
		$password = $this->input->post('ipassword');
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		
		/* Server side PHP input validation */
		// if($username==='') {
		// 	$Return['error'] = "Username field is required.";
		// } elseif($password===''){
		// 	$Return['error'] = "Password field is required.";
		// } elseif($email===''){
		// 	$Return['error'] = "email field is required.";
		// }
		// if($Return['error']!=''){
		// 	$this->output($Return);
		// }
		
		$data = array(
			'username' => $username,
			'password' => $password,
			
			);

		// $result = $this->Login_model->login($data);	
		$result = $this->Login_model->loginWithCond($data);

		
		if ($result == TRUE) 
		{

				$result = $this->Login_model->read_user_information($username);
				if($result[0]->user_role_id == 9)
				{
					    $session_data = array(
						'user_id' => $result[0]->user_id,
						'username' => $result[0]->username,
						'email' => $result[0]->email,
						'companyId' => $result[0]->company_id,



					);
									// Add user data in session
					$this->session->set_userdata('username', $session_data);
					// print_r($session_data);die();
					$Return['result'] = 'Logged In Successfully.';
					 
					// update last login info
					$ipaddress = $this->input->ip_address();
					  
					 $last_data = array(
						'last_login_date' => date('d-m-Y H:i:s'),
						'last_login_ip' => $ipaddress,
						'is_logged_in' => '1'
					); 
					
					$id = $result[0]->user_id;
					  
					$this->Employees_model->update_record($last_data, $id);


					if($result[0]->check_change_password == 0)
					{

						redirect(base_url().'Forgot_password/reset_verify?token='.$id);

						// $this->output('Change Password');
						// exit;
						
					}else{
						redirect(base_url().'dashboard');
						// redirect('employee_panel/dashboard');
						// $this->output($Return);
						
						// exit;
					}
				}
				else
				{
					$session_data = array(
						'user_id' => $result[0]->user_id,
						'username' => $result[0]->username,
						'email' => $result[0]->email,
						'companyId' => $result[0]->company_id,
					);
									// Add user data in session
					$this->session->set_userdata('username', $session_data);
				
					$Return['result'] = 'Logged In Successfully.';
				// 	print_r($session_data);die();
					// update last login info
					$ipaddress = $this->input->ip_address();
					  
					 $last_data = array(
						'last_login_date' => date('d-m-Y H:i:s'),
						'last_login_ip' => $ipaddress,
						'is_logged_in' => '1'
					); 
					
					$id = $result[0]->user_id; // user id
					  
					$this->Employees_model->update_record($last_data, $id);

					if($result[0]->check_change_password == 0)
					{

						redirect(base_url().'Forgot_password/reset_verify?token='.$id);

						// $this->output('Change Password');
						// exit;
						
					}else{
						redirect(base_url().'dashboard');
						// redirect('employee_panel/dashboard');
						// $this->output($Return);
						
						// exit;
					}
					// $this->output($Return);
					
					// exit;
				}
				
			} else {

				$this->session->set_flashdata('error','Invalid Login Credential.');
				redirect(base_url());
			// 	$Return['error'] = "Invalid Login Credential.";
			// 	// /*Return*/
			// 	$this->output($Return);
			}
		}


} 
?>