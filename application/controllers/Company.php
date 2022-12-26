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
 * @package  iLinkHR - Company
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
	
	 public function __construct() {
    	parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the models
		$this->load->model("Company_model");
		$this->load->model("Hrms_model");
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
		$data['title'] = $this->Hrms_model->site_title();
		$data['all_countries'] = $this->Hrms_model->get_countries();
		$data['get_company_types'] = $this->Company_model->get_company_types();
		$data['breadcrumbs'] = $this->lang->line('module_company_title');
		$data['path_url'] = 'company';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('3',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("company/company_list", $data, TRUE);
				$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
     }
 
    public function company_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("company/company_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$company = $this->Company_model->get_companiesWithoutSuperAdmin();
		
		$data = array();

          foreach($company->result() as $r) {
			  
			  // get country
			  $country = $this->Hrms_model->read_country_info($r->country);
			  // get user
			  $user = $this->Hrms_model->read_user_info($r->added_by);
			  // user full name
			  if(!is_null($user)){
			  	$full_name = $user[0]->first_name.' '.$user[0]->last_name;
			  } else {
				  $full_name = '--';	
			  }
			  if ($r->is_active == 1)
			   {
			  	$activeNotactive = 'inactive';
			  	$faIcon ='fa-check';
			  }else{
			  	$activeNotactive = 'active';
			  	$faIcon ='fa-close';
			  }
			  
               $data[] = array(
			   		'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-company_id="'. $r->company_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-company_id="'. $r->company_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->company_id . '"><i class="fa fa-trash-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$activeNotactive.'"><a href="javascript:void(0);" onclick="setValinactive('.$r->company_id .')" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" ><i class="fa '.$faIcon.'"></i></a></span>

			   		',
                    $r->name,
                    $r->email,
                    $r->website_url,
                    $r->city,
                    $country[0]->country_name,
					$full_name
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $company->num_rows(),
                 "recordsFiltered" => $company->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	 
	 public function read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('company_id');
       // $data['all_countries'] = $this->Hrms_model->get_countries();
		$result = $this->Company_model->read_company_information($id);
		$data = array(
				'company_id' => $result[0]->company_id,
				'name' => $result[0]->name,
				'type_id' => $result[0]->type_id,
				'government_tax' => $result[0]->government_tax,
				'trading_name' => $result[0]->trading_name,
				'registration_no' => $result[0]->registration_no,
				'email' => $result[0]->email,
				'logo' => $result[0]->logo,
				'contact_number' => $result[0]->contact_number,
				'website_url' => $result[0]->website_url,
				'address_1' => $result[0]->address_1,
				'address_2' => $result[0]->address_2,
				'city' => $result[0]->city,
				'state' => $result[0]->state,
				'zipcode' => $result[0]->zipcode,
				'countryid' => $result[0]->country,
				'all_countries' => $this->Hrms_model->get_countries(),
				'get_company_types' => $this->Company_model->get_company_types()
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('company/dialog_company', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_company() {
	
		if($this->input->post('add_type')=='company') {
		// Check validation for user input
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lname', 'last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('epassword', 'epassword', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fname', 'first name', 'trim|required|xss_clean');
		$name = $this->input->post('name');
		$trading_name = $this->input->post('trading_name');
		$registration_no = $this->input->post('registration_no');
		$email = $this->input->post('email');
		$contact_number = $this->input->post('contact_number');
		$website = $this->input->post('website');
		$address_1 = $this->input->post('address_1');
		$address_2 = $this->input->post('address_2');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zipcode = $this->input->post('zipcode');
		$country = $this->input->post('country');
		$user_id = $this->input->post('user_id');
		$file = $_FILES['logo']['tmp_name'];
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$username = $this->input->post('username');
		$password = $this->input->post('epassword');
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		if($name==='') {
			$Return['error'] = $this->lang->line('hrms_error_name_field');
		} else if( $this->input->post('company_type')==='') {
			$Return['error'] = $this->lang->line('hrms_error_ctype_field');
		} else if($contact_number==='') {
			$Return['error'] = $this->lang->line('hrms_error_contact_field');
		} else if($email==='') {
			$Return['error'] = $this->lang->line('hrms_error_cemail_field');
		} else if($website==='') {
			$Return['error'] = $this->lang->line('hrms_error_website_field');
		}  else if($city==='') {
			$Return['error'] = $this->lang->line('hrms_error_city_field');
		} else if($zipcode==='') {
			$Return['error'] = $this->lang->line('hrms_error_zipcode_field');
		} else if($country==='') {
			$Return['error'] = $this->lang->line('hrms_error_country_field');
		}else if($fname==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_first_name');
		}  else if($lname==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_last_name');
		} else if($username==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_username');
		} else if($this->check_exist_username($username)) {
			 $Return['error'] = "This username is already exist.";
		} else if($password==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_password');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['logo']['size'] == 0) {
			$fname = 'no file';
			 $Return['error'] = $this->lang->line('hrms_error_logo_field');
		} else {
			if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','gif');
				$filename = $_FILES['logo']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["logo"]["tmp_name"];
					$bill_copy = "uploads/company/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$lname = basename($_FILES["logo"]["name"]);
					$newfilename = 'logo_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
				} else {
					$Return['error'] = $this->lang->line('hrms_error_attatchment_type');
				}
			}
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'name' => $this->input->post('name'),
		'type_id' => $this->input->post('company_type'),
		'government_tax' => $this->input->post('hrms_gtax'),
		'trading_name' => $this->input->post('trading_name'),
		'registration_no' => $this->input->post('registration_no'),
		'email' => $this->input->post('email'),
		'contact_number' => $this->input->post('contact_number'),
		'website_url' => $this->input->post('website'),
		'address_1' => $this->input->post('address_1'),
		'address_2' => $this->input->post('address_2'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'added_by' => $this->input->post('user_id'),
		'logo' => $fname,
		'created_at' => date('d-m-Y'),
		
		);
		$result0911 = $this->Company_model->add($data);
		$lastId = $this->db->insert_id();

		

		$dataInsert = array(
		'first_name' => $this->input->post('fname'),
		'last_name' => $this->input->post('lname'),
		'username' => $this->input->post('username'),
		'email' => $this->input->post('email'),
		'password' => $this->input->post('epassword'),
		'company_id' =>$lastId,
		'department_id'=>2,
		'designation_id'=>2,
		'office_shift_id'=>1,
		'user_role_id' =>1,
		'user_role_id' =>1,
		'is_active' =>1,
		'gender'=>'Male',
		'created_at' => date('d-m-Y')

		);
	
		$result = $this->Hrms_model->insert_entry('hrms_employees',$dataInsert);
		
		$empLastId = $this->db->insert_id();
// location
		$dataLocation = array(
		'company_id' => $lastId,
		'location_name' => $this->input->post('name'),
		'location_head' => $empLastId,
		'location_manager' => $empLastId,
		'email' => $this->input->post('email'),
		'phone' => $this->input->post('contact_number'),
		'address_1' => $this->input->post('address_1'),
		'address_2' => $this->input->post('address_2'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'added_by' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Hrms_model->insert_entry('hrms_office_location',$dataLocation);
		$locId = $this->db->insert_id();
// department
		$dataDepartment = array(
		'department_name' => 'Admin',
		'location_id' => $locId,
		'employee_id' => $empLastId,
		'added_by' => $empLastId,
		'company_id' => $lastId,
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Hrms_model->insert_entry('hrms_departments',$dataDepartment);
		$depId = $this->db->insert_id();
//Designation
		$dataDesignation = array(
		'department_id' => $depId,
		'designation_name' => 'admin',
		'added_by' => $this->input->post('user_id'),
		'company_id' => $lastId,
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Hrms_model->insert_entry('hrms_designations',$dataDesignation);
		$lastDesig = $this->db->insert_id();
//*update employee head designation
		$dataUpdateEmp = array(
			'designation_id' => $lastDesig,
			);
		$where = array('user_id'=>$empLastId);
		$this->Hrms_model->update_entry('hrms_employees',$dataUpdateEmp,$where);

		$dataOffice = array(
			'shift_name' => 'morning',
			'company_id' =>$lastId,
			'default_shift' => 0,
			'monday_in_time' => '09:00',
			'monday_out_time' => '17:00',
			'tuesday_in_time' => '09:00',
			'tuesday_out_time' => '17:00',
			'wednesday_in_time' => '09:00',
			'wednesday_out_time' => '17:00',
			'thursday_in_time' => '09:00',
			'thursday_out_time' => '17:00',
			'friday_in_time' => '09:00',
			'friday_out_time' => '17:00',
			'saturday_in_time' => '09:00',
			'saturday_out_time' => '17:00',
			'sunday_in_time' =>'09:00',
			'sunday_out_time' => '17:00',
			'created_at' =>date('Y-m-d H:i:s'),
			);
		$result = $this->Hrms_model->insert_entry('hrms_office_shift',$dataOffice);
		if ($result0911 === true) {
				
			$data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
			$data['message'] = 'Registration of your company is successfully done your username = "'.$this->input->post('username').'" and password = '.$this->input->post('epassword').'';
			$data['title'] = "iLinkHR Registration";
			$this->load->library('email');
			/*$config['mailtype'] = 'html';
			$config['charset'] = 'iso-8859-1';
			$config['priority'] = 1;*/
			$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_user' => 'neeteshagrawal',
			'smtp_pass' => 'neetesh@12345',
			'smtp_port' => 587,
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		    ));
			//$this->email->initialize($config);
			$this->email->from('info@infograins.in','iLinkHR');
			$this->email->to($this->input->post('email'));
			$this->email->subject('iLinkHR:-Registration');
			$message = $this->load->view('company_register_template',$data, TRUE);
			
			$this->email->message($message);
			// $this->email->send();
			if ($this->email->send()) {
			$Return['result'] = $this->lang->line('hrms_success_add_company');
		} else {
		    
		    $Return['result'] = $this->lang->line('hrms_success_add_company');
			//$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		} else {

			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
// ***************send email******
		
//****************end email********
		$this->output($Return);
		exit;
		}
	}
	public function check_exist_username($username)
	{
		$employee = $this->Employees_model->read_employee_information_by_username($username);
		if($employee === true){
			return true;
		} else {
			return false;
		}
	}
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='company') {
		$id = $this->uri->segment(3);
		// Check validation for user input
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
		$name = $this->input->post('name');
		$trading_name = $this->input->post('trading_name');
		$registration_no = $this->input->post('registration_no');
		$email = $this->input->post('email');
		$contact_number = $this->input->post('contact_number');
		$website = $this->input->post('website');
		$address_1 = $this->input->post('address_1');
		$address_2 = $this->input->post('address_2');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zipcode = $this->input->post('zipcode');
		$country = $this->input->post('country');
		$user_id = $this->input->post('user_id');
		$file = $_FILES['logo']['tmp_name'];
				
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		if($name==='') {
			$Return['error'] = $this->lang->line('hrms_error_name_field');
		} else if( $this->input->post('company_type')==='') {
			$Return['error'] = $this->lang->line('hrms_error_ctype_field');
		} else if($contact_number==='') {
			$Return['error'] = $this->lang->line('hrms_error_contact_field');
		} else if($email==='') {
			$Return['error'] = $this->lang->line('hrms_error_cemail_field');
		} else if($website==='') {
			$Return['error'] = $this->lang->line('hrms_error_website_field');
		} else if($city==='') {
			$Return['error'] = $this->lang->line('hrms_error_city_field');
		} else if($zipcode==='') {
			$Return['error'] = $this->lang->line('hrms_error_zipcode_field');
		} else if($country==='') {
			$Return['error'] = $this->lang->line('hrms_error_country_field');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['logo']['size'] == 0) {
			 $fname = 'no file';
			 $no_logo_data = array(
			'name' => $this->input->post('name'),
			'type_id' => $this->input->post('company_type'),
			'government_tax' => $this->input->post('hrms_gtax'),
			'trading_name' => $this->input->post('trading_name'),
			'registration_no' => $this->input->post('registration_no'),
			'email' => $this->input->post('email'),
			'contact_number' => $this->input->post('contact_number'),
			'website_url' => $this->input->post('website'),
			'address_1' => $this->input->post('address_1'),
			'address_2' => $this->input->post('address_2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zipcode' => $this->input->post('zipcode'),
			'country' => $this->input->post('country'),
			);
			 $result = $this->Company_model->update_record_no_logo($no_logo_data,$id);
		} else {
			if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','gif');
				$filename = $_FILES['logo']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["logo"]["tmp_name"];
					$bill_copy = "uploads/company/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$lname = basename($_FILES["logo"]["name"]);
					$newfilename = 'logo_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
					$data = array(
					'name' => $this->input->post('name'),
					'type_id' => $this->input->post('company_type'),
					'government_tax' => $this->input->post('hrms_gtax'),
					'trading_name' => $this->input->post('trading_name'),
					'registration_no' => $this->input->post('registration_no'),
					'email' => $this->input->post('email'),
					'contact_number' => $this->input->post('contact_number'),
					'website_url' => $this->input->post('website'),
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'zipcode' => $this->input->post('zipcode'),
					'country' => $this->input->post('country'),
					'logo' => $fname,		
					);
					// update record > model
					$result = $this->Company_model->update_record($data,$id);
				} else {
					$Return['error'] = $this->lang->line('hrms_error_attatchment_type');
				}
			}
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_update_company');
		} else {
			$Return['error'] = $Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
//Delete employee table data

		$where = 'company_id ='.$id;
		$this->Hrms_model->delete_entry('hrms_employees',$where);
		$result = $this->Company_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = $this->lang->line('hrms_success_delete_company');
		} else {
			$Return['error'] = $Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
	}

	public function activeInactive() {
		/* Define return | here result is used to return user data and error for error message */

		$id = $_POST['id'];
		$Return = array('result'=>'', 'error'=>'');
		
		$result = $this->Company_model->read_company_information($id);
		if (!empty($result))
		{
			if ($result[0]->is_active == 1) 
			{
				$status = '2';
			}else{
				$status = '1';
			}
			$data = array(
				'is_active' => $status,
				'modified_at' => date('Y-m-d H:i:s')
				);
			$this->Company_model->update_record($data,$id);
			$Return['result'] = $this->lang->line('hrms_success_add_company');
		}else{
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}

		$this->output($Return);
	}
}
