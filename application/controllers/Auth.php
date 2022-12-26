<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('CommonModel');
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		//$token = $this->input->get_request_header('token', TRUE);	
		//$this->user = $this->_userLoginCheck( $token );
	}

	public function reset_verify()
    {
        // echo "string";die;
    	$id = $this->input->get('token');

    	$condition = array(
            // "email_id"      => $email_id,
			"id"  	=> $id,
		);	
		$userDetail = $this->CommonModel->selectRowDataByCondition($condition,'user');

        if($userDetail === FALSE)
        {	          
            redirect('admin/login');
        }
        if($userDetail)
        {
        	// $fullname = $userDetail->first_name.''.$userDetail->last_name;
            $email_id = $userDetail->email;
        	$user_id  = $userDetail->id;
        	// print_r($id);die;
            $this->load->view('email_templates/reset_password',
            	array(
                    'email_id'  =>  $email_id,
            		'id'	=>	$user_id,
	            	'name'		=>	$userDetail->name
	            ));
		}
	} 

	public function verify_resetpassword()
	{
        // echo "string";die;
        $condition  = array("id" => $this->input->get('user_id'));

        if ($this->input->post('npwd') == $this->input->post('cpwd')) 
        {
            $data       = array(
				"password" => $this->input->post('npwd')
			);

            $updateData = $this->CommonModel->updateRowByCondition($condition,'user',$data);

            if($updateData) 
            { 
            	$userDetail = $this->CommonModel->selectRowDataByCondition($condition,'user');
            	// print_r($userDetail);die;
                $this->session->set_flashdata('success','Password reset Successfully');
                $this->load->view('email_templates/thankyou',array(
                    // 'name'  =>  $fullname
	            	'name'  =>  $userDetail->name
	            ));
            }
            else
            {
                $this->session->set_flashdata('error', 'Password not reset');
                $this->load->view('email_templates/forget_password');
            }
        }
        else 
        { 
            $this->session->set_flashdata('error', 'Your new Password and confirm Password not match!');
            redirect('Auth/forget?id='.base64_encode($this->input->post('email')));
        } 
		
	} 

      
}   
           
