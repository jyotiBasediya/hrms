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

class ReportController extends MY_Controller {
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
		$this->load->model("Client_model");
		$this->load->model("Project_model");
		$this->load->model("Task_model");
		$this->load->model('CommonModel');
        $this->load->model('Employees_model');
	}

	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}

	public function report_list()
    {
    	
    	$data['clients'] = $this->Client_model->getAllClient();
	    $data['employees'] = $this->Project_model->getAllemp();
	    $data['project'] = $this->Project_model->getAllproject();
	    $data['task']=$this->Task_model->getdata();

// print_r( $data['employees']);die;

	    $client_name = "";
	    $project_name = "";
	    $task_id = "";
	    $employee = "";
        $task_status = "";
        // $approved_status = "";

         $approved_status = 'ALL';
         
        $start_date = "";
        $end_date = "";
        

	    $data['report_list'] = $this->CommonModel->getTimesheetReport($client_name,$project_name,$task_id,$employee,$task_status,$approved_status,$start_date,$end_date);
// print_r($data['report_list']);die;
		$this->load->view('common/header');
		$this->load->view('report/report_list',$data);

		$this->load->view('common/footer');  
    }



    public function getProject()
	{
        $condition  = array(
            "client_name" => $this->input->post('client_name'),
            "status" => 'active',
        );
        $catData = $this->CommonModel->selectResultDataByCondition($condition,'add_project');
        
        if (!empty($catData)) {
            echo json_encode($catData);
        }else{
            echo "0";
        }
    }

    public function getEmpProject()
    {
        
        $emp_name =$this->input->post('emp_name');
        
        $catData = $this->CommonModel->getEmpProject($emp_name);
        
        // print_r($catData);die;
        if (!empty($catData)) {
            echo json_encode($catData);
        }else{
            echo "0";
        }
    }

    public function getTask()
	{
		$project_name = $this->input->post('project_name');

        $condition  = array(
            "project_name" => $this->input->post('project_name'),
            "task_status" => 'active',
        );
        $catData = $this->CommonModel->selectResultDataByCondition($condition,'hrms_tasks');
        
        if (!empty($catData)) {
            echo json_encode($catData);
        }else{
            echo "0";
        }
    }

    public function getEmployee()
	{

		$task_id = $this->input->post('task_id');
        $catData = $this->CommonModel->getEmployeeTask($task_id);
        // print_r($catData);die;
        
        if (!empty($catData)) {
            echo json_encode($catData);
        }else{
            echo "0";
        }
    } 

    public function filter()
    {

    	$client_name = $this->input->post('client_name');
    	$project_name = $this->input->post('project_name');
    	$task_id = $this->input->post('task_id');
    	$employee = $this->input->post('employee_name');
        $task_status = $this->input->post('task_status');



        if(isset($_POST['approved_status']))
        {
            $approved_status = $this->input->post('approved_status');
        }else{
            $approved_status = 'ALL';
        }
        // echo $approved_status;
        // echo "<br>";
        // print_r($_POST);die;
        // $approved_status = isset($this->input->post('approved_status'))?$this->input->post('approved_status'):'';

        $start_date = $this->input->post('start');
        $end_date = $this->input->post('end');


        $key  = $this->CommonModel->getTimesheetReport($client_name,$project_name,$task_id,$employee,$task_status,$approved_status,$start_date,$end_date);
    	// print_r($key);die;

        $session = $this->session->userdata('username');
       $user_info = $this->Hrms_model->read_user_info($session['user_id']);
       
       // print_r($user_info[0]->user_id);die;
       $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
       
       $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
       
       $role_resources_ids = explode(',',$role_user[0]->role_resources);

        if ($key) 
        {
            $k = 0;
            for ($i=0; $i < count($key); $i++) { 

               	$company = $key[$i]['client_first_name'].' '.$key[$i]['client_first_name'];
               	$employee = $key[$i]['first_name'].' '.$key[$i]['last_name'];
               	$status = '';
                $total = $key[$i]['cost'] * $key[$i]['hour'];
                $k = $k+1;

                if($key[$i]['approved_status'] == 1){
                    $status = ' <span class="btn btn-success remove_effect">Approved</span>';

                    $approved_status ='<a href="#myModalComplete" data-toggle="modal" class="btn btn-primary complete" value='.$key[$i]['id'].' data-id='.$key[$i]['id'].'>Completed</a>';
                }else if($key[$i]['approved_status'] == 2){
                    $status = ' <span class="btn btn-danger remove_effect">Rejected</span>';

                    $approved_status ='<span class="btn btn-danger remove_effect">Rejected</span>';
                }else if($key[$i]['approved_status'] == 3){
                    $status = ' <span class="btn btn-success remove_effect">Completed</span>';

                    $approved_status ='<span class="btn btn-success remove_effect">Completed</span>';
                }else{
                    $status = ' <span class="btn btn-info remove_effect">Pending</span>';

                    $accept = '<a href="#myModalAccept" data-toggle="modal" class="btn btn-primary accept" value='.$key[$i]['id'].' data-id='.$key[$i]['id'].'>Accept</a>';
                    $rejected = '<a href="#myModalReject" data-toggle="modal" class="btn btn-primary reject" value='.$key[$i]['id'].' data-id='.$key[$i]['id'].'>Reject</a>';

                    $approved_status = $accept.' '.$rejected;
                }

                if(!empty($key[$i]['comment']))
                {
                    $comment = $key[$i]['comment'];
                }else{
                    $comment = "No Comment";
                }


                $date = date("d-m-Y", strtotime($key[$i]['date']));


                if(in_array('68',$role_resources_ids)) {
                     $arr[] = array(
                        $k,
                        $company,
                        $key[$i]['project_name'],
                        $key[$i]['task_name'],
                        $employee,
                        $key[$i]['employee_email'],
                        $date,
                        $key[$i]['hour'],
                        $key[$i]['task_status'],
                        $key[$i]['cost'],
                        $total,
                        $status,
                        $comment,
                        $approved_status 
                    );
                }else{
                     $arr[] = array(
                        $k,
                        $company,
                        $key[$i]['project_name'],
                        $key[$i]['task_name'],
                        $employee,
                        $key[$i]['employee_email'],
                        $date,
                        $key[$i]['hour'],
                        $key[$i]['task_status'],
                        $key[$i]['cost'],
                        $total,
                        $status,
                        $comment,
                    );
                }
            }
        }

        if (!empty($arr)) {
            $arr2 = array("data" => $arr);
        }else{
            $arr2 = array("data" => []);
        }
        echo json_encode($arr2);
    }


    public function employee_report_list()
    {

        $session = $this->session->userdata('username');
            
        $user_id = $session['user_id'];
        
        // $data['clients'] = $this->Client_model->getAllClient();
        // $data['employees'] = $this->Project_model->getAllemp();
        // $data['project'] = $this->Project_model->getAllproject();
        // $data['task']=$this->Task_model->getdata();


        // $client_name = "";
        // $project_name = "";
        // $task_id = "";
        // $employee = $user_id;

        // $data['report_list'] = $this->CommonModel->getReport($client_name,$project_name,$task_id,$employee);

        $data['clients'] = $this->Client_model->getAllClient();
        $data['employees'] = $this->Project_model->getAllemp();
        $data['project'] = $this->Project_model->getAllproject();
        $data['task']=$this->Task_model->getdata();

// print_r( $data['employees']);die;

        $client_name = "";
        $project_name = "";
        $task_id = "";
        $employee = $session['user_id'];
        $task_status = "";
        // $approved_status = "";

         $approved_status = 'ALL';
         
        $start_date = "";
        $end_date = "";
        

        $data['report_list'] = $this->CommonModel->getTimesheetReport($client_name,$project_name,$task_id,$employee,$task_status,$approved_status,$start_date,$end_date);

        $this->load->view('common/header');
        // $this->load->view('report/employee_report_list',$data);
        $this->load->view('report/employee_timesheet_report',$data);

        $this->load->view('common/footer');  
    }

    public function employee_search()
    {

        $session = $this->session->userdata('username');
            
        $user_id = $session['user_id'];
        
        $data['clients'] = $this->Client_model->getAllClient();
        $data['employees'] = $this->Project_model->getAllemp();
        $data['project'] = $this->Project_model->getAllproject();
        $data['task']=$this->Task_model->getdata();


        $client_name = "";
        $project_name = "";
        $task_id = "";
        $employee = $user_id;

        $data['report_list'] = $this->CommonModel->getReport($client_name,$project_name,$task_id,$employee);

        $this->load->view('common/header');
        $this->load->view('report/employee_search',$data);

        $this->load->view('common/footer');  
    }

    public function searchEmp()
    {
        $word = $this->input->post('word');

        $key = $this->CommonModel->searchEmp($word);
        // print_r($key);die;

        if ($key) 
        {
            $k = 0;
            for ($i=0; $i < count($key); $i++) { 

                $employee = $key[$i]['first_name'].' '.$key[$i]['last_name'];

                if($key[$i]['manager_id'])
                {
                    $manager = $key[$i]['m_f_name'].' '.$key[$i]['m_l_name'];
                }else{
                    $manager = 'No manager assign';
                }
                
                if($key[$i]['location'])
                {
                    $location = $key[$i]['location'];
                }else{
                    $location = 'No location added';
                }

                if($key[$i]['time_zone'])
                {
                    $time_zone = $key[$i]['time_zone'];
                }else{
                    $time_zone = 'No time zone added';
                }

                $date = date("d M", strtotime($key[$i]['date_of_birth']));
                $status = '';
                $k = $k+1;

                if(!empty($key[$i]['profile_picture']))
                  {
                    $gst_img = base_url().'uploads/gst/'.$key[$i]['profile_picture'];
                  }else{
                    $gst_img =  base_url().'uploads/gst/default.png';
                  }

                $img = '<img src="'.$gst_img.'" alt="img" width="500" height="600">';
                $arr[] = array(
                    $k,
                    $employee,
                    $manager,
                    $img,
                    $key[$i]['mobile_no'],
                    $key[$i]['email'],
                    $date,
                    $key[$i]['level'],
                    $location,
                    $time_zone,
                );
            }
        }

        if (!empty($arr)) {
            $arr2 = array("data" => $arr);
        }else{
            $arr2 = array("data" => []);
        }
        echo json_encode($arr2);
    }


    public function time_status()
    {



        $this->load->library('email');
        // print_r($_POST);die;
        
        $id          =  $this->input->post('id');
        $approved_status  =  $this->input->post('approved_status');
        $admin_comment  =  $this->input->post('admin_comment');
        
        
        $condition = array(
            "id" => $id
        );
        
        if($approved_status == 1)
        {
            $data = array(
                'approved_status' => $approved_status
            );

            $updateData = $this->CommonModel->updateRowByCondition($condition,'employee_resources',$data);

            if($updateData){
                // $where = array('id'=>$this->input->post('leave'));
                $employee_resources = $this->CommonModel->getsingle('employee_resources',$condition);


                 $last_id= $employee_resources->employee_id;
                $employe_detail = $this->Employees_model->edit_id($last_id);

                $manger_id = $employe_detail->manager_id;

                  $dataV['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
                // $dataV['email']             =   $employe_detail->email;
                // $dataV['password']          =   $employe_detail->password;
                $dataV['type']              =   8;
                $dataV['type_msg']          =   'Task approved';
                $dataV['status']            =   'approved';

                //--------------Manager Detail-------------------------------------------------------
                $last_id= $employe_detail->manager_id;;
                $manger_detail  = $this->Employees_model->edit_id($last_id);

                $dataV['manger_email']     =   $manger_detail->email;
                $dataV['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;


                  $view = $this->load->view('email_templates/employee_message',$dataV,TRUE );

                    $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                        ->to($employe_detail->email)         
                        ->subject('Task approved')    
                        ->message($view)
                        ->set_mailtype('html');

                    // // send email
                    $sent = $this->email->send();

                 if($sent){
                //--------------ALl Manger send mail-----------------------------------------------------
                        $getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');
                         // print_r($getAllMangerList);die;

                        foreach ($getAllMangerList as $key => $value) 
                        {
                            $last_id= $session['user_id'];
                            $employe_detail = $this->Employees_model->edit_id($last_id);

                            $manger_id = $employe_detail->manager_id;


                            $where = array('id'=>$this->input->post('leave'));
                            $leave_category = $this->CommonModel->getsingle('hrms_leave_category',$where);

                            $dataAllM['emp_name']              =   $employe_detail->first_name.' '.$employe_detail->last_name;
                            $dataAllM['email']             =   $employe_detail->email;
                            $dataAllM['password']          =   $employe_detail->password;
                            $dataAllM['type']              =   8;
                            $dataAllM['type_msg']          =   'Task approved';

                            $dataAllM['status']            =   'rejected';

                            //--------------Manager Detail-------------------------------------------------------
                                $dataAllM['manger_email']     =   $value['email'];
                                $dataAllM['name']             =   $value['first_name'].' '.$value['last_name'];


                            $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

                            $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                                ->to($value['email'])         
                                ->subject('Task approved')    
                                ->message($view)
                                ->set_mailtype('html');

                            // // send email
                             $sentAll = $this->email->send();

                        }
                //--------------ALl Manger send mail-----------------------------------------------------      
                    }
            }
            
             $this->session->set_flashdata('success','You approved task');
                    redirect('ReportController/report_list'); 
        }
        elseif($approved_status == 2)
        {
            $data = array(
                'approved_status' => $approved_status,
                'comment' => $admin_comment,
            );

            $updateData = $this->CommonModel->updateRowByCondition($condition,'employee_resources',$data);

            if($updateData){
                // $where = array('id'=>$this->input->post('leave'));
                $employee_resources = $this->CommonModel->getsingle('employee_resources',$condition);


                 $last_id= $employee_resources->employee_id;
                $employe_detail = $this->Employees_model->edit_id($last_id);

                $manger_id = $employe_detail->manager_id;

                  $dataV['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
                // $dataV['email']             =   $employe_detail->email;
                // $dataV['password']          =   $employe_detail->password;
                $dataV['type']              =   8;
                $dataV['type_msg']          =   'Task rejected';
                $dataV['status']            =   'rejected';
                $dataV['note']            =   $admin_comment;

                //--------------Manager Detail-------------------------------------------------------
                $last_id= $employe_detail->manager_id;;
                $manger_detail  = $this->Employees_model->edit_id($last_id);

                $dataV['manger_email']     =   $manger_detail->email;
                $dataV['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;


                  $view = $this->load->view('email_templates/employee_message',$dataV,TRUE );

                    $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                        ->to($employe_detail->email)         
                        ->subject('Task rejected')    
                        ->message($view)
                        ->set_mailtype('html');

                    // // send email
                    $sent = $this->email->send();

                 if($sent){
                //--------------ALl Manger send mail-----------------------------------------------------
                        $getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');
                         // print_r($getAllMangerList);die;

                        foreach ($getAllMangerList as $key => $value) 
                        {
                            $last_id= $session['user_id'];
                            $employe_detail = $this->Employees_model->edit_id($last_id);

                            $manger_id = $employe_detail->manager_id;


                            $where = array('id'=>$this->input->post('leave'));
                            $leave_category = $this->CommonModel->getsingle('hrms_leave_category',$where);

                            $dataAllM['emp_name']              =   $employe_detail->first_name.' '.$employe_detail->last_name;
                            $dataAllM['email']             =   $employe_detail->email;
                            $dataAllM['password']          =   $employe_detail->password;
                            $dataAllM['type']              =   8;
                            $dataAllM['type_msg']          =   'Task rejected';

                            $dataAllM['status']            =   'rejected';

                             $dataAllM['note']            =   $admin_comment;
                            //--------------Manager Detail-------------------------------------------------------
                                $dataAllM['manger_email']     =   $value['email'];
                                $dataAllM['name']             =   $value['first_name'].' '.$value['last_name'];


                            $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

                            $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                                ->to($value['email'])         
                                ->subject('Task rejected')    
                                ->message($view)
                                ->set_mailtype('html');

                            // // send email
                             $sentAll = $this->email->send();

                        }
                //--------------ALl Manger send mail-----------------------------------------------------      
                    }
            }
            
             $this->session->set_flashdata('success','You rejected task');
                    redirect('ReportController/report_list'); 
        }
        elseif($approved_status == 3)
        {
            $data = array(
                'approved_status' => $approved_status
            );

            $updateData = $this->CommonModel->updateRowByCondition($condition,'employee_resources',$data);
                
             if($updateData){
                // $where = array('id'=>$this->input->post('leave'));
                $employee_resources = $this->CommonModel->getsingle('employee_resources',$condition);


                 $last_id= $employee_resources->employee_id;
                $employe_detail = $this->Employees_model->edit_id($last_id);

                $manger_id = $employe_detail->manager_id;

                  $dataV['name']             =   $employe_detail->first_name.' '.$employe_detail->last_name;
                // $dataV['email']             =   $employe_detail->email;
                // $dataV['password']          =   $employe_detail->password;
                $dataV['type']              =   8;
                $dataV['type_msg']          =   'Task complete';
                $dataV['status']            =   'complete';

                //--------------Manager Detail-------------------------------------------------------
                $last_id= $employe_detail->manager_id;;
                $manger_detail  = $this->Employees_model->edit_id($last_id);

                $dataV['manger_email']     =   $manger_detail->email;
                $dataV['emp_name']         =   $manger_detail->first_name.' '.$manger_detail->last_name;


                  $view = $this->load->view('email_templates/employee_message',$dataV,TRUE );

                    $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                        ->to($employe_detail->email)         
                        ->subject('Task complete')    
                        ->message($view)
                        ->set_mailtype('html');

                    // // send email
                    $sent = $this->email->send();

                 if($sent){
                //--------------ALl Manger send mail-----------------------------------------------------
                        $getAllMangerList = $this->CommonModel->selectResultDataByConditionAndFieldName(array('user_role_id' => 5),'hrms_employees','hrms_employees.user_id');
                         // print_r($getAllMangerList);die;

                        foreach ($getAllMangerList as $key => $value) 
                        {
                            $last_id= $session['user_id'];
                            $employe_detail = $this->Employees_model->edit_id($last_id);

                            $manger_id = $employe_detail->manager_id;


                            $where = array('id'=>$this->input->post('leave'));
                            $leave_category = $this->CommonModel->getsingle('hrms_leave_category',$where);

                            $dataAllM['emp_name']              =   $employe_detail->first_name.' '.$employe_detail->last_name;
                            $dataAllM['email']             =   $employe_detail->email;
                            $dataAllM['password']          =   $employe_detail->password;
                            $dataAllM['type']              =   8;
                            $dataAllM['type_msg']          =   'Task complete';

                            $dataAllM['status']            =   'complete';

                            //--------------Manager Detail-------------------------------------------------------
                                $dataAllM['manger_email']     =   $value['email'];
                                $dataAllM['name']             =   $value['first_name'].' '.$value['last_name'];


                            $view = $this->load->view('email_templates/employee_message',$dataAllM,TRUE );

                            $this->email->from('hrms@aaravsolutions.com', 'AARAV SOLUTIONS HRMS PORTAL')
                                ->to($value['email'])         
                                ->subject('Task complete')    
                                ->message($view)
                                ->set_mailtype('html');

                            // // send email
                             $sentAll = $this->email->send();

                        }
                //--------------ALl Manger send mail-----------------------------------------------------      
                    }
            }
            
             $this->session->set_flashdata('success','You complete');
                    redirect('ReportController/report_list'); 
        }
    }


    public function employee_filter()
    {

        $client_name = $this->input->post('client_name');
        $project_name = $this->input->post('project_name');
        $task_id = $this->input->post('task_id');
        $employee = $this->input->post('employee_name');
        $task_status = $this->input->post('task_status');



        if(isset($_POST['approved_status']))
        {
            $approved_status = $this->input->post('approved_status');
        }else{
            $approved_status = 'ALL';
        }
        // echo $approved_status;
        // echo "<br>";
        // print_r($_POST);die;
        // $approved_status = isset($this->input->post('approved_status'))?$this->input->post('approved_status'):'';

        $start_date = $this->input->post('start');
        $end_date = $this->input->post('end');


        $key  = $this->CommonModel->getTimesheetReport($client_name,$project_name,$task_id,$employee,$task_status,$approved_status,$start_date,$end_date);
        // print_r($key);die;

        $session = $this->session->userdata('username');
       $user_info = $this->Hrms_model->read_user_info($session['user_id']);
       
       // print_r($user_info[0]->user_id);die;
       $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
       
       $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
       
       $role_resources_ids = explode(',',$role_user[0]->role_resources);

        if ($key) 
        {
            $k = 0;
            for ($i=0; $i < count($key); $i++) { 

                $company = $key[$i]['client_first_name'].' '.$key[$i]['client_first_name'];
                $employee = $key[$i]['first_name'].' '.$key[$i]['last_name'];
                $status = '';
                $total = $key[$i]['cost'] * $key[$i]['hour'];
                $k = $k+1;

                if($key[$i]['approved_status'] == 1){
                    $status = ' <span class="btn btn-success remove_effect">Approved</span>';

                    $approved_status ='<a href="#myModalComplete" data-toggle="modal" class="btn btn-primary complete" value='.$key[$i]['id'].' data-id='.$key[$i]['id'].'>Completed</a>';
                }else if($key[$i]['approved_status'] == 2){
                    $status = ' <span class="btn btn-danger remove_effect">Rejected</span>';

                    $approved_status ='<span class="btn btn-danger remove_effect">Rejected</span>';
                }else if($key[$i]['approved_status'] == 3){
                    $status = ' <span class="btn btn-success remove_effect">Completed</span>';

                    $approved_status ='<span class="btn btn-success remove_effect">Completed</span>';
                }else{
                    $status = ' <span class="btn btn-info remove_effect">Pending</span>';

                    $accept = '<a href="#myModalAccept" data-toggle="modal" class="btn btn-primary accept" value='.$key[$i]['id'].' data-id='.$key[$i]['id'].'>Accept</a>';
                    $rejected = '<a href="#myModalReject" data-toggle="modal" class="btn btn-primary reject" value='.$key[$i]['id'].' data-id='.$key[$i]['id'].'>Reject</a>';

                    $approved_status = $accept.' '.$rejected;
                }

                if(!empty($key[$i]['comment']))
                {
                    $comment = $key[$i]['comment'];
                }else{
                    $comment = "No Comment";
                }


                $date = date("d-m-Y", strtotime($key[$i]['date']));

                 $arr[] = array(
                    $k,
                    $company,
                    $key[$i]['project_name'],
                    $key[$i]['task_name'],
                    $employee,
                    $key[$i]['employee_email'],
                    $date,
                    $key[$i]['hour'],
                    $key[$i]['task_status'],
                    // $key[$i]['cost'],
                    // $total,
                    $status,
                    $comment,
                );
                
            }
        }

        if (!empty($arr)) {
            $arr2 = array("data" => $arr);
        }else{
            $arr2 = array("data" => []);
        }
        echo json_encode($arr2);
    }
}

