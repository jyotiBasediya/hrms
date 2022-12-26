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

class ExpenseCategory extends MY_Controller {
	
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
     	// echo "hi";
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

		$data['expense_categories'] = $this->Expense_model->all_expense_categories();
        // print_r($data['expense_categories']);die();
		$this->load->view('common/header');
		//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('expense/expense_categorylist',$data);
		$this->load->view('common/footer');
    }

    public function addExpenseCategory($id=false){

    	$data = array();

    	if(isset($_POST) && !empty($_POST)){
    		// print_r($_POST);
    		// die;
    		$idata = array();
    		$idata['name'] = $_POST['name'];
    		
			if(isset($_POST['expense_category_id']) && !empty($_POST['expense_category_id'])){
				$res = $this->Expense_model->updatecategory($idata,$_POST['expense_category_id']);
				$data['msg'] = "Category has been Updated successfully";
    		}else{
    			$idata['created_at'] = date('Y-m-d H:i:s');
	    		$res = $this->Expense_model->addcategory($idata);
	    		if($res){
	    			$data['msg'] = "Category has been added successfully";
	    		}else{
	    			$data['msg'] = "Oops something went wrong please try again.";
	    		}
	    	}
    	}

    	if($id){
    		$whr = array('expense_category_id'=>$id);
    		$pdata = $this->Expense_model->getsingleexpencedata('expense_categories',$whr);
    		if(isset($pdata) && !empty($pdata)){
    			$data['pdata'] = $pdata[0];
    		}

    		// print_r($data['pdata']);
    		// die;
    	}
    	$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('expense/addExpenseCategory',$data);

		$this->load->view('common/footer');
    }

    public function status_category()
    {
    	$data = $this->CommonModel->selectRowDataByCondition(array('expense_category_id' =>  $this->input->post('expense_category_id')),'expense_categories');

        $condition = array(
            "expense_category_id" => $this->input->post('expense_category_id')
        );
        if($data->status == 1){
            $data = array("status" => '0');
        }else{
            $data = array("status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'expense_categories',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }

    }


    public function delete_expense_category()
	{
	    $condition = array(
	        "expense_category_id" => $this->uri->segment(3)
	    );
	    // print_r($condition);die;
	   $data = array(
	                "is_delete"      => 1,
	            );
	            
	    // print_r($condition);exit;
	    $data = $this->CommonModel->updateRowByCondition($condition,'expense_categories',$data);  
	    
	    if ($data) {
	        $this->session->set_flashdata('success','Expense category deleted successfully');
	        redirect('expenseCategory');  
	    }else{
	        $this->session->set_flashdata('error', 'Expense category not deleted');
	        redirect('expenseCategory');  
	    }
	}
}