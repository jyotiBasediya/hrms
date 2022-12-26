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

class Add_client extends MY_Controller {
	
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
	

	public function index()
		{  
			// if ($_SERVER['REQUEST_METHOD']=='post') {
				
   //     $data = array(
   //              'first_name' => $this->input->post('fname'),
   //              'last_name' => $this->input->post('lname'),
   //              'company_name' => $this->input->post('cname'),
   //              'contact_no' => $this->input->post('cnumber'),
   //              'mail_id' => $this->input->post('email')
   //          );
   //     $this->db->insert('add_client', $data);
			// 		}
			// 		else{
			// 			// redirect('');
			// 		}
   $data['data']=$this->Client_model->getdata();
            
			
              	// print_r($data['groups']);die();
		$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('client/add_client',$data);

		$this->load->view('common/footer');



		}
public function editpost($id)
  {
    $this->load->view('common/header');

    $data['client_detail'] = $this->Client_model->edit($id);
// print_r($data['employees_detail']);die;
    $this->load->view('client/edit_client',$data);

    $this->load->view('common/footer'); 
  }

  public function updates()
  { 

        $id = $this->input->post('id');

        $client_detail= $this->Client_model->edit($id);


        if(!empty($_FILES['picture']['name']))
        {
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
                $picture = $client_detail->gst_certificate;
            }
        }else{
            $picture = $client_detail->gst_certificate;
        }

        $data = array(
            'first_name'=>$this->input->post('cname'),
            // 'last_name'=>$this->input->post('lname'),
            'company_name'=>$this->input->post('cname'),
            'company_address'=>$this->input->post('company_address'),
            'gst_number'=>$this->input->post('gst_number'),

            'pan_number'=>$this->input->post('pan_number'),
            'spoc_name'=>$this->input->post('spoc_name'),
            
            'person_name'=>$this->input->post('person_name'),
            'contact_no  '=>$this->input->post('contact_no'),
            'mail_id'=>$this->input->post('mail_id'),
            'gst_certificate'=>$picture,
        );

        $this->db->where('id',$id);
        $this->db->update('add_client',$data); 
        redirect('add_client');
    }

	public function register ()
	{
	     if($this->input->post('userSubmit')){
        
        //Check whether user upload picture
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
		    

		$data = array(
            // 'first_name' => $this->input->post('fname'),
            // 'last_name' => $this->input->post('lname'),
            'first_name' => $this->input->post('cname'),
            'company_name' => $this->input->post('cname'),
            'company_address'=>$this->input->post('company_address'),
            'gst_number'=>$this->input->post('gst_number'),

            'pan_number'=>$this->input->post('pan_number'),
            'spoc_name'=>$this->input->post('spoc_name'),

            'gst_certificate'=>$picture,
            'person_name'=>$this->input->post('person_name'),
            'contact_no' => $this->input->post('cnumber'),
            'mail_id' => $this->input->post('email')
         );
		  //   print_r($data);die();
        $insertUserData = $this->db->insert('add_client', $data);
         if($insertUserData){
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            }else{
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
        }

        redirect('add_client');  

	}

  public function delete_client()
    {
        $condition = array(
            "id" => $this->uri->segment(3)
        );
        // print_r($condition);die;
       $data = array(
                    "is_delete"      => 1,
                );
                
        // print_r($condition);exit;
        $data = $this->CommonModel->updateRowByCondition($condition,'add_client',$data);  
        
        if ($data) {
            $this->session->set_flashdata('success','Client deleted successfully');
            redirect('add_client');  
        }else{
            $this->session->set_flashdata('error', 'Client not deleted');
            redirect('add_client');  
        }
    }

}