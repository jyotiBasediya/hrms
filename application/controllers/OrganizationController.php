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

class OrganizationController extends MY_Controller {
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
		$this->load->model("Project_model");
		$this->load->model("Timesheet_model");
		$this->load->model("Roles_model");
		$this->load->model("CommonModel");

	}

	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}

	public function location()
    {
    	// echo "string";die;
     	$session = $this->session->userdata('username'); 

     	// print_r($session);die;
		$data['title'] = $this->Hrms_model->site_title();
		$data['all_countries'] = $this->Hrms_model->get_countries();
		$data['all_companies'] = $this->Hrms_model->get_companies();
		$data['all_employees'] = $this->Hrms_model->all_employees_byCmpId($session['companyId']);

		$data['breadcrumbs'] = $this->lang->line('hrms_locations');

		$data['path_url'] = 'location';

		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();	 

		// $location = $this->Location_model->get_locationsByCmy();
		// $data['location'] = $this->Location_model->get_all_location();
		$data['location'] = $this->CommonModel->selectAllResultData('hrms_office_location');
		// print_r($data['location']);die;

		$this->load->view('common/header');
		$this->load->view('organization/location',$data);

		$this->load->view('common/footer');  
    }
 
 	public function location_list()
    {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("location/location_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		// $location = $this->Location_model->get_locations();
		$location = $this->Location_model->get_locationsByCmy();
		
		$data = array();

          foreach($location as $r) {
			  
			  // get country
			  $country = $this->Hrms_model->read_country_info($r->country);
			  // get company
			  $company = $this->Hrms_model->read_company_info($r->company_id);
			  // get user
			  $user = $this->Hrms_model->read_user_info($r->added_by);
			  // user full name
			  $full_name = $user[0]->first_name.' '.$user[0]->last_name;
			  
			   // get location head
			  $location_head = $this->Hrms_model->read_user_info($r->location_head);
			  // user full name
			  $head_name = $location_head[0]->first_name.' '.$location_head[0]->last_name;

			  if(isset($company[0]->name)){

               $data[] = array(
			   		'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-location_id="'. $r->location_id . '"><i class="fa fa-pencil-square-o"></i></button></span></span><span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-location_id="'. $r->location_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->location_id . '"><i class="fa fa-trash-o"></i></button></span>',
                    $r->location_name,
					$head_name,
                    $company[0]->name,
                    $r->city,
                    $country[0]->country_name,
					$full_name
               );
           	}

          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => count($location),
                 "recordsFiltered" => count($location),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
    }

    public function add_location()
    {
     	if($_SERVER['REQUEST_METHOD'] == 'POST'){

     		// print_r($_POST);die;

     		$data = array(
                'location_name' => $this->input->post('location_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address_1' => $this->input->post('address_1'),
                
             );
	     	// print_r($data);die();
	        $this->db->insert('hrms_office_location', $data);
	        redirect('location');
     	}else{

     		// $data['employees'] = $this->Project_model->getAllemp();
			// $data['leave_detail'] = $this->Timesheet_model->edit_id($id);
			// print_r($data['employees_detail']);die;
			$this->load->view('common/header');
			$this->load->view('organization/add_location');

			$this->load->view('common/footer'); 

     	}
    }


    public function edit_location($id)
	{
	
		$data['location_detail'] = $this->Timesheet_model->edit_location($id);
		$this->load->view('common/header');
		$this->load->view('organization/edit_location',$data);

		$this->load->view('common/footer'); 

     }


     	public function update_location()
	{ 
			$id = $this->input->post('location_id');
         	$data = array(
                'location_name' => $this->input->post('location_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address_1' => $this->input->post('address_1'),
                
             );
       // print_r($data);die();
		$this->db->where('location_id',$id);
		$this->db->update('hrms_office_location',$data);	
		redirect('location');
	}

	public function department()
    {
    	$data['all_roles'] = $this->Roles_model->all_user_roles();
		// print_r($data['all_roles']);die;

		$this->load->view('common/header');
		$this->load->view('organization/department',$data);

		$this->load->view('common/footer');  
    }

    public function add_department()
    {
     	if($_SERVER['REQUEST_METHOD'] == 'POST'){

     		// print_r($_POST);die;

     		$role_resources = $this->input->post('role_resources');
        
        	$role = implode(", ", $role_resources);

     		$data = array(
                'role_name' => $this->input->post('role_name'),
                'role_resources' => $role,
                
             );

	        $this->db->insert('hrms_user_roles', $data);
	        redirect('department');
     	}else{
			$this->load->view('common/header');
			$this->load->view('organization/add_department');

			$this->load->view('common/footer'); 

     	}
    }


    public function edit_department($id)
	{
	
		$data['role_detail'] = $this->Timesheet_model->edit_department($id);
		$this->load->view('common/header');
		$this->load->view('organization/edit_department',$data);

		$this->load->view('common/footer'); 

     }


    public function update_department()
	{ 

		// print_r($_POST);die;

		$role_resources = $this->input->post('role_resources');
        
        $role = implode(", ", $role_resources);

			$id = $this->input->post('role_id');
         	$data = array(
                'role_name' => $this->input->post('role_name'),
                'role_resources' => $role,
             );
       // print_r($data);die();
		$this->db->where('role_id',$id);
		$this->db->update('hrms_user_roles',$data);	
		redirect('department');
	}


	public function division()
    {

    	$data['division'] = $this->CommonModel->selectResultDataByConditionAndFieldName(array('status' => 1),'division','division.id');
		// print_r($data['all_roles']);die;

		$this->load->view('common/header');
		$this->load->view('organization/division',$data);

		$this->load->view('common/footer');  
    }

    public function add_division()
    {
     	if($_SERVER['REQUEST_METHOD'] == 'POST'){
     		$data = array(
                'name' => $this->input->post('name'),
             );

	        $this->db->insert('division', $data);

	        $this->session->set_flashdata('success','Division added successfully');
	        redirect('OrganizationController/division');
     	}else{
			$this->load->view('common/header');
			$this->load->view('organization/add_division');

			$this->load->view('common/footer'); 

     	}
    }


    public function edit_division()
	{
		$id = $this->uri->segment(3);

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
         	$data = array(
                'name' => $this->input->post('name'),
             );
			$this->db->where('id',$id);
			$this->db->update('division',$data);

			$this->session->set_flashdata('success','Division updated successfully');
	        redirect('OrganizationController/division');
			
     	}else{
			$data['division_detail'] = $this->CommonModel->selectRowDataByCondition(array('id' => $id),'division');
			$this->load->view('common/header');
			$this->load->view('organization/edit_division',$data);
			$this->load->view('common/footer'); 

     	}

     }


 //    public function update_department()
	// { 

	// 	// print_r($_POST);die;

	// 	$role_resources = $this->input->post('role_resources');
        
 //        $role = implode(", ", $role_resources);

	// 		$id = $this->input->post('role_id');
 //         	$data = array(
 //                'role_name' => $this->input->post('role_name'),
 //                'role_resources' => $role,
 //             );
 //       // print_r($data);die();
	// 	$this->db->where('role_id',$id);
	// 	$this->db->update('hrms_user_roles',$data);	
	// 	redirect('department');
	// }
}