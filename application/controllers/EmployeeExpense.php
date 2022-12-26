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
 * @package  iLinkHR - Expense
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class employeeExpense extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model("Expense_model");
		$this->load->model("Hrms_model");
		$this->load->model("CommonModel");
		$this->load->model("Employees_model");
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
     	// echo "hi";die;
		$data['title'] = $this->Hrms_model->site_title();
		// $data['all_expense_types'] = $this->Expense_model->all_expense_types();
		// $data['all_employees'] = $this->Hrms_model->all_employees();

		// $data['expense_categories'] = $this->Expense_model->all_expense_types();
		// // $data['all_employees'] = $this->Hrms_model->all_employees();
		// $data['breadcrumbs'] = $this->lang->line('hrms_expenses');
		// $data['path_url'] = 'expense';
		// $session = $this->session->userdata('username');
		
		// $role_resources_ids = $this->Hrms_model->user_role_resource();
		// if(in_array('1',$role_resources_ids)) {
		// 	if(!empty($session)){ 
		// 	$data['subview'] = $this->load->view("expense/expense_categorylist", $data, TRUE);
		// 	$this->load->view('layout_main', $data); //page load
		// 	} else {
		// 		redirect('');
		// 	}
		// } else {
		// 	redirect('dashboard/');
		// }

		// $data['expense_categories'] = $this->Expense_model->all_employeeexpense();
        //print_r($data['clients']);die();
		$session = $this->session->userdata('username');
		$user_id =  $session['user_id'];

		$whr = array('employee_id'=>$user_id);
    	$pdata = $this->Expense_model->getwhrexpencedata('expense_appliedby_employee',$whr);
		// die;
		// $user_info = $this->Hrms_model->read_user_info($session['user_id']);
        $data['pdata'] = $pdata;
		$this->load->view('common/header');
		//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('expense/employeeExpense',$data);
		$this->load->view('common/footer');
    }

    public function applyforExpense()
    {

    	$this->load->library('email');

    	$data['title'] = $this->Hrms_model->site_title();

    	$data = array();
    	$session = $this->session->userdata('username');
		$user_id =  $session['user_id'];
    	if(isset($_POST) && !empty($_POST))
    	{

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
	                $picture = '';
	            }
	        }else{
	            $picture = '';
	        }
			

    		$data = array(
	            'expense_category_id' => $_POST['expense_category_id'],
	            'employee_id' => $user_id,
	            'img'=>$picture,
	            'remark'=>$_POST['remark'],
	            'amount'=>$_POST['amount'],
	            'status'=>"pending",
	         );
		  //   print_r($data);die();
       		 $res = $this->db->insert('expense_appliedby_employee', $data);
         

    		if($res)
    		{
    			 //--------------Employee Detail-------------------------------------------------------
		            $last_id= $session['user_id'];
		            $employe_detail = $this->Employees_model->edit_id($last_id);

		            $manger_id = $employe_detail->manager_id;


		            $where = array('expense_category_id'=>$_POST['expense_category_id']);
		            $expense_category = $this->CommonModel->getsingle('expense_categories',$where);

		            $dataV['emp_name']          =   $employe_detail->first_name.' '.$employe_detail->last_name;
		            $dataV['email']             =   $employe_detail->email;
		            $dataV['password']          =   $employe_detail->password;
		            $dataV['type']              =   2;
		            $dataV['type_msg']          =   'Apply for Expense';

		            $dataV['amount']           =   $_POST['amount'];
		            $dataV['note']             =   $_POST['remark'];

		            $dataV['leave_name']       =   $expense_category->name;

		        //--------------Manager Detail-------------------------------------------------------
		            $last_id= $manger_id;
		            $manger_detail = $this->Employees_model->edit_id($last_id);

		            $dataV['manger_email']     =   $manger_detail->email;
		            $dataV['name']             =   $manger_detail->first_name.' '.$manger_detail->last_name;

		            // print_r($manger_detail);die;

		            $view = $this->load->view('email_templates/employee_message',$dataV,TRUE );
		                

		            $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
		                ->to($manger_detail->email)         
		                ->subject('Apply for Expense')    
		                ->message($view)
		                ->set_mailtype('html');

		            // // send email
		             $sent = $this->email->send();

		             if($sent){

		             	$getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');
		                 // print_r($getAllMangerList);die;

		                foreach ($getAllMangerList as $key => $value) 
		                {
		                    $last_id= $session['user_id'];
		                    $employe_detail = $this->Employees_model->edit_id($last_id);

		                    $manger_id = $employe_detail->manager_id;


		                    $where = array('id'=>$this->input->post('leave'));
		                    $leave_category = $this->CommonModel->getsingle('hrms_leave_category',$where);

		                    $dataAllM['emp_name']          =   $employe_detail->first_name.' '.$employe_detail->last_name;
		                    $dataAllM['email']             =   $employe_detail->email;
		                    $dataAllM['password']          =   $employe_detail->password;
		                    $dataAllM['type']              =   2;
		                    $dataAllM['type_msg']          =   'Apply for Expense';

		                    $dataAllM['amount']           =   $_POST['amount'];
				            $dataAllM['note']             =   $_POST['remark'];

				            $dataAllM['leave_name']       =   $expense_category->name;


		                    //--------------Manager Detail-------------------------------------------------------
		                        $dataAllM['manger_email']     =   $value['email'];
		                        $dataAllM['name']             =   $value['first_name'].' '.$value['last_name'];


		                    $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

		                    $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
		                        ->to($value['email'])         
		                        ->subject('Apply for Expense')    
		                        ->message($view)
		                        ->set_mailtype('html');

		                    // // send email
		                     $sentAll = $this->email->send();
		                }      
		             }
    			$this->session->set_flashdata('success', 'Applied for expense successfully');
    		}
    		else{
    			$this->session->set_flashdata('error', 'Oops something went wrong please try again.');
    		}

    		redirect('employeeExpense');  
    	}


		$expense_categories = $this->Expense_model->all_expense_categories();

        $data['expense_categories'] = $this->CommonModel->selectResultDataByConditionAndFieldName(array("status" => 1,),'expense_categories','expense_categories.expense_category_id');
	
        // $data['expense_categories'] = $expense_categories;
		$this->load->view('common/header');
		//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('expense/applyforExpense',$data);
		$this->load->view('common/footer');
    }
}