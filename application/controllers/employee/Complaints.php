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
 * @package  iLinkHR - User > Complaints
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaints extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Complaints_model");
		$this->load->model("Hrms_model");
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
		$data['all_employees'] = $this->Hrms_model->all_employees();
		$session = $this->session->userdata('username');
		$data['breadcrumbs'] = 'Complaints';
		$data['path_url'] = 'user/user_complaints';
		if(!empty($session)){ 
			$data['subview'] = $this->load->view("user/complaint_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
		} else {
			redirect('');
		}
		  
     }
 
    public function complaint_list()
     {

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("user/complaint_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$complaint = $this->Complaints_model->get_complaints();
		
		$data = array();

        foreach($complaint->result() as $r) {
			
		 $aim = explode(',',$r->complaint_against);
		 foreach($aim as $dIds) {
		 if($session['user_id'] == $dIds) {	
			 			  
		// get user > added by
		$user = $this->Hrms_model->read_user_info($r->complaint_from);
		// user full name
		$complaint_from = $user[0]->first_name.' '.$user[0]->last_name;
		// get complaint date
		$complaint_date = $this->Hrms_model->set_date_format($r->complaint_date);
		
		if($r->complaint_against == '') {
			$ol = '--';
		} else {
			$ol = '<ol class="nl">';
			foreach(explode(',',$r->complaint_against) as $desig_id) {
				$_comp_name = $this->Hrms_model->read_user_info($desig_id);
				$ol .= '<li>'.$_comp_name[0]->first_name.' '.$_comp_name[0]->last_name.'</li>';
			 }
			 $ol .= '</ol>';
		}
		
		// get status
		if($r->status==0): $status = 'Pending';
		elseif($r->status==1): $status = 'Accepted'; else: $status = 'Rejected'; endif;
		
		// description
		$description =  html_entity_decode($r->description);
		
		$data[] = array('<span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-complaint_id="'. $r->complaint_id . '"><i class="fa fa-eye"></i></button></span>',
			$complaint_from,
			$ol,
			$r->title,
			$complaint_date,
			$status,
			$description
		);
      }
		 } } // e-complaints
	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $complaint->num_rows(),
			 "recordsFiltered" => $complaint->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
}
