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
 * @package  iLinkHR - Employees
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the models
		$this->load->model("Timesheet_model");
		$this->load->model("Employees_model");
		$this->load->model("Hrms_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		$this->load->model("Roles_model");
		$this->load->model("Location_model");
		$this->load->model("Add_model");
		$this->load->model("CommonModel");
		$this->load->model("Project_model");
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
		$data['data']=$this->Add_model->getdata();
			$data['groups'] = $this->Add_model->getAllGroups();

			$data['all_roles'] = $this->Roles_model->all_user_roles();

// print_r($data['data']);die;
		$this->load->view('common/header');
		$this->load->view('employees/employees_list',$data);

		$this->load->view('common/footer'); 
    }

    public function viewpost($id)
	{
		$this->load->view('common/header');

		$data['employees_detail'] = $this->Employees_model->edit_id($id);
		$data['all_roles'] = $this->Roles_model->all_user_roles();
		$data['groups'] = $this->Add_model->getAllGroups();
// print_r($data['employees_detail']);die;
		$this->load->view('employees/view_employee',$data);

		$this->load->view('common/footer'); 
	}

    
	public function editpost($id)
	{
		$this->load->view('common/header');

		$data['employees_detail'] = $this->Employees_model->edit_id($id);
		
		$data['all_roles'] = $this->Roles_model->all_user_roles();
		$data['groups'] = $this->Add_model->getAllGroups();

		$data['employees'] = $this->Project_model->getAllemp();

		$data['all_division'] = $this->CommonModel->selectResultDataByCondition(array('status' => 1),'division');

// print_r($data['all_roles']);die;
		$this->load->view('employees/edit_employee',$data);

		$this->load->view('common/footer'); 
	}

	public function updates()
	{ 
		
		// print_r($_POST);die;
		$full_name = $this->input->post('full_name');
		$a = explode(' ', $full_name);
		$f_name = $a[0];
		$l_name = $a[1];

		$id = $this->input->post('id');

		$employees_detail = $this->Employees_model->edit_id($id);

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
                $picture = $employees_detail->profile_picture;
            }
        }else{
            $picture = $employees_detail->profile_picture;
        }

		$data = array(
			'first_name'=>$f_name ,
			'last_name'=>$l_name,
			'email'=>$this->input->post('email'),
			'date_of_joining'=>$this->input->post('sdate'),
			'date_of_leaving'=>$this->input->post('edate'),
			'role'=>$this->input->post('role'),
			'empType'=>$this->input->post('employment'),
			'division'=>$this->input->post('division'),
			'default_task'=>$this->input->post('task'),
			'employee_id'=>$this->input->post('enumuber'),
			'accounting_id'=>$this->input->post('account'),
			'status'=>$this->input->post('status'),
			'notes'=>$this->input->post('note'),
			// 'password'=>$this->input->post('password'),
			// 'confirm_password'=>$this->input->post('cpass'),

			'check_timesheat' => $this->input->post('check_timesheat'),
			'timesheet' => $this->input->post('timesheet'),
			'check_timeoff' => $this->input->post('check_timeoff'),
			'time_off' => $this->input->post('time_off'),
			'expense_check' => $this->input->post('check_expense'),
			'expenses' => $this->input->post('expenses'),

			'desk_number' => $this->input->post('desk_number'),
			'location' => $this->input->post('location'),
			'time_zone' => $this->input->post('time_zone'),

			'user_role_id' => $this->input->post('user_role_id'),

			'date_of_birth' => $this->input->post('date_of_birth'),
			'mobile_no' => $this->input->post('mobile_no'),
			'manager_id' => $this->input->post('manager_id'),

			'profile_picture'=>$picture,

		);

		$this->db->where('user_id',$id);
		$this->db->update('hrms_employees',$data);	

		$this->session->set_flashdata('success','You update employee detail successfully');
		redirect('employees');
	}



   public function edit($id)
   {
      
   	$this->load->model('Employees_model');
   	$user= $this->Employees_model->getuser($id);
   	$data = array();
   	$data['user'] = 	$user;
   	$this->load->view('common/header');
   	$this->load->view('employees/edit',$data);
   	$this->load->view('common/footer');
   }
   // 		  public function updates($id)
   // {
   //     $products=new Employees_model;
   //     $products->update_product($id);
   //     redirect(base_url('employees'));
   // }



	public function editemployee($uid)
	{	
	
		$reslt=$this->Employees_model->getuserdetail($uid);
		$this->load->view('employees/edit',['row'=>$reslt]);

		// $user_id = $this->uri->segment(3);
		// $this->load->model("employees_model");
		// $data["user_data"] = $this->employees_model->update($user_id);
		// $data["fetch_data"] = $this->Add_model->getdata();
		// $this->load->view('employees/edit',$data);

  //     $id=$this->input->post('id');
  //     $full_name=$this->input->post('full_name');
  //      $email=$this->input->post('mail_id');


		// $data['edit'] = $this->Employees_model->update($id,$full_name,$email);


		// $this->load->view('employees/edit',$data);
		// $id=$this->input->post('id');
		// $full_name=$this->input->post('full_name');
		// $email=$this->input->post('mail_id');
		// $result['data']=$this->Add_model->update_records($id,$full_name,$email);

		// if($this->input->post('update'))
		// {
		// 	$id=$this->input->post('id');
		// 	$full_name=$this->input->post('full_name');
		// 	$email=$this->input->post('email');
		// 	$this->Add_model->update_records($full_name,$email,$id);
		// 	echo "Date updated successfully !";
		// }

		// $this->load->view('common/header');
		// $this->load->view('employees/edit',$result);
		// $this->load->view('common/footer'); 

	}
     // public function editEmployee()
     // {
  //    	// echo "string";
  //    	// die();
  //    	     	$id=$this->input->post('id');
  //    	     	  	$full_name=$this->input->post('full_name');
  //    	     	  	  	$email=$this->input->post('mail_id');
  //    	$result['data']=$this->Add_model->update_records($id,$full_name,$email);
     	
  //    	if($this->input->post('update'))
		// {
		// $full_name=$this->input->post('full_name');
		
		// $email=$this->input->post('email');
		// $this->Add_model->update_records($full_name,$email,$id);
		// echo "Date updated successfully !";

		// }
			// $this->load->view('common/header');

		 // $this->load->view('employees/update_records');
		 // 		$this->load->view('common/footer');

	// $this->load->view('common/header');
	// 	 $this->load->view('employees/edit');

	// 	$this->load->view('common/footer'); 

 //     }







	// employees directory 
	public function directory() {
		$session = $this->session->userdata('username');

		$data['title'] = $this->Hrms_model->site_title();
		$data['all_departments'] = $this->Department_model->all_departments();
		$data['all_designations'] = $this->Designation_model->all_designationsByCmy();
		$data['all_user_roles'] = $this->Roles_model->all_user_roles();
		$data['all_employees'] = $this->Hrms_model->all_employees_byCmpId($session['companyId']);
		$data['breadcrumbs'] = $this->lang->line('hrms_employees_directory');
		$data['path_url'] = 'employees_directory';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('52',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("employees/directory", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
     } 
 
    public function employees_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employees_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$session = $this->session->userdata('username');
		
		$employee = $this->Employees_model->get_employee_withCompany($session['companyId']);
		if (!empty($employee))
		 {
			
		$data = array();

        foreach($employee as $r) {

		 if ($r->is_active == 1)
			   {
			  	$activeNotactive = 'inactive';
			  	$faIcon ='fa-check';
			  }else{
			  	$activeNotactive = 'active';
			  	$faIcon ='fa-close';
			  } 
		// user full name
		$full_name = $r->first_name.' '.$r->last_name;				
		// get status
		if($r->is_active==1): $status = 'Active';
		elseif($r->is_active==2): $status = 'Not Active'; endif;
		// user role
		$role = $this->Hrms_model->read_user_role_info($r->user_role_id);
		// get designation
		$designation = $this->Designation_model->read_designation_information($r->designation_id);
		// department
		$department = $this->Department_model->read_department_information($r->department_id);
		$department_designation = $designation[0]->designation_name.'('.$department[0]->department_name.')';
		
		if($r->user_role_id != '1' && $r->user_id!=23) {
			$option = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_view_details').'"><a href="employees/detail/'.$r->user_id.'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" title="View Details"><i class="fa fa-arrow-circle-right"></i></button></a></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_terminate').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->user_id . '"><i class="fa fa-trash-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_sepration').'"><a href="javascript:void(0);" onclick="setEmpValinactive('.$r->user_id .')" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" ><i class="fa '.$faIcon.'"></i></a></span>';
		} else {
			$option = '';
		}
		$data[] = array(
			$option,
			$r->employee_id,
			$full_name,
			$r->username,
			$r->email,
			$role[0]->role_name,
			$department_designation,
			$status
		);
      
	  }
	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => count($employee),
			 "recordsFiltered" => count($employee),
			 "data" => $data
		);
	   echo json_encode($output);
	  exit();
     }
    
 }
	 
	  public function detail() {

		$id = $this->uri->segment(3);
		$session = $this->session->userdata('username');
		$result = $this->Employees_model->read_employee_information($id);
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		$data['breadcrumbs'] = $this->lang->line('hrms_employee_details');
		$data['path_url'] = 'employees_detail';
		
		if(in_array('13',$role_resources_ids)) {
			if(!empty($session)){ 
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
		
		$data = array(
			'breadcrumbs' => $this->lang->line('hrms_employee_detail'),
			'path_url' => 'employees_detail',
			'first_name' => $result[0]->first_name,
			'last_name' => $result[0]->last_name,
			'user_id' => $result[0]->user_id,
			'employee_id' => $result[0]->employee_id,
			'username' => $result[0]->username,
			'email' => $result[0]->email,
			'department_id' => $result[0]->department_id,
			'designation_id' => $result[0]->designation_id,
			'user_role_id' => $result[0]->user_role_id,
			'date_of_birth' => $result[0]->date_of_birth,
			'date_of_leaving' => $result[0]->date_of_leaving,
			'gender' => $result[0]->gender,
			'marital_status' => $result[0]->marital_status,
			'contact_no' => $result[0]->contact_no,
			'address' => $result[0]->address,
			'is_active' => $result[0]->is_active,
			'office_shift_id' => $result[0]->office_shift_id,
			'emp_type_id' => $result[0]->empType,
			'date_of_joining' => $result[0]->date_of_joining,
			'all_departments' => $this->Department_model->all_departmentsBycmp(),
			'all_designations' => $this->Designation_model->all_designationsByCmy(),
			'all_user_roles' => $this->Roles_model->all_user_roles(),
			'title' => $this->Hrms_model->site_title(),
			'profile_picture' => $result[0]->profile_picture,
			'facebook_link' => $result[0]->facebook_link,
			'twitter_link' => $result[0]->twitter_link,
			'blogger_link' => $result[0]->blogger_link,
			'linkdedin_link' => $result[0]->linkdedin_link,
			'google_plus_link' => $result[0]->google_plus_link,
			'instagram_link' => $result[0]->instagram_link,
			'pinterest_link' => $result[0]->pinterest_link,
			'youtube_link' => $result[0]->youtube_link,

			'passport' => $result[0]->passport_number,
			'pissue' => $result[0]->passport_issuedate,
			'pexpiry' => $result[0]->passsport_expirydate,
			'emergencyContact' => $result[0]->emergency_contact_number,
			'emerName' => $result[0]->emergency_contact_name,
			'relation' => $result[0]->emergency_contact_relation,
			'relativeEmail' => $result[0]->emergency_contact_email,
			'empWpn' => $result[0]->wpn,
			'wpnissue'=>$result[0]->wpn_issuedate,
			'wpnexpiry' =>$result[0]->wpn_expirydate,
			'empVisa' => $result[0]->visa_number,
			'visaissue'=>$result[0]->visa_issuedate,
			'visaexpiry' =>$result[0]->visa_expirydate,
			'empNsn' =>$result[0]->nsn,

			'country' =>$result[0]->country,
			'state' =>$result[0]->state,
			'city'  =>$result[0]->city,
			'municipality'  =>$result[0]->municipality,

			'all_countries' => $this->Hrms_model->get_countries(),
			'all_document_types' => $this->Employees_model->all_document_types(),
			'all_education_level' => $this->Employees_model->all_education_level(),
			'all_qualification_language' => $this->Employees_model->all_qualification_language(),
			'all_qualification_skill' => $this->Employees_model->all_qualification_skill(),
			'all_contract_types' => $this->Employees_model->all_contract_types(),
			'all_contracts' => $this->Employees_model->all_employee_contracts($result[0]->user_id),
			'all_office_shifts' => $this->Employees_model->all_office_shifts(),
			'all_employee_type' => $this->Employees_model->all_employee_type(),
			'all_office_locations' => $this->Location_model->all_office_locations(),
			'all_leaves' => $this->Timesheet_model->all_leave_types(),
			'all_country' => $this->Hrms_model->get_countries(),
			);
		
		$data['subview'] = $this->load->view("employees/employee_detail", $data, TRUE);
		$this->load->view('layout_main', $data); //page load
		
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	 
	public function dialog_contact() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_contact_information($id);
		$data = array(
				'contact_id' => $result[0]->contact_id,
				'employee_id' => $result[0]->employee_id,
				'relation' => $result[0]->relation,
				'is_primary' => $result[0]->is_primary,
				'is_dependent' => $result[0]->is_dependent,
				'contact_name' => $result[0]->contact_name,
				'work_phone' => $result[0]->work_phone,
				'work_phone_extension' => $result[0]->work_phone_extension,
				'mobile_phone' => $result[0]->mobile_phone,
				'home_phone' => $result[0]->home_phone,
				'work_email' => $result[0]->work_email,
				'personal_email' => $result[0]->personal_email,
				'address_1' => $result[0]->address_1,
				'address_2' => $result[0]->address_2,
				'city' => $result[0]->city,
				'state' => $result[0]->state,
				'zipcode' => $result[0]->zipcode,
				'country' => $result[0]->country,
				'all_countries' => $this->Hrms_model->get_countries()
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_document() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$document = $this->Employees_model->read_document_information($id);
		$data = array(
				'document_id' => $document[0]->document_id,
				'document_type_id' => $document[0]->document_type_id,
				'd_employee_id' => $document[0]->employee_id,
				'all_document_types' => $this->Employees_model->all_document_types(),
				'date_of_expiry' => $document[0]->date_of_expiry,
				'title' => $document[0]->title,
				'is_alert' => $document[0]->is_alert,
				'description' => $document[0]->description,
				'notification_email' => $document[0]->notification_email,
				'document_file' => $document[0]->document_file
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_imgdocument() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$document = $this->Employees_model->read_imgdocument_information($id);
		$data = array(
				'immigration_id' => $document[0]->immigration_id,
				'document_type_id' => $document[0]->document_type_id,
				'd_employee_id' => $document[0]->employee_id,
				'all_document_types' => $this->Employees_model->all_document_types(),
				'all_countries' => $this->Hrms_model->get_countries(),
				'document_number' => $document[0]->document_number,
				'document_file' => $document[0]->document_file,
				'issue_date' => $document[0]->issue_date,
				'expiry_date' => $document[0]->expiry_date,
				'country_id' => $document[0]->country_id,
				'eligible_review_date' => $document[0]->eligible_review_date,
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_qualification() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_qualification_information($id);
		$data = array(
				'qualification_id' => $result[0]->qualification_id,
				'employee_id' => $result[0]->employee_id,
				'name' => $result[0]->name,
				'education_level_id' => $result[0]->education_level_id,
				'from_year' => $result[0]->from_year,
				'language_id' => $result[0]->language_id,
				'to_year' => $result[0]->to_year,
				'skill_id' => $result[0]->skill_id,
				'description' => $result[0]->description,
				'all_education_level' => $this->Employees_model->all_education_level(),
				'all_qualification_language' => $this->Employees_model->all_qualification_language(),
				'all_qualification_skill' => $this->Employees_model->all_qualification_skill()
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	public function dialog_work_experience() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_work_experience_information($id);
		$data = array(
				'work_experience_id' => $result[0]->work_experience_id,
				'employee_id' => $result[0]->employee_id,
				'company_name' => $result[0]->company_name,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date,
				'post' => $result[0]->post,
				'description' => $result[0]->description
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_bank_account() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_bank_account_information($id);
		$data = array(
				'bankaccount_id' => $result[0]->bankaccount_id,
				'employee_id' => $result[0]->employee_id,
				'is_primary' => $result[0]->is_primary,
				'account_title' => $result[0]->account_title,
				'account_number' => $result[0]->account_number,
				'bank_name' => $result[0]->bank_name,
				'bank_code' => $result[0]->bank_code,
				'bank_branch' => $result[0]->bank_branch
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_contract() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_contract_information($id);
		$data = array(
				'contract_id' => $result[0]->contract_id,
				'employee_id' => $result[0]->employee_id,
				'contract_type_id' => $result[0]->contract_type_id,
				'from_date' => $result[0]->from_date,
				'designation_id' => $result[0]->designation_id,
				'title' => $result[0]->title,
				'to_date' => $result[0]->to_date,
				'description' => $result[0]->description,
				'all_contract_types' => $this->Employees_model->all_contract_types(),
				'all_designations' => $this->Designation_model->all_designationsByCmy(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_leave() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_leave_information($id);
		$data = array(
				'leave_id' => $result[0]->leave_id,
				'employee_id' => $result[0]->employee_id,
				'contract_id' => $result[0]->contract_id,
				'casual_leave' => $result[0]->casual_leave,
				'medical_leave' => $result[0]->medical_leave
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_shift() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_emp_shift_information($id);
		$data = array(
				'emp_shift_id' => $result[0]->emp_shift_id,
				'employee_id' => $result[0]->employee_id,
				'shift_id' => $result[0]->shift_id,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	public function dialog_location() {
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_location_information($id);
		$data = array(
				'office_location_id' => $result[0]->office_location_id,
				'employee_id' => $result[0]->employee_id,
				'location_id' => $result[0]->location_id,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_employee_details', $data);
		} else {
			redirect('');
		}
	}
	
	// get departmens > designations
	public function designation() {

		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->uri->segment(3);
		
		$data = array(
			'department_id' => $id,
			'all_designations' => $this->Designation_model->all_designationsByCmy(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/get_designations", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
 	}
	
	// get departmens > designations
	public function head_designation() {

		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->uri->segment(3);
		
		$data = array(
			'department_id' => $id,
			'all_designations' => $this->Designation_model->all_designationsByCmy(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/head_designations", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
 	}
	
	// get departmens > designations
	public function employee_by_designation() {

		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->uri->segment(3);
		
		$data = array(
			'designation_id' => $id,
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/head_employees", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
 	}
	 
	public function read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('warning_id');
		$result = $this->Warning_model->read_warning_information($id);
		$data = array(
				'warning_id' => $result[0]->warning_id,
				'warning_to' => $result[0]->warning_to,
				'warning_by' => $result[0]->warning_by,
				'warning_date' => $result[0]->warning_date,
				'warning_type_id' => $result[0]->warning_type_id,
				'subject' => $result[0]->subject,
				'description' => $result[0]->description,
				'status' => $result[0]->status,
				'all_employees' => $this->Hrms_model->all_employees(),
				'all_warning_types' => $this->Warning_model->all_warning_types(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('warning/dialog_warning', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_employee() {
	
	 
		//if($this->input->post('add_type')=='employee') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('first_name')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_first_name');
		} else if(!ctype_alpha($this->input->post('first_name'))) {
       		 $Return['error'] = "First name contains only characters.";
		} else if($this->input->post('last_name')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_last_name');
		} else if(!ctype_alpha($this->input->post('last_name'))) {
       		 $Return['error'] = "Last name contains only characters.";
		} else if($this->input->post('employee_id')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_employee_id');
		} else if(empty($this->input->post('date_of_joining'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_joining_date');
		} else if(empty($this->input->post('department_id'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_department');
		} else if(empty($this->input->post('designation_id'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_designation');
		} else if(empty($this->input->post('role'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_user_role');
		} else if(empty($this->input->post('username'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_username');
		} else if($this->check_exist_username($this->input->post('username'))) {
			 $Return['error'] = "This username is already exist.";
		} else if(empty($this->input->post('email'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_email');
		} else if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('hrms_employee_error_invalid_email');
		} else if(empty($this->input->post('contact_no'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_contact_number');
		} else if(empty($this->input->post('password'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_password');
		} else if(strlen($this->input->post('password')) < 6) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_password_least');
		} else if($this->input->post('password')!==$this->input->post('confirm_password')) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_password_not_match');
		} else if(empty($this->input->post('emp_type_id'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_emp_type');
		}else if(empty($this->input->post('head_designation'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_head_designation_err');
		}else if(empty($this->input->post('head_employee'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_head_employee_err');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		$session = $this->session->userdata('username');
 
    	$getAdminData = $this->Hrms_model->getsingle('hrms_employees',array('user_id'=>$session['user_id']));
    	if (!empty($getAdminData)) {

    		$compny_id = $getAdminData->company_id ;
    		
		$data = array(
		'employee_id' => $this->input->post('employee_id'),
		'office_shift_id' => $this->input->post('office_shift_id'),
		'first_name' => $this->input->post('first_name'),
		'last_name' => $this->input->post('last_name'),
		'username' => $this->input->post('username'),
		'email' => $this->input->post('email'),
		'password' => $this->input->post('password'),
		'date_of_birth' => $this->input->post('date_of_birth'),
		'gender' => $this->input->post('gender'),
		'user_role_id' => $this->input->post('role'),
		'department_id' => $this->input->post('department_id'),
		'designation_id' => $this->input->post('designation_id'),
		'date_of_joining' => $this->input->post('date_of_joining'),
		'contact_no' => $this->input->post('contact_no'),
		'address' => $this->input->post('address'),
		'created_at' => date('d-m-Y'),
		'head_designation' => $this->input->post('head_designation'),
		'head_employee' => $this->input->post('head_employee'),
		'is_active' => 1,
		'company_id' => $compny_id,
		'empType' => $this->input->post('emp_type_id'),
		'country' => $this->input->post('country'),
		'state' => $this->input->post('state'),
		'city' => $this->input->post('city'),
		'municipality' => $this->input->post('municipality'),

		);
	
		$result = $this->Employees_model->add($data);
		if ($result == TRUE) {
		 
			$Return['result'] = $this->lang->line('hrms_success_add_employee');
			
			//get setting info 
			$setting = $this->Hrms_model->read_setting_info(1);
			if($setting[0]->enable_email_notification == 'yes') {

				//get employee
				$user_info = $this->Employees_model->read_new_employee_information();
				
				//get company info
				$cinfo = $this->Hrms_model->read_company_setting_info(1);
				//get email template
				$template = $this->Hrms_model->read_email_template(8);
						
				$subject = $template[0]->subject.' - '.$cinfo[0]->company_name;
				$logo = base_url().'uploads/logo/'.$cinfo[0]->logo;
				
				// get user full name
				$full_name = $this->input->post('first_name').' '.$this->input->post('last_name');
				
				$message = ' <div style="background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;"> <img src="'.$logo.'" title="'.$cinfo[0]->company_name.'"><br>'.str_replace(array("{var site_name}","{var site_url}","{var username}","{var employee_id}","{var employee_name}","{var email}","{var password}"),array($cinfo[0]->company_name,site_url(),$this->input->post('username'),$this->input->post('employee_id'),$full_name,$this->input->post('email'),$this->input->post('password')),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';

				$emailData['employee_id'] = $user_info[0]->user_id;
				$emailData['email_type'] = "receive";
				$emailData['email_to'] = $this->input->post('email');
				$emailData['email_subject'] = $subject;
				$emailData['email_message'] = $message;
				$emailData['email_for'] = 'Welcome';
				$this->sendSMTPMail($emailData);

			}
			else
			{
			    
			}
			
		} else {
		    
		     
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
	}else {
	 
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
	
		$this->output($Return);
		exit;
		//}
			/*echo "faiwqwrwertertel";
		    	print_r($data);
		die();*/
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
	
	/*  add and update employee details info */
	
	// Validate and update info in database // basic info
	public function basic_info() {
	
		if($this->input->post('type')=='basic_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('first_name')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_first_name');
		} else if($this->input->post('last_name')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_last_name');
		} else if($this->input->post('employee_id')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_employee_id');
		} else if(empty($this->input->post('date_of_joining'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_joining_date');
		} else if(empty($this->input->post('department_id'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_department');
		} else if(empty($this->input->post('designation_id'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_designation');
		} else if(empty($this->input->post('role'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_user_role');
		} else if(empty($this->input->post('username'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_username');
		} else if(empty($this->input->post('email'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_email');
		} else if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('hrms_employee_error_invalid_email');
		} else if(empty($this->input->post('emp_type_id'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_emp_type');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'employee_id' => $this->input->post('employee_id'),
		'first_name' => $this->input->post('first_name'),
		'last_name' => $this->input->post('last_name'),
		'username' => $this->input->post('username'),
		'email' => $this->input->post('email'),
		'date_of_birth' => $this->input->post('date_of_birth'),
		'gender' => $this->input->post('gender'),
		'user_role_id' => $this->input->post('role'),
		'marital_status' => $this->input->post('marital_status'),
		'is_active' => $this->input->post('status'),
		'department_id' => $this->input->post('department_id'),
		'designation_id' => $this->input->post('designation_id'),
		'date_of_joining' => $this->input->post('date_of_joining'),
		'contact_no' => $this->input->post('contact_no'),
		'address' => $this->input->post('address'),
		'office_shift_id' => $this->input->post('office_shift_id'),
		'empType' => $this->input->post('emp_type_id'),

		'wpn'=>$this->input->get_post('empWpn'),
		'wpn_issuedate'=>$this->input->get_post('wpnIssueDate'),
		'wpn_expirydate'=>$this->input->get_post('wpnExpiryDate'),

		'passport_number'=>$this->input->get_post('passport'),
		'passport_issuedate'=>$this->input->get_post('passportIssueDate'),
		'passsport_expirydate'=>$this->input->get_post('passportExpiryDate'),

		'emergency_contact_name'=>$this->input->get_post('emerName'),
		'emergency_contact_number'=>$this->input->get_post('emergencyContact'),
		'emergency_contact_relation'=>$this->input->get_post('relation'),
		'emergency_contact_email'=>$this->input->get_post('emergencyemail'),

		'nsn'=>$this->input->get_post('empNsn'),
		'visa_number'=>$this->input->get_post('empVisa'),
		'visa_issuedate'=>$this->input->get_post('visaIssueDate'),
		'visa_expirydate'=>$this->input->get_post('visaExpiryDate'),

		'country' =>$this->input->get_post('country'),
		'state' =>$this->input->get_post('state'),
		'city'  =>$this->input->get_post('city'),
		'municipality'  =>$this->input->get_post('municipality')

		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->basic_info($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_basic_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database // social info
	public function profile_picture() {
	//die('hii');
		if($this->input->post('type')=='profile_picture') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->input->post('user_id');
			
		/* Check if file uploaded..*/
		if($_FILES['p_file']['size'] == 0 && null ==$this->input->post('remove_profile_picture')) {
			$Return['error'] = $this->lang->line('hrms_employee_select_picture');
		} else {
			if(is_uploaded_file($_FILES['p_file']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','pdf','gif');
				$filename = $_FILES['p_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["p_file"]["tmp_name"];
					$profile = "uploads/user_img/";
					$set_img = base_url()."uploads/user_img/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$name = basename($_FILES["p_file"]["name"]);
					$newfilename = 'profile_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $profile.$newfilename);
					$fname = $newfilename;
					
					//UPDATE Employee info in DB
					$data = array('profile_picture' => $fname);
					$result = $this->Employees_model->profile_picture($data,$id);
					if ($result == TRUE) {
						$Return['result'] = $this->lang->line('hrms_employee_picture_updated');
						$Return['img'] = $set_img.$fname;
					} else {
						$Return['error'] = $this->lang->line('hrms_error_msg');
					}
					$this->output($Return);
					exit;
					
				} else {
					$Return['error'] = $this->lang->line('hrms_employee_picture_type');
				}
				}
			}
			
			if(null!=$this->input->post('remove_profile_picture')) {
				//UPDATE Employee info in DB
				$data = array('profile_picture' => 'no file');				
				$row = $this->Employees_model->read_employee_information($id);
				$profile = base_url()."uploads/user_img/";
				$result = $this->Employees_model->profile_picture($data,$id);
				if ($result == TRUE) {
					$Return['result'] = $this->lang->line('hrms_employee_picture_updated');
					if($row[0]->gender=='Male') {
						$Return['img'] = $profile.'default_male.jpg';
					} else {
						$Return['img'] = $profile.'default_female.jpg';
					}
				} else {
					$Return['error'] = $this->lang->line('hrms_error_msg');
				}
				$this->output($Return);
				exit;
				
			}
				
			if($Return['error']!=''){
				$this->output($Return);
			}
		}
	}
	
	// Validate and update info in database // basic info
	public function social_info() {
	
		if($this->input->post('type')=='social_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');		
	
		$data = array(
		'facebook_link' => $this->input->post('facebook_link'),
		'twitter_link' => $this->input->post('twitter_link'),
		'blogger_link' => $this->input->post('blogger_link'),
		'linkdedin_link' => $this->input->post('linkdedin_link'),
		'google_plus_link' => $this->input->post('google_plus_link'),
		'instagram_link' => $this->input->post('instagram_link'),
		'pinterest_link' => $this->input->post('pinterest_link'),
		'youtube_link' => $this->input->post('youtube_link')
		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->social_info($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_success_update_social_info');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	
	// Validate and update info in database // contact info
	public function update_contacts_info() {
	
		if($this->input->post('type')=='contact_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		/* Server side PHP input validation */		
		if($this->input->post('salutation')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_salutation');
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_contact_name');
		} else if($this->input->post('relation')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_grp');
		} else if($this->input->post('primary_email')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_pemail');
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_mobile');
		} else if($this->input->post('city')==='') {
			 $Return['error'] = $this->lang->line('hrms_error_city_field');
		} else if($this->input->post('country')==='') {
			 $Return['error'] = $this->lang->line('hrms_error_country_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'salutation' => $this->input->post('salutation'),
		'contact_name' => $this->input->post('contact_name'),
		'relation' => $this->input->post('relation'),
		'company' => $this->input->post('company'),
		'job_title' => $this->input->post('job_title'),
		'primary_email' => $this->input->post('primary_email'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'address' => $this->input->post('address'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'employee_id' => $this->input->post('user_id'),
		'contact_type' => 'permanent'
		);
		
		$query = $this->Employees_model->check_employee_contact_permanent($this->input->post('user_id'));
		if ($query->num_rows() > 0 ) {
			$res = $query->result();
			$e_field_id = $res[0]->contact_id;
			$result = $this->Employees_model->contact_info_update($data,$e_field_id);
		} else {
			$result = $this->Employees_model->contact_info_add($data);
		}

		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_contact_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database //  econtact info
	public function update_contact_info() {
	
		if($this->input->post('type')=='contact_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		/* Server side PHP input validation */		
		if($this->input->post('salutation')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_salutation');
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_contact_name');
		} else if($this->input->post('relation')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_grp');
		} else if($this->input->post('primary_email')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_pemail');
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_mobile');
		} else if($this->input->post('city')==='') {
			 $Return['error'] = $this->lang->line('hrms_error_city_field');
		} else if($this->input->post('country')==='') {
			 $Return['error'] = $this->lang->line('hrms_error_country_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'salutation' => $this->input->post('salutation'),
		'contact_name' => $this->input->post('contact_name'),
		'relation' => $this->input->post('relation'),
		'company' => $this->input->post('company'),
		'job_title' => $this->input->post('job_title'),
		'primary_email' => $this->input->post('primary_email'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'address' => $this->input->post('address'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'employee_id' => $this->input->post('user_id'),
		'contact_type' => 'current'
		);
		
		$query = $this->Employees_model->check_employee_contact_current($this->input->post('user_id'));
		if ($query->num_rows() > 0 ) {
			$res = $query->result();
			$e_field_id = $res[0]->contact_id;
			$result = $this->Employees_model->contact_info_update($data,$e_field_id);
		} else {
			$result = $this->Employees_model->contact_info_add($data);
		}
		//$e_field_id = 1;
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_contact_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database // contact info
	public function contact_info() {
	
		if($this->input->post('type')=='contact_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('relation')==='') {
       		 $Return['error'] = "The relation field is required.";
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = "The contact name field is required.";
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = "The mobile field is required.";
		}
		
		if(null!=$this->input->post('is_primary')) {
			$is_primary = $this->input->post('is_primary');
		} else {
			$is_primary = '';
		}
		if(null!=$this->input->post('is_dependent')) {
			$is_dependent = $this->input->post('is_dependent');
		} else {
			$is_dependent = '';
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'relation' => $this->input->post('relation'),
		'work_email' => $this->input->post('work_email'),
		'is_primary' => $is_primary,
		'is_dependent' => $is_dependent,
		'personal_email' => $this->input->post('personal_email'),
		'contact_name' => $this->input->post('contact_name'),
		'address_1' => $this->input->post('address_1'),
		'work_phone' => $this->input->post('work_phone'),
		'work_phone_extension' => $this->input->post('work_phone_extension'),
		'address_2' => $this->input->post('address_2'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'home_phone' => $this->input->post('home_phone'),
		'country' => $this->input->post('country'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->contact_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = 'Contact Information added.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database //  econtact info
	public function e_contact_info() {
	
		if($this->input->post('type')=='e_contact_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('relation')==='') {
       		 $Return['error'] = "The relation field is required.";
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = "The contact name field is required.";
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = "The mobile field is required.";
		}
		
		if(null!=$this->input->post('is_primary')) {
			$is_primary = $this->input->post('is_primary');
		} else {
			$is_primary = '';
		}
		if(null!=$this->input->post('is_dependent')) {
			$is_dependent = $this->input->post('is_dependent');
		} else {
			$is_dependent = '';
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'relation' => $this->input->post('relation'),
		'work_email' => $this->input->post('work_email'),
		'is_primary' => $is_primary,
		'is_dependent' => $is_dependent,
		'personal_email' => $this->input->post('personal_email'),
		'contact_name' => $this->input->post('contact_name'),
		'address_1' => $this->input->post('address_1'),
		'work_phone' => $this->input->post('work_phone'),
		'work_phone_extension' => $this->input->post('work_phone_extension'),
		'address_2' => $this->input->post('address_2'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'home_phone' => $this->input->post('home_phone'),
		'country' => $this->input->post('country')
		);
		
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->contact_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = 'Contact Information updated.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // document info
	public function document_info() {
	
		if($this->input->post('type')=='document_info' && $this->input->post('data')=='document_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('document_type_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_d_type');
		} else if($this->input->post('date_of_expiry')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_expiry_date');
		} else if($this->input->post('title')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_document_title');
		} else if($this->input->post('email')==='') {
			 $Return['error'] = $this->lang->line('hrms_error_notify_email_field');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['document_file']['size'] == 0) {
			$Return['error'] = $this->lang->line('hrms_employee_select_d_file');
		} else {
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','pdf','gif','txt','pdf','xls','xlsx','doc','docx');
				$filename = $_FILES['document_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["document_file"]["tmp_name"];
					$documentd = "uploads/document/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$name = basename($_FILES["document_file"]["name"]);
					$newfilename = 'document_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $documentd.$newfilename);
					$fname = $newfilename;
				} else {
					$Return['error'] = $this->lang->line('hrms_employee_document_file_type');
				}
			}
		}
					
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'document_type_id' => $this->input->post('document_type_id'),
		'date_of_expiry' => $this->input->post('date_of_expiry'),
		'document_file' => $fname,
		'title' => $this->input->post('title'),
		'notification_email' => $this->input->post('email'),
		'is_alert' => $this->input->post('send_mail'),
		'description' => $this->input->post('description'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->document_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_d_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // document info
	public function immigration_info() {
	
		if($this->input->post('type')=='immigration_info' && $this->input->post('data')=='immigration_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('document_type_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_d_type');
		} else if($this->input->post('document_number')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_d_number');
		} else if($this->input->post('issue_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_d_issue');
		} else if($this->input->post('expiry_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_expiry_date');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['document_file']['size'] == 0) {
			$Return['error'] = $this->lang->line('hrms_employee_select_d_file');
		} else {
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','pdf','gif','txt','pdf','xls','xlsx','doc','docx');
				$filename = $_FILES['document_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["document_file"]["tmp_name"];
					$documentd = "uploads/document/immigration/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$name = basename($_FILES["document_file"]["name"]);
					$newfilename = 'document_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $documentd.$newfilename);
					$fname = $newfilename;
				} else {
					$Return['error'] = $this->lang->line('hrms_employee_document_file_type');
				}
			}
		}
					
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'document_type_id' => $this->input->post('document_type_id'),
		'document_number' => $this->input->post('document_number'),
		'document_file' => $fname,
		'issue_date' => $this->input->post('issue_date'),
		'expiry_date' => $this->input->post('expiry_date'),
		'country_id' => $this->input->post('country'),
		'eligible_review_date' => $this->input->post('eligible_review_date'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y h:i:s'),
		);
		$result = $this->Employees_model->immigration_info_add($data);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_img_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // document info
	public function e_immigration_info() {
	
		if($this->input->post('type')=='e_immigration_info' && $this->input->post('data')=='e_immigration_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('document_type_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_d_type');
		} else if($this->input->post('document_number')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_d_number');
		} else if($this->input->post('issue_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_d_issue');
		} else if($this->input->post('expiry_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_expiry_date');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['document_file']['size'] == 0) {
			$data = array(
				'document_type_id' => $this->input->post('document_type_id'),
				'document_number' => $this->input->post('document_number'),
				'issue_date' => $this->input->post('issue_date'),
				'expiry_date' => $this->input->post('expiry_date'),
				'country_id' => $this->input->post('country'),
				'eligible_review_date' => $this->input->post('eligible_review_date'),
				);
				$e_field_id = $this->input->post('e_field_id');
				$result = $this->Employees_model->img_document_info_update($data,$e_field_id);
				if ($result == TRUE) {
					$Return['result'] = $this->lang->line('hrms_employee_img_info_updated');
				} else {
					$Return['error'] = $this->lang->line('hrms_error_msg');
				}
				$this->output($Return);
				exit;
		} else {
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','pdf','gif','txt','pdf','xls','xlsx','doc','docx');
				$filename = $_FILES['document_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["document_file"]["tmp_name"];
					$documentd = "uploads/document/immigration/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$name = basename($_FILES["document_file"]["name"]);
					$newfilename = 'document_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $documentd.$newfilename);
					$fname = $newfilename;
					$data = array(
					'document_type_id' => $this->input->post('document_type_id'),
					'document_number' => $this->input->post('document_number'),
					'document_file' => $fname,
					'issue_date' => $this->input->post('issue_date'),
					'expiry_date' => $this->input->post('expiry_date'),
					'country_id' => $this->input->post('country'),
					'eligible_review_date' => $this->input->post('eligible_review_date'),
					);
					$e_field_id = $this->input->post('e_field_id');
					$result = $this->Employees_model->img_document_info_update($data,$e_field_id);
					if ($result == TRUE) {
						$Return['result'] = $this->lang->line('hrms_employee_d_info_updated');
					} else {
						$Return['error'] = $this->lang->line('hrms_error_msg');
					}
					$this->output($Return);
					exit;
				} else {
					$Return['error'] = $this->lang->line('hrms_employee_document_file_type');
				}
			}
		}
							
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_img_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // e_document info
	public function e_document_info() {
	 
		if($this->input->post('type')=='e_document_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if($this->input->post('document_type_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_d_type');
		} else if($this->input->post('date_of_expiry')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_expiry_date');
		} else if($this->input->post('title')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_document_title');
		} else if($this->input->post('email')==='') {
			 $Return['error'] = $this->lang->line('hrms_error_notify_email_field');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['document_file']['size'] == 0) {
			$data = array(
				'document_type_id' => $this->input->post('document_type_id'),
				'date_of_expiry' => $this->input->post('date_of_expiry'),
				'title' => $this->input->post('title'),
				'notification_email' => $this->input->post('email'),
					'is_alert' => $this->input->post('send_mail'),
				'description' => $this->input->post('description')
				);
				$e_field_id = $this->input->post('e_field_id');
				$result = $this->Employees_model->document_info_update($data,$e_field_id);
				if ($result == TRUE) {
					$Return['result'] = $this->lang->line('hrms_employee_d_info_updated');
				} else {
					$Return['error'] = $this->lang->line('hrms_error_msg');
				}
				$this->output($Return);
				exit;
		} else {
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','pdf','gif','txt','pdf','xls','xlsx','doc','docx');
				$filename = $_FILES['document_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["document_file"]["tmp_name"];
					$documentd = "uploads/document/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$name = basename($_FILES["document_file"]["name"]);
					$newfilename = 'document_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $documentd.$newfilename);
					$fname = $newfilename;
					$data = array(
					'document_type_id' => $this->input->post('document_type_id'),
					'date_of_expiry' => $this->input->post('date_of_expiry'),
					'document_file' => $fname,
					'title' => $this->input->post('title'),
					'notification_email' => $this->input->post('email'),
					'is_alert' => $this->input->post('send_mail'),
					'description' => $this->input->post('description')
					);
					$e_field_id = $this->input->post('e_field_id');
					$result = $this->Employees_model->document_info_update($data,$e_field_id);
					if ($result == TRUE) {
						$Return['result'] = $this->lang->line('hrms_employee_d_info_updated');
					} else {
						$Return['error'] = $this->lang->line('hrms_error_msg');
					}
					$this->output($Return);
					exit;
				} else {
					$Return['error'] = $this->lang->line('hrms_employee_document_file_type');
				}
			}
		}
					
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		
		}
	}
	
	// Validate and add info in database // qualification info
	public function qualification_info() {
	
		if($this->input->post('type')=='qualification_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */	
		$from_year = $this->input->post('from_year');
		$to_year = $this->input->post('to_year');
		$st_date = strtotime($from_year);
		$ed_date = strtotime($to_year);
			
		if($this->input->post('name')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_sch_uni');
		} else if($this->input->post('from_year')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('to_year')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_to_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('hrms_employee_error_date_shouldbe');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'name' => $this->input->post('name'),
		'education_level_id' => $this->input->post('education_level'),
		'from_year' => $this->input->post('from_year'),
		'language_id' => $this->input->post('language'),
		'to_year' => $this->input->post('to_year'),
		'skill_id' => $this->input->post('skill'),
		'description' => $this->input->post('description'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->qualification_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_error_q_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // qualification info
	public function e_qualification_info() {
	
		if($this->input->post('type')=='e_qualification_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		$from_year = $this->input->post('from_year');
		$to_year = $this->input->post('to_year');
		$st_date = strtotime($from_year);
		$ed_date = strtotime($to_year);
			
		if($this->input->post('name')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_sch_uni');
		} else if($this->input->post('from_year')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('to_year')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_to_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('hrms_employee_error_date_shouldbe');
		}
			
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'name' => $this->input->post('name'),
		'education_level_id' => $this->input->post('education_level'),
		'from_year' => $this->input->post('from_year'),
		'language_id' => $this->input->post('language'),
		'to_year' => $this->input->post('to_year'),
		'skill_id' => $this->input->post('skill'),
		'description' => $this->input->post('description')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->qualification_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_error_q_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // work experience info
	public function work_experience_info() {
	
		if($this->input->post('type')=='work_experience_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$frm_date = strtotime($this->input->post('from_date'));	
		$to_date = strtotime($this->input->post('to_date'));
		/* Server side PHP input validation */		
		if($this->input->post('company_name')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_company_name');
		} else if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('to_date')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_to_date');
		} else if($frm_date > $to_date) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_date_shouldbe');
		} else if($this->input->post('post')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_post');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_name' => $this->input->post('company_name'),
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'post' => $this->input->post('post'),
		'description' => $this->input->post('description'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->work_experience_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_error_w_exp_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function e_work_experience_info() {
	
		if($this->input->post('type')=='e_work_experience_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$frm_date = strtotime($this->input->post('from_date'));	
		$to_date = strtotime($this->input->post('to_date'));
		/* Server side PHP input validation */		
		if($this->input->post('company_name')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_company_name');
		} else if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('to_date')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_to_date');
		} else if($frm_date > $to_date) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_date_shouldbe');
		} else if($this->input->post('post')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_post');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_name' => $this->input->post('company_name'),
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'post' => $this->input->post('post'),
		'description' => $this->input->post('description')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->work_experience_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_error_w_exp_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	
	// Validate and add info in database // bank account info
	public function bank_account_info() {
	
		if($this->input->post('type')=='bank_account_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		/* Server side PHP input validation */		
		if($this->input->post('account_title')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_acc_title');
		} else if($this->input->post('account_number')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_acc_number');
		} else if($this->input->post('bank_name')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_bank_name');
		} else if($this->input->post('bank_code')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_bank_code');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'account_title' => $this->input->post('account_title'),
		'account_number' => $this->input->post('account_number'),
		'bank_name' => $this->input->post('bank_name'),
		'bank_code' => $this->input->post('bank_code'),
		'bank_branch' => $this->input->post('bank_branch'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->bank_account_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_error_bank_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // ebank account info
	public function e_bank_account_info() {
	
		if($this->input->post('type')=='e_bank_account_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		/* Server side PHP input validation */		
		if($this->input->post('account_title')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_acc_title');
		} else if($this->input->post('account_number')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_acc_number');
		} else if($this->input->post('bank_name')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_bank_name');
		} else if($this->input->post('bank_code')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_bank_code');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'account_title' => $this->input->post('account_title'),
		'account_number' => $this->input->post('account_number'),
		'bank_name' => $this->input->post('bank_name'),
		'bank_code' => $this->input->post('bank_code'),
		'bank_branch' => $this->input->post('bank_branch')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->bank_account_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_error_bank_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database //contract info
	public function contract_info() {
	
		if($this->input->post('type')=='contract_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$frm_date = strtotime($this->input->post('from_date'));	
		$to_date = strtotime($this->input->post('to_date'));
		/* Server side PHP input validation */		
		if($this->input->post('contract_type_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_contract_type');
		} else if($this->input->post('title')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_contract_title');
		} else if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('to_date')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_to_date');
		} else if($frm_date > $to_date) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_frm_to_date');
		} else if($this->input->post('designation_id')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_designation');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'contract_type_id' => $this->input->post('contract_type_id'),
		'title' => $this->input->post('title'),
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'designation_id' => $this->input->post('designation_id'),
		'description' => $this->input->post('description'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->contract_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_contract_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database //e contract info
	public function e_contract_info() {
	
		if($this->input->post('type')=='e_contract_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$frm_date = strtotime($this->input->post('from_date'));	
		$to_date = strtotime($this->input->post('to_date'));
		/* Server side PHP input validation */		
		if($this->input->post('contract_type_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_contract_type');
		} else if($this->input->post('title')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_contract_title');
		} else if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('to_date')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_to_date');
		} else if($frm_date > $to_date) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_frm_to_date');
		} else if($this->input->post('designation_id')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_designation');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'contract_type_id' => $this->input->post('contract_type_id'),
		'title' => $this->input->post('title'),
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'designation_id' => $this->input->post('designation_id'),
		'description' => $this->input->post('description')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->contract_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_contract_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database //leave_info
	public function leave_info() {
	
		if($this->input->post('type')=='leave_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		/* Server side PHP input validation */		
		if($this->input->post('contract_id')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_contract_f');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'contract_id' => $this->input->post('contract_id'),
		'casual_leave' => $this->input->post('casual_leave'),
		'medical_leave' => $this->input->post('medical_leave'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->leave_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_leave_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database //Eleave_info
	public function e_leave_info() {
	
		if($this->input->post('type')=='e_leave_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
							
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'casual_leave' => $this->input->post('casual_leave'),
		'medical_leave' => $this->input->post('medical_leave')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->leave_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_leave_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // shift info
	public function shift_info() {
	
		if($this->input->post('type')=='shift_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');

		/* Server side PHP input validation */		
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('shift_id')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_shift_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'shift_id' => $this->input->post('shift_id'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->shift_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_shift_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // eshift info
	public function e_shift_info() {
	
		if($this->input->post('type')=='e_shift_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		}
					
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->shift_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_shift_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // location info
	public function location_info() {
	
		if($this->input->post('type')=='location_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');

		/* Server side PHP input validation */		
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('location_id')==='') {
			 $Return['error'] = $this->lang->line('error_location_dept_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'location_id' => $this->input->post('location_id'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->location_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_location_info_added');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and add info in database // elocation info
	public function e_location_info() {
	
		if($this->input->post('type')=='e_location_info') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');

		/* Server side PHP input validation */		
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_frm_date');
		} else if($this->input->post('location_id')==='') {
			 $Return['error'] = $this->lang->line('error_location_dept_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->location_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_location_info_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Validate and update info in database // change password
	public function change_password() {
	
		if($this->input->post('type')=='change_password') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */		
		if(trim($this->input->post('new_password'))==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_newpassword');
		} else if(strlen($this->input->post('new_password')) < 6) {
			$Return['error'] = $this->lang->line('hrms_employee_error_password_least');
		} else if(trim($this->input->post('new_password_confirm'))==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_new_cpassword');
		} else if($this->input->post('new_password')!=$this->input->post('new_password_confirm')) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_old_new_cpassword');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'password' => $this->input->post('new_password')
		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->change_password($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_password_update');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	 /*  get all employee details lisitng *//////////////////
	 
	// employee contacts - listing
	public function contacts()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$contacts = $this->Employees_model->set_employee_contacts($id);
		
		$data = array();

        foreach($contacts->result() as $r) {
			
			if($r->is_primary==1){
				$primary = '<span class="tag tag-success">'.$this->lang->line('hrms_employee_primary').'</span>';
			 } else {
				 $primary = '';
			 }
			 if($r->is_dependent==2){
				$dependent = '<span class="tag tag-danger">'.$this->lang->line('hrms_employee_dependent').'</span>';
			 } else {
				 $dependent = '';
			 }
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->contact_id . '" data-field_type="contact"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->contact_id . '" data-token_type="contact"><i class="fa fa-trash-o"></i></button></span>',
			$r->contact_name . ' ' .$primary . ' '.$dependent,
			$r->relation,
			$r->work_email,
			$r->mobile_phone
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $contacts->num_rows(),
			 "recordsFiltered" => $contacts->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee documents - listing
	public function documents() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$documents = $this->Employees_model->set_employee_documents($id);
		
		$data = array();

        foreach($documents->result() as $r) {
			
			$d_type = $this->Employees_model->read_document_type_information($r->document_type_id);
			$date_of_expiry = $this->Hrms_model->set_date_format($r->date_of_expiry);
			if($r->document_file!='' && $r->document_file!='no file') {
			 $functions = '<span data-toggle="tooltip" data-placement="top" title="Download"><a href="'.site_url().'download?type=document&filename='.$r->document_file.'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" title="'.$this->lang->line('hrms_download').'"><i class="fa fa-download"></i></button></a></span>';
			 } else {
				 $functions ='';
			 }
			 
			 if($r->is_alert==1){
			 	$alert = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_e_details_alert_notifyemail').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"><i class="fa fa-bell"></i></button></span>';
			 } else {
				 $alert = '';
			 }
		
		$data[] = array(
			$alert.$functions.'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->document_id . '" data-field_type="document"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->document_id . '" data-token_type="document"><i class="fa fa-trash-o"></i></button></span>',
			$d_type[0]->document_type,
			$r->title,
			$r->notification_email,
			$date_of_expiry
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $documents->num_rows(),
			 "recordsFiltered" => $documents->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 // employee immigration - listing
	public function immigration() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$immigration = $this->Employees_model->set_employee_immigration($id);
		
		$data = array();

        foreach($immigration->result() as $r) {
			
		$issue_date = $this->Hrms_model->set_date_format($r->issue_date);
		$expiry_date = $this->Hrms_model->set_date_format($r->expiry_date);
		$eligible_review_date = $this->Hrms_model->set_date_format($r->eligible_review_date);
		$d_type = $this->Employees_model->read_document_type_information($r->document_type_id);
		$document_d = $d_type[0]->document_type.'<br>'.$r->document_number;	
				
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->immigration_id . '" data-field_type="imgdocument"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->immigration_id . '" data-token_type="imgdocument"><i class="fa fa-trash-o"></i></button></span>',
			$document_d,
			$issue_date,
			$expiry_date,
			$r->country_id,
			$eligible_review_date,
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $immigration->num_rows(),
			 "recordsFiltered" => $immigration->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee qualification - listing
	public function qualification() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$qualification = $this->Employees_model->set_employee_qualification($id);
		
		$data = array();

        foreach($qualification->result() as $r) {
			
			$education = $this->Employees_model->read_education_information($r->education_level_id);
			$language = $this->Employees_model->read_qualification_language_information($r->language_id);
			
			/*if($r->skill_id == 'no course') {
				$ol = 'No Course';
			} else {
				$ol = '<ol class="nl">';
				foreach(explode(',',$r->skill_id) as $desig_id) {
					$skill = $this->Employees_model->read_qualification_skill_information($desig_id);
					$ol .= '<li>'.$skill[0]->name.'</li>';
				 }
				 $ol .= '</ol>';
			}*/
		$sdate = $this->Hrms_model->set_date_format($r->from_year);
		$edate = $this->Hrms_model->set_date_format($r->to_year);	
		
		$time_period = $sdate.' - '.$edate;
		// get date
		$pdate = $time_period;
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->qualification_id . '" data-field_type="qualification"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->qualification_id . '" data-token_type="qualification"><i class="fa fa-trash-o"></i></button></span>',
			$r->name,
			$pdate,
			$education[0]->name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $qualification->num_rows(),
			 "recordsFiltered" => $qualification->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee work experience - listing
	public function experience() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$experience = $this->Employees_model->set_employee_experience($id);
		
		$data = array();

        foreach($experience->result() as $r) {
			
			$from_date = $this->Hrms_model->set_date_format($r->from_date);
			$to_date = $this->Hrms_model->set_date_format($r->to_date);
			
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->work_experience_id . '" data-field_type="work_experience"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->work_experience_id . '" data-token_type="work_experience"><i class="fa fa-trash-o"></i></button></span>',
			$r->company_name,
			$from_date,
			$to_date,
			$r->post,
			$r->description
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $experience->num_rows(),
			 "recordsFiltered" => $experience->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee bank account - listing
	public function bank_account() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$bank_account = $this->Employees_model->set_employee_bank_account($id);
		
		$data = array();

        foreach($bank_account->result() as $r) {			
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->bankaccount_id . '" data-field_type="bank_account"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->bankaccount_id . '" data-token_type="bank_account"><i class="fa fa-trash-o"></i></button></span>',
			$r->account_title,
			$r->account_number,
			$r->bank_name,
			$r->bank_code,
			$r->bank_branch
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $bank_account->num_rows(),
			 "recordsFiltered" => $bank_account->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee contract - listing
	public function contract() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$contract = $this->Employees_model->set_employee_contract($id);
		
		$data = array();

        foreach($contract->result() as $r) {			
			// designation
			$designation = $this->Designation_model->read_designation_information($r->designation_id);
			//contract type
			$contract_type = $this->Employees_model->read_contract_type_information($r->contract_type_id);
			// date
			$duration = $this->Hrms_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Hrms_model->set_date_format($r->to_date);
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->contract_id . '" data-field_type="contract"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->contract_id . '" data-token_type="contract"><i class="fa fa-trash-o"></i></button></span>',
			$duration,
			$designation[0]->designation_name,
			$contract_type[0]->name,
			$r->title
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $contract->num_rows(),
			 "recordsFiltered" => $contract->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee leave - listing
	public function leave() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$leave = $this->Employees_model->set_employee_leave($id);
		
		$data = array();

        foreach($leave->result() as $r) {			
			// contract
			$contract = $this->Employees_model->read_contract_information($r->contract_id);
			// contract duration
			$duration = $this->Hrms_model->set_date_format($contract[0]->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Hrms_model->set_date_format($contract[0]->to_date);
			$contracti = $contract[0]->title.' '.$duration;
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->leave_id . '" data-field_type="leave"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->leave_id . '" data-token_type="leave"><i class="fa fa-trash-o"></i></button></span>',
			$contracti,
			$r->casual_leave,
			$r->medical_leave
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $leave->num_rows(),
			 "recordsFiltered" => $leave->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee office shift - listing
	public function shift() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$shift = $this->Employees_model->set_employee_shift($id);
		
		$data = array();

        foreach($shift->result() as $r) {			
			// contract
			$shift_info = $this->Employees_model->read_shift_information($r->shift_id);
			// contract duration
			$duration = $this->Hrms_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Hrms_model->set_date_format($r->to_date);
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->emp_shift_id . '" data-field_type="shift"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->emp_shift_id . '" data-token_type="shift"><i class="fa fa-trash-o"></i></button></span>',
			$duration,
			$shift_info[0]->shift_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $shift->num_rows(),
			 "recordsFiltered" => $shift->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	// employee location - listing
	public function location() {
		//set data
		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/employee_detail", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(3);
		$location = $this->Employees_model->set_employee_location($id);
		
		$data = array();

        foreach($location->result() as $r) {			
			// contract
			$of_location = $this->Location_model->read_location_information($r->location_id);
			// contract duration
			$duration = $this->Hrms_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Hrms_model->set_date_format($r->to_date);
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->office_location_id . '" data-field_type="location"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->office_location_id . '" data-token_type="location"><i class="fa fa-trash-o"></i></button></span>',
			$duration,
			$of_location[0]->location_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $location->num_rows(),
			 "recordsFiltered" => $location->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='warning') {
			
		$id = $this->uri->segment(3);
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
			
		/* Server side PHP input validation */
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('warning_to')==='') {
       		 $Return['error'] = $this->lang->line('hrms_employee_error_warning');
		} else if($this->input->post('type')==='') {
			$Return['error'] = $this->lang->line('hrms_employee_error_warning_type');
		} else if($this->input->post('subject')==='') {
			 $Return['error'] = $this->lang->line('hrms_employee_error_subject');
		} else if(empty($this->input->post('warning_by'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_warning_by');
		} else if(empty($this->input->post('warning_date'))) {
			 $Return['error'] = $this->lang->line('hrms_employee_error_warning_date');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'warning_to' => $this->input->post('warning_to'),
		'warning_type_id' => $this->input->post('type'),
		'description' => $qt_description,
		'subject' => $this->input->post('subject'),
		'warning_by' => $this->input->post('warning_by'),
		'warning_date' => $this->input->post('warning_date'),
		'status' => $this->input->post('status'),
		);
		
		$result = $this->Warning_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('hrms_employee_warning_updated');
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// delete contact record
	public function delete_contact() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_contact_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_contact_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete document record
	public function delete_document() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_document_record($id);
			if(isset($id)) {
				$Return['result'] = 'Document deleted.';
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete document record
	public function delete_imgdocument() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_imgdocument_record($id);
			if(isset($id)) {
				$Return['result'] = 'Immigration deleted.';
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete qualification record
	public function delete_qualification() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_qualification_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_qualification_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete work_experience record
	public function delete_work_experience() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_work_experience_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_work_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete bank_account record
	public function delete_bank_account() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_bank_account_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_bankaccount_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete contract record
	public function delete_contract() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_contract_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_contract_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete leave record
	public function delete_leave() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_leave_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_leave_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete shift record
	public function delete_shift() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_shift_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_shift_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete location record
	public function delete_location() {
		
		if($this->input->post('data')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_location_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_location_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// delete employee record
	public function delete() {
		
		if($this->input->post('is_ajax')=='2') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');
			$id = $this->uri->segment(3);
			$result = $this->Employees_model->delete_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('hrms_employee_current_deleted');
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}
			$this->output($Return);
		}
	}

    public function export()
	{      
	    
		$table_name = 'hrms_employees';
		$result = $this->db->get($table_name);
       
		// Starting the PHPExcel library
		$this->load->library('Excel');
	    

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
		$objPHPExcel->setActiveSheetIndex(0);
	 
	 	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30); 
        
			/***************Set Field********Start************/
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Employee ID');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'Name');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'Email');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, 'Contact');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, 'Designation');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, 'Date of joining');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, 'Gender');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, 'Address');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'A/C Number');
			
			/***************Set Field********End*************/
        
			
		// Fetching the table data
		$row = 2;
		
		$i =1;
		foreach($result->result() as $data)
		{	
			
			$designation = $this->Designation_model->read_designation_information($data->designation_id);
			
			if(!empty($designation)){
				$designation_name = $designation[0]->designation_name;
			} else {
				$designation_name = "";
			}
			
			$bank_account = $this->Employees_model->set_employee_bank_account($data->user_id);
			$bank_detail = $bank_account->result();
			
			if(!empty($bank_detail)){
				$account_number = $bank_detail[0]->account_number;
			} else {
				$account_number = "";
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data->user_id);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, ucfirst($data->first_name." ".$data->last_name));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data->email);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data->contact_no);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $designation_name);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data->date_of_joining);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data->gender);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data->address);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $account_number);
			
 
			$i++;
			
			$row++;
		}
 
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Employees-List_'.date('Y-m-d').'.xls"');
		header('Cache-Control: max-age=0');
 
		$objWriter->save('php://output');

	}

	public function no_work()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$data['breadcrumbs'] = 'No Work';
		$data['path_url'] = 'no_work';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('13',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("employees/no_work_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
	}

	public function no_work_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/no_work_list", $data);
		} else {
			redirect('');
		}

		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$works = $this->Employees_model->get_no_work_reminderByCmp();

		$data = array();

		foreach($works as $r) {

			$employee = $this->Employees_model->read_employee_information($r->employee_id);
			// user full name
			$full_name = $employee[0]->first_name.' '.$employee[0]->last_name;

			// reminder date
			$reminder_at = $this->Hrms_model->set_date_format($r->work_date);

			$data[] = array(
				'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->have_word_id . '"><i class="fa fa-trash-o"></i></button></span>',
				$full_name,
				$reminder_at,
			);

		}
		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($works),
			"recordsFiltered" => count($works),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function no_work_delete()
	{

		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Employees_model->delete_no_work_record($id);
		if(isset($id)) {
			$Return['result'] = 'Reminder deleted';
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);

	}

	public function medical_convocation()
	{
		$session = $this->session->userdata('username');
		$data['title'] = $this->Hrms_model->site_title();
		$data['breadcrumbs'] = 'Medical Convocation';
		$data['path_url'] = 'medical_convocation';
		$data['all_employees'] =  $this->Hrms_model->all_employees_byCmpId($session['companyId']);
		
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('13',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("employees/medical_convocation_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
	}

	public function medical_convocation_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/medical_convocation_list", $data);
		} else {
			redirect('');
		}

		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$data['all_employees'] = $this->Hrms_model->all_employees_byCmpId($session['companyId']);
		$employees = $this->Employees_model->get_employee_withCompany($session['companyId']);

		$data = array();

		foreach($employees as $e) {

			// user full name
			$full_name = $e->first_name.' '.$e->last_name;

			$convocation = $this->Employees_model->read_medical_convocation($e->user_id);

			if(!empty($convocation)){

				$convocation_id = $convocation[0]->convocation_id;
				$health_status = $convocation[0]->health_status;
				$disease = $convocation[0]->disease;
				$last_convo = $this->Hrms_model->set_date_format($convocation[0]->convocation_date);

			} else {

				$convocation_id = '';
				$health_status = '-';
				$disease = '-';
				$last_convo = '-';
				
			}

			if($convocation_id != ''){
				$option = '<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-convocation_id="'. $e->user_id . '"><i class="fa fa-pencil-square-o"></i></button></span>';
			} else {
				$option = '';
			}

			$data[] = array(
				$option,
				$full_name,
				$last_convo,
				$disease,
				$health_status,
				($e->blood_group != '')?$e->blood_group:'-',
				($e->height != '')?$e->height:'-',
				($e->weight != '')?$e->weight:'-',
				($e->disease != '')?$e->disease:'-',
			);

		}
		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($employees),
			"recordsFiltered" => count($employees),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function add_medical_convocation()
	{
		$Return = array('result'=>'', 'error'=>'');

		if($this->input->post('employee_id')===''){
			$Return['error'] = 'Please select employee';
		} else if($this->input->post('convocation_date')===''){
			$Return['error'] = 'Please enter convocation date';
		} else if($this->input->post('health_status')===''){
			$Return['error'] = 'Please enter health status';
		} else if($this->input->post('disease')===''){
			$Return['error'] = 'Please enter employee disease detail';
		} else if($this->input->post('blood_group')===''){
			$Return['error'] = 'Please enter blood group';
		} else if($this->input->post('height')===''){
			$Return['error'] = 'Please enter employee height';
		} else if($this->input->post('weight')===''){
			$Return['error'] = 'Please enter employee weight';
		}

		if($Return['error']!=''){
			$this->output($Return);
		}

		$employee_id = $this->input->post('employee_id');

		$employee_data = [
			'blood_group' => $this->input->post('blood_group'),
			'height' => $this->input->post('height'),
			'weight' => $this->input->post('weight'),
		];

		$eresult = $this->Employees_model->update_record($employee_data, $employee_id);

		$convocation = [
			'employee_id' => $this->input->post('employee_id'),
			'convocation_date' => $this->input->post('convocation_date'),
			'health_status' => $this->input->post('health_status'),
			'disease' => $this->input->post('disease'),
			'created_by' => $this->input->post('user_id'),
			'created_at' => date('Y-m-d H:i:s'),
		];

		$cresult = $this->Employees_model->add_medical_convocation($convocation);

		if($eresult && $cresult){
			$Return['result'] = 'Medical Detail added.';
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}

		$this->output($Return);

	}

	public function read_convocation_record()
	{
		$employee_id = $this->input->get('convocation_id');

		$convocation = $this->Employees_model->read_medical_convocation($employee_id);
		$employee = $this->Employees_model->read_employee_information($employee_id);

		$data = [
			'employee_id' => $employee_id,
			'convocation_id' => $convocation[0]->convocation_id,
			'convocation_date' => $convocation[0]->convocation_date,
			'health_status' => $convocation[0]->health_status,
			'disease' => $convocation[0]->disease,
			'blood_group' => $employee[0]->blood_group,
			'height' => $employee[0]->height,
			'weight' => $employee[0]->weight,
			'all_employees' => $this->Hrms_model->all_employees(),
		];

		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('employees/dialog_convocation', $data);
		} else {
			redirect('');
		}

	}

	public function edit_convocation()
	{
		if($this->input->post('edit_type')=='convocation') {

			$id = $this->uri->segment(3);		
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'');

			/* Server side PHP input validation */
			if($this->input->post('employee_id')===''){
				$Return['error'] = 'Please select employee';
			} else if($this->input->post('convocation_date')===''){
				$Return['error'] = 'Please enter convocation date';
			} else if($this->input->post('health_status')===''){
				$Return['error'] = 'Please enter health status';
			} else if($this->input->post('disease')===''){
				$Return['error'] = 'Please enter employee disease detail';
			} else if($this->input->post('blood_group')===''){
				$Return['error'] = 'Please enter blood group';
			} else if($this->input->post('height')===''){
				$Return['error'] = 'Please enter employee height';
			} else if($this->input->post('weight')===''){
				$Return['error'] = 'Please enter employee weight';
			}

			if($Return['error']!=''){
				$this->output($Return);
			}

			$employee_id = $this->input->post('employee_id');

			$employee_data = [
				'blood_group' => $this->input->post('blood_group'),
				'height' => $this->input->post('height'),
				'weight' => $this->input->post('weight'),
			];

			$eresult = $this->Employees_model->update_record($employee_data, $employee_id);

			$convocation_id = $this->input->post('convocation_id');

			$convocation = [
				'convocation_date' => $this->input->post('convocation_date'),
				'health_status' => $this->input->post('health_status'),
				'disease' => $this->input->post('disease'),
			];

			$cresult = $this->Employees_model->update_medical_convocation($convocation, $convocation_id);

			if($eresult && $cresult){
				$Return['result'] = 'Medical detail updated.';
			} else {
				$Return['error'] = $this->lang->line('hrms_error_msg');
			}

			$this->output($Return);

			exit;
		}
	}

	public function medical_convocation_delete()
	{

		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Employees_model->delete_no_work_record($id);
		if(isset($id)) {
			$Return['result'] = 'Reminder deleted';
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);

	}

	public function feedback()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$data['breadcrumbs'] = 'Feedback';
		$data['path_url'] = 'feedback';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('13',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("employees/feedback_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}
	}

	public function feedback_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("employees/feedback_list", $data);
		} else {
			redirect('');
		}

		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$feedbacks = $this->Employees_model->get_feedbackByCmp();

		$data = array();

		foreach($feedbacks as $r) {

			$employee = $this->Employees_model->read_employee_information($r->employee_id);
			// user full name
			$full_name = $employee[0]->first_name.' '.$employee[0]->last_name;

			// reminder date
			$reminder_at = $this->Hrms_model->set_date_format($r->created_at);

			$answers = explode(',', $r->answers);

			$data[] = array(
				'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('hrms_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->feedback_id . '"><i class="fa fa-trash-o"></i></button></span>',
				$full_name,
				(isset($answers[0]))?$answers[0]:'-',
				(isset($answers[1]))?$answers[1]:'-',
				(isset($answers[2]))?$answers[2]:'-',
				(isset($answers[3]))?$answers[3]:'-',
				(isset($answers[4]))?$answers[4]:'-',
				$r->message,
				$reminder_at,
			);

		}
		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($feedbacks),
			"recordsFiltered" => count($feedbacks),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function feedback_delete()
	{

		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Employees_model->delete_feedback_record($id);
		if(isset($id)) {
			$Return['result'] = 'Reminder deleted';
		} else {
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}
		$this->output($Return);

	}

	public function activeInactive()
	{

		$id = $_POST['id'];
		$Return = array('result'=>'', 'error'=>'');
		
		$result = $this->Employees_model->read_employee_information($id);
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
			$this->Employees_model->update_record($data,$id);
			$Return['result'] = $this->lang->line('hrms_success_update_employee');
		}else{
			$Return['error'] = $this->lang->line('hrms_error_msg');
		}

		$this->output($Return);
	}

}
