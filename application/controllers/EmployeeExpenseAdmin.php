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

class EmployeeExpenseAdmin extends MY_Controller {
  
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
        //  if(!empty($session)){ 
        //  $data['subview'] = $this->load->view("expense/expense_categorylist", $data, TRUE);
        //  $this->load->view('layout_main', $data); //page load
        //  } else {
        //    redirect('');
        //  }
        // } else {
        //  redirect('dashboard/');
        // }

        // $data['expense_categories'] = $this->Expense_model->all_employeeexpense();
            //print_r($data['clients']);die();
        $session = $this->session->userdata('username');
        $user_id =  $session['user_id'];

        $whr = array('1'=>1);
        $pdata = $this->Expense_model->getwhrexpencedata('expense_appliedby_employee',$whr);
        // die;
        // $user_info = $this->Hrms_model->read_user_info($session['user_id']);
            $data['pdata'] = $pdata;
        $this->load->view('common/header');
        //$data['subview'] = $this->load->view('dashboard/index',$data);
        $this->load->view('expense/employeeExpenseAdmin',$data);
        $this->load->view('common/footer');
    }

    public function approve($id)
    {
        $this->load->library('email');

        // echo "approve";
        $data = array('status'=>'approved');
        $update = $this->Expense_model->updateemployeeexpense($data,$id);

        if($update)
        {
            $empExpenseDetail = $this->CommonModel->getsingle('expense_appliedby_employee',array('id'=>$id));

        //--------------Employee Detail-------------------------------------------------------
            $last_id= $empExpenseDetail->employee_id;
            $employe_detail = $this->Employees_model->edit_id($last_id);


            $where = array('expense_category_id'=> $empExpenseDetail->expense_category_id);
            $leave_category = $this->CommonModel->getsingle('expense_categories',$where);

            $dataV['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
            $dataV['email']            =   $employe_detail->email;
            $dataV['password']         =   $employe_detail->password;
            $dataV['type']             =   3;
            $dataV['type_msg']         =   'Approved Expense';

            $dataV['amount']           =   $empExpenseDetail->amount;
            $dataV['note']             =   $empExpenseDetail->remark;
            $dataV['leave_name']       =   $leave_category->name;
            $dataV['status']           =   'approved';


        //--------------Manager Detail-------------------------------------------------------
            $last_id= $employe_detail->manager_id;;
            $manger_detail  = $this->Employees_model->edit_id($last_id);

            $dataV['manger_email']     =   $manger_detail->email;
            $dataV['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;

            $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

            $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                ->to($manger_detail->email)         
                ->subject('Approved Expense')    
                ->message($view)
                ->set_mailtype('html');

            // // send email
            $sent = $this->email->send();

            if($sent)
            {
                $getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');
                 // print_r($getAllMangerList);die;

                foreach ($getAllMangerList as $key => $value) 
                {

                    $dataAllM['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
                    $dataAllM['email']            =   $employe_detail->email;
                    $dataAllM['password']         =   $employe_detail->password;
                    $dataAllM['type']             =   3;
                    $dataAllM['type_msg']         =   'Approved Expense';

                    $dataAllM['amount']           =   $empExpenseDetail->amount;
                    $dataAllM['note']             =   $empExpenseDetail->remark;
                    $dataAllM['leave_name']       =   $leave_category->name;
                    $dataAllM['status']           =   'approved';

                        
                    //--------------Manager Detail-------------------------------------------------------
                    $last_id= $employe_detail->manager_id;;
                    $manger_detail  = $this->Employees_model->edit_id($last_id);

                    $dataAllM['manger_email']     =   $manger_detail->email;
                    $dataAllM['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;


                    $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

                    $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                        ->to($value['email'])         
                        ->subject('Approved Expense')    
                        ->message($view)
                        ->set_mailtype('html');

                    // // send email
                     $sentAll = $this->email->send();

                } 

                $this->session->set_flashdata('success', 'Expense approved successfully');
            }
            else{
               $this->session->set_flashdata('error', 'Oops something went wrong please try again.');
            }
        }
        redirect("/EmployeeExpenseAdmin");

    }


    public function decline($id)
    {
        $this->load->library('email');
        
        $data = array('status'=>'decline');
        $update = $this->Expense_model->updateemployeeexpense($data,$id);


        if($update)
        {
            $empExpenseDetail = $this->CommonModel->getsingle('expense_appliedby_employee',array('id'=>$id));

        //--------------Employee Detail-------------------------------------------------------
            $last_id= $empExpenseDetail->employee_id;
            $employe_detail = $this->Employees_model->edit_id($last_id);


            $where = array('expense_category_id'=> $empExpenseDetail->expense_category_id);
            $leave_category = $this->CommonModel->getsingle('expense_categories',$where);

            $dataV['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
            $dataV['email']            =   $employe_detail->email;
            $dataV['password']         =   $employe_detail->password;
            $dataV['type']             =   4;
            $dataV['type_msg']         =   'Rejected Expense';

            $dataV['amount']           =   $empExpenseDetail->amount;
            $dataV['note']             =   $empExpenseDetail->remark;
            $dataV['leave_name']       =   $leave_category->name;
            $dataV['status']           =   'rejected';


        //--------------Manager Detail-------------------------------------------------------
            $last_id= $employe_detail->manager_id;;
            $manger_detail  = $this->Employees_model->edit_id($last_id);

            $dataV['manger_email']     =   $manger_detail->email;
            $dataV['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;

            $view = $this->load->view('email_templates/employee_message',$dataV,TRUE );

            $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                ->to($manger_detail->email)         
                ->subject('Rejected Expense')    
                ->message($view)
                ->set_mailtype('html');

            // // send email
            $sent = $this->email->send();

            if($sent)
            {
                $getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');
                 // print_r($getAllMangerList);die;

                foreach ($getAllMangerList as $key => $value) 
                {

                    $dataAllM['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
                    $dataAllM['email']            =   $employe_detail->email;
                    $dataAllM['password']         =   $employe_detail->password;
                    $dataAllM['type']             =   3;
                    $dataAllM['type_msg']         =   'Rejected Expense';

                    $dataAllM['amount']           =   $empExpenseDetail->amount;
                    $dataAllM['note']             =   $empExpenseDetail->remark;
                    $dataAllM['leave_name']       =   $leave_category->name;
                    $dataAllM['status']           =   'rejected';

                        
                    //--------------Manager Detail-------------------------------------------------------
                    $last_id= $employe_detail->manager_id;;
                    $manger_detail  = $this->Employees_model->edit_id($last_id);

                    $dataAllM['manger_email']     =   $manger_detail->email;
                    $dataAllM['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;


                    $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

                    $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                        ->to($value['email'])         
                        ->subject('Rejected Expense')    
                        ->message($view)
                        ->set_mailtype('html');

                    // // send email
                     $sentAll = $this->email->send();
                } 
                $this->session->set_flashdata('success', 'Expense rejected successfully');
            }
            else{
               $this->session->set_flashdata('error', 'Oops something went wrong please try again.');
            }
        }


        redirect("/EmployeeExpenseAdmin");
    }
    
}