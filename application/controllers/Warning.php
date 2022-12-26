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

 * @package  iLinkHR - Warning

 * @author-email  ilinkhr@gmail.com

 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Warning extends MY_Controller {

	

	 public function __construct() {

        parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Warning_model");

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
     	$session = $this->session->userdata('username');
		$data['title'] = $this->Hrms_model->site_title();

		$data['all_employees'] =  $this->Hrms_model->all_employees_byCmpId($session['companyId']);

		$data['all_warning_types'] = $this->Warning_model->all_warning_types();

		$data['breadcrumbs'] = 'Warnings';

		$data['path_url'] = 'warning';

		$session = $this->session->userdata('username');

		$role_resources_ids = $this->Hrms_model->user_role_resource();

		if(in_array('22',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("warning/warning_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

 

    public function warning_list()

     {



		$data['title'] = $this->Hrms_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("warning/warning_list", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$warning = $this->Warning_model->get_warningByCmp();

		

		$data = array();



          foreach($warning as $r) {

			 			  

		// get user > warning to

		$user = $this->Hrms_model->read_user_info($r->warning_to);

		// user full name

		$warning_to = $user[0]->first_name.' '.$user[0]->last_name;

		// get user > warning by

		$user_by = $this->Hrms_model->read_user_info($r->warning_by);

		// user full name

		$warning_by = $user_by[0]->first_name.' '.$user_by[0]->last_name;

		// get warning date

		$warning_date = $this->Hrms_model->set_date_format($r->warning_date);

				

		// get status

		if($r->status==0): $status = 'Pending';

		elseif($r->status==1): $status = 'Accepted'; else: $status = 'Rejected'; endif;

		// get warning type

		$warning_type = $this->Warning_model->read_warning_type_information($r->warning_type_id);

		

		$data[] = array(

			'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-warning_id="'. $r->warning_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-warning_id="'. $r->warning_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->warning_id . '"><i class="fa fa-trash-o"></i></button></span>',

			$warning_to,

			$warning_date,

			$r->subject,

			$warning_type[0]->type,

			$status,

			$warning_by

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => count($warning),

			 "recordsFiltered" =>count($warning),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

	 

	 public function read()

	{
		
$session = $this->session->userdata('username');

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

				'all_employees' => $this->Hrms_model->all_employees_byCmpId($session['companyId']),

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

	public function add_warning() {

	

		if($this->input->post('add_type')=='warning') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$description = $this->input->post('description');

		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);

		

		if($this->input->post('warning_to')==='') {

       		 $Return['error'] = "The warning to field is required.";

		} else if($this->input->post('type')==='') {

			$Return['error'] = "The warning type field is required.";

		} else if($this->input->post('subject')==='') {

			 $Return['error'] = "The subject field is required.";

		} else if(empty($this->input->post('warning_by'))) {

			 $Return['error'] = "The warning by field is required.";

		} else if(empty($this->input->post('warning_date'))) {

			 $Return['error'] = "The warning date field is required.";

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

		'status' => '0',

		'created_at' => date('d-m-Y'),

		);

		$result = $this->Warning_model->add($data);

		if ($result == TRUE) {



			$warning_type = $this->Warning_model->read_warning_type_information($this->input->post('type'));

			//get company info

			$cinfo = $this->Hrms_model->read_company_setting_info(1);

			$template = $this->Hrms_model->read_email_template(16);

				

			//get employee info

			$user_info = $this->Hrms_model->read_user_info($this->input->post('warning_to'));

			$warning_by = $this->Hrms_model->read_user_info($this->input->post('warning_by'));

			

			$full_name = $user_info[0]->first_name.' '.$user_info[0]->last_name;

			$warning_by_name = $warning_by[0]->first_name.' '.$warning_by[0]->last_name;

			$subject = $template[0]->subject.' : '.$this->input->post('subject').' - '.$cinfo[0]->company_name;

			$logo = base_url().'uploads/logo/'.$cinfo[0]->logo;

				

			$message = ' <div style="background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;"> <img src="'.$logo.'" title="'.$cinfo[0]->company_name.'"><br>'.str_replace(array("{var site_name}","{var warning_type}","{var warning_by}","{var warning_message}"),array($cinfo[0]->company_name,$warning_type[0]->type,$warning_by_name,$qt_description),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';



			$emailData['employee_id'] = $this->input->post('warning_to');

			$emailData['email_type'] = "receive";

			$emailData['email_for'] = "Warning";

			$emailData['email_to'] = $user_info[0]->email;

			$emailData['email_subject'] = $subject;

			$emailData['email_message'] = $message;

			$this->sendSMTPMail($emailData);



			$Return['result'] = 'Warning added.';

		} else {

			$Return['error'] = 'Bug. Something went wrong, please try again.';

		}

		$this->output($Return);

		exit;

		}

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

       		 $Return['error'] = "The warning to field is required.";

		} else if($this->input->post('type')==='') {

			$Return['error'] = "The warning type field is required.";

		} else if($this->input->post('subject')==='') {

			 $Return['error'] = "The subject field is required.";

		} else if(empty($this->input->post('warning_by'))) {

			 $Return['error'] = "The warning by field is required.";

		} else if(empty($this->input->post('warning_date'))) {

			 $Return['error'] = "The warning date field is required.";

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

			$Return['result'] = 'Warning updated.';

		} else {

			$Return['error'] = 'Bug. Something went wrong, please try again.';

		}

		$this->output($Return);

		exit;

		}

	}

	

	public function delete() {

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

		$id = $this->uri->segment(3);

		$result = $this->Warning_model->delete_record($id);

		if(isset($id)) {

			$Return['result'] = 'Warning deleted.';

		} else {

			$Return['error'] = 'Bug. Something went wrong, please try again.';

		}

		$this->output($Return);

	}

}

