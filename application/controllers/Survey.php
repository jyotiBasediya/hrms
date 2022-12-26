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
 * @package  iLinkHR - Survey
 * @author-email  ilinkhr@gmail.com
 * @copyright  Copyright 2017 © ilinkhr.com. All Rights Reserved
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the model
		$this->load->model("Survey_model");
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
		$data['breadcrumbs'] = 'Survey';
		$data['path_url'] = 'survey';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('15',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("survey/survey_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
	}
 
    public function survey_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("survey/survey_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$survey = $this->Survey_model->get_survey();
		
		$data = array();

		foreach($survey->result() as $r) {
			 			  
			// get user > added by
			$user = $this->Hrms_model->read_user_info($r->created_by);
			// user full name
			$full_name = $user[0]->first_name.' '.$user[0]->last_name;
			//Survey date
			$survey_date = $this->Hrms_model->set_date_format($r->created_at);

			$data[] = array(
				'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-survey_id="'. $r->survey_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-survey_id="'. $r->survey_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->survey_id . '"><i class="fa fa-trash-o"></i></button></span>',
				$r->title,
				$full_name,
				$survey_date
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $survey->num_rows(),
			"recordsFiltered" => $survey->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
     }
	 
	public function read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$id = $this->input->get('survey_id');
		$result = $this->Survey_model->read_survey_information($id);
		$data = array(
				'survey_id' => $result[0]->survey_id,
				'title' => $result[0]->title,
				'description' => $result[0]->description,
				'survey_questions' => $this->Survey_model->all_survey_questions($id)
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('survey/dialog_survey', $data);
		} else {
			redirect('');
		}
	}
	
	// Validate and add info in database
	public function add_survey() {

		if($this->input->post('add_type')=='survey') {

			$Return = array('result'=>'', 'error'=>'');

			if($this->input->post('title')==='') {
			$Return['error'] = "The title field is required.";
			} else if($this->input->post('survey_information')==='') {
				$Return['error'] = "The survey information field is required.";
			} else {

				$session = $this->session->userdata('username');
					
				$data = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('survey_information'),
					'created_by' => $session['user_id'],
					'created_at' => date('Y-m-d H:i:s'),
				);
				$result = $this->Survey_model->add($data);
				if ($result == TRUE) {

					$survey = $this->Survey_model->read_last_survey_information();

					$questionsCount = count($this->input->post('question'));
					$questions = $this->input->post('question');
					$answer_type = $this->input->post('answer_type');
					$answer_option = $this->input->post('answer_option');

					for ($i=0; $i < $questionsCount; $i++) { 

						$question = [
							"survey_id" => $survey[0]->survey_id,
							"question" => $questions[$i],
							"answer_type" => $answer_type[$i],
							"answer_options" => (isset($answer_option[$i])) ? json_encode($answer_option[$i]) : '' ,
							"created_by" => $this->input->post('_user'),
							"created_at" => date("Y-m-d H:i:s"),
						];

						$this->Survey_model->add_question($question);

					}

					$Return['result'] = 'Survey added.';

				} else {
					$Return['error'] = 'Bug. Something went wrong, please try again.';
				}
			}

			$this->output($Return);
			exit;
		
		}

	}
	
	// Validate and update info in database
	public function update() {
	
		if($this->input->post('edit_type')=='survey') {
			
		$id = $this->uri->segment(3);
		
		$Return = array('result'=>'', 'error'=>'');

			if($this->input->post('title')==='') {
			$Return['error'] = "The title field is required.";
			} else if($this->input->post('survey_information')==='') {
				$Return['error'] = "The survey information field is required.";
			} else {

				$session = $this->session->userdata('username');
					
				$data = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('survey_information'),
					'created_by' => $session['user_id'],
					'created_at' => date('Y-m-d H:i:s'),
				);
				$result = $this->Survey_model->update_record($data, $id);
				if ($result == TRUE) {

					$session = $this->session->userdata('username');

					$questionsCount = count($this->input->post('question'));
					$questions = $this->input->post('question');
					$answer_type = $this->input->post('answer_type');
					$answer_option = $this->input->post('answer_option');
					$question_ids = $this->input->post('question_id');

					for ($i=0; $i < $questionsCount; $i++) { 

						if(isset($question_ids[$i])){

							$question = [
								"question" => $questions[$i],
								"answer_type" => $answer_type[$i],
								"answer_options" => (isset($answer_option[$i])) ? json_encode($answer_option[$i]) : '' ,
							];

							$this->Survey_model->update_questions($question, $question_ids[$i]);

						} else {

							$question = [
								"survey_id" => $id,
								"question" => $questions[$i],
								"answer_type" => $answer_type[$i],
								"answer_options" => (isset($answer_option[$i])) ? json_encode($answer_option[$i]) : '' ,
								"created_by" => $session['user_id'],
								"created_at" => date("Y-m-d H:i:s"),
							];

							$this->Survey_model->add_question($question);

						}

					}

					$Return['result'] = 'Survey added.';

				} else {
					$Return['error'] = 'Bug. Something went wrong, please try again.';
				}
			}

			$this->output($Return);
			exit;

		}
	}
	
	public function delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Survey_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = 'Award deleted.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}

	public function employee_survey()
	{
     	$data['title'] = $this->Hrms_model->site_title();
		$data['breadcrumbs'] = 'Survey';
		$data['path_url'] = 'employee_survey';
		$session = $this->session->userdata('username');
		$role_resources_ids = $this->Hrms_model->user_role_resource();
		if(in_array('15',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("survey/employee_survey_list", $data, TRUE);
			$this->load->view('layout_main', $data); //page load
			} else {
				redirect('');
			}
		} else {
			redirect('dashboard/');
		}		  
	}
 
    public function employee_survey_list()
	{

		$data['title'] = $this->Hrms_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("survey/employee_survey_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$answers = $this->Survey_model->get_employee_survey();
		
		$data = array();

		foreach($answers->result() as $r) {
			 			  
			// get user > added by
			$user = $this->Hrms_model->read_user_info($r->employee_id);
			
			// get survey > survey id
			$survey = $this->Survey_model->read_survey_information($r->survey_id);

			// user full name
			$full_name = $user[0]->first_name.' '.$user[0]->last_name;
			
			//Survey date
			$survey_date = $this->Hrms_model->set_date_format($r->craeted_at);

			$data[] = array(
				'<span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-answer_id="'. $r->survey_id . '" data-employee_id="'. $r->employee_id . '"><i class="fa fa-eye"></i></button></span><!-- <span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->answer_id . '"><i class="fa fa-trash-o"></i></button></span> -->',
				$full_name,
				$survey[0]->title,
				$survey_date
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $answers->num_rows(),
			"recordsFiltered" => $answers->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
     }
	 
	public function employee_survey_read()
	{
		$data['title'] = $this->Hrms_model->site_title();
		$survey_id = $this->input->get('answer_id');
		$employee_id = $this->input->get('employee_id');
			
		// get survey > survey id
		$survey = $this->Survey_model->read_survey_information($survey_id);

		// get survey answer > survey id & employee id
		$result = $this->Survey_model->read_survey_answer_information($survey_id, $employee_id);

		$answers = [];

		foreach ($result as $r) {

			// get survey question > question id
			$question = $this->Survey_model->read_survey_question($r->survey_id);

			$answers[] = [
				"question" => $question[0]->question,
				"answer" => $r->answer
			];
			
		}

		$data = array(
				'survey' => $survey[0],
				'answers' => $answers,
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('survey/dialog_employee_survey', $data);
		} else {
			redirect('');
		}
	}
	
	public function employee_survey_delete() {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');
		$id = $this->uri->segment(3);
		$result = $this->Survey_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = 'Award deleted.';
		} else {
			$Return['error'] = 'Bug. Something went wrong, please try again.';
		}
		$this->output($Return);
	}
}
