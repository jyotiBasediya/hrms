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

class Update extends MY_Controller {
	
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

     }
	

	public function index($id)
		{  
	
            $data['posts'] = $this->Employees_model->edit_id($id);
		
		$this->load->view('common/header');
			
		$this->load->view('employees/edit',$data);

		$this->load->view('common/footer');



		}
     public function updates($id)
             {
              $id = $this->input->post('id');
              
              $data = array(
                  'full_name'=>$this->input->post('full_name'),
                  'email'=>$this->input->post('mail_id')

              );
              $this->db->where('id',$id);
              $this->db->update('employees',$data);
              // redirect('employees');

             }


}