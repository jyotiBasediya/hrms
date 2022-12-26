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

class Dashboard extends MY_Controller {
	
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
		  $this->load->model('CommonModel');
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
		// echo 1;
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			
		} else {
			redirect('');
		}
		// get user > added by
		$user = $this->Hrms_model->read_user_info($session['user_id']);
		// get designation
		$_designation = $this->Designation_model->read_designation_information($user[0]->designation_id);
		$data = array(
			'title' => $this->Hrms_model->site_title(),
			'breadcrumbs' => $this->lang->line('dashboard_title'),
			'path_url' => 'dashboard',
			'first_name' => $user[0]->first_name,
			'last_name' => $user[0]->last_name,
			'employee_id' => $user[0]->employee_id,
			'username' => $user[0]->username,
			'email' => $user[0]->email,
			// 'designation_name' => $_designation[0]->designation_name,
			'date_of_birth' => $user[0]->date_of_birth,
			'date_of_joining' => $user[0]->date_of_joining,
			'contact_no' => $user[0]->contact_no,
			'last_four_employees' => $this->Hrms_model->last_four_employeesbyCmpId($session['companyId']),
			'last_jobs' => $this->Hrms_model->last_jobs()
			);
		//   print_r($data);
		//     die();*/


		$data['newsletter'] = $this->CommonModel->newsletterList();


		$employee_id = $session['user_id'];
        // $data['data'] = $this->CommonModel->getEmployeeMyTask($employee_id);
        $data['task'] = $this->CommonModel->latestTask($employee_id);
        $data['through_of_day'] = $this->CommonModel->latestThroughofday();

        // print_r($data['task']);die;

		$this->load->view('common/header');
			//$data['subview'] = $this->load->view('dashboard/index',$data);
		$this->load->view('dashboard/index',$data);

		$this->load->view('common/footer');


			// $this->load->view('layout_main',$data); //page load
	}
	
	// get opened and closed tickets for chart
	public function tickets_data()
	{
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('opened'=>'', 'closed'=>'');
		// open
		$Return['opened'] = $this->Hrms_model->all_open_tickets();
		// closed
		$Return['closed'] = $this->Hrms_model->all_closed_tickets();
		$this->output($Return);
		exit;
	}
	
	// get company wise salary
	public function payroll_company_wise()
	{
		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');
		$c_name = array();
		$c_am = array();	
		$c_color = array('#ff4dff','#a64dff','#cc33ff','#9966ff','#0099ff','#33cc33','#ff4dff','#ff1aff','#0099cc','#ff0066');
		$someArray = array();
		$j=0;
		foreach($this->Hrms_model->all_companies_chart() as $comp) {
		$company_pay = $this->Hrms_model->get_company_make_payment($comp->company_id);
		$c_name[] = htmlspecialchars_decode($comp->name);
		$c_am[] = $company_pay[0]->paidAmount;
		$someArray[] = array(
		  'label'   => htmlspecialchars_decode($comp->name),
		  'value' => $company_pay[0]->paidAmount,
		  'bgcolor' => $c_color[$j]
		  );
		  $j++;
		}
		$Return['c_name'] = $c_name;
		$Return['c_am'] = $c_am;
		$Return['chart_data'] = $someArray;
		$this->output($Return);
		exit;
	}
	
	// get location|station wise salary
	public function payroll_location_wise()
	{
		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');
		$c_name = array();
		$c_am = array();	
		$c_color = array('#3e70c9','#f59345','#f44236','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC');
		$someArray = array();
		$j=0;
		foreach($this->Hrms_model->all_location_chart() as $location) {
		$location_pay = $this->Hrms_model->get_location_make_payment($location->location_id);
		$c_name[] = htmlspecialchars_decode($location->location_name);
		$c_am[] = $location_pay[0]->paidAmount;
		$someArray[] = array(
		  'label'   => htmlspecialchars_decode($location->location_name),
		  'value' => $location_pay[0]->paidAmount,
		  'bgcolor' => $c_color[$j]
		  );
		  $j++;
		}
		$Return['c_name'] = $c_name;
		$Return['c_am'] = $c_am;
		$Return['chart_data'] = $someArray;
		$this->output($Return);
		exit;
	}
	
	// get department wise salary
	public function payroll_department_wise()
	{
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');
		$c_name = array();
		$c_am = array();	
		$c_color = array('#3e70c9','#f59345','#f44236','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC');
		$someArray = array();
		$j=0;
		foreach($this->Hrms_model->all_departments_chart() as $department) {
		$department_pay = $this->Hrms_model->get_department_make_payment($department->department_id);
		$c_name[] = htmlspecialchars_decode($department->department_name);
		$c_am[] = $department_pay[0]->paidAmount;
		$someArray[] = array(
		  'label'   => htmlspecialchars_decode($department->department_name),
		  'value' => $department_pay[0]->paidAmount,
		  'bgcolor' => $c_color[$j]
		  );
		  $j++;
		}
		$Return['c_name'] = $c_name;
		$Return['c_am'] = $c_am;
		$Return['chart_data'] = $someArray;
		$this->output($Return);
		exit;
	}
	
	// get designation wise salary
	public function payroll_designation_wise()
	{
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');
		$c_name = array();
		$c_am = array();	
		$c_color = array('#1AAF5D','#F2C500','#F45B00','#8E0000','#0E948C','#6495ED','#DC143C','#006400','#556B2F','#9932CC');
		$someArray = array();
		$j=0;
		foreach($this->Hrms_model->all_designations_chart() as $designation) {
		$result = $this->Hrms_model->get_designation_make_payment($designation->designation_id);
		$c_name[] = htmlspecialchars_decode($designation->designation_name);
		$c_am[] = $result[0]->paidAmount;
		$someArray[] = array(
		  'label'   => htmlspecialchars_decode($designation->designation_name),
		  'value' => $result[0]->paidAmount,
		  'bgcolor' => $c_color[$j]
		  );
		  $j++;
		}
		$Return['c_name'] = $c_name;
		$Return['c_am'] = $c_am;
		$Return['chart_data'] = $someArray;
		$this->output($Return);
		exit;
	}
	
	// set new language
	public function set_language($language = "") {
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
        
    }


    public function add_throughofday()
    {
    	$data  = array( 
			'heading'=>$this->input->post('heading'),
			'description'=>$this->input->post('description'),
		);

		$insert =	$this->db->insert('hrms_throughofday', $data);

		if($insert){
			$this->session->set_flashdata('success','Through of the day');
	            redirect('dashboard');  
		}else{
			$this->session->set_flashdata('error','Something went wrong');
	            redirect('dashboard');  
		}
    }
}
