<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model('api_model','',TRUE);
		$this->load->library(array('form_validation','common','session','email'));
		$this->load->helper(array('html','url','globle'));
		header('Access-Control-Allow-Origin: *'); 
	}

	function index()
	{
		redirect('api/page');
	}

	function page()
	{
		$this->load->view('api_list');
	}

	function encode_data($arrResult)
	{
		$output = json_encode($arrResult);		
		echo $output;
	}

	function TestNotifications()
	{  
		$output = array();

		$device_type="Android";

		if($device_type != NULL)
		{  

			$message1 = 'Test message'; 
			$message2 = "Test message 2"; 
			if($device_type == 'Android' || $device_type == 'android')
			{ 

				$deviceid = "dolbXoO8RCk:APA91bHqHw10acMKMo26aFC81dRZn8oJP0WwA-AG17BpgFPEpYCtb6dY2bFH369Pj2joPFby6PU6u8zlc8ct4s7AzXvji7rgJp-foA8Nf-rKBcs3PeCRKkTmiisJx_GONlZja49Wd0tV";

				$registatoin_ids = array($deviceid);
				$message123 = array("msg" => $message1,"notification" => $message2,"notitype" =>'New job', "job_id" => "12", "job_type" => "job");
				$result1=$this->sendMessageuser($message123,$registatoin_ids); 

				$output['success'] = "1";
				$output['msg'] = "Android Notification";
				$output['result'] = $result1;
				$this->encode_data($output);

			} 
			else if($device_type == 'iOS')
			{ 
				$deviceid="61195f26fc290c61a153b203b820eb74f56ef6901f8d7eab11"; 

				$registatoin_ids = array($deviceid);
				$message123 = array("msg" => $message1,"notification" => $message2,"notitype" =>'New job', "job_id" => "51", "job_type" => "ONDEMAND");
				$result1=$this->sendnotificationiosDriver($registatoin_ids,$message123);  

				$output['success'] = "1";
				$output['msg'] = "iOS Notification";
				$output['result'] = $result1;
				$this->encode_data($output);
			}



		}
		else
		{
			$output['success'] = "0";
			$output['msg'] = "Enter device type";

			return $output;
		}
	}

	function sendMessageuser($data,$target){

		$url = 'https://fcm.googleapis.com/fcm/send';
		$server_key = 'AIzaSyDnGVwO07jo7wHrZ375Asz9AfPnP-3EQZE';

		$fields = array();
		$fields['data'] = $data;

		if(is_array($target)){
			$fields['registration_ids'] = $target;
		}else{
			$fields['to'] = $target;
		}

		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$server_key);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}


	function sendnotificationiosDriver($deviceToken, $message) 
	{

		$deviceToken=$deviceToken[0];
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'uploads/pemfiles/develop_lazarus.pem');

		stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (!$fp) 
			exit("Failed to connect: $err $errstr" . PHP_EOL);

		$body['aps'] = array(
			'alert' => $message['notification'],
			'badge' => 1, 
			'sound' => 'oven.caf',
			'content-available'=>1,
			);
		$body['newparcel'] = array(

			'msg' => $message['msg'],
			'notitype' => $message['notitype'],
			'job_id' => $message['job_id'],
			'job_type' => $message['job_type'],


			);
		$payload = json_encode($body);
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		$result = fwrite($fp, $msg, strlen($msg));
		fclose($fp);
		if (!$result)
		{
			return '1';
		}  
		else
		{
			return '0'; 
		}
	}


	function sendMailcheck()
	{
		$attachment_path = "";
		$full_name = 'ritika bhawsar';
		$config = array (
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
			);
		$this->load->library('email',$config);

		$this->email->from('info@ems.in', 'lazarus');
		$this->email->to('ritika@infograins.in');

		$this->email->subject('testlazarus');
		$this->email->message('Hello' .$full_name. ' You have successfully completed your registration.we will be in touch after admin confirmation');
		if($attachment_path !='') 
		{
			$this->email->attach($attachment_path);
		}

		if($this->email->send())
		{
			echo "yes";
		}else{
			echo "no";
		}
	}

	function checkUsername()
	{

		$output=array();

		if(!$this->input->get_post('username'))
		{ 
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$username = $this->input->get_post('username');

			$result = $this->api_model->getWhere('hrms_employees', array('username'=>$username, 'is_active'=>1));
			if(!empty($result))
			{
				$output['success'] = 1; 
				$output['msg'] = "Username Already Exist";
			}
			else
			{
				$output['success'] = 0; 
				$output['msg'] = "Success";

			}	

		}

		$this->encode_data($output);
	}

	function check_email($email)
	{
		$result = $this->api_model->getWhere('hrms_employees', array('email'=>$email, 'is_active'=>0));
		if(!empty($result))
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}

	function login()
	{
		$output=array();

		if(!$this->input->get_post('username') || !$this->input->get_post('password') || !$this->input->get_post('device_id') || !$this->input->get_post('device_type') || !$this->input->get_post('user_role'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{

			// $user_data = $this->api_model->getSingle('hrms_employees', array('username'=>$this->input->get_post('username'), 'password'=>$this->input->get_post('password'), 'is_active'=>1));
			$user_data = $this->api_model->select_single_row("select first_name,user_id,last_name,username,email,email_two,password,date_of_birth,city_of_birth,country_of_birth,profile_background,designation_id,gender,marital_status,spouse_name,spouse_dob,marrige_anniversery_date,children,address,address_two,profile_picture,wpn,wpn_issuedate,wpn_expirydate,passport_number,passport_issuedate,user_role_id,company_id,date_of_joining,passsport_expirydate,emergency_contact_name,emergency_contact_number,emergency_contact_relation,emergency_contact_email,contact_no,nsn,visa_number,is_active,visa_issuedate,last_login_date,visa_expirydate,telephone from hrms_employees where username = '".$this->input->get_post('username')."' and password = '".$this->input->get_post('password')."' and is_active = 1 and user_role_id = '".$this->input->get_post('user_role')."'");
				  // echo $this->db->last_query();
				  // print_r($user_data);die();
			if(empty($user_data))
			{
				$output['success'] = 0;
				$output['msg'] = 'Please enter correct username or password';
			}
			else
			{
				
				$update_data = array(
					'device_id'=>$this->input->get_post('device_id'),
					'device_type'=>$this->input->get_post('device_type'),
					'last_login_date'=>date('Y-m-d H:i:s'),
					
					);

				$this->api_model->update_data('hrms_employees', array('user_id'=>$user_data->user_id), $update_data);


				$output["success"] = "1";
				$output["msg"] = 'Login Successfully';
				$user_data->last_login = date('d-M-Y h:i a', strtotime($user_data->last_login_date));

// ******************extra Data***********************
$user_id = $user_data->user_id;

				$bank_detail = $this->api_model->getSingle('hrms_employee_bankaccount', array('employee_id' => $user_id));
				$designation_detail = $this->api_model->getSingle('hrms_designations', array('designation_id' => $user_data->designation_id));
				$attendance_detail = $this->api_model->select_single_row("SELECT COUNT(*) AS count FROM (SELECT * FROM hrms_attendance_time WHERE employee_id = '".$user_id."' AND MONTH(attendance_date) = '".date('m')."' GROUP BY attendance_date) AS tmp");
				$projects = $this->api_model->select_single_row("SELECT COUNT(*) AS projects FROM hrms_tasks WHERE FIND_IN_SET($user_id, assigned_to)");
				$awards = $this->api_model->select_single_row("SELECT COUNT(*) AS awards FROM hrms_awards WHERE employee_id='".$user_id."'");
				$warnings = $this->api_model->select_single_row("SELECT COUNT(*) AS warnings FROM hrms_employee_warnings WHERE warning_to='".$user_id."'");
				$email_count = $this->api_model->select_single_row("SELECT COUNT(*) AS email_count FROM hrms_email_history WHERE employee_id='".$user_id."'");
				$announcement = $this->api_model->getSingle('hrms_announcements', array('CURDATE() BETWEEN start_date AND end_date'));

				$output["success"] = 1;
				$output["msg"] = "success";
				$user_data->url = base_url().'uploads/user_img/';



					if (!empty($bank_detail)) {
					$user_data->account_number = $bank_detail->account_number;
				} else {
					$user_data->account_number  = "";
				}

				if (!empty($designation_detail)) {
					$user_data->job_profile = $designation_detail->designation_name;
				} else {
					$user_data->job_profile = "";
				}

				if ($user_data->profile_picture != "")  {
					$user_data->profile_image = file_exists('uploads/user_img/'.$user_data->profile_picture)?base_url().'uploads/user_img/'.$user_data->profile_picture:"https://www.w3schools.com/w3images/avatar2.png";
				} else {
					$user_data->profile_image = "https://www.w3schools.com/w3images/avatar2.png";
				}

				if ($user_data->profile_background != "") {
					$user_data->cover_image = (file_exists('uploads/user_cover_img/'.$user_data->profile_background))?base_url().'uploads/user_cover_img/'.$user_data->profile_background:base_url().'uploads/user_cover_img/'."cover.png";
				} else {
					$user_data->cover_image = base_url().'uploads/user_cover_img/'."cover.png";
				}

				$user_data->attendance_days = $attendance_detail->count;
				$user_data->projects = $projects->projects;
				$user_data->awards = $awards->awards;
				$user_data->warnings = $warnings->warnings;
				$user_data->email_count = $email_count->email_count;
				$user_data->date_of_join = date("Y-m-d", strtotime($user_data->date_of_joining));

				$user_data->is_verify = $user_data->is_active;
				$user_data->check_status = '1';

				if (!empty($announcement)) {
					$user_data->announcement = $announcement->description;
				} else {
					$user_data->announcement = "";
				}

//************end data**********************
				$output['object'] = $user_data;

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"action" => 'Processed',
					"access_type" => 'Login',
					"access" => '<p><a href="'.site_url('employees/detail/'.$user_data->user_id).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> logged in.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			}

		}

		$this->output($output);
	}

	function forgot_password()
	{
		$output=array();

		if(!$this->input->get_post('email'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$user_data = $this->api_model->getSingle('hrms_employees', array('email'=>$this->input->get_post('email'), 'is_active'=>1));

			if(empty($user_data))
			{
				$output['success'] = 0;
				$output['msg'] = 'Please enter your registered email';
			}
			else
			{

				$password = $this->random_number(6);
				$password_n = $password;

				$update_data = array(
					'password'=>$password_n
				);

				$this->api_model->update_data('hrms_employees', array('user_id'=>$user_data->user_id), $update_data);



				$message = "Oops!! You forgot your password. No problem.Your new Password is ".$password." and Username is '".$user_data->username."'  Thanks.";

				$data_email['fullname'] = $user_data->first_name.' '.$user_data->last_name;

				$this->load->library('email');
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['priority'] = 1;

				$this->email->initialize($config);
				$this->email->from('info@ilinkhr.in','iLinkHR');
				$this->email->to($user_data->email);
				$this->email->subject('iLinkHR:- Forgot Password');
				$data_email['str_final'] = $message;
				$message = $this->load->view('forgot_password_email_template',$data_email, TRUE);
				$this->email->message($message);
				if ($this->email->send())
				{
					$output['success'] = 1;
					$output['msg'] = 'Please check your email address for password.';

					switch ($user_data->gender) {
						case 'Male':
							$h = 'his';
							break;
						case 'Female':
							$h = 'her';
							break;					
						default:
							$h = '';
							break;
					}

					$history = [
						"employee_id" => $user_data->user_id,
						"access_id" => 0,
						"action" => 'Processed',
						"access_type" => 'Forgot Password',
						"access" => '<p><a href="'.site_url('employees/detail/'.$user_data->user_id).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> was forgot '.$h.' password.</a></p>',
						"created_at" => date('Y-m-d H:i:s'),
					];

					$this->accessHistory($history);

				}
				else
				{
					$output['success'] = 0;
					$output['msg'] = 'Oops some error please try again.';
				}

			}

		}

		$this->encode_data($output);
	}

	function random_number($length)  {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $string[rand(0, strlen($string) - 1)];
		}
		return $randomString;
	}

	function logout()
	{
		$output = array();

		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{

			$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

			$update_data = array(
				'device_id'=>'',
				'device_type'=>'',
				);

			$this->api_model->update_data('hrms_employees', array('user_id'=>$this->input->get_post('user_id')), $update_data);

			if(!empty($user_data))
			{
				$output["msg"] = 'Successfully Logout';
				$output["success"] = "1";
			}
			else
			{
				$output['success'] = 0;
				$output['msg'] = 'No Users Exits !';
			}

		}

		$this->encode_data($output);
	}	

	function uploadProfileImage() 
	{
		$output = array();

		if(!$this->input->get_post('user_id')) {
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		} else {
			$image_name = $_FILES["profile_image"]["name"];

			if($_FILES["profile_image"]["name"]!='')  {
				$directory = USER_IMAGE;

				$image_name_new = time().'.jpg';
				$image_path = $directory.$image_name_new;
				if(move_uploaded_file($_FILES["profile_image"]["tmp_name"], $image_path)) {

					$query = "update hrms_employees set profile_picture = '".$image_name_new."' where user_id = '".$this->input->get_post('user_id')."'";
					$this->db->query($query);

					$output['success'] = 1;
					$output['msg'] = 'updated successfully';

					$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

					switch ($user_data->gender) {
						case 'Male':
							$h = 'his';
							break;
						case 'Female':
							$h = 'her';
							break;
						default:
							$h = '';
							break;
					}

					$history = [
						"employee_id" => $user_data->user_id,
						"access_id" => 0,
						"access_type" => 'Profile Image Update',
						"action" => 'Edited',
						"access" => '<p><a href="'.site_url('employees/detail/'.$user_data->user_id).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> changed '.$h.' profile image.</a></p>',
						"created_at" => date('Y-m-d H:i:s'),
					];

					$this->accessHistory($history);

				} else {
					$output['success'] = 0;
					$output['msg'] = 'Failed to upload image.';
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Check Parameter';
			}	

		}

		$this->encode_data($output);
	}

	function uploadCoverImage() 
	{
		$output = array();

		if(!$this->input->get_post('user_id')) {
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		} else {

			$image_name = $_FILES["cover_image"]["name"];

			if($_FILES["cover_image"]["name"]!='')  {
				$directory =COVER_IMAGE;

				$image_name_new = time().'.jpg';
				$image_path = $directory.$image_name_new;

				if(move_uploaded_file($_FILES["cover_image"]["tmp_name"], $image_path)) {

					$query = "update hrms_employees set profile_background = '".$image_name_new."' where user_id = '".$this->input->get_post('user_id')."'";
					$this->db->query($query);

					$output['success'] = 1;
					$output['msg'] = 'updated successfully';

					$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

					switch ($user_data->gender) {
						case 'Male':
							$h = 'his';
							break;
						case 'Female':
							$h = 'her';
							break;
						default:
							$h = '';
							break;
					}

					$history = [
						"employee_id" => $user_data->user_id,
						"access_id" => 0,
						"access_type" => 'Profile Cover Update',
						"action" => 'Edited',
						"access" => '<p><a href="'.site_url('employees/detail/'.$user_data->user_id).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> changed '.$h.' cover image.</a></p>',
						"created_at" => date('Y-m-d H:i:s'),
					];

					$this->accessHistory($history);

				} else {
					$output['success'] = 0;
					$output['msg'] = 'Failed to upload image.';					
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Check Parameter';
			}	

		}

		$this->encode_data($output);
	}

	function getprofile()
	{
		$output = array();

		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{

			$user_id = $this->input->get_post('user_id');

			$user_data = $this->api_model->getSingle('hrms_employees', array('user_id' => $user_id));

			if(!empty($user_data))
			{
				$bank_detail = $this->api_model->getSingle('hrms_employee_bankaccount', array('employee_id' => $user_id));
				$designation_detail = $this->api_model->getSingle('hrms_designations', array('designation_id' => $user_data->designation_id));
				$attendance_detail = $this->api_model->select_single_row("SELECT COUNT(*) AS count FROM (SELECT * FROM hrms_attendance_time WHERE employee_id = '".$user_id."' AND MONTH(attendance_date) = '".date('m')."' GROUP BY attendance_date) AS tmp");
				$projects = $this->api_model->select_single_row("SELECT COUNT(*) AS projects FROM hrms_tasks WHERE FIND_IN_SET($user_id, assigned_to)");
				$awards = $this->api_model->select_single_row("SELECT COUNT(*) AS awards FROM hrms_awards WHERE employee_id='".$user_id."'");
				$warnings = $this->api_model->select_single_row("SELECT COUNT(*) AS warnings FROM hrms_employee_warnings WHERE warning_to='".$user_id."'");
				$email_count = $this->api_model->select_single_row("SELECT COUNT(*) AS email_count FROM hrms_email_history WHERE employee_id='".$user_id."'");
				$announcement = $this->api_model->getSingle('hrms_announcements', array('CURDATE() BETWEEN start_date AND end_date'));

				$output["msg"] = 'Success';
				$output["success"] = "1";
				$output["object"]['user_id'] = $user_id;

				if ($user_data->username != "")  {
					$output["object"]['username'] = $user_data->username;
				} else {
					$output["object"]['username'] = "";
				}		

				$output["object"]['fname'] = $user_data->first_name;
				$output["object"]['lname'] = $user_data->last_name;
				$output["object"]['email'] = $user_data->email;
				$output["object"]['address'] = $user_data->address;
				$output["object"]['contact_number'] = $user_data->contact_no;
				$output["object"]['date_of_join'] = date("Y-m-d", strtotime($user_data->date_of_joining));
				$output["object"]['password'] = $user_data->password;

				if (!empty($bank_detail)) {
					$output["object"]['account_number'] = $bank_detail->account_number;
				} else {
					$output["object"]['account_number'] = "";
				}

				if (!empty($designation_detail)) {
					$output["object"]['job_profile'] = $designation_detail->designation_name;
				} else {
					$output["object"]['job_profile'] = "";
				}

				if ($user_data->profile_picture != "")  {
					$output["object"]['profile_image'] = file_exists('uploads/user_img/'.$user_data->profile_picture)?base_url().'uploads/user_img/'.$user_data->profile_picture:"https://www.w3schools.com/w3images/avatar2.png";
				} else {
					$output["object"]['profile_image'] = "https://www.w3schools.com/w3images/avatar2.png";
				}

				if ($user_data->profile_background != "") {
					$output["object"]['cover_image'] = (file_exists('uploads/user_cover_img/'.$user_data->profile_background))?base_url().'uploads/user_cover_img/'.$user_data->profile_background:base_url().'uploads/user_cover_img/'."cover.png";
				} else {
					$output["object"]['cover_image'] = base_url().'uploads/user_cover_img/'."cover.png";
				}

				$output["object"]['attendance_days'] = $attendance_detail->count;
				$output["object"]['projects'] = $projects->projects;
				$output["object"]['awards'] = $awards->awards;
				$output["object"]['warnings'] = $warnings->warnings;
				$output["object"]['email_count'] = $email_count->email_count;

				if (!empty($announcement)) {
					$output["object"]['announcement'] = $announcement->description;
				} else {
					$output["object"]['announcement'] = "";
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'No Users Exist!';
			}

		}

		$this->encode_data($output);
	}

	function contact()
	{
		$output=array();

		if(!$this->input->get_post('full_name')  || !$this->input->get_post('email') 
			|| !$this->input->get_post('message') || !$this->input->get_post('user_id')
			)
		{	
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{

			$insert_data = array(
				'name'=>$this->input->get_post('full_name'),

				'email'=>$this->input->get_post('email'),

				'message'=>$this->input->get_post('message'),

				'created_at'=>date('Y-m-d H:i:s'),
				'user_id'=>$this->input->get_post('user_id')
				);

			$insert_id = $this->api_model->insert_data('contact_us', $insert_data);

			$output["msg"] = 'Thanks, we will be in touch!';
			$output["success"] = "1";
			$output["object"]['inserted_id'] = "$insert_id";
			$output["object"]['name'] = $this->input->get_post('full_name');
			$output["object"]['email'] = $this->input->get_post('email');

			$msg = 'New enquiry message from '.$this->input->get_post('full_name');

			$data_notification  = array(
				'msg_from' => $this->input->get_post('user_id'), 
				'message' => $msg,
				'msg_for' => 2,
				'msg_type' => 6,
				'datetime' => date('Y-m-d H:i:s')
				);
			$this->admin_model->insert_entry('lazarus_notification', $data_notification);
		}

		$this->encode_data($output);
	}

	function privacyPolicy()
	{
		$output = array();

		$output["msg"] = 'Success';
		$output["success"] = "1";
		$output["object"]['title'] = 'Privacy Policy';
		$output["object"]['contain'] = "<html><head></head><body><p><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p></body></html>";

		$this->encode_data($output);
	}
//http://192.168.1.118/hrms/Api/punchInOut?user_id=48&latitude=15.2792368&longitude=-4.3150492&punch_status=1
	function punchInOut()
	{
		$output = array();

		if( !$this->input->get_post('user_id') || !$this->input->get_post('punch_status'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else if (!$this->input->get_post('latitude') || $this->input->get_post('latitude') == 0)
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enable location from your device';
		}
		else if (!$this->input->get_post('longitude') || $this->input->get_post('longitude') == 0) 
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enable location from your device';
		}

		else
		{
			if ($this->input->get_post('punch_status') == 1)
			{

				$punchindata = $this->api_model->select_single_row("select time_attendance_id, clock_out from  `hrms_attendance_time` where employee_id = '".$this->input->get_post('user_id')."' order by time_attendance_id desc LIMIT 1");
				if (!empty($punchindata))
				{

					if ($punchindata->clock_out != "")
					{
						$todayLastPunchOut = $this->api_model->select_single_row("select time_attendance_id, clock_out from  `hrms_attendance_time` where employee_id = '".$this->input->get_post('user_id')."' AND attendance_date='".date('Y-m-d')."' order by time_attendance_id desc LIMIT 1");
						if(!empty($todayLastPunchOut)){
							$lastOut = $todayLastPunchOut->clock_out;
						} else {
							$lastOut = '0000-00-00 00:00:00';
						}
						$datetime1 	= new DateTime($lastOut);
						$datetime2 	= new DateTime(date('Y-m-d H:i:s'));
						$interval 	= $datetime1->diff($datetime2);
						$hours_ov   = $interval->format('%h');
						$minutes_ov = $interval->format('%i');
						$seconds_ov = $interval->format('%s');
						$rest 		= $hours_ov .":".$minutes_ov.":".$seconds_ov;

						$data = array(
							'employee_id' =>$this->input->get_post('user_id'),
							'attendance_date'=>date('Y-m-d'),
							'clock_in'=>date('Y-m-d H:i:s'),
							'clock_in_out'=>1,
							'time_late'=>date('Y-m-d H:i:s'),
							'total_rest'=>$rest,
							'in_latitude'=>$this->input->get_post('latitude'),
							'in_longitude'=>$this->input->get_post('longitude'),
							'attendance_status'=>'Present'
						);	

						$this->api_model->insert_data('hrms_attendance_time', $data);	
						$output["msg"] = 'Punch In Successfully';
						$output["success"] = "1";

						$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

						$history = [
							"employee_id" => $user_data->user_id,
							"access_id" => 0,
							"access_type" => 'Punch In',
							"action" => 'Processed',
							"access" => '<p><a href="'.site_url('timesheet/attendance/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> punched in.</a></p>',
							"created_at" => date('Y-m-d H:i:s'),
						];

						$this->accessHistory($history);

					}
					else
					{
						$output["msg"] = 'Already Punch In';
						$output["success"] = "0";
					}

				}
				else
				{
					$data = array(
						'employee_id' =>$this->input->get_post('user_id'),
						'attendance_date'=>date('Y-m-d'),
						'clock_in'=>date('Y-m-d H:i:s'),
						'clock_in_out'=>1,
						'time_late'=>date('Y-m-d H:i:s'),
						'in_latitude'=>$this->input->get_post('latitude'),
						'in_longitude'=>$this->input->get_post('longitude'),
						'attendance_status'=>'Present'
					);

					$insert_id = $this->api_model->insert_data('hrms_attendance_time', $data);	
					$output["msg"] = 'punch in Successfully';
					$output["success"] = "1";

					$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

					$history = [
						"employee_id" => $user_data->user_id,
						"access_id" => 0,
						"action" => 'Processed',
						"access_type" => 'Punch In',
						"access" => '<p><a href="'.site_url('timesheet/attendance/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> punched in.</a></p>',
						"created_at" => date('Y-m-d H:i:s'),
					];

					$this->accessHistory($history);

				}
			}
			else if ($this->input->get_post('punch_status') == 2) 
			{
				$punchoutdata = $this->api_model->select_single_row("select time_attendance_id,clock_out from  `hrms_attendance_time` where employee_id = '".$this->input->get_post('user_id')."' order by time_attendance_id desc LIMIT 1");
				if (!empty($punchoutdata)) 
				{
					if ($punchoutdata->clock_out == "") 
					{

						$punchId = $punchoutdata->time_attendance_id;

						$update_data = array(
							'clock_out'=>date('Y-m-d H:i:s'),
							'early_leaving'=>date('Y-m-d H:i:s'),
							'overtime'=>date('Y-m-d H:i:s'),
							'out_latitude'=>$this->input->get_post('latitude'),
							'out_longitude'=>$this->input->get_post('longitude'),
							'clock_in_out'=>'2'
							);
						$this->api_model->update_data('hrms_attendance_time', array('time_attendance_id'=>$punchId), $update_data);  
						$output["msg"] = 'Punch Out Successfully';
						$output["success"] = "1";

						$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

						$history = [
							"employee_id" => $user_data->user_id,
							"access_id" => 0,
							"access_type" => 'Punch Out',
							"action" => 'Processed',
							"access" => '<p><a href="'.site_url('timesheet/attendance/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> punched out.</a></p>',
							"created_at" => date('Y-m-d H:i:s'),
						];

						$this->accessHistory($history);

					}
					else
					{
						$output["msg"] = 'Already Punch Out';
						$output["success"] = "0";
					}
				}
				else
				{
					$output["msg"] = 'Please Punch In';
					$output["success"] = "0";
				}
			} 
			else
			{
				$output["msg"] = 'invalide status';
				$output["success"] = "0";
			}
		}

		$this->encode_data($output);
	}

	function getPunchStatus()
	{
		$output = array();

		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{

			$punch_data = $this->api_model->select_single_row("select * from  `hrms_attendance_time` where employee_id = '".$this->input->get_post('user_id')."' order by time_attendance_id desc LIMIT 1");

			if(!empty($punch_data)) {
				$output["msg"] = 'Success';
				$output["success"] = "1";
				$output["object"]['user_id'] = $this->input->get_post('user_id');
				$output["object"]['punch_status'] = $punch_data->clock_in_out;
			} else {
				$output['success'] = 0;
				$output['msg'] = 'Not punched yet.';
			}

		}

		$this->encode_data($output);
	}

	function updateProfile() 
	{
		$output = array();

		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'User ID can not be empty';
			$this->encode_data($output);
			exit;

		}
		else if(!$this->input->get_post('fname'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter first name';
			$this->encode_data($output);
			exit;
		} else if(!ctype_alpha($this->input->get_post('fname'))){
			$output['success'] = 0;
			$output['msg'] = 'Please enter correct first name.';
			$this->encode_data($output);
			exit;
		}
		else if(!$this->input->get_post('lname'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter last name';
			$this->encode_data($output);
			exit;
		} else if(!ctype_alpha($this->input->get_post('lname'))){
			$output['success'] = 0;
			$output['msg'] = 'Please enter correct last name.';
			$this->encode_data($output);
			exit;
		}
		else if(!$this->input->get_post('address'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter address';
			$this->encode_data($output);
			exit;
		}
		else if(!$this->input->get_post('email'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter email';
			$this->encode_data($output);
			exit;
		}
		else if(!$this->input->get_post('contact_number'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter contact number';
			$this->encode_data($output);
			exit;
		}
		else if(!$this->input->get_post('account_number'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter account number';
			$this->encode_data($output);
			exit;
		}
		else if(!$this->input->get_post('job_profile'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Please enter job profile';
			$this->encode_data($output);
			exit;				
		}
		else
		{

			$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

			if(!empty($user_data))
			{

				if(!empty($_FILES["profile_image"]))
				{
					$directory ='uploads/user_img/';

					$image_name_new = time().'.jpg';
					$image_path = $directory.$image_name_new;
					move_uploaded_file($_FILES["profile_image"]["tmp_name"], $image_path);
				}
				else
				{
					$image_name_new = $user_data->profile_picture;
				}

				$update_data = array(
					'profile_picture'=>$image_name_new,
					'first_name'=>$this->input->get_post('fname'),
					'last_name'=>$this->input->get_post('lname'),
					'address'=>$this->input->get_post('address'),
					'contact_no'=>$this->input->get_post('contact_number'),
					'email'=>$this->input->get_post('email'),
					'last_login_date'=>date('Y-m-d H:i:s'),
				);
				$this->api_model->update_data('hrms_employees', array('user_id'=>$this->input->get_post('user_id')), $update_data);

				$bank_detail = $this->api_model->getSingle('hrms_employee_bankaccount', array('employee_id' => $this->input->get_post('user_id')));

				if(!empty($bank_detail)){
					$update_data = array(
						'account_number'=>$this->input->get_post('account_number'),
						);
					$this->api_model->update_data('hrms_employee_bankaccount', array('employee_id'=>$this->input->get_post('user_id')), $update_data);
				} else {
					$update_data = array(
						'account_number'=>$this->input->get_post('account_number'),
						'employee_id'=>$this->input->get_post('user_id'),
						'created_at' => date('Y-m-d H:i:s'),
						);
					$this->api_model->insert_data('hrms_employee_bankaccount', $update_data);
				}

				$output['success'] = 1;
				$output['msg'] = 'updated successfully';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				switch ($user_data->gender) {
					case 'Male':
						$h = 'his';
						break;
					case 'Female':
						$h = 'her';
						break;
					default:
						$h = '';
						break;
				}

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Update Profile',
					"action" => 'Edited',
					"access" => '<p><a href="'.site_url('employees/detail/'.$user_data->user_id).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> updated '.$h.' profile.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);


			}
			else
			{
				$output['success'] = 0;
				$output['msg'] = 'User doesn\'t exist!';
			}

			$this->encode_data($output);
		}
	}

	function awards()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			$employee_id = $this->input->get_post('user_id');
			$awards = $this->api_model->select_multiple_row("SELECT hrms_awards.award_month_year, hrms_award_type.award_type FROM hrms_awards JOIN hrms_award_type ON hrms_award_type.award_type_id=hrms_awards.award_type_id WHERE hrms_awards.employee_id='".$employee_id."'");
			if(!empty($awards)){
				$output['success'] = 1;
				$output['msg'] = 'Success';
				foreach ($awards as $awa) {
					$output['object'][] = array('award' => $awa->award_type, 'date' => date('F Y', strtotime($awa->award_month_year)));
				}
			} else {
				$output['success'] = 0;
				$output['msg'] = 'No award found!';
			}
		}

		$this->encode_data($output);
	}

	function remaining_leave()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			
			$employee_id = $this->input->get_post('user_id');
			$all_leave_types = $this->api_model->getAll('hrms_leave_type', 'leave_type_id');

			$output['success'] = 1;
			$output['msg'] = 'Success';
			
			foreach($all_leave_types as $leave_type){
				
				$leaveCount = $this->api_model->select_single_row("SELECT SUM(casual_leave) AS casual_leave, SUM(medical_leave) AS medical_leave from hrms_employee_leave WHERE employee_id='".$employee_id."'");

				if($leave_type->type_name == "Casual Leave"){
					$TotalLeave = $leaveCount->casual_leave;
				} else if($leave_type->type_name == "Medical Leave"){
					$TotalLeave = $leaveCount->medical_leave;
				}

				$count_l = 0;
				$leaves = $this->api_model->select_multiple_row("SELECT * from hrms_leave_applications where employee_id = '".$employee_id."' and leave_type_id='".$leave_type->leave_type_id."'");

				foreach ($leaves as $leave) {
					$fdate = new DateTime($leave->from_date);
					$tdate 	= new DateTime($leave->to_date);
					$interval = $fdate->diff($tdate);
					$count_l += $interval->format('%a')+1;
				}

				if($leave_type->type_name == "Casual Leave"){
					$output['object']['casual_leave'] = (($TotalLeave-$count_l) > 0)?$TotalLeave-$count_l.'':'0';
				} else if($leave_type->type_name == "Medical Leave"){
					$output['object']['medical_leave'] = ''.(($TotalLeave-$count_l) > 0)?$TotalLeave-$count_l.'':'0';
				}
			}
		}

		$this->encode_data($output);
	}

	function leave_type()
	{
		$output = [];
		$leave_types = $this->api_model->select_multiple_row("SELECT * FROM hrms_leave_type WHERE status=1");
		if(!empty($leave_types)){

			$output['success'] = 1;
			$output['msg'] = "Success";

			foreach ($leave_types as $leave_type) {
				$output['object'][] = array(
											'id' => $leave_type->leave_type_id,
											'name' => $leave_type->type_name,
										);
			}
		} else {
			$output['success'] = 1;
			$output['msg'] = "Success";
		}

		$this->encode_data($output);
	}

	function add_leave()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('from_date') || !$this->input->get_post('to_date') || !$this->input->get_post('reason') || !$this->input->get_post('leave_type') || !$this->input->get_post('company_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';			
		} else {
			$data = [
						'employee_id' => $this->input->get_post('user_id'),
						'from_date' => $this->input->get_post('from_date'),
						'to_date' => $this->input->get_post('to_date'),
						'applied_on' => date('Y-m-d H:i:s'),
						'reason' => $this->input->get_post('reason'),
						'status' => '1',
						'created_at' => date('Y-m-d H:i:s'),
						'leave_type_id' => $this->input->get_post('leave_type'),
					];
			$num = $this->api_model->insert_data('hrms_leave_applications', $data);
			if($num > 0){

				$output['success'] = 1;
				$output['msg'] = 'Leave added successfully.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Apply For Leave',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('timesheet/leave/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> applied for leave.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

				
			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed to add leave.';
			}
		}

		$this->encode_data($output);
	}

	function list_of_leave()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			
			$employee_id = $this->input->get_post('user_id');
			$leaves = $this->api_model->select_multiple_row("SELECT *, hrms_leave_applications.status AS leave_status FROM hrms_leave_applications JOIN hrms_leave_type ON hrms_leave_type.leave_type_id=hrms_leave_applications.leave_type_id WHERE employee_id='".$employee_id."' ORDER BY hrms_leave_applications.from_date DESC");
			if(!empty($leaves)){
				$output['success'] = 1;
				$output['msg'] = 'Success';	
				foreach ($leaves as $leave) {

					switch ($leave->leave_status) {
						case 1:
							$status = 'Pending';
							break;
						case 2:
							$status = 'Approved';
							break;
						case 3:
							$status = 'Rejected';
							break;						
						default:
							$status = 'Error';
							break;
					}

					$fdate = new DateTime($leave->from_date);
					$tdate = new DateTime($leave->to_date);
					$interval   = $fdate->diff($tdate);
					$leave_day = $interval->format('%a')+1;

					$output['object'][] = array(
												'leave_type' => $leave->type_name,
												'leave_date' => $leave->from_date,
												'reason' => $leave->reason,
												'status' => $status,
												'duration' => ''.$leave_day.'',
											);

				}			
			} else {
				$output['success'] = 0;
				$output['msg'] = 'No leave found.';
			}

		}
		
		$this->encode_data($output);
	}

	function attendance_history()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			
			$employee_id = $this->input->get_post('user_id');
			$result = [];
			
			for ($i=1; $i<=12; $i++) {
				
				$date = date('Y-m-d', strtotime("-$i month"));
				
				$working_days = $this->api_model->select_single_row("SELECT COUNT(*) AS working_days FROM (SELECT time_attendance_id FROM hrms_attendance_time WHERE MONTH(attendance_date) = MONTH('".$date."') AND YEAR(attendance_date) = YEAR('".$date."') AND employee_id='".$employee_id."' GROUP BY attendance_date) AS tmp");
				
				$leave_days = $this->api_model->select_multiple_row("SELECT * FROM hrms_leave_applications WHERE employee_id='".$employee_id."' AND status=2 AND MONTH(from_date)=MONTH('".$date."') AND YEAR(from_date)=YEAR('".$date."')");
				
				$myLeaves = [];
				$leaveCount = 0;

				foreach ($leave_days as $leaves) {

					$from_date = new DateTime($leaves->from_date);
					$to_date = new DateTime($leaves->to_date);
					$to_date = $to_date->modify( '+1 day' );

					$period = new DatePeriod(
						$from_date,
						new DateInterval('P1D'),
						$to_date
					);

					foreach($period as $today){
						if($today->format("m") == date('m', strtotime($date))){
							$myLeaves[] = $today->format("d");
							$leaveCount++;
						}
					}

				}
				
				$available = $this->api_model->select_single_row("SELECT COUNT(*) AS available FROM (SELECT time_attendance_id FROM hrms_attendance_time WHERE employee_id='".$employee_id."' AND MONTH(attendance_date)=MONTH('".$date."') AND YEAR(attendance_date)=YEAR('".$date."') GROUP BY attendance_date) AS tmp");

				if($available->available > 0){
					$result[] = [
								'month' => date('F', strtotime($date)),
								'working_days' => ''.cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($date)),date('Y', strtotime($date))).'',
								'leaves' => ''.$leaveCount.'',
								'leave_days' => '('.implode(',', $myLeaves).')',
								'available' => $available->available,
							];
				}

			} 

		}

		if(!empty($result)){
			$output['success'] = 1;
			$output['msg'] = 'Success';
			$output['object'] = $result;
		} else {
			$output['success'] = 0;
			$output['msg'] = 'No history found';
		}
		
		$this->encode_data($output);
	}

	function worksheet_tasks()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			
			$page = ($this->input->get_post('page'))?$this->input->get_post('page'):1;
			$limit = 10;
			$start = ($page*$limit)-$limit;
			$employee_id = $this->input->get_post('user_id');

			if($this->input->get_post('search')){
				$condition = " AND task_name LIKE '".$this->input->get_post('search')."%'";
			} else {
				$condition = "";
			}
			
			$tasks = $this->api_model->select_multiple_row("SELECT * FROM hrms_tasks WHERE FIND_IN_SET(".$employee_id.", assigned_to) " . $condition . " LIMIT ".$start.", ".$limit);

			if(!empty($tasks)){
				$output['success'] = 1;
				$output['msg'] = 'Success';
				foreach ($tasks as $task) {

					$created_by = $this->api_model->getSingle('hrms_employees', array('user_id' => $task->created_by));

					switch ($task->task_status) {
						case 0:
							$status = 'Not Started';
							break;
						case 1:
							$status = 'In Progress';
							break;
						case 2:
							$status = 'Completed';
							break;
						case 3:
							$status = 'Deferred';
							break;						
						default:
							$status = 'Unknown';
							break;
					}

					$output['object'][] = [
											'project_id' => $task->task_id,
											'worksheet_name' => $task->task_name,
											'date' => $task->start_date,
											'status' => $status,
											'created_by' => $created_by->first_name." ".$created_by->last_name,
										];
				}
			} else {
				$output['success'] = 0;
				$output['msg'] = 'No worksheet found';
			}

		}

		$this->encode_data($output);
	}

	function have_work()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			$data = [
						'employee_id' => $this->input->get_post('user_id'),
						'work_status' => 1,
						'work_date' => date('Y-m-d H:i:s')
					];
			if($this->api_model->insert_data('hrms_employee_have_work', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Thank you.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'No Work',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('employees/no_work/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> remind for no work.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed to send work status.';
			}
		}

		$this->encode_data($output);
	}

	function project_detail()
	{
		$output = [];

		if(!$this->input->get_post('project_id') || !$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			$detail = $this->api_model->select_single_row("SELECT hrms_tasks.task_name, GROUP_CONCAT(CONCAT(hrms_employees.first_name, ' ', hrms_employees.last_name)) AS developers, hrms_tasks.description, hrms_tasks.start_date, hrms_tasks.end_date, hrms_tasks.task_status FROM hrms_tasks JOIN hrms_employees ON FIND_IN_SET(hrms_employees.user_id, hrms_tasks.assigned_to) WHERE hrms_tasks.task_id='".$this->input->get_post('project_id')."' AND FIND_IN_SET('".$this->input->get_post('user_id')."', assigned_to)");

			if(!empty($detail)){

				if($detail->task_name == "" && $detail->task_name == NULL){
					$output['success'] = 0;
					$output['msg'] = 'Project not found.';
				} else {

					$images = $this->api_model->getWhere('hrms_tasks_attachment', array('task_id' => $this->input->get_post('project_id')));

					$projectImages = [];

					if(!empty($images)){

						foreach ($images as $image) {
							$projectImages[] = [
													'image_id' => $image->task_attachment_id,
													'image' => base_url().'uploads/task/'.$image->attachment_file,
												];
						}

					}

					$output['success'] = 1;
					$output['msg'] = "Success";

					switch ($detail->task_status) {
						case 0:
							$status = 'Not Started';
							break;
						case 1:
							$status = 'In Progress';
							break;
						case 2:
							$status = 'Completed';
							break;
						case 3:
							$status = 'Deferred';
							break;						
						default:
							$status = 'Unknown';
							break;
					}

					$date1 = date_create($detail->start_date);
					$date2 = date_create($detail->end_date);
					$diff = date_diff($date1,$date2);
					$days = $diff->format("%a");

					$output['object'] = [
						'title' => $detail->task_name,
						'developers' => $detail->developers,
						'description' => $detail->description,
						'start_date' => $detail->start_date,
						'end_date' => $detail->end_date,
						'status' => $status,
						'days' => ($days+1).' Days',
						'images' => $projectImages,
					];

				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Project not found.';
			}
		}

		$this->encode_data($output);
	}

	function uploadProjectImage()
	{
		$output = [];

		if(!$this->input->get_post('project_id') || !$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			$image_name = $_FILES["project_image"]["name"];

			if($_FILES["project_image"]["name"]!='')
			{
				$directory =TASK_IMAGE;

				$image_name_new = time().'.jpg';
				$image_path = $directory.$image_name_new;
				if(move_uploaded_file($_FILES["project_image"]["tmp_name"], $image_path)){

					$data = [
								'task_id' => $this->input->get_post('project_id'),
								'upload_by' => $this->input->get_post('user_id'),
								'attachment_file' => $image_name_new,
								'created_at' => date('Y-m-d h:i:s'),
							];

					if($this->api_model->insert_data('hrms_tasks_attachment', $data)){
						$output['success'] = 1;
						$output['msg'] = 'Success';

						$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

						$history = [
							"employee_id" => $user_data->user_id,
							"access_id" => 0,
							"access_type" => 'Task Image',
							"action" => 'Added',
							"access" => '<p><a href="'.site_url('timesheet/task_details/id/'.$this->input->get_post('project_id')).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> added task images.</a></p>',
							"created_at" => date('Y-m-d H:i:s'),
						];

						$this->accessHistory($history);

					} else {
						$output['success'] = 0;
						$output['msg'] = 'Failed to add image.';
					}

				} else {
					$output['success'] = 0;
					$output['msg'] = 'Failed to upload image.';
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Please select image.';
			}
		}

		$this->encode_data($output);
	}

	function removeProjectImage()
	{
		$output = [];

		if(!$this->input->get_post('image_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			if($this->api_model->delete_data('hrms_tasks_attachment', array('task_attachment_id' => $this->input->get_post('image_id')))){
				$output['success'] = 1;
				$output['msg'] = 'Success';
			} else {
				$output['success'] = 0;
				$output['msg'] = 'Faield to delete.';
			}
		}

		$this->encode_data($output);
	}

	function projectQuery()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('project_id') || !$this->input->get_post('query')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			$data = [
						'employee_id' => $this->input->get_post('user_id'),
						'task_id' => $this->input->get_post('project_id'),
						'query' => $this->input->get_post('query'),
						'query_date' => date('Y-m-d H:i:s'),
					];
			if($this->api_model->insert_data('hrms_tasks_query', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Success';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				switch ($user_data->gender) {
					case 'Male':
						$h = 'his';
						break;
					case 'Female':
						$h = 'her';
						break;
					default:
						$h = '';
						break;
				}

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Project Query',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('timesheet/task_details/id/'.$this->input->get_post('project_id')).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> have a query about '.$h.' task.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Faield to send query.';
			}
		}

		$this->encode_data($output);
	}

	function file_management()
	{

		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('department_id')){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		} else if(!isset($_FILES['file']['name'])){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		} else {

			$directory =FILE_MANAGEMENT;

			$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
			$image_name_new = time().'.'.$ext;
			$image_path = $directory.$image_name_new;

			if(move_uploaded_file($_FILES["file"]["tmp_name"], $image_path)) {

				$data = [
							'employee_id' => $this->input->get_post('user_id'),
							'department_id' => $this->input->get_post('department_id'),
							'file_name' => $image_name_new,
							'file_date' => date('Y-m-d H:i:s'),
							'status' => '1',
						];

				if($this->api_model->insert_data('hrms_file_management', $data)){

					$output['success'] = 1;
					$output['msg'] = 'updated successfully.';

					$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

					$history = [
						"employee_id" => $user_data->user_id,
						"access_id" => 0,
						"access_type" => 'File Management',
						"action" => 'Added',
						"access" => '<p><a href="'.site_url('file_management').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> added a file.</a></p>',
						"created_at" => date('Y-m-d H:i:s'),
					];

					$this->accessHistory($history);

				} else {
					$output['success'] = 0;
					$output['msg'] = 'Failed to upload file.';
				}				

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed to upload file.';					
			}
			
		}

		$this->encode_data($output);
	}

	function privacy()
	{
		$data['privacies'] = $this->api_model->select_multiple_row("SELECT * FROM hrms_company_policy");
		$this->load->view('privacy', $data);
	}

	function privacyPolicyByCompny()
	{
		if(!$this->input->get_post('user_id')){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->encode_data($output);

		}else{
			$getUserData = $this->api_model->select_single_row("select * from hrms_employees where user_id = '".$this->input->get_post('user_id')."'");
			if (!empty($getUserData) && $getUserData->company_id != "") 
			{
				
				$cmpId = $getUserData->company_id;
				$data['privacies'] = $this->api_model->select_single_row("SELECT * FROM hrms_company_policy where company_id =".$cmpId);
				if (!empty($data['privacies'])) 
				{
					$this->load->view('privecyPolicyCmpVise', $data);
				}else{
					$output['success'] = 0;
			   $output['msg'] = 'No Data found';
			   $this->encode_data($output);
				}
				
			}else{
				$output['success'] = 0;
			   $output['msg'] = 'No Data found';
			   $this->encode_data($output);

			}
		
	}
	}

	function directory()
	{
		if(!$this->input->get_post('company_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->encode_data($output);
		} else {
		$data['company_id'] = $this->input->get_post('company_id');
		$this->load->view('directory',$data);
	    }
	}

	function salaryDetail()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('year')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			
			if($this->input->get_post('year') == 'current'){
				$year = date('Y');
				$lastYearMonth = date('m');
			} else if($this->input->get_post('year') == 'last'){
				$year = date('Y')-1;
				$lastYearMonth = 12;
			} else {
				$output['success'] = 0;
				$output['msg'] = 'Invalid Year.';
				$year = 0;
			}

			$data = [];
			if($year != 0){


				if($this->input->get_post('year') == 'current'){
					$lastMonth = ($lastYearMonth-1 == 1)?12:$lastYearMonth-1;
					$lastMonth = ($lastMonth == 0)?1:$lastMonth;
					$lastMonth = (strlen($lastMonth) > 1)?$lastMonth:'0'.$lastMonth;
					$lastYear  = ($lastYearMonth-1 == 1)?$year-1:$year;
				} else {
					$lastYear = date('Y')-1;
					$lastMonth = 12;	
				}

				$lastMonthSalary = [];
				$salary = $this->api_model->select_single_row("SELECT * FROM hrms_make_payment WHERE employee_id ='".$this->input->get_post('user_id')."' AND SUBSTRING_INDEX(payment_date, '-', 1) ='".$lastYear."' AND SUBSTRING_INDEX(SUBSTRING_INDEX(payment_date, '-', 2), '-', -1) = '".$lastMonth."'");

				if(!empty($salary)){
					$lastMonthSalary = [
						"id" => $salary->make_payment_id,
						"month" => date('F Y', strtotime($salary->payment_date.'-01')),
						"salary" => $salary->net_salary,
						"status" => "Transferred",
					];
				} else {
					$lastMonthPending = ($lastMonth == 1)?12:$lastMonth-1;
					$lastYearPending  = $lastYear;
					$salary = $this->api_model->select_single_row("SELECT * FROM hrms_make_payment WHERE employee_id ='".$this->input->get_post('user_id')."' AND SUBSTRING_INDEX(payment_date, '-', 1) ='".$lastYearPending."' AND SUBSTRING_INDEX(SUBSTRING_INDEX(payment_date, '-', 2), '-', -1) = '".$lastMonthPending."'");
					if(!empty($salary)){
						$lastMonthSalary = [
							"id" => "",
							"month" => date('F Y', strtotime($lastYear.'-'.$lastMonth.'-01')),
							"salary" => $salary->net_salary,
							"status" => "Pending",
						];
					}
				}

				if(!empty($lastMonthSalary)){
					$data[] = $lastMonthSalary;
				}

				for ($i=$lastYearMonth; $i >= 0 ; $i--) {
					$month = (strlen($i) == 1)?'0'.$i:$i;
					if($lastMonth != $month){
						$salary = $this->api_model->select_single_row("SELECT * FROM hrms_make_payment WHERE employee_id ='".$this->input->get_post('user_id')."' AND SUBSTRING_INDEX(payment_date, '-', 1) ='".$year."' AND SUBSTRING_INDEX(SUBSTRING_INDEX(payment_date, '-', 2), '-', -1) = '".$month."'");
						if(!empty($salary)){
							$data[] = [
								"id" => $salary->make_payment_id,
								"month" => date('F Y', strtotime($salary->payment_date.'-01')),
								"salary" => $salary->net_salary,
								"status" => "Transfered",
							];
						}	
					}
				}

				if(!empty($data)){
					$output['success'] = 1;
					$output['msg'] = "Salary Detail Found.";
					$output['object'] = $data;
				} else {
					$output['success'] = 0;
					$output['msg'] = "No Salary Detail Found.";
				}

			}

		}

		$this->encode_data($output);
	}

	function getSalarySlip()
	{
		$this->load->model('Hrms_model');
		if(!$this->input->get_post('salary_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
		} else {
			$id = $this->input->get_post('salary_id');

			$payment 	= $this->api_model->getSingle('hrms_make_payment', array("make_payment_id" => $id));
			$user 		= $this->api_model->getSingle('hrms_employees', array("user_id" => $payment->employee_id));
			$_des_name 	= $this->api_model->getSingle('hrms_designations', array("designation_id" => $user->designation_id));
			$department = $this->api_model->getSingle('hrms_departments', array("department_id" => $user->department_id));
			$location 	= $this->api_model->getSingle('hrms_office_location', array("location_id" => $department->location_id));
			$company 	= $this->api_model->getSingle('hrms_companies', array("company_id" => $location->company_id));
			
			$p_method = '';
			if($payment->payment_method==1){
			  $p_method = 'Online';
			} else if($payment->payment_method==2){
			  $p_method = 'PayPal';
			} else if($payment->payment_method==3) {
			  $p_method = 'Payoneer';
			} else if($payment->payment_method==4){
			  $p_method = 'Bank Transfer';
			} else if($payment->payment_method==5) {
			  $p_method = 'Cheque';
			} else {
			  $p_method = 'Cash';
			}


			$tbl = '';
			
			// Allowances
			if($payment->house_rent_allowance!='' || $payment->house_rent_allowance!=0){
				$hra = $this->Hrms_model->currency_sign($payment->house_rent_allowance);
			} else { $hra = '0';}
			if($payment->medical_allowance!='' || $payment->medical_allowance!=0){
				$ma = $this->Hrms_model->currency_sign($payment->medical_allowance);
			} else { $ma = '0';}
			if($payment->travelling_allowance!='' || $payment->travelling_allowance!=0){
				$ta = $this->Hrms_model->currency_sign($payment->travelling_allowance);
			} else { $ta = '0';}
			if($payment->dearness_allowance!='' || $payment->dearness_allowance!=0){
				$da = $this->Hrms_model->currency_sign($payment->dearness_allowance);
			} else { $da = '0';}
			if($payment->total_allowances!='' || $payment->total_allowances!=0){
				$ta2 = $this->Hrms_model->currency_sign($payment->total_allowances);
			} else { $ta2 = '0';}
			
			// Deductions
			if($payment->provident_fund!='' || $payment->provident_fund!=0){
				$pf = $this->Hrms_model->currency_sign($payment->provident_fund);
			} else { $pf = '0';}
			if($payment->tax_deduction!='' || $payment->tax_deduction!=0){
				$td = $this->Hrms_model->currency_sign($payment->tax_deduction);
			} else { $td = '0';}
			if($payment->security_deposit!='' || $payment->security_deposit!=0){
				$sd = $this->Hrms_model->currency_sign($payment->security_deposit);
			} else { $sd = '0';}
			if($payment->basic_salary!='' || $payment->basic_salary!=0){
				$bs = $this->Hrms_model->currency_sign($payment->basic_salary);
			} else { $bs = '0';}
			if($payment->gross_salary!='' || $payment->gross_salary!=0){
				$gs = $this->Hrms_model->currency_sign($payment->gross_salary);
			} else { $gs = '0';}
			if($payment->total_deductions!='' || $payment->total_deductions!=0){
				$td2 = $this->Hrms_model->currency_sign($payment->total_deductions);
			} else { $td2 = '0';}

			if($payment->net_salary!='' || $payment->net_salary!=0){
				$nt = $this->Hrms_model->currency_sign($payment->net_salary);
			} else { $nt = '0';}
			if($payment->payment_amount!='' || $payment->payment_amount!=0){
				$pa = $this->Hrms_model->currency_sign($payment->payment_amount);
			} else { $pa = '0';}

			$data['company_log'] = $company->logo;
			$data['company_name'] = $company->name;
			$data['company_email'] = $company->email;
			$data['company_phone'] = $company->contact_number;
			$data['company_counrty'] = $this->api_model->getSingle('hrms_countries', array("country_id" => $company->country));
			$data['company_address'] = $company->address_1.' '.$company->address_2.', '.$company->city.' - '.$company->zipcode.', '.$data['company_counrty']->country_name;
			$data['make_payment_id'] = $payment->make_payment_id;
			$data['date'] = date("d F, Y");
			$data['fullname'] = $user->first_name.' '.$user->last_name;
			$data['employee_id'] = $user->employee_id;
			$data['department_name'] = $department->department_name;
			$data['designation_name'] = $_des_name->designation_name;
			$data['payment_date'] = date("F Y", strtotime($payment->payment_date));
			$data['hra'] = $hra;
			$data['ma'] = $ma;
			$data['ta'] = $ta;
			$data['da'] = $da;
			$data['pf'] = $pf;
			$data['td'] = $td;
			$data['sd'] = $sd;
			$data['bs'] = $bs;
			$data['gs'] = $gs;
			$data['ta2'] = $ta2;
			$data['td2'] = $td2;
			$data['nt'] = $nt;
			$data['pa'] = $pa;
			$data['p_method'] = $p_method;

			$this->load->library('email');
			$config['mailtype'] = 'html';
			$config['charset'] = 'iso-8859-1';
			$config['priority'] = 1;

			$this->email->initialize($config);
			$this->email->from('info@infograins.in','iLinkHR');
			$this->email->to($user->email);
			$this->email->subject('iLinkHR:- '.$data['payment_date'].' Salary Slip');
			$message = $this->load->view('salary_slip_template',$data, TRUE);
			$this->email->message($message);
			if ($this->email->send()) {
				$output['success'] = 1;
				$output['msg'] = 'Please check your email for salary slip.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				switch ($user_data->gender) {
					case 'Male':
						$h = 'his';
						break;
					case 'Female':
						$h = 'her';
						break;
					default:
						$h = '';
						break;
				}

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Salary Slip',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('payroll/payment_history/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> want to see '.$h.' salary slip of '.$data['payment_date'].'.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Oops some error please try again.';
			}

		}

		$this->encode_data($output);
	}

	function designations()
	{
		$output = [];
		$designations = $this->api_model->getWhere('hrms_designations', []);
		if(!empty($designations)){

			$output['success'] = 1;
			$output['msg'] = 'Designations List.';
			
			foreach ($designations as $designation) {
				$output['object'][] = [
					"designation_id" => $designation->designation_id,
					"designation_name" => $designation->designation_name,
				];	
			}

		} else {
			$output['success'] = 0;
			$output['msg'] = 'No Designation Found.';
		}

		$this->encode_data($output);
	}

	function applyAppraisal()
	{
		$output = [];
		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else if(!$this->input->get_post('name')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else if(!$this->input->get_post('designation_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else if(!$this->input->get_post('last_appraisal_date')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else if(!$this->input->get_post('expected_appraisal_date')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else if(!$this->input->get_post('current_salary')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else if(!$this->input->get_post('expected_salary')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else {

			$data = [
				'user_id' => $this->input->get_post('user_id'),
				'name' => $this->input->get_post('name'),
				'designation_id' => $this->input->get_post('designation_id'),
				'last_appraisal_date' => $this->input->get_post('last_appraisal_date'),
				'expected_appraisal_date' => $this->input->get_post('expected_appraisal_date'),
				'current_salary' => $this->input->get_post('current_salary'),
				'expected_salary' => $this->input->get_post('expected_salary'),
				'apply_date' => date('Y-m-d H:i:s'),
				'apply_status' => 0,
			];

			if($this->api_model->insert_data('hrms_appraisal_apply', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Applied For Appraisal.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Appraisal Application',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('performance/appraisal_applications').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> applied for appraisal.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed To Apply For Appraisal.';
			}

		}

		$this->encode_data($output);
	}


	// ***************end prmotion**************

	function files_list()
	{
		$output = [];
		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else {

			$files = $this->api_model->select_multiple_row("SELECT * FROM hrms_file_management WHERE employee_id = '".$this->input->get_post('user_id')."' AND file_name != ''");

			if(!empty($files)){

				$output['success'] = 1;
				$output['msg'] = 'Files List';

				foreach ($files as $file) {

					$department = $this->api_model->getSingle('hrms_departments', array("department_id" => $file->department_id));

					switch ($file->status) {
						case 1:
							$status = "Uploaded";
							break;
						case 2:
							$status = "Requested";
							break;						
						default:
							$status = "Error";
							break;
					}

					$output['object'][] = [
						"file_id" => $file->file_id,
						"file" => base_url().'uploads/files/'.$file->file_name,
						"file_name" => $file->file_name,
						"file_date" => date('d M Y', strtotime($file->file_date)),
						"department" => $department->department_name,
						"status" => $status
					];
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'No File Found.';
			}

		}

		$this->encode_data($output);
	}

	function recruiments()
	{
		$output = [];
		$recruiments = $this->api_model->getWhere('hrms_jobs', array("status" => "1"));

		if(!empty($recruiments)){

			$output['success'] = 1;
			$output['msg'] = "Recruiments List";

			foreach ($recruiments as $r) {

				$designation = $this->api_model->getSingle('hrms_designations', array('designation_id' => $r->designation_id));

				$output['object'][] = [
					"id" => $r->job_id,
					"title" => $r->job_title,
					"description" => '<div><p style="margin: 5px 0;"><strong>Designation : </strong> '.$designation->designation_name.'</p><p style="margin: 5px 0;"><strong>Posts : </strong> '.$r->job_vacancy.'</p><p style="margin: 5px 0;"><strong>Gender : </strong> '.$r->gender.'</p><p style="margin: 5px 0;"><strong>Minimum Experience : </strong> '.$r->minimum_experience.'</p><p style="margin: 5px 0;"><strong>Posted Date :</strong> '.date('d-M-Y', strtotime($r->created_at)).'</p></div>'.$r->long_description,
					"ios_status" => "0",
				];
			}

		} else {
			$output['success'] = 0;
			$output['msg'] = "No Recruiment Found.";
		}

		$this->encode_data($output);
	}

	function applyForRecruiment()
	{
		$output = [];
		if(
			!$this->input->get_post('user_id') ||
			!$this->input->get_post('job_id') ||
			!$this->input->get_post('name') ||
			!$this->input->get_post('email') ||
			!$this->input->get_post('phone') ||
			!$this->input->get_post('experience') ||
			!$this->input->get_post('message')
		){
			$output['success'] = 0;
			$output['msg'] = 'Check Perameter.';
		} else {

			if($_FILES["resume"]["name"]!='')  {

				$ext = pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);
				$resume = 'resume_'.time().'.'.$ext;

				if(move_uploaded_file($_FILES['resume']['tmp_name'], RESUME.$resume)){

					$data = [
						"user_id" => $this->input->get_post('user_id'),
						"job_id" => $this->input->get_post('job_id'),
						"name" => $this->input->get_post('name'),
						"email" => $this->input->get_post('email'),
						"phone" => $this->input->get_post('phone'),
						"experience" => $this->input->get_post('experience'),
						"message" => $this->input->get_post('message'),
						"job_resume" => $resume,
						"application_status" => "Applied",
						"application_remarks" => $this->input->get_post('message'),
						"created_at" => date('Y-m-d H:i:s'),
					];

					if($this->api_model->insert_data('hrms_job_applications', $data)){
						$output['success'] = 1;
						$output['msg'] = 'Applied.';

						$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

						$history = [
							"employee_id" => $user_data->user_id,
							"access_id" => 0,
							"access_type" => 'Recruitment',
							"action" => 'Added',
							"access" => '<p><a href="'.site_url('job_post').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> applied for job requirement.</a></p>',
							"created_at" => date('Y-m-d H:i:s'),
						];

						$this->accessHistory($history);

					} else {
						$output['success'] = 0;
						$output['msg'] = 'Failed to apply. Please try after some time.';
					}

				} else {
					$output['success'] = 0;
					$output['msg'] = 'Failed to upload resume.';
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Please upload your resume.';
			}
		}

		$this->encode_data($output);
	}

	function emailList()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = "Check Perameter.";
		} else {

			$condition = "";
			if($this->input->get_post('search')){
				$condition = " AND email_subject LIKE '".$this->input->get_post('search')."%'";
			}

			$emails = $this->api_model->select_multiple_row("SELECT * FROM hrms_email_history WHERE employee_id='".$this->input->get_post('user_id')."'".$condition);

			if(!empty($emails)){
				$output['success'] = 1;
				$output['msg'] = "Email List.";
				foreach ($emails as $email) {
					$output['object'][] = [
						"subject" => $email->email_subject,
						"message" => $email->email_message,
						"date" => date('d-M-Y', strtotime($email->send_date)),
						"time" => date('h:i A', strtotime($email->send_date)),
						"sent" => ($email->email_type == 'send')?'sent to - HR':'sent by - HR',
					];
				}
			} else {
				$output['success'] = 0;
				$output['msg'] = "No Email Found.";
			}
		}

		$this->encode_data($output);
	}

	function fileRequest()
	{
		$output = [];
		if(!$this->input->get_post('user_id') || !$this->input->get_post('department_id') || !$this->input->get_post('title')){
			$output['success'] = 0;
			$output['msg'] = "Check Perameter.";
		} else {
			$data = [
				"department_id" => $this->input->get_post('department_id'),
				"employee_id" => $this->input->get_post('user_id'),
				"title" => $this->input->get_post('title'),
				"file_date" => date('Y-m-d H:i:s'),
				"status" => '2'
			];

			if($this->api_model->insert_data('hrms_file_management', $data)){
				$output['success'] = 1;
				$output['msg'] = "Request Sent.";

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'File Request',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('file_management').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> requested for a file.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);
				
			} else {
				$output['success'] = 0;
				$output['msg'] = "Failed To Request.";
			}
		}

		$this->encode_data($output);

	}

	function departments()
	{
		$output = [];
		$departments = $this->api_model->getWhere('hrms_departments', []);
		if(!empty($departments)){

			$output['success'] = 1;
			$output['msg'] = 'departments List.';
			
			foreach ($departments as $department) {
				$output['object'][] = [
					"department_id" => $department->department_id,
					"department_name" => $department->department_name,
				];	
			}

		} else {
			$output['success'] = 0;
			$output['msg'] = 'No Department Found.';
		}

		$this->encode_data($output);
	}

	function performance()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('performance')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			switch ($this->input->get_post('performance')) {
				case 'monthly':
					$interval = 1;
					break;
				case 'quaterly':
					$interval = 3;
					break;
				case 'yearly':
					$interval = 12;
					break;
				default:
					$interval = 1;
					break;
			}

			$performances = $this->api_model->select_multiple_row('SELECT hrms_tasks.task_name, hrms_tasks_comments.task_comments, hrms_tasks.expected_end_date, hrms_tasks.end_date FROM hrms_tasks JOIN hrms_tasks_comments ON hrms_tasks.task_id=hrms_tasks_comments.task_id WHERE FIND_IN_SET('.$this->input->get_post('user_id').', assigned_to) AND hrms_tasks.expected_end_date >=last_day(now()) + interval 1 day - interval '.$interval.' month AND hrms_tasks.expected_end_date <= CURDATE()');

			if(!empty($performances)){

				$output['success'] = 1;
				$output['msg'] = "Performances List.";

				foreach ($performances as $performance) {
					$output['object'][] = [
						"task" => $performance->task_name,
						"description" => $performance->task_comments,
						"deadline" => $performance->expected_end_date,
						"completed" => $performance->end_date,
					];
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = "No Performance.";
			}
		}

		$this->encode_data($output);

	}

	function trainings()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('traning')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			if($this->input->get_post('traning') == 'upcoming'){
				$condition = "start_date >= CURDATE()";
			} else if($this->input->get_post('traning') == 'previous'){
				$condition = "start_date < CURDATE()";
			}

			$trainings = $this->api_model->select_multiple_row("SELECT * FROM hrms_training WHERE FIND_IN_SET(".$this->input->get_post('user_id').", employee_id) AND ".$condition);

			if(!empty($trainings)){

				$output['success'] = 1;
				$output['msg'] = "Trainings List.";

				foreach ($trainings as $training) {

					$trainer = $this->api_model->getSingle('hrms_trainers', array("trainer_id" => $training->trainer_id));

					$traning_type = $this->api_model->getSingle('hrms_training_types', array("training_type_id" => $training->training_type_id));

					$output['object'][] = [
						"traning_type" => $traning_type->type,
						"trainer" => $trainer->first_name.' '.$trainer->last_name,
						"traning_period" => date('d/m/Y', strtotime($training->start_date)).' - '.date('d/m/Y', strtotime($training->finish_date)),
					];
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = "No Trainings.";
			}

		}

		$this->encode_data($output);
		
	}

	function benefits()
	{
		$this->load->view('benefits');
	}

	function FAQ()
	{
		$data['faqs'] = $this->api_model->select_multiple_row("SELECT * FROM hrms_faq");
		$this->load->view('faq', $data);
	}
//http://192.168.1.118/hrms/Api/ticketList?user_id=49&company_id=17
	function ticketList()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('company_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			$tickets = $this->api_model->select_multiple_row("SELECT * FROM hrms_support_tickets WHERE compny_id = ".$this->input->get_post('company_id')." AND FIND_IN_SET(".$this->input->get_post('user_id').", employee_id)");

			if(!empty($tickets)){

				$output['success'] = 1;
				$output['msg'] = "Trainigs List.";

				foreach ($tickets as $ticket) {

					switch ($ticket->ticket_priority) {
						case 1:
							$priority = 'Low';
							break;
						case 2:
							$priority = 'Medium';
							break;
						case 3:
							$priority = 'High';
							break;
						case 4:
							$priority = 'Critical';
							break;						
						default:
							$priority = 'Error';
							break;
					}

					switch ($ticket->ticket_status) {
						case 1:
							$status="Open";
							break;
						case 2:
							$status="Closed";
							break;						
						default:
							$status="Error";
							break;
					}

					$output['object'][] = [
						"subject" => $ticket->subject,
						"description" => $ticket->description,
						"priority" => $priority,
						"status" => $status,
						"ticket_date" => date('d/m/Y', strtotime($ticket->created_at)),
						"ticket_id" => $ticket->ticket_id,
					];
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = "No Ticket.";
			}

		}

		$this->encode_data($output);
	}
//http://192.168.1.118/hrms/Api/addTicket?user_id=49&company_id=17&subject=problem&priority=2&description=this is test
	function addTicket()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('subject') || !$this->input->get_post('priority') || !$this->input->get_post('description') || !$this->input->get_post('company_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {
			
			$this->load->model('Hrms_model');
			$ticket_code = $this->Hrms_model->generate_random_string();

			$data = [
				"ticket_code" => $ticket_code,
				"subject" => $this->input->get_post('subject'),
				"employee_id" => $this->input->get_post('user_id'),
				"ticket_priority" => $this->input->get_post('priority'),
				"description" => $this->input->get_post('description'),
				"ticket_status" => "1",
				"compny_id" => $this->input->get_post('company_id'),
				"created_at" => date('Y-m-d H:i:s'),
			];

			if($this->api_model->insert_data('hrms_support_tickets', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Ticket Generated.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Ticket Generated',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('tickets').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> generated a ticket.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed To Generate Ticket.';
			}
		}

		$this->encode_data($output);
	}

	function addDeleteProjectFiles()
	{
		$output['success'] = 0;
		$output['msg'] = "Failed.";

		if(!$this->input->get_post('user_id') || !$this->input->get_post('project_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			if($this->input->get_post('previous_images') != ""){

				$output['success'] = 1;
				$output['msg'] = "Files Saved Successfully.";
				
				$previous_images = explode(',', $this->input->get_post('previous_images'));

				$project_images = $this->api_model->getWhere('hrms_tasks_attachment', array("task_id" => $this->input->get_post('project_id')));

				foreach ($project_images as $image) {
					if(!in_array($image->task_attachment_id, $previous_images)){
						if(!$this->api_model->delete('hrms_tasks_attachment', array("task_attachment_id" => $image->task_attachment_id))){
							$output['success'] = 0;
							$output['msg'] = "Failed To Delete Image.";
							break;
						}
					}
				}

			}

			if(isset($_FILES['images'])){

				$output['success'] = 1;
				$output['msg'] = "Files Saved Successfully.";

				$filesCount = count($_FILES['images']['name']);

				if($filesCount > 0){
					for ($i=0; $i < $filesCount; $i++) { 

						$directory =TASK_IMAGE;
						$ext = pathinfo($_FILES["images"]["name"][$i], PATHINFO_EXTENSION);
						$image_name_new = 'task_'.time().$i.'.'.$ext;
						$image_path = $directory.$image_name_new;
						move_uploaded_file($_FILES["images"]["tmp_name"][$i], $image_path);

						$data = [
							'task_id' => $this->input->get_post('project_id'),
							'upload_by' => $this->input->get_post('user_id'),
							'attachment_file' => $image_name_new,
							'created_at' => date('Y-m-d h:i:s'),
						];

						if(!$this->api_model->insert_data('hrms_tasks_attachment', $data)){
							$output['success'] = 0;
							$output['msg'] = "Failed To Add Image.";
							break;
						}

					}
				}

			}

			$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

			$history = [
				"employee_id" => $user_data->user_id,
				"access_id" => 0,
				"access_type" => 'Task Images',
				"action" => 'Added',
				"access" => '<p><a href="'.site_url('timesheet/task_details/id/'.$this->input->get_post('project_id')).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> added/removed images from the task.</a></p>',
				"created_at" => date('Y-m-d H:i:s'),
			];

			$this->accessHistory($history);

		}

		$this->encode_data($output);
	}

	function warnings()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			$warnings = $this->api_model->getWhere('hrms_employee_warnings', array("warning_to" => $this->input->get_post('user_id')));


			if(!empty($warnings)){
				
				$output['success'] = 1;
				$output['msg'] = "Warnings List.";

				foreach ($warnings as $warning) {

					$warning_type = $this->api_model->getSingle('hrms_warning_type', array("warning_type_id" => $warning->warning_type_id));

					$output['object'][] = [
						"subject" => $warning->subject,
						"description" => $warning->description,
						"warning_date" => date('d/m/Y', strtotime($warning->created_at)),
						"warning_time" => date('h:i A', strtotime($warning->created_at)),
						"warning_type" => $warning_type->type,
					];
				}
			} else {
				$output['success'] = 0;
				$output['msg'] = "No Warning Found.";
			}
		}

		$this->encode_data($output);
	}

	function officeShift()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			$officeShifts = $this->api_model->getWhere('hrms_employee_shift', array("employee_id" => $this->input->get_post('user_id')));

			if(!empty($officeShifts)){
				
				$output['success'] = 1;
				$output['msg'] = "Office Shift Detail.";

				foreach ($officeShifts as $shift) {

					$shiftDetail = $this->api_model->getSingle('hrms_office_shift', array("office_shift_id" => $shift->shift_id));

					$output['object'][] = [
						"duration" => date("d/m/Y", strtotime($shift->from_date)).' - '.date("d/m/Y", strtotime($shift->to_date)),
						"shift_time" => date('h:i A', strtotime($shiftDetail->monday_in_time)).' - '.date('h:i A', strtotime($shiftDetail->monday_out_time)),
					];
				}

			} else {
				$output['success'] = 0;
				$output['msg'] = "No Shift Found.";
			}
		}

		$this->encode_data($output);
	}

	function travels()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			$travels = $this->api_model->getWhere('hrms_employee_travels', array("employee_id" => $this->input->get_post('user_id')));


			if(!empty($travels)){
				
				$output['success'] = 1;
				$output['msg'] = "Travels List.";

				foreach ($travels as $travel) {

					switch ($travel->status) {
						case 0:
							$status = "Pending";
							break;
						case 1:
							$status = "Accepted";
							break;
						case 2:
							$status = "Rejected";
							break;						
						default:
							$status = "Error";
							break;
					}

					$output['object'][] = [
						"visit" => $travel->visit_place.' ('.$travel->visit_purpose.')',
						"visit_date" => date('d/m/Y', strtotime($travel->start_date)).' - '.date('d/m/Y', strtotime($travel->end_date)),
						"description" => $travel->description,
						"status" => $status,
					];
				}
			} else {
				$output['success'] = 0;
				$output['msg'] = "No Travel Found.";
			}
		}

		$this->encode_data($output);
	}

	function addTravel($value='')
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('destination') || !$this->input->get_post('purpose') || !$this->input->get_post('description') || !$this->input->get_post('dep_date') || !$this->input->get_post('return_date') || !$this->input->get_post('company_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
		} else {

			$data = [
				"employee_id" => $this->input->get_post('user_id'),
				"company_id" => $this->input->get_post('company_id'),
				"visit_purpose" => $this->input->get_post('purpose'),
				"visit_place" => $this->input->get_post('destination'),
				"description" => $this->input->get_post('description'),
				"start_date" => date('Y-m-d', strtotime($this->input->get_post('dep_date'))),
				"end_date" => date('Y-m-d', strtotime($this->input->get_post('return_date'))),
				"status" => 0,
				"created_at" => date('Y-m-d H:i:s'),
				"added_by" =>  $this->input->get_post('user_id'),
			];

			if($this->api_model->insert_data('hrms_employee_travels', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Travel Detail Added Successfully.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Travel Expense',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('travel').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> added travel expense.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed To Add Detail.';
			}
		}

		$this->encode_data($output);
	}

	function announcements()
	{
		$output = [];

		$announcements = $this->api_model->getAll('hrms_announcements', 'announcement_id');


		if(!empty($announcements)){
			
			$output['success'] = 1;
			$output['msg'] = "Travels List.";

			foreach ($announcements as $announcement) {

				$output['object'][] = [
					"title" => $announcement->title,
					"date" => date('d/m/Y', strtotime($announcement->created_at)),
					"description" => $announcement->summary,
				];
			}
		} else {
			$output['success'] = 0;
			$output['msg'] = "No Travel Found.";
		}

		$this->encode_data($output);
	}

	function surveyList()
	{
		$output = [];

		$surveys = $this->api_model->getAll('hrms_survey', 'survey_id');


		if(!empty($surveys)){
			
			$output['success'] = 1;
			$output['msg'] = "Survey List.";

			foreach ($surveys as $survey) {

				$output['object'][] = [
					"survey_id" => $survey->survey_id,
					"title" => $survey->title,
					"description" => $survey->description,
				];
			}
		} else {
			$output['success'] = 0;
			$output['msg'] = "No Survey Found.";
		}

		$this->encode_data($output);
	}

	function takeSurvey()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('survey_id')){
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
			$this->encode_data($output);
			die();
		} else {

			$data['survey_id'] = $this->input->get_post('survey_id');
			$data['user_id'] = $this->input->get_post('user_id');
			$data['questions'] = $this->api_model->getWhere('hrms_survey_question', array("survey_id" => $this->input->get_post('survey_id')));

			if(!empty($data['questions'])){
				$this->load->view('survey', $data);
			} else {
				$output['success'] = 0;
				$output['msg'] = 'No Question In Survey.';
				$this->encode_data($output);
				die();
			}

		}
		
	}

	function addSurveyAnswers()
	{
		if($this->input->post()){
			foreach ($_POST['question'] as $question) {
				
				if(isset($_POST['inputText_'.$question]))
					$answer = $_POST['inputText_'.$question];
				else if(isset($_POST['inputSelect_'.$question]))
					$answer = $_POST['inputSelect_'.$question];
				else if(isset($_POST['inputRadio_'.$question]))
					$answer = $_POST['inputRadio_'.$question];
				else if(isset($_POST['inputCheckbox_'.$question]))
					$answer = implode(', ', $_POST['inputCheckbox_'.$question]);
				else if(isset($_POST['inputTextarea_'.$question]))
					$answer = $_POST['inputTextarea_'.$question];
				else 
					$answer = "";
				
				$data = [
					"employee_id" => $this->input->post('user_id'),
					"survey_id" => $this->input->post('survey_id'),
					"question_id" => $question,
					"answer" => $answer,
					"craeted_at" => date('Y-m-d H:i:s'),
				];

				$this->api_model->insert_data('hrms_survey_answers', $data);

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Survey',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('survey/employee_survey').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> take a tour to survey.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			}
		} else {
			redirect('Api/takeSurvey');
		}
	}

	public function editHealth()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('blood_group') || !$this->input->get_post('height') || !$this->input->get_post('weight') || !$this->input->get_post('disease')){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
			$this->encode_data($output);
			die();

		} else {

			$data = [
				'blood_group' => $this->input->get_post('blood_group'),
				'height' => $this->input->get_post('height'),
				'weight' => $this->input->get_post('weight'),
				'disease' => $this->input->get_post('disease'),
			];

			if($this->api_model->update_data('hrms_employees', array("user_id" => $this->input->get_post('user_id')), $data)){
				$output['success'] = 1;
				$output['msg'] = 'Health Detail Updated.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				switch ($user_data->gender) {
					case 'Male':
						$h = 'his';
						break;
					case 'Female':
						$h = 'her';
						break;
					default:
						$h = '';
						break;
				}

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Update Health',
					"action" => 'Edited',
					"access" => '<p><a href="'.site_url('employees/detail/'.$this->input->get_post('user_id')).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> update '.$h.' health detail.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed to update.';
			}

		}

		$this->encode_data($output);
		
	}

	public function medicalConvocation()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
			$this->encode_data($output);
			die();

		} else {

			$convocation = $this->api_model->select_single_row("SELECT blood_group, height, weight, disease FROM hrms_employees WHERE user_id='".$this->input->get_post('user_id')."'");
			$health = $this->api_model->select_single_row("SELECT * FROM hrms_employee_medical_convocation WHERE employee_id='".$this->input->get_post('user_id')."' ORDER BY convocation_id DESC LIMIT 1");
			
			$output['success'] = 1;
			$output['msg'] = "Medical Convocation Detail.";

			if(empty($health)){
				$output['object']['last_check'] = '';
				$output['object']['health_disease']	= '';
				$output['object']['health_status'] = '';
			} else {
				$output['object']['last_check'] = date('d/m/Y', strtotime($health->convocation_date));
				$output['object']['health_disease']	= $health->disease;
				$output['object']['health_status'] = $health->health_status;
			}

			$output['object']['blood_group'] = $convocation->blood_group;
			$output['object']['height'] = $convocation->height;
			$output['object']['weight'] = $convocation->weight;
			if(!empty($convocation->disease)){
			    	$output['object']['disease'] = $convocation->disease;
			}else{
			    	$output['object']['disease'] = "";
			}
		

		}

		$this->encode_data($output);
	}

	public function MedicalConvocationRequest()
	{
		$output = [];

		if(!$this->input->get_post('user_id')){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
			$this->encode_data($output);
			die();

		} else {

			$data = [
				'employee_id' => $this->input->get_post('user_id'),
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
			];

			if($this->api_model->insert_data('hrms_employee_medical_request', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Request Sent.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				switch ($user_data->gender) {
					case 'Male':
						$h = 'his';
						break;
					case 'Female':
						$h = 'her';
						break;
					default:
						$h = '';
						break;
				}

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Medical Convocation Request',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('employees/medical_convocation/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> requested for '.$h.' medical convocation.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed to Send Request.';
			}

		}

		$this->encode_data($output);
		
	}

	public function feedback()
	{
		$output = [];

		if(!$this->input->get_post('user_id') || !$this->input->get_post('answer') || !$this->input->get_post('message')){
			
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter.';
			$this->encode_data($output);
			die();

		} else {

			$data = [
				'employee_id' => $this->input->get_post('user_id'),
				'answers' => $this->input->get_post('answer'),
				'message' => $this->input->get_post('message'),
				'created_at' => date('Y-m-d H:i:s'),
			];

			if($this->api_model->insert_data('hrms_employee_feedback', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Thank You For Your Feedback.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				switch ($user_data->gender) {
					case 'Male':
						$h = 'his';
						break;
					case 'Female':
						$h = 'her';
						break;
					default:
						$h = '';
						break;
				}

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Feedback',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('employees/feedback/').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> gave '.$h.' feedback.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed to Send Feedback.';
			}

		}

		$this->encode_data($output);
		
	}

	public function accessHistory($data)
	{
		$data['status'] = 0;
		$this->api_model->insert_data('hrms_access_history', $data);
	}

//-----------------------RITIKA CODE----------------------
//http://192.168.1.118/hrms/Api/getUserData?user_id=1
public function getUserData()
{
	$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->output( $output ); 

		}
		else
		{
			$user_data = $this->api_model->select_single_row('select first_name,user_id,last_name,username,email,email_two,password,date_of_birth,city_of_birth,country_of_birth,profile_background,designation_id,gender,marital_status,spouse_name,spouse_dob,marrige_anniversery_date,children,address,address_two,profile_picture,wpn,wpn_issuedate,wpn_expirydate,passport_number,passport_issuedate,user_role_id,company_id,date_of_joining,passsport_expirydate,emergency_contact_name,emergency_contact_number,emergency_contact_relation,emergency_contact_email,contact_no,nsn,visa_number,visa_issuedate,visa_expirydate,telephone from hrms_employees where user_id = "'.$this->input->get_post('user_id').'"');
			
			if(!empty($user_data))
			{
				$user_id = $this->input->get_post('user_id');

				$bank_detail = $this->api_model->getSingle('hrms_employee_bankaccount', array('employee_id' => $user_id));
				$designation_detail = $this->api_model->getSingle('hrms_designations', array('designation_id' => $user_data->designation_id));
				$attendance_detail = $this->api_model->select_single_row("SELECT COUNT(*) AS count FROM (SELECT * FROM hrms_attendance_time WHERE employee_id = '".$user_id."' AND MONTH(attendance_date) = '".date('m')."' GROUP BY attendance_date) AS tmp");
				$projects = $this->api_model->select_single_row("SELECT COUNT(*) AS projects FROM hrms_tasks WHERE FIND_IN_SET($user_id, assigned_to)");
				$awards = $this->api_model->select_single_row("SELECT COUNT(*) AS awards FROM hrms_awards WHERE employee_id='".$user_id."'");
				$warnings = $this->api_model->select_single_row("SELECT COUNT(*) AS warnings FROM hrms_employee_warnings WHERE warning_to='".$user_id."'");
				$email_count = $this->api_model->select_single_row("SELECT COUNT(*) AS email_count FROM hrms_email_history WHERE employee_id='".$user_id."'");
				$announcement = $this->api_model->getSingle('hrms_announcements', array('CURDATE() BETWEEN start_date AND end_date'));

				$output["success"] = 1;
				$output["msg"] = "success";
				$user_data->url = base_url().'uploads/user_img/';

// *********extra Data********

					if (!empty($bank_detail)) {
					$user_data->account_number = $bank_detail->account_number;
				} else {
					$user_data->account_number  = "";
				}

				if (!empty($designation_detail)) {
					$user_data->job_profile = $designation_detail->designation_name;
				} else {
					$user_data->job_profile = "";
				}

				if ($user_data->profile_picture != "")  {
					$user_data->profile_image = file_exists('uploads/user_img/'.$user_data->profile_picture)?base_url().'uploads/user_img/'.$user_data->profile_picture:"https://www.w3schools.com/w3images/avatar2.png";
				} else {
					$user_data->profile_image = "https://www.w3schools.com/w3images/avatar2.png";
				}

				if ($user_data->profile_background != "") {
					$user_data->cover_image = (file_exists('uploads/user_cover_img/'.$user_data->profile_background))?base_url().'uploads/user_cover_img/'.$user_data->profile_background:base_url().'uploads/user_cover_img/'."cover.png";
				} else {
					$user_data->cover_image = base_url().'uploads/user_cover_img/'."cover.png";
				}

				$user_data->attendance_days = $attendance_detail->count;
				$user_data->projects = $projects->projects;
				$user_data->awards = $awards->awards;
				$user_data->warnings = $warnings->warnings;
				$user_data->email_count = $email_count->email_count;
				$user_data->date_of_join = date("Y-m-d", strtotime($user_data->date_of_joining));

				if (!empty($announcement)) {
					$user_data->announcement = $announcement->description;
				} else {
					$user_data->announcement = "";
				}

//************end data**********
				$output['object'] = $user_data;


			}else
			{
				$output['success'] = 0;
				$output['msg'] = 'No Users Exist!';
			}


			$this->output( $output ); 
 	 	}	
}
//http://192.168.1.118/hrms/Api/updateEmployeProfile?user_id=43&first_name=shilpa&email=kripa@infograins.com&date_of_birth=2017-12-01&marital_status=Married&last_name=agrwal&address=Indore&contact_no=2589635&emergency_contact_name=ritika&emergency_contact_number=1234567890&city_of_birth=Indore&country_of_birth=ndia&address_two=Lane%202%20India&telephone=102121544&email_two=archana@infograins.com&nsn=4654654546545656456564&spouse_name=Ritik&spouse_dob=09\/09\/1994&marrige_anniversery_date=09\/09\/2007&children=Two&wpn=12121456454445&wpn_issuedate=09\/09\/2007&wpn_expirydat=09\/09\/2007&passport_number=63564845649648548&passport_issuedate=09\/09\/2007&passsport_expirydat=09\/09\/2007&visa_number=7444465456465654564&visa_issuedat=09\/09\/2007&visa_expirydate=09\/09\/2007
public function updateEmployeProfile()
{
	$output = array();
		if(!$this->input->get_post('user_id') || !$this->input->get_post('first_name') || !$this->input->get_post('email') || !$this->input->get_post('date_of_birth') || !$this->input->get_post('marital_status') || !$this->input->get_post('last_name') || !$this->input->get_post('address') || !$this->input->get_post('contact_no') || !$this->input->get_post('emergency_contact_name') || !$this->input->get_post('emergency_contact_number'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->output( $output ); 

		}
		else
		{
			$getUserData = $this->api_model->getSingle('hrms_employees',array('user_id'=>$this->input->get_post('user_id')));
			

			if(!empty($_FILES["profile_image"])) {
				$directory = USER_IMAGE;
				

				$image_name_new = time().'.jpg';
				$image_path = $directory.$image_name_new;
				move_uploaded_file($_FILES["profile_image"]["tmp_name"], $image_path);
				}else{
					$image_name_new = $getUserData->profile_picture;
				}

			$dataUpdate = array(
			'first_name'=>$this->input->get_post('first_name'),
			'last_name'=>$this->input->get_post('last_name'),
			'email'=>$this->input->get_post('email'),
			'email_two'=>$this->input->get_post('email_two'),
			'password'=>$this->input->get_post('password'),
			'date_of_birth'=>$this->input->get_post('date_of_birth'),
			'city_of_birth'=>$this->input->get_post('city_of_birth'),
			'country_of_birth'=>$this->input->get_post('country_of_birth'),
			'gender'=>$this->input->get_post('gender'),
			'marital_status'=>$this->input->get_post('marital_status'),
			'spouse_name'=>$this->input->get_post('spouse_name'),
			'spouse_dob'=>$this->input->get_post('spouse_dob'),
			'marrige_anniversery_date'=>$this->input->get_post('marrige_anniversery_date'),
			'children'=>$this->input->get_post('children'),
			'address'=>$this->input->get_post('address'),
			'address_two'=>$this->input->get_post('address_two'),
			'contact_no'=>$this->input->get_post('contact_no'),
			'telephone'=>$this->input->get_post('telephone'),
			'profile_picture'=>$image_name_new,
			'wpn'=>$this->input->get_post('wpn'),
			'wpn_issuedate'=>$this->input->get_post('wpn_issuedate'),
			'wpn_expirydate'=>$this->input->get_post('wpn_expirydate'),
			'passport_number'=>$this->input->get_post('passport_number'),
			'passport_issuedate'=>$this->input->get_post('passport_issuedate'),
			'passsport_expirydate'=>$this->input->get_post('passsport_expirydate'),
			'emergency_contact_name'=>$this->input->get_post('emergency_contact_name'),
			'emergency_contact_number'=>$this->input->get_post('emergency_contact_number'),
			'emergency_contact_relation'=>$this->input->get_post('emergency_contact_relation'),
			'emergency_contact_email'=>$this->input->get_post('emergency_contact_email'),
			'nsn'=>$this->input->get_post('nsn'),
			'visa_number'=>$this->input->get_post('visa_number'),
			'visa_issuedate'=>$this->input->get_post('visa_issuedate'),
			'visa_expirydate'=>$this->input->get_post('visa_expirydate'),
			'modified_at'=>$this->input->get_post('modified_at')

			);
			$where = array('user_id'=>$this->input->get_post('user_id'));
			$this->api_model->update_data('hrms_employees',$where,$dataUpdate);
			$output['success'] = 1;
			$output['msg'] = 'Success';

			$this->encode_data($output);
		}
}
//http://192.168.1.118/hrms/Api/punchHistory?user_id=1&search=2018-04-18
function punchHistory()
{

	$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->output( $output ); 

		}
		else
		{
			if (!$this->input->get_post('search')) 
			{
				$sql = 'select * from `hrms_attendance_time` where `employee_id` = "'.$this->input->get_post('user_id').'" order by `attendance_date` desc';
			}else{
				$sql = 'select * from `hrms_attendance_time` where `employee_id` = "'.$this->input->get_post('user_id').'" and `attendance_date`= "'.$this->input->get_post('search').'" order by `attendance_date` desc';
			}
			
			//echo $sql;die();
			$user_data = $this->api_model->select_multiple_row($sql);
			
			if(!empty($user_data))
			{
				$output['success'] = 1;
			    $output['msg'] = 'Success';
				$sqlarray = array();
				$i=0;
				foreach ($user_data as $value) {
					//echo $value->attendance_date;
				$sqlarray[$i]['date'] = $value->attendance_date;
				$sqlarray[$i]['day'] = date("l", strtotime($value->attendance_date));


				$punch_in = $this->api_model->select_multiple_row('select clock_in,clock_out from hrms_attendance_time where attendance_date = "'.$value->attendance_date.'"');
				$j=0;
				$clockArray = array();
				foreach ($punch_in as $clockInvalue) 
				{
                     $sqlarray[$i]['punchin'][$j]['time'] = date("H:i", strtotime($clockInvalue->clock_in));

                     if (!empty($clockInvalue->clock_out))
                     {
                     	$outDate = date("H:i", strtotime($clockInvalue->clock_out));
                     }else{
                     	$outDate = "";
                     }
                   	 $sqlarray[$i]['punchout'][$j]['time'] = $outDate;

					 $j++;
				}
				$i++;
				}
			      //$sqlarray['punchin'] = $clockArray;
				 $output["object"]= $sqlarray;
				
			}else
			{
				$output['success'] = 0;
				$output['msg'] = 'No Users Exist!';
			}


			$this->output( $output ); 
 	 	}
}
//http://192.168.1.118/hrms/Api/getContract?user_id=31
public function getContract()
{
//die('hii');
	$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->output( $output ); 

		}
		else
		{
			$data['getContractData'] = $this->api_model->select_single_row("select * from hrms_employee_contract where employee_id = '".$this->input->get_post('user_id')."'");
			
				
				if (!empty($data['getContractData'])) 
				{
					$this->load->view('contractEmp', $data);
				}else{
					$data['title'] = array('name'=>'Contract');
					$this->load->view('noDataTemplete', $data);
				}
				

		}
}

//http://192.168.1.118/hrms/Api/getProbations?user_id=31
public function getProbations()
{
//die('hii');
	$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->output( $output ); 

		}
		else
		{
			$data['getgetProbationsData'] = $this->api_model->select_single_row("select * from hrms_employee_probations where employee_id = '".$this->input->get_post('user_id')."'");
			
				
				if (!empty($data['getgetProbationsData'])) 
				{
					$this->load->view('probationsEmp', $data);
				}else{
					$data['title'] = array('name'=>'probation');
					$this->load->view('noDataTemplete', $data);
				}
				

		}
}
//**************get manager employee***************
	//Api/getUnderEmp?user_id=4&se
	public function getUnderEmp()
	{
		$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$userData = $this->api_model->select_single_row('select `hrms_employees`.*,`hrms_designations`.`designation_name` from `hrms_employees` inner join `hrms_designations` on `hrms_designations`.`designation_id` = `hrms_employees`.`designation_id` where `hrms_employees`.`user_id` = "'.$this->input->get_post('user_id').'"');

if ($this->input->get_post('search') != "") 
{
	$title = $this->input->get_post('search');
	$sql="select `hrms_employees`.*,`hrms_designations`.`designation_name` from `hrms_employees` inner join `hrms_designations` on `hrms_designations`.`designation_id` = `hrms_employees`.`designation_id` where `hrms_employees`. head_employee = '".$this->input->get_post('user_id')."' AND `hrms_employees`.`first_name` LIKE '".$title."%'";


			$getUserData = $this->api_model->select_multiple_row($sql);
			if (!empty($getUserData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;

				foreach ($getUserData as $value) 
				{
					if (!empty($value->profile_picture)) 
					{
						$prof = $value->profile_picture;
					}else{
						$prof = "defult.jpg";
					}
                     $sqlarray[$i]['url'] =  base_url().'uploads/user_img/';
                   	 $sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;
                   	 $sqlarray[$i]['profile'] = $prof;
                   	 $sqlarray[$i]['id'] = $value->user_id;
                   	  $sqlarray[$i]['designation'] = $value->designation_name;

					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
}else{
	$sql='select `hrms_employees`.*,`hrms_designations`.`designation_name` from `hrms_employees` inner join `hrms_designations` on `hrms_designations`.`designation_id` = `hrms_employees`.`designation_id` where `hrms_employees`. head_employee = "'.$this->input->get_post('user_id').'"' ;




			$getUserData = $this->api_model->select_multiple_row($sql);
			if (!empty($getUserData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=1;

				if (!empty($userData->profile_picture)) 
					{
						$profile = $userData->profile_picture;
					}else{
						$profile = "defult.jpg";
					}
                     $sqlarray[0]['url'] =  base_url().'uploads/user_img/';
                   	 $sqlarray[0]['name'] = $userData->first_name.' '.$userData->last_name;
                   	 $sqlarray[0]['profile'] = $profile;
                   	 $sqlarray[0]['id'] = $userData->user_id;
                   	 $sqlarray[0]['designation'] = $userData->designation_name;


				foreach ($getUserData as $value) 
				{
					if (!empty($value->profile_picture)) 
					{
						$prof = $value->profile_picture;
					}else{
						$prof = "defult.jpg";
					}
                     $sqlarray[$i]['url'] =  base_url().'uploads/user_img/';
                   	 $sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;
                   	 $sqlarray[$i]['profile'] = $prof;
                   	 $sqlarray[$i]['id'] = $value->user_id;
                   	  $sqlarray[$i]['designation'] = $value->designation_name;

					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
}


			
		}
		$this->encode_data($output);
	}

//*****************Transfer List******************
	//http://192.168.1.118/hrms/Api/trnsferList?user_id=31
	public function trnsferList()
	{
		$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			

			$getUserData = $this->api_model->select_multiple_row('select hrms_employee_transfer.*,hrms_employees.first_name ,hrms_employees.last_name from  hrms_employee_transfer inner join hrms_employees on hrms_employees.user_id = hrms_employee_transfer.employee_id where hrms_employee_transfer.employee_id = "'.$this->input->get_post('user_id').'"');
			if (!empty($getUserData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;

			//print_r($getUserData);
				foreach ($getUserData as $value) 
				{
					if (!empty($value->transfer_department)) 
					{
						$getDesignationTo = $this->api_model->select_single_row("select department_name	 from hrms_departments where department_id =".$value->transfer_department);
						$desTo = $getDesignationTo->department_name	;
					}
					else{
						$desTo = "";

					}
					
					if (!empty($value->department_from)) 
					{
						$getDesignationFrom = $this->api_model->select_single_row("select department_name	 from hrms_departments where department_id =".$value->department_from);
						$desFrom = $getDesignationFrom->department_name	;
					}else{
							$desFrom = "";
					}

					

					$getTransferFrom = $this->api_model->select_single_row("select location_name from hrms_office_location where location_id =".$value->transferfrom);


					$getTransferTo = $this->api_model->select_single_row("select location_name from hrms_office_location where location_id =".$value->transfer_location);
					
					if (!empty($desTo)) 
					{
						$sqlarray[$i]['department_to'] = $desTo;
					}else{
						$sqlarray[$i]['department_to'] = "";
					}
                   	 
                   	 if (!empty($desFrom)) 
					{
							 $sqlarray[$i]['department_from'] = $desFrom;
					}else{
							 $sqlarray[$i]['department_from'] = "";
					}
                   	 
                   	 if (!empty($getTransferTo->location_name)) 
					{
						$sqlarray[$i]['location_to'] = $getTransferTo->location_name;
					}else{
						$sqlarray[$i]['location_to'] = "";
					}
                   	 
                   	 if (!empty($getTransferFrom->location_name)) 
					{
						 $sqlarray[$i]['location_from'] = $getTransferFrom->location_name;
					}else{
						 $sqlarray[$i]['location_from'] = "";
					}
                   	 
                   $sqlarray[$i]['date'] = $value->created_at;
                   $sqlarray[$i]['designation_to'] = "";
                   $sqlarray[$i]['designation_from'] = "";
                   $sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;
                   	
					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
			
		}
		$this->encode_data($output);
	}
//***********prmotion list*************************
	//http://192.168.1.118/hrms/Api/prmotionList?user_id=31
	public function prmotionList()
	{
		$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			

			$getUserData = $this->api_model->select_multiple_row('select hrms_employee_promotions.*,hrms_employees.first_name ,hrms_employees.last_name  from  hrms_employee_promotions inner join hrms_employees on hrms_employees.user_id = hrms_employee_promotions.employee_id where hrms_employee_promotions.employee_id = "'.$this->input->get_post('user_id').'"');
			if (!empty($getUserData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;

			
				foreach ($getUserData as $value) 
				{
					$getDesignationTo = $this->api_model->select_single_row("select designation_name from hrms_designations where designation_id =".$value->designation_to);

					$getDesignationFrom = $this->api_model->select_single_row("select designation_name from hrms_designations where designation_id =".$value->designation_from);

					$getTransferFrom = $this->api_model->select_single_row("select location_name from hrms_office_location where location_id =".$value->location_from);

					$getTransferTo = $this->api_model->select_single_row("select location_name from hrms_office_location where location_id =".$value->location_To);
					if (!empty($getDesignationTo)) 
					{
						$sqlarray[$i]['designation_to'] = $getDesignationTo->designation_name;
					}else{
						$sqlarray[$i]['designation_to'] = "";
					}
                   	 if (!empty($getDesignationFrom)) 
					{
						$sqlarray[$i]['designation_from'] = $getDesignationFrom->designation_name;
					}else{
						$sqlarray[$i]['designation_from'] = "";
					}
                   	 if (!empty($getTransferTo)) 
					{
						$sqlarray[$i]['location_to'] = $getTransferTo->location_name;
					}else{
						$sqlarray[$i]['location_to'] = "";
					}
					if (!empty($getTransferFrom)) 
					{
						 $sqlarray[$i]['location_from'] = $getTransferFrom->location_name;
					}else{
						$sqlarray[$i]['location_from'] = "";
					}
                   	
                   	
                   	 $sqlarray[$i]['date'] = $value->created_at;
					$sqlarray[$i]['department_to'] = "";
					$sqlarray[$i]['department_from'] = "";
					$sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;

					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
			
		}
		$this->encode_data($output);
	}
//https://infograins.in/INFO01/hrms/Api/addTransfer?transferfrom=10&company_id=21&department_from=9&transfer_location=12&transfer_department=8&user_id=61
	function addTransfer()
	{
		$output = array();
		if(!$this->input->get_post('user_id') || !$this->input->get_post('company_id') || !$this->input->get_post('transfer_department')  || !$this->input->get_post('department_from')  || !$this->input->get_post('transfer_location')  || !$this->input->get_post('transferfrom'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$data = array(
				'company_id' =>$this->input->get_post('company_id'),
				'employee_id' =>$this->input->get_post('user_id'),
				'transfer_department' =>$this->input->get_post('transfer_department'),
				'department_from' =>$this->input->get_post('department_from'),
				'transfer_location' =>$this->input->get_post('transfer_location'),
				'transferfrom' =>$this->input->get_post('transferfrom'),
				'status' =>'1',
				'created_at' =>date('Y-m-d'),
				'added_by' => $this->input->get_post('user_id'),

				'description' =>$this->input->get_post('description')
				);
			$num = $this->api_model->insert_data('hrms_employee_transfer', $data);
			if($num > 0){

				$output['success'] = 1;
				$output['msg'] = 'Transfer Request Added successfully.';
			}
		}
		$this->encode_data($output);
	}
//http://192.168.1.118/hrms/Api/apply_prmotion?user_id=49&company_id=17&title=prmotion&description=test promotion&location_To=4&location_from=5&department_to=11&department_from=11&designation_to=27&designation_from=28
	// ************Apply for prmotion***********
		function apply_prmotion()
	{
		$output = array();
		if(!$this->input->get_post('user_id') || !$this->input->get_post('company_id') || !$this->input->get_post('title')  || !$this->input->get_post('description')  || !$this->input->get_post('location_To')  || !$this->input->get_post('location_from') || !$this->input->get_post('department_to')  || !$this->input->get_post('department_from') || !$this->input->get_post('designation_to')  || !$this->input->get_post('designation_from'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		} else {
			$data = [
				'employee_id' =>$this->input->get_post('user_id'),
				'company_id' => $this->input->get_post('company_id'),
				'title' => $this->input->get_post('title'),
				// 'promotion_date' => $this->input->post('promotion_date'),
				'description' => $this->input->get_post('description'),

				'location_To'     => $this->input->get_post('location_To'),
				'location_from'   => $this->input->get_post('location_from'),
				'department_to'   => $this->input->get_post('department_to'),
				'department_from' => $this->input->get_post('department_from'),
				'designation_to'  => $this->input->get_post('designation_to'),
				'designation_from'=> $this->input->get_post('designation_from'),

				'added_by' => $this->input->get_post('user_id'),
				'created_at' => date('d-m-Y'),
			];

			if($this->api_model->insert_data('hrms_employee_promotions', $data)){
				$output['success'] = 1;
				$output['msg'] = 'Applied For Prmotion.';

				$user_data = $this->api_model->getSingle('hrms_employees', array('user_id'=>$this->input->get_post('user_id')));

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"access_type" => 'Appraisal Application',
					"action" => 'Added',
					"access" => '<p><a href="'.site_url('performance/appraisal_applications').'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> applied for appraisal.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			} else {
				$output['success'] = 0;
				$output['msg'] = 'Failed To Apply For Prmotion.';
			}

		}

		$this->encode_data($output);
	}
//***********get department****************]
//http://192.168.1.118/hrms/Api/getDepartment?company_id=17	
	function getDepartment()
	{
		$output = array();
		if(!$this->input->get_post('company_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$getCompnayData = $this->api_model->select_multiple_row('SELECT * from hrms_departments where company_id  = "'.$this->input->get_post('company_id').'"');
			if (!empty($getCompnayData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;

			
				foreach ($getCompnayData as $value) 
				{
                   	 $sqlarray[$i]['department_id'] = $value->department_id;
                   	 $sqlarray[$i]['department_name'] = $value->department_name;

					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
			
		}
		$this->encode_data($output);
	}
//***********get department****************]
//http://192.168.1.118/hrms/Api/getDesignation?department_id=17	
	function getDesignation()
	{
		$output = array();
		if(!$this->input->get_post('department_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$getDesignationData = $this->api_model->select_multiple_row('SELECT * from hrms_designations where department_id  = "'.$this->input->get_post('department_id').'"');
			if (!empty($getDesignationData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;

			
				foreach ($getDesignationData as $value) 
				{
                   	 $sqlarray[$i]['designation_id'] = $value->designation_id;
                   	 $sqlarray[$i]['designation_name'] = $value->designation_name;

					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
			
		}
		$this->encode_data($output);
	}	

	//***********get department****************]
//http://192.168.1.118/hrms/Api/getLocation?company_id=17	
	function getLocation()
	{
		$output = array();
		if(!$this->input->get_post('company_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$getLocationData = $this->api_model->select_multiple_row('SELECT * from hrms_office_location where company_id = "'.$this->input->get_post('company_id').'"');
			if (!empty($getLocationData)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;

			
				foreach ($getLocationData as $value) 
				{
                   	 $sqlarray[$i]['location_id'] = $value->location_id;
                   	 $sqlarray[$i]['location_name'] = $value->location_name;

					 $i++;
				}
					$output["object"]= $sqlarray;
				
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No Data Found';
				
			}
			
		}
		$this->encode_data($output);
	}
//**************see all pending request***********
	function allRequest()
	{
			$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->encode_data($output);

		}
		else
		{
			// ***********paginaton****
			$pnumber =$this->input->get_post('page');

			if ($pnumber != "")
				$pagenumber = $pnumber + 1;
			else
				$pagenumber = 1;

			$end_limit = 10;
			$per_page = ($end_limit * $pagenumber) - 10;
			//********end pagination*****
			if (!$this->input->get_post('search'))
			 {

//******************************************Leave*************************************************
			$sql = "select hrms_leave_applications.*,hrms_employees.first_name,hrms_employees.last_name from hrms_leave_applications INNER join hrms_employees on hrms_employees.user_id = hrms_leave_applications.employee_id where  hrms_leave_applications.status ='1' AND hrms_employees.head_employee=".$this->input->get_post('user_id');
			$getLeaveData = $this->api_model->select_multiple_row($sql);
			$i=0;
			if (!empty($getLeaveData)) {
				$sqlarray = array();
				
				foreach ($getLeaveData as $value) 
				{
					 if ($value->reason == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->reason;
					 }
					 if ($value->leave_type_id == '1') 
					{
						$leave_type = "Casual Leave";
					}else{
						$leave_type = "Medical Leave";
					}

						$sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$i]['type'] = 'Leave';
					 	$sqlarray[$i]['description'] = $description;
						$sqlarray[$i]['date'] =date('d-M-Y', strtotime($value->created_at)); 
						$sqlarray[$i]['request_id'] = $value->leave_id;
						$sqlarray[$i]['leave_type'] = $leave_type;

						$sqlarray[$i]['from'] = $value->from_date;
						$sqlarray[$i]['to'] = $value->to_date;
						$sqlarray[$i]['project'] = "";
						$sqlarray[$i]['subject'] = "";
						$sqlarray[$i]['priority'] = "";
						$sqlarray[$i]['travlerDateFrom'] = "";
						$sqlarray[$i]['travlerDateTo'] = "";
						$sqlarray[$i]['locationTo'] = "";
						$sqlarray[$i]['locationFrom'] = "";
						$sqlarray[$i]['departmentFrom'] = "";
						$sqlarray[$i]['departmentTo'] = "";
						$sqlarray[$i]['designationFrom'] = "";
						$sqlarray[$i]['designationTo'] = "";
						
					 $i++;

				}
				$j = $i;
				    
					// $output["object"]= $sqlarray;
					
			}else{$j = $i;}
//**************************************Transfer***********************
			$sql = "select hrms_employee_transfer.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_transfer INNER join hrms_employees on hrms_employees.user_id = hrms_employee_transfer.employee_id where  hrms_employee_transfer.status ='0' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			
			$getTransferData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTransferData)) {
				

				foreach ($getTransferData as $value) 
				{
//**Designation From 
					$getDesignationFrom = $this->api_model->getSingle('hrms_designations',array('designation_id'=>$value->designation_from));

// ***Designation To
					$getDesignationTo   = $this->api_model->getSingle('hrms_designations',array('designation_id'=>$value->designation_to));
//***Department from
					$getDepartmentFrom  = $this->api_model->getSingle('hrms_departments',array('department_id'=>$value->department_from));
// **Department to
					$getDepartmentTo    = $this->api_model->getSingle('hrms_departments',array('department_id'=>$value->transfer_department));
//**Location From
					$getLocationFrom    = $this->api_model->getSingle('hrms_office_location',array('location_id'=>$value->transferfrom));
//**Location To
					$getLocationTo      = $this->api_model->getSingle('hrms_office_location',array('location_id'=>$value->transfer_location));

//Loc from
					
						if (!empty($getLocationFrom) && $getLocationFrom->location_name != "")
					  {
					 	$locFrom = $getLocationFrom->location_name;
					  }else{
					  	$locFrom = "";
					  }
					
//loc to
						if (!empty($getLocationTo) && $getLocationTo->location_name != "")
					  {
					 	$locTo = $getLocationTo->location_name;
					  }else{
					  	$locTo = "";
					  }
					  
// department From
						if (!empty($getDepartmentFrom) && $getDepartmentFrom->department_name != "")
					  {
					 	$depFrom = $getDepartmentFrom->department_name;
					  }else{
					  	$depFrom = "";
					  }
					  
// Department to
					if (!empty($getDepartmentTo) && $getDepartmentTo->department_name != "")
					  {
					 	$depTo = $getDepartmentTo->department_name;
					  }else{
					  	$depTo = "";
					  }
					  
//des from
						if (!empty($getDesignationFrom) && $getDesignationFrom->designation_name != "")
					  {
					 	$desFrom = $getDesignationFrom->designation_name;
					  }else{
					  	$desFrom = "";
					  }
					
					  
// Des to
					  
					  	if (!empty($getDesignationTo) && $getDesignationTo->designation_name != "")
					  {
					 	$desto =  $getDesignationTo->designation_name;
					  }else{
					  	$desto =  "";
					  }
					  

					   if (empty($value->description)) 
					 {
					 	$description = "";
					 }else{
						$description =  $value->description;
					 }


						$sqlarray[$j]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$j]['type'] = 'Transfer';
						$sqlarray[$j]['description'] = $description;
						$sqlarray[$j]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$j]['request_id'] = $value->transfer_id;
						$sqlarray[$j]['leave_type'] = "";


						$sqlarray[$j]['locationFrom'] = $locFrom;
						$sqlarray[$j]['locationTo'] = $locTo;
						$sqlarray[$j]['departmentFrom'] = $depFrom;
						$sqlarray[$j]['departmentTo'] = $depTo;
						$sqlarray[$j]['designationFrom'] = $desFrom;
						$sqlarray[$j]['designationTo'] = $desto;
						$sqlarray[$j]['from'] = "";
						$sqlarray[$j]['to'] = "";
						$sqlarray[$j]['project'] = "";
						$sqlarray[$j]['subject'] = "";
						$sqlarray[$j]['priority'] = "";
						$sqlarray[$j]['travlerDateFrom'] = "";
						$sqlarray[$j]['travlerDateTo'] = "";

					 $j++;
				}
					$k = $j;
					// $output["object"]= $sqlarray;
					
			}else{$k = $j;}
//********************************************Prmotion********************************************

		$sql = "select hrms_employee_promotions.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_promotions INNER join hrms_employees on hrms_employees.user_id = hrms_employee_promotions.employee_id where  hrms_employee_promotions.status ='0' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getPrmotionData = $this->api_model->select_multiple_row($sql);
			if (!empty($getPrmotionData)) {
				
				
				foreach ($getPrmotionData as $value) 
				{
					  if (empty($value->description)) 
					 {
					 	$description = "";
					 }else{
					 	// $withOutBr = str_replace("&lt;/br&lt;/","",$value->description);
					 	// echo $withOutBr;
					 	
					 	// 	print_r($errors);die();
					 	// die();
			 			$description =  $value->description;
					 }
						$sqlarray[$k]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$k]['type'] = 'Prmotion';
						$sqlarray[$k]['description'] = $description;
						$sqlarray[$k]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$k]['request_id'] = $value->promotion_id;
						$sqlarray[$k]['leave_type'] = "";

						$sqlarray[$k]['locationFrom'] = "";
						$sqlarray[$k]['locationTo'] = "";
						$sqlarray[$k]['departmentFrom'] = "";
						$sqlarray[$k]['departmentTo'] = "";
						$sqlarray[$k]['designationFrom'] = "";
						$sqlarray[$k]['designationTo'] = "";
						$sqlarray[$k]['from'] = "";
						$sqlarray[$k]['to'] = "";
						$sqlarray[$k]['project'] = "";
						$sqlarray[$k]['subject'] = "";
						$sqlarray[$k]['priority'] = "";
						$sqlarray[$k]['travlerDateFrom'] = "";
						$sqlarray[$k]['travlerDateTo'] = "";
                   	  

					 $k++;

				}
				$l = $k;
				    
					// $output["object"]= $sqlarray;
					
			}else{$l = $k;}
//*********************************************Travel********************************
$sql = "select hrms_employee_travels.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_travels INNER join hrms_employees on hrms_employees.user_id = hrms_employee_travels.employee_id where  hrms_employee_travels.status ='0' AND hrms_employees.head_employee=".$this->input->get_post('user_id');


			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
						$sqlarray[$l]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$l]['type'] = 'Travler';
						$sqlarray[$l]['description'] = $description;
						$sqlarray[$l]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$l]['request_id'] = $value->travel_id;
						$sqlarray[$l]['leave_type'] = "";

						$sqlarray[$l]['travlerDateFrom'] = $value->start_date;
						$sqlarray[$l]['travlerDateTo'] = $value->end_date;
						$sqlarray[$l]['locationTo'] = $value->visit_place;
						$sqlarray[$l]['project'] = "";
						$sqlarray[$l]['subject'] = "";
						$sqlarray[$l]['priority'] = "";
						$sqlarray[$l]['locationFrom'] = "";
						$sqlarray[$l]['departmentFrom'] = "";
						$sqlarray[$l]['departmentTo'] = "";
						$sqlarray[$l]['designationFrom'] = "";
						$sqlarray[$l]['designationTo'] = "";
						$sqlarray[$l]['from'] = "";
						$sqlarray[$l]['to'] = "";

                   	  

					 $l++;

				}
				$m = $l;
				    
					// $output["object"]= $sqlarray;
					
			}else{$m = $l;}

//******************************Tickiting**********************************
			$sql = "select hrms_support_tickets.*,hrms_employees.first_name,hrms_employees.last_name from hrms_support_tickets INNER join hrms_employees on hrms_employees.user_id = hrms_support_tickets.employee_id where  hrms_support_tickets.ticket_status ='1' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
 //priority******

					if ($value->ticket_priority == "") 
					{
					$priority = "";
					}else if ($value->ticket_priority == 1) 
					{
					$priority = "Low";
					}else if ($value->ticket_priority == 2) 
					{
					$priority = "Medium";
					}else if ($value->ticket_priority == 3) 
					{
					$priority = "High";
					}else{
					$priority = "critical";
					}
						$sqlarray[$m]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$m]['type'] = 'Complain';
						$sqlarray[$m]['description'] = $description;
						$sqlarray[$m]['date'] = date('d-M-Y', strtotime($value->created_at)); 
						$sqlarray[$m]['request_id'] = $value->ticket_id;
						$sqlarray[$m]['leave_type'] = "";

						$sqlarray[$m]['subject'] = $value->subject;
						$sqlarray[$m]['priority'] = $priority;
						$sqlarray[$m]['travlerDateFrom'] = "";
						$sqlarray[$m]['travlerDateTo'] = "";
						$sqlarray[$m]['locationTo'] = "";
						$sqlarray[$m]['locationFrom'] = "";
						$sqlarray[$m]['departmentFrom'] = "";
						$sqlarray[$m]['departmentTo'] = "";
						$sqlarray[$m]['designationFrom'] = "";
						$sqlarray[$m]['designationTo'] = "";
						$sqlarray[$m]['from'] = "";
						$sqlarray[$m]['to'] = "";
						$sqlarray[$m]['project'] = "";

                   	  

					 $m++;

				}
				$n = $m;
				    
					// $output["object"]= $sqlarray;
					
			}else{$n = $m;}
//****************************project Query*****************************
			$sql = "select hrms_tasks_query.*,hrms_employees.first_name,hrms_employees.last_name,hrms_projects.title from hrms_tasks_query INNER join hrms_employees on hrms_employees.user_id = hrms_tasks_query.employee_id inner join hrms_projects on hrms_projects.project_id = hrms_tasks_query.task_id where hrms_tasks_query.status = 1 and hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					

						$sqlarray[$n]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$n]['type'] = 'Project Query';
						$sqlarray[$n]['description'] = $value->query;
						$sqlarray[$n]['date'] = date('d-M-Y', strtotime($value->query_date)); 
						$sqlarray[$n]['request_id'] = $value->tasks_query_id;
						$sqlarray[$n]['leave_type'] = "";

						$sqlarray[$n]['project'] = $value->title;
						$sqlarray[$n]['subject'] = "";
						$sqlarray[$n]['priority'] = "";
						$sqlarray[$n]['travlerDateFrom'] = "";
						$sqlarray[$n]['travlerDateTo'] = "";
						$sqlarray[$n]['locationTo'] = "";
						$sqlarray[$n]['locationFrom'] = "";
						$sqlarray[$n]['departmentFrom'] = "";
						$sqlarray[$n]['departmentTo'] = "";
						$sqlarray[$n]['designationFrom'] = "";
						$sqlarray[$n]['designationTo'] = "";
						$sqlarray[$n]['from'] = "";
						$sqlarray[$n]['to'] = "";

                   	  

					 $n++;

				}
				$o = $n;
				    
					// $output["object"]= $sqlarray;
					
			}else{$o = $n;}
//**************************have Work****************************			
			$sql = "select hrms_employee_have_work.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_have_work INNER join hrms_employees on hrms_employees.user_id = hrms_employee_have_work.employee_id  where hrms_employee_have_work.status = 1 and hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					

						$sqlarray[$o]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$o]['type'] = 'No Work';
						$sqlarray[$o]['description'] = "No Work";
						$sqlarray[$o]['date'] = date('d-M-Y', strtotime($value->work_date));
						$sqlarray[$o]['request_id'] = $value->have_word_id;
						$sqlarray[$o]['leave_type'] = "";

						$sqlarray[$o]['project'] = "";
						$sqlarray[$o]['subject'] = "";
						$sqlarray[$o]['priority'] = "";
						$sqlarray[$o]['travlerDateFrom'] = "";
						$sqlarray[$o]['travlerDateTo'] = "";
						$sqlarray[$o]['locationTo'] = "";
						$sqlarray[$o]['locationFrom'] = "";
						$sqlarray[$o]['departmentFrom'] = "";
						$sqlarray[$o]['departmentTo'] = "";
						$sqlarray[$o]['designationFrom'] = "";
						$sqlarray[$o]['designationTo'] = "";
						$sqlarray[$o]['from'] = "";
						$sqlarray[$o]['to'] = "";

                   	  

					 $o++;

				}
				$p = $o;
				    // $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
					//$output["object"]= $sqlarray;
					
			}else{$p = $o;}
					 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
					$output["object"]= $sqlarray;
			}else{
//*****************-------------------*With Search*--------------------******************** 
				$search = trim($this->input->get_post('search'));
				if ($search == 'Leave') 
				{
					//*******************Leave**************
			$sql = "select hrms_leave_applications.*,hrms_employees.first_name,hrms_employees.last_name from hrms_leave_applications INNER join hrms_employees on hrms_employees.user_id = hrms_leave_applications.employee_id where  hrms_leave_applications.status ='1' AND hrms_employees.head_employee=".$this->input->get_post('user_id');
			$getLeaveData = $this->api_model->select_multiple_row($sql);
			$i=0;
			$sqlarray = array();
			if (!empty($getLeaveData)) {
				
				
				foreach ($getLeaveData as $value) 
				{
					 if ($value->reason == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->reason;
					 }

//***Leave type
					if ($value->leave_type_id == '1') 
					{
						$leave_type = "Casual Leave";
					}else{
						$leave_type = "Medical Leave";
					}					 

						$sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$i]['type'] = 'Leave';
					 	$sqlarray[$i]['description'] = $description;
						$sqlarray[$i]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$i]['leave_type'] = $leave_type;

						$sqlarray[$i]['from'] = $value->from_date;
						$sqlarray[$i]['to'] = $value->to_date;
						$sqlarray[$i]['project'] = "";
						$sqlarray[$i]['subject'] = "";
						$sqlarray[$i]['priority'] = "";
						$sqlarray[$i]['travlerDateFrom'] = "";
						$sqlarray[$i]['travlerDateTo'] = "";
						$sqlarray[$i]['locationTo'] = "";
						$sqlarray[$i]['locationFrom'] = "";
						$sqlarray[$i]['departmentFrom'] = "";
						$sqlarray[$i]['departmentTo'] = "";
						$sqlarray[$i]['designationFrom'] = "";
						$sqlarray[$i]['designationTo'] = "";
						
					 $i++;

				}
			}
			 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
			$output["object"]= $sqlarray;
				}else if ($search == 'Transfer') 
				{
					//**************************************Transfer***********************
			$sql = "select hrms_employee_transfer.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_transfer INNER join hrms_employees on hrms_employees.user_id = hrms_employee_transfer.employee_id where  hrms_employee_transfer.status ='0' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			
			$getTransferData = $this->api_model->select_multiple_row($sql);
			$j=0;
			$sqlarray = array();
			if (!empty($getTransferData)) {
				

				foreach ($getTransferData as $value) 
				{
//**Designation From 
					$getDesignationFrom = $this->api_model->getSingle('hrms_designations',array('designation_id'=>$value->designation_from));

// ***Designation To
					$getDesignationTo   = $this->api_model->getSingle('hrms_designations',array('designation_id'=>$value->designation_to));
//***Department from
					$getDepartmentFrom  = $this->api_model->getSingle('hrms_departments',array('department_id'=>$value->department_from));
// **Department to
					$getDepartmentTo    = $this->api_model->getSingle('hrms_departments',array('department_id'=>$value->transfer_department));
//**Location From
					$getLocationFrom    = $this->api_model->getSingle('hrms_office_location',array('location_id'=>$value->transferfrom));
//**Location To
					$getLocationTo      = $this->api_model->getSingle('hrms_office_location',array('location_id'=>$value->transfer_location));

//Loc from
					if ($getLocationFrom->location_name != "")
					  {
					 	$locFrom = $getLocationFrom->location_name;
					  }else{
					  	$locFrom = "";
					  }
//loc to
					  if ($getLocationTo->location_name != "")
					  {
					 	$locTo = $getLocationTo->location_name;
					  }else{
					  	$locTo = "";
					  }
// department From
					  if ($getDepartmentFrom->department_name != "")
					  {
					 	$depFrom = $getDepartmentFrom->department_name;
					  }else{
					  	$depFrom = "";
					  }
// Department to
					  if ($getDepartmentTo->department_name != "")
					  {
					 	$depTo = $getDepartmentTo->department_name;
					  }else{
					  	$depTo = "";
					  }
//des from
					  if ($getDesignationFrom->designation_name != "")
					  {
					 	$desFrom = $getDesignationFrom->designation_name;
					  }else{
					  	$desFrom = "";
					  }
// Des to
					  if ($getDesignationTo->designation_name != "")
					  {
					 	$desto =  $getDesignationTo->designation_name;
					  }else{
					  	$desto =  "";
					  }

					   if (empty($value->description)) 
					 {
					 	$description = "";
					 }else{
						//$errors = explode('&lt;/p&gt;', $value->description);
			 			$description =  $value->description;
					 }


						$sqlarray[$j]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$j]['type'] = 'Transfer';
						$sqlarray[$j]['description'] = $description;
						$sqlarray[$j]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$j]['request_id'] = $value->transfer_id;

						$sqlarray[$j]['leave_type'] = "";
						$sqlarray[$j]['locationFrom'] = $locFrom;
						$sqlarray[$j]['locationTo'] = $locTo;
						$sqlarray[$j]['departmentFrom'] = $depFrom;
						$sqlarray[$j]['departmentTo'] = $depTo;
						$sqlarray[$j]['designationFrom'] = $desFrom;
						$sqlarray[$j]['designationTo'] = $desto;
						$sqlarray[$j]['from'] = "";
						$sqlarray[$j]['to'] = "";
						$sqlarray[$j]['project'] = "";
						$sqlarray[$j]['subject'] = "";
						$sqlarray[$j]['priority'] = "";
						$sqlarray[$j]['travlerDateFrom'] = "";
						$sqlarray[$j]['travlerDateTo'] = "";

					 $j++;
				}
					}
					 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
					$output["object"]= $sqlarray;
				}else if ($search == 'Prmotion')
				 {
					//**********************Prmotion************

		$sql = "select hrms_employee_promotions.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_promotions INNER join hrms_employees on hrms_employees.user_id = hrms_employee_promotions.employee_id where  hrms_employee_promotions.status ='0' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getPrmotionData = $this->api_model->select_multiple_row($sql);
			$k=0;
			$sqlarray = array();
			if (!empty($getPrmotionData)) {
				foreach ($getPrmotionData as $value) 
				{
					  if (empty($value->description)) 
					 {
					 	$description = "";
					 }else{
					 	// $withOutBr = str_replace("&lt;/br&lt;/","",$value->description);
					 	// echo $withOutBr;
					 	
					 	// 	print_r($errors);die();
					 	// die();
			 			$description =  $value->description;
					 }
						$sqlarray[$k]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$k]['type'] = 'Prmotion';
						$sqlarray[$k]['description'] = $description;
						$sqlarray[$k]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$k]['request_id'] = $value->promotion_id;
						$sqlarray[$k]['leave_type'] = "";
						$sqlarray[$k]['locationFrom'] = "";
						$sqlarray[$k]['locationTo'] = "";
						$sqlarray[$k]['departmentFrom'] = "";
						$sqlarray[$k]['departmentTo'] = "";
						$sqlarray[$k]['designationFrom'] = "";
						$sqlarray[$k]['designationTo'] = "";
						$sqlarray[$k]['from'] = "";
						$sqlarray[$k]['to'] = "";
						$sqlarray[$k]['project'] = "";
						$sqlarray[$k]['subject'] = "";
						$sqlarray[$k]['priority'] = "";
						$sqlarray[$k]['travlerDateFrom'] = "";
						$sqlarray[$k]['travlerDateTo'] = "";
                   	  

					 $k++;

				}
					
			}
			 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
			 $output["object"]= $sqlarray;
				}else if ($search == 'Travler') 
				{
//****************Travel**************
$sql = "select hrms_employee_travels.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_travels INNER join hrms_employees on hrms_employees.user_id = hrms_employee_travels.employee_id where  hrms_employee_travels.status ='0' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			$getPrmotionData = $this->api_model->select_multiple_row($sql);
			$l=0;
			$sqlarray = array();
			if (!empty($getTravelData)) {
				
				foreach ($getTravelData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
						$sqlarray[$l]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$l]['type'] = 'Travler';
						$sqlarray[$l]['description'] = $description;
						$sqlarray[$l]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$l]['request_id'] = $value->travel_id;
						$sqlarray[$l]['leave_type'] = "";
						$sqlarray[$l]['travlerDateFrom'] = $value->start_date;
						$sqlarray[$l]['travlerDateTo'] = $value->end_date;
						$sqlarray[$l]['locationTo'] = $value->visit_place;
						$sqlarray[$l]['project'] = "";
						$sqlarray[$l]['subject'] = "";
						$sqlarray[$l]['priority'] = "";
						$sqlarray[$l]['locationFrom'] = "";
						$sqlarray[$l]['departmentFrom'] = "";
						$sqlarray[$l]['departmentTo'] = "";
						$sqlarray[$l]['designationFrom'] = "";
						$sqlarray[$l]['designationTo'] = "";
						$sqlarray[$l]['from'] = "";
						$sqlarray[$l]['to'] = "";

                   	  

					 $l++;

				}
					
			}
			 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
			$output["object"]= $sqlarray;
				}else if ($search == 'Complain') 
				{

//*********Complain*******
			$sql = "select hrms_support_tickets.*,hrms_employees.first_name,hrms_employees.last_name from hrms_support_tickets INNER join hrms_employees on hrms_employees.user_id = hrms_support_tickets.employee_id where  hrms_support_tickets.ticket_status ='1' AND hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			$m=0;
			$sqlarray = array();
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
 //priority******

					if ($value->ticket_priority == "") 
					{
					$priority = "";
					}else if ($value->ticket_priority == 1) 
					{
					$priority = "Low";
					}else if ($value->ticket_priority == 2) 
					{
					$priority = "Medium";
					}else if ($value->ticket_priority == 3) 
					{
					$priority = "High";
					}else{
					$priority = "critical";
					}
						$sqlarray[$m]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$m]['type'] = 'Complain';
						$sqlarray[$m]['description'] = $description;
						$sqlarray[$m]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$m]['request_id'] = $value->ticket_id;
						$sqlarray[$m]['leave_type'] = "";
						$sqlarray[$m]['subject'] = $value->subject;
						$sqlarray[$m]['priority'] = $priority;
						$sqlarray[$m]['travlerDateFrom'] = "";
						$sqlarray[$m]['travlerDateTo'] = "";
						$sqlarray[$m]['locationTo'] = "";
						$sqlarray[$m]['locationFrom'] = "";
						$sqlarray[$m]['departmentFrom'] = "";
						$sqlarray[$m]['departmentTo'] = "";
						$sqlarray[$m]['designationFrom'] = "";
						$sqlarray[$m]['designationTo'] = "";
						$sqlarray[$m]['from'] = "";
						$sqlarray[$m]['to'] = "";
						$sqlarray[$m]['project'] = "";

                   	  

					 $m++;

				}	
			}
			 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
			$output["object"]= $sqlarray;
					
				}else if ($search == 'ProjectQuery') 
				{
					//******************project Query******************
			$sql = "select hrms_tasks_query.*,hrms_employees.first_name,hrms_employees.last_name,hrms_projects.title from hrms_tasks_query INNER join hrms_employees on hrms_employees.user_id = hrms_tasks_query.employee_id inner join hrms_projects on hrms_projects.project_id = hrms_tasks_query.task_id where hrms_tasks_query.status = 1 and hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			$n=0;
			$sqlarray = array();
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					

						$sqlarray[$n]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$n]['type'] = 'Project Query';
						$sqlarray[$n]['description'] = $value->query;
						$sqlarray[$n]['date'] = date('d-M-Y', strtotime($value->query_date));
						$sqlarray[$n]['request_id'] = $value->tasks_query_id;
						$sqlarray[$n]['leave_type'] = "";
						$sqlarray[$n]['project'] = $value->title;
						$sqlarray[$n]['subject'] = "";
						$sqlarray[$n]['priority'] = "";
						$sqlarray[$n]['travlerDateFrom'] = "";
						$sqlarray[$n]['travlerDateTo'] = "";
						$sqlarray[$n]['locationTo'] = "";
						$sqlarray[$n]['locationFrom'] = "";
						$sqlarray[$n]['departmentFrom'] = "";
						$sqlarray[$n]['departmentTo'] = "";
						$sqlarray[$n]['designationFrom'] = "";
						$sqlarray[$n]['designationTo'] = "";
						$sqlarray[$n]['from'] = "";
						$sqlarray[$n]['to'] = "";

                   	  

					 $n++;

				}
				}
				 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
				$output["object"]= $sqlarray;
					
				}else if($search == "NoWork") 
				{
					//***************have Work*********			
			$sql = "select hrms_employee_have_work.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_have_work INNER join hrms_employees on hrms_employees.user_id = hrms_employee_have_work.employee_id  where hrms_employee_have_work.status = 1 and hrms_employees.head_employee=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			$o=0;
			$sqlarray = array();
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					

						$sqlarray[$o]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$o]['type'] = 'No Work';
						$sqlarray[$o]['description'] = "No Work";
						$sqlarray[$o]['date'] = date('d-M-Y', strtotime($value->work_date));
						$sqlarray[$o]['request_id'] = $value->have_word_id;
						$sqlarray[$o]['leave_type'] = "";
						$sqlarray[$o]['project'] = "";
						$sqlarray[$o]['subject'] = "";
						$sqlarray[$o]['priority'] = "";
						$sqlarray[$o]['travlerDateFrom'] = "";
						$sqlarray[$o]['travlerDateTo'] = "";
						$sqlarray[$o]['locationTo'] = "";
						$sqlarray[$o]['locationFrom'] = "";
						$sqlarray[$o]['departmentFrom'] = "";
						$sqlarray[$o]['departmentTo'] = "";
						$sqlarray[$o]['designationFrom'] = "";
						$sqlarray[$o]['designationTo'] = "";
						$sqlarray[$o]['from'] = "";
						$sqlarray[$o]['to'] = "";
					 $o++;

				}
					
			}
			 $sqlarray = array_slice( $sqlarray, $per_page, $end_limit );
			$output["object"]= $sqlarray;
				}

			}


		
	if (!empty($output)) 
			{

				$output['success'] = 1;
				$output['msg'] = 'success';
				$this->encode_data($output);	
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No data';
				$this->encode_data($output);
			}

		}
		
	}
//*****************Accept Reject Request**********	
//http://192.168.1.118/hrms/Api/acceptRejectRequest?request_id=1&request_type=Prmotion&status=2	
	function acceptRejectRequest()
	{
	$output=array();

		if(!$this->input->get_post('request_id') || !$this->input->get_post('request_type') || !$this->input->get_post('status'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->encode_data($output);

		}
		else
		{
			$requestType= $this->input->get_post('request_type');
			$request_id = $this->input->get_post('request_id');
			$status 	= $this->input->get_post('status');
			$comment 	= $this->input->get_post('comment');
//****Leave*** 
			if ($requestType == 'Leave') 
			{
				$getData = $this->api_model->getSingle('hrms_leave_applications' ,array('leave_id'=>$this->input->get_post('request_id')));
				if (!empty($getData)) 
				{
					$update_data = array(
						'status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'remarks' => $comment
						);
					$where = array('leave_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_leave_applications',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****Transfer*** 				
			}else if ($requestType == 'Transfer') 
			{
				$getData = $this->api_model->getSingle('hrms_employee_transfer' ,array('transfer_id'=>$this->input->get_post('request_id')));
					if (!empty($getData)) 
				{
					$update_data = array(
						'status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'comment' => $comment
						);
					$where = array('transfer_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_employee_transfer',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****Prmotion*** 				
			}else if ($requestType == 'Prmotion') 
			{
				$getData = $this->api_model->getSingle('hrms_employee_promotions' ,array('promotion_id'=>$this->input->get_post('request_id')));
					if (!empty($getData)) 
				{
					$update_data = array(
						'status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'comment' => $comment
						);
					$where = array('promotion_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_employee_promotions',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****Travler*** 				
			}else if ($requestType == 'Travler') 
			{
				$getData = $this->api_model->getSingle('hrms_employee_travels' ,array('travel_id'=>$this->input->get_post('request_id')));
					if (!empty($getData)) 
				{
					$update_data = array(
						'status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'comment' => $comment
						);
					$where = array('travel_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_employee_travels',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****Ticketing*** 				
			}else if ($requestType == 'Complain') 
			{
				$getData = $this->api_model->getSingle('hrms_support_tickets' ,array('ticket_id'=>$this->input->get_post('request_id')));
					if (!empty($getData)) 
				{
					//print_r($getData);die();
					$update_data = array(
						'ticket_status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'comment' => $comment
						);
					$where = array('ticket_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_support_tickets',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****Project Query*** 				
			}else if ($requestType == 'ProjectQuery') 
			{
				$getData = $this->api_model->getSingle('hrms_tasks_query' ,array('tasks_query_id'=>$this->input->get_post('request_id')));
					if (!empty($getData)) 
				{
					//print_r($getData);die();
					$update_data = array(
						'status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'comment' => $comment
						);
					$where = array('tasks_query_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_tasks_query',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****No Work*** 				
			}else if ($requestType == 'NoWork') 
			{
				$getData = $this->api_model->getSingle('hrms_employee_have_work' ,array('have_word_id'=>$this->input->get_post('request_id')));
					if (!empty($getData)) 
				{
					$update_data = array(
						'status' => $status,
						'modified_at' => date('Y-m-d H:i:s'),
						'comment' => $comment
						);
					$where = array('have_word_id'=>$this->input->get_post('request_id'));
					$this->api_model->update_data('hrms_employee_have_work',$where, $update_data);
					$output["success"] = "1";
					$output["msg"] = 'status Change Successfully';
				}else{
					$output['success'] = 0;
					$output['msg'] = 'Id not found';
				}
//****Wrong Request***				
			}else{
			$output['success'] = 0;
			$output['msg'] = 'wrong request type';
			}
			$this->encode_data($output);
		}
	}

//************Request History***************
//http://192.168.1.118/hrms/Api/requestHistory?user_id=5	
function requestHistory()
{
		$output = array();
		if(!$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';
			$this->encode_data($output);

		}
		else
		{

//******************************************Leave*************************************************
			$sql = "select hrms_leave_applications.*,hrms_employees.first_name,hrms_employees.last_name from hrms_leave_applications INNER join hrms_employees on hrms_employees.user_id = hrms_leave_applications.employee_id where  hrms_leave_applications.status !='1' AND hrms_employees.user_id=".$this->input->get_post('user_id');
			$getLeaveData = $this->api_model->select_multiple_row($sql);
			$i=0;
			if (!empty($getLeaveData)) {
				$sqlarray = array();
				
				foreach ($getLeaveData as $value) 
				{
					 if ($value->reason == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->reason;
					 }
 //*****status**** 
					if ($value->status == "2") 
					{
					$status = "Approve";
					}else if ($value->status == "3") 
					{
					$status = "Rejected";
					} else{
					$status = "";
					}

//****comment*** 
					if ($value->remarks == "") 
					{
					$comment = "";
					} else{
					$comment = $value->remarks;
					}
						$sqlarray[$i]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$i]['type'] = 'Leave';
					 	$sqlarray[$i]['description'] = $description;
						$sqlarray[$i]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$i]['request_id'] = $value->leave_id;

						$sqlarray[$i]['status'] = $status;
						$sqlarray[$i]['comment'] = $comment;

						$sqlarray[$i]['from'] = $value->from_date;
						$sqlarray[$i]['to'] = $value->to_date;
						$sqlarray[$i]['project'] = "";
						$sqlarray[$i]['subject'] = "";
						$sqlarray[$i]['priority'] = "";
						$sqlarray[$i]['travlerDateFrom'] = "";
						$sqlarray[$i]['travlerDateTo'] = "";
						$sqlarray[$i]['locationTo'] = "";
						$sqlarray[$i]['locationFrom'] = "";
						$sqlarray[$i]['departmentFrom'] = "";
						$sqlarray[$i]['departmentTo'] = "";
						$sqlarray[$i]['designationFrom'] = "";
						$sqlarray[$i]['designationTo'] = "";
						
					 $i++;

				}
				$j = $i;
				    
					$output["object"]= $sqlarray;
					
			}else{$j = $i;}
//**************************************Transfer***********************
			$sql = "select hrms_employee_transfer.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_transfer INNER join hrms_employees on hrms_employees.user_id = hrms_employee_transfer.employee_id where  hrms_employee_transfer.status !='0' AND hrms_employees.user_id=".$this->input->get_post('user_id');

			
			$getTransferData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTransferData)) {
				

				foreach ($getTransferData as $value) 
				{
//**Designation From 
					$getDesignationFrom = $this->api_model->getSingle('hrms_designations',array('designation_id'=>$value->designation_from));

// ***Designation To
					$getDesignationTo   = $this->api_model->getSingle('hrms_designations',array('designation_id'=>$value->designation_to));
//***Department from
					$getDepartmentFrom  = $this->api_model->getSingle('hrms_departments',array('department_id'=>$value->department_from));
// **Department to
					$getDepartmentTo    = $this->api_model->getSingle('hrms_departments',array('department_id'=>$value->transfer_department));
//**Location From
					$getLocationFrom    = $this->api_model->getSingle('hrms_office_location',array('location_id'=>$value->transferfrom));
//**Location To
					$getLocationTo      = $this->api_model->getSingle('hrms_office_location',array('location_id'=>$value->transfer_location));

//Loc from
					if ($getLocationFrom->location_name != "")
					  {
					 	$locFrom = $getLocationFrom->location_name;
					  }else{
					  	$locFrom = "";
					  }
//loc to
					  if ($getLocationTo->location_name != "")
					  {
					 	$locTo = $getLocationTo->location_name;
					  }else{
					  	$locTo = "";
					  }
// department From
					  if ($getDepartmentFrom->department_name != "")
					  {
					 	$depFrom = $getDepartmentFrom->department_name;
					  }else{
					  	$depFrom = "";
					  }
// Department to
					  if ($getDepartmentTo->department_name != "")
					  {
					 	$depTo = $getDepartmentTo->department_name;
					  }else{
					  	$depTo = "";
					  }
//des from
					  if ($getDesignationFrom->designation_name != "")
					  {
					 	$desFrom = $getDesignationFrom->designation_name;
					  }else{
					  	$desFrom = "";
					  }
// Des to
					  if ($getDesignationTo->designation_name != "")
					  {
					 	$desto =  $getDesignationTo->designation_name;
					  }else{
					  	$desto =  "";
					  }

					   if (empty($value->description)) 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
//*****status**** 
					if ($value->status == "1") 
					{
					$status = "Approved";
					}else if ($value->status == "2") 
					{
					$status = "Rejected";
					} else{
					$status = "";
					}

//****comment*** 
					if ($value->comment == "") 
					{
					$comment = "";
					} else{
					$comment = $value->comment;
					}

						$sqlarray[$j]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$j]['type'] = 'Transfer';
						$sqlarray[$j]['description'] = $description;
						$sqlarray[$j]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$j]['request_id'] = $value->transfer_id;
						$sqlarray[$j]['status'] = $status;
						$sqlarray[$j]['comment'] = $comment;

						$sqlarray[$j]['locationFrom'] = $locFrom;
						$sqlarray[$j]['locationTo'] = $locTo;
						$sqlarray[$j]['departmentFrom'] = $depFrom;
						$sqlarray[$j]['departmentTo'] = $depTo;
						$sqlarray[$j]['designationFrom'] = $desFrom;
						$sqlarray[$j]['designationTo'] = $desto;
						$sqlarray[$j]['from'] = "";
						$sqlarray[$j]['to'] = "";
						$sqlarray[$j]['project'] = "";
						$sqlarray[$j]['subject'] = "";
						$sqlarray[$j]['priority'] = "";
						$sqlarray[$j]['travlerDateFrom'] = "";
						$sqlarray[$j]['travlerDateTo'] = "";

					 $j++;
				}
					$k = $j;
					$output["object"]= $sqlarray;
					
			}else{$k = $j;}
//********************************************Prmotion********************************************

		$sql = "select hrms_employee_promotions.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_promotions INNER join hrms_employees on hrms_employees.user_id = hrms_employee_promotions.employee_id where  hrms_employee_promotions.status !='0' AND hrms_employees.user_id=".$this->input->get_post('user_id');

			$getPrmotionData = $this->api_model->select_multiple_row($sql);
			if (!empty($getPrmotionData)) {
				
				
				foreach ($getPrmotionData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
 //*****status**** 
					if ($value->status == "1") 
					{
					$status = "Approved";
					}else if ($value->status == "2") 
					{
					$status = "Rejected";
					} else{
					$status = "";
					}

//****comment*** 
					if ($value->comment == "") 
					{
					$comment = "";
					} else{
					$comment = $value->comment;
					}
						$sqlarray[$k]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$k]['type'] = 'Prmotion';
						$sqlarray[$k]['description'] = $description;
						$sqlarray[$k]['date'] =date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$k]['request_id'] = $value->promotion_id;
						$sqlarray[$k]['status'] = $status;
						$sqlarray[$k]['comment'] = $comment;

						$sqlarray[$k]['locationFrom'] = "";
						$sqlarray[$k]['locationTo'] = "";
						$sqlarray[$k]['departmentFrom'] = "";
						$sqlarray[$k]['departmentTo'] = "";
						$sqlarray[$k]['designationFrom'] = "";
						$sqlarray[$k]['designationTo'] = "";
						$sqlarray[$k]['from'] = "";
						$sqlarray[$k]['to'] = "";
						$sqlarray[$k]['project'] = "";
						$sqlarray[$k]['subject'] = "";
						$sqlarray[$k]['priority'] = "";
						$sqlarray[$k]['travlerDateFrom'] = "";
						$sqlarray[$k]['travlerDateTo'] = "";
                   	  

					 $k++;

				}
				$l = $k;
				    
					$output["object"]= $sqlarray;
					
			}else{$l = $k;}
//*********************************************Travel********************************
$sql = "select hrms_employee_travels.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_travels INNER join hrms_employees on hrms_employees.user_id = hrms_employee_travels.employee_id where  hrms_employee_travels.status !='0' AND hrms_employees.user_id=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
 //*****status**** 
					if ($value->status == "1") 
					{
					$status = "Approved";
					}else if ($value->status == "2") 
					{
					$status = "Rejected";
					} else{
					$status = "";
					}

//****comment*** 
					if ($value->comment == "") 
					{
					$comment = "";
					} else{
					$comment = $value->comment;
					}					 
						$sqlarray[$l]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$l]['type'] = 'Travler';
						$sqlarray[$l]['description'] = $description;
						$sqlarray[$l]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$l]['request_id'] = $value->travel_id;
						$sqlarray[$l]['status'] = $status;
						$sqlarray[$l]['comment'] = $comment;

						$sqlarray[$l]['travlerDateFrom'] = $value->start_date;
						$sqlarray[$l]['travlerDateTo'] = $value->end_date;
						$sqlarray[$l]['locationTo'] = $value->visit_place;
						$sqlarray[$l]['project'] = "";
						$sqlarray[$l]['subject'] = "";
						$sqlarray[$l]['priority'] = "";
						$sqlarray[$l]['locationFrom'] = "";
						$sqlarray[$l]['departmentFrom'] = "";
						$sqlarray[$l]['departmentTo'] = "";
						$sqlarray[$l]['designationFrom'] = "";
						$sqlarray[$l]['designationTo'] = "";
						$sqlarray[$l]['from'] = "";
						$sqlarray[$l]['to'] = "";

                   	  

					 $l++;

				}
				$m = $l;
				    
					$output["object"]= $sqlarray;
					
			}else{$m = $l;}

//******************************Tickiting**********************************
			$sql = "select hrms_support_tickets.*,hrms_employees.first_name,hrms_employees.last_name from hrms_support_tickets INNER join hrms_employees on hrms_employees.user_id = hrms_support_tickets.employee_id where  hrms_support_tickets.ticket_status !='1' AND hrms_employees.user_id=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					  if ($value->description == "") 
					 {
					 	$description = "";
					 }else{
					 	$description = $value->description;
					 }
 //priority******

					if ($value->ticket_priority == "") 
					{
					$priority = "";
					}else if ($value->ticket_priority == 1) 
					{
					$priority = "Low";
					}else if ($value->ticket_priority == 2) 
					{
					$priority = "Medium";
					}else if ($value->ticket_priority == 3) 
					{
					$priority = "High";
					}else{
					$priority = "critical";
					}
 //*****status**** 
					if ($value->ticket_status  == "2") 
					{
					$status = "Close";
					}else{
					$status = "";
					}

//****comment*** 
					if ($value->comment == "") 
					{
					$comment = "";
					} else{
					$comment = $value->comment;
					}					
						$sqlarray[$m]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$m]['type'] = 'Complain';
						$sqlarray[$m]['description'] = $description;
						$sqlarray[$m]['date'] = date('d-M-Y', strtotime($value->created_at));
						$sqlarray[$m]['request_id'] = $value->ticket_id;
						$sqlarray[$m]['status'] = $status;
						$sqlarray[$m]['comment'] = $comment;

						$sqlarray[$m]['subject'] = $value->subject;
						$sqlarray[$m]['priority'] = $priority;
						$sqlarray[$m]['travlerDateFrom'] = "";
						$sqlarray[$m]['travlerDateTo'] = "";
						$sqlarray[$m]['locationTo'] = "";
						$sqlarray[$m]['locationFrom'] = "";
						$sqlarray[$m]['departmentFrom'] = "";
						$sqlarray[$m]['departmentTo'] = "";
						$sqlarray[$m]['designationFrom'] = "";
						$sqlarray[$m]['designationTo'] = "";
						$sqlarray[$m]['from'] = "";
						$sqlarray[$m]['to'] = "";
						$sqlarray[$m]['project'] = "";

                   	  

					 $m++;

				}
				$n = $m;
				    
					$output["object"]= $sqlarray;
					
			}else{$n = $m;}
//****************************project Query*****************************
			$sql = "select hrms_tasks_query.*,hrms_employees.first_name,hrms_employees.last_name,hrms_projects.title from hrms_tasks_query INNER join hrms_employees on hrms_employees.user_id = hrms_tasks_query.employee_id inner join hrms_projects on hrms_projects.project_id = hrms_tasks_query.task_id where hrms_tasks_query.status != 1 and hrms_employees.user_id=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					
 //*****status**** 
					if ($value->status == "2") 
					{
					$status = "Close";
					}else{
					$status = "";
					}

//****comment*** 
					if ($value->comment == "") 
					{
					$comment = "";
					} else{
					$comment = $value->comment;
					}	
						$sqlarray[$n]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$n]['type'] = 'Project Query';
						$sqlarray[$n]['description'] = $value->query;
						$sqlarray[$n]['date'] = date('d-M-Y', strtotime($value->query_date));
						$sqlarray[$n]['request_id'] = $value->tasks_query_id;
						$sqlarray[$n]['status'] = $status;
						$sqlarray[$n]['comment'] = $comment;

						$sqlarray[$n]['project'] = $value->title;
						$sqlarray[$n]['subject'] = "";
						$sqlarray[$n]['priority'] = "";
						$sqlarray[$n]['travlerDateFrom'] = "";
						$sqlarray[$n]['travlerDateTo'] = "";
						$sqlarray[$n]['locationTo'] = "";
						$sqlarray[$n]['locationFrom'] = "";
						$sqlarray[$n]['departmentFrom'] = "";
						$sqlarray[$n]['departmentTo'] = "";
						$sqlarray[$n]['designationFrom'] = "";
						$sqlarray[$n]['designationTo'] = "";
						$sqlarray[$n]['from'] = "";
						$sqlarray[$n]['to'] = "";

                   	  

					 $n++;

				}
				$o = $n;
				    
					$output["object"]= $sqlarray;
					
			}else{$o = $n;}
//**************************have Work****************************			
			$sql = "select hrms_employee_have_work.*,hrms_employees.first_name,hrms_employees.last_name from hrms_employee_have_work INNER join hrms_employees on hrms_employees.user_id = hrms_employee_have_work.employee_id  where hrms_employee_have_work.status != 1 and hrms_employees.user_id=".$this->input->get_post('user_id');

			$getTravelData = $this->api_model->select_multiple_row($sql);
			if (!empty($getTravelData)) {
				
				
				foreach ($getTravelData as $value) 
				{
					
 //*****status**** 
					if ($value->status == "2") 
					{
					$status = "Close";
					}else{
					$status = "";
					}

//****comment*** 
					if ($value->comment == "") 
					{
					$comment = "";
					} else{
					$comment = $value->comment;
					}	
						$sqlarray[$o]['name'] = $value->first_name.' '.$value->last_name;
						$sqlarray[$o]['type'] = 'No Work';
						$sqlarray[$o]['description'] = "No Work";
						$sqlarray[$o]['date'] = date('d-M-Y', strtotime($value->work_date));
						$sqlarray[$o]['request_id'] = $value->have_word_id;
						$sqlarray[$o]['status'] = $status;
						$sqlarray[$o]['comment'] = $comment;

						$sqlarray[$o]['project'] = "";
						$sqlarray[$o]['subject'] = "";
						$sqlarray[$o]['priority'] = "";
						$sqlarray[$o]['travlerDateFrom'] = "";
						$sqlarray[$o]['travlerDateTo'] = "";
						$sqlarray[$o]['locationTo'] = "";
						$sqlarray[$o]['locationFrom'] = "";
						$sqlarray[$o]['departmentFrom'] = "";
						$sqlarray[$o]['departmentTo'] = "";
						$sqlarray[$o]['designationFrom'] = "";
						$sqlarray[$o]['designationTo'] = "";
						$sqlarray[$o]['from'] = "";
						$sqlarray[$o]['to'] = "";

                   	  

					 $o++;

				}
				$p = $o;
				    
					$output["object"]= $sqlarray;
					
			}else{$p = $o;}

		
	if (!empty($output)) 
			{
				$output['success'] = 1;
				$output['msg'] = 'success';
				$this->encode_data($output);	
			}else{
				$output['success'] = 0;
				$output['msg'] = 'No data';
				$this->encode_data($output);
			}

		}
		
}		
//****************login old*************************
	function loginOld()
	{
		$output=array();

		if(!$this->input->get_post('username') || !$this->input->get_post('password') || !$this->input->get_post('device_id') || !$this->input->get_post('device_type'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{

			$user_data = $this->api_model->getSingle('hrms_employees', array('username'=>$this->input->get_post('username'), 'password'=>$this->input->get_post('password'), 'is_active'=>1));

			if(empty($user_data))
			{
				$output['success'] = 0;
				$output['msg'] = 'Please enter correct username or password';
			}
			else
			{
				$output["object"]['last_login'] = date('d-M-Y h:i a', strtotime($user_data->last_login_date));
				$update_data = array(
					'device_id'=>$this->input->get_post('device_id'),
					'device_type'=>$this->input->get_post('device_type'),
					'last_login_date'=>date('Y-m-d H:i:s'),
					);

				$this->api_model->update_data('hrms_employees', array('user_id'=>$user_data->user_id), $update_data);

				$output["msg"] = 'Login Successfully';
				$output["success"] = "1";
				$output["object"]['user_id'] = $user_data->user_id;
				$output["object"]['fname'] = $user_data->first_name;
				$output["object"]['lname'] = $user_data->last_name;
				$output["object"]['email'] = $user_data->email;		      
				$output["object"]['is_verify'] = $user_data->is_active;
				$output["object"]['check_status'] = '1';

				$history = [
					"employee_id" => $user_data->user_id,
					"access_id" => 0,
					"action" => 'Processed',
					"access_type" => 'Login',
					"access" => '<p><a href="'.site_url('employees/detail/'.$user_data->user_id).'"><strong>'.$user_data->first_name.' '.$user_data->last_name.'</strong> logged in.</a></p>',
					"created_at" => date('Y-m-d H:i:s'),
				];

				$this->accessHistory($history);

			}

		}

		$this->encode_data($output);
	}

//**************ticketing add comment**************
	//http://192.168.1.118/hrms/Api/addTicketComment?user_id=49&ticket_id=27&comment=%27hii
	public function addTicketComment()
	{
		$output=array();

		if(!$this->input->get_post('ticket_id') || !$this->input->get_post('comment') || !$this->input->get_post('user_id'))
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$insert_data = array(
				'ticket_id' => $this->input->get_post('ticket_id'),
				'ticket_comments' => $this->input->get_post('comment'),
				'user_id' => $this->input->get_post('user_id'),
				'created_at' => date('d-m-Y h:i:s')
				);
			$this->api_model->insert_data('hrms_tickets_comments', $insert_data);
			$output['success'] = 1;
			$output['msg'] = 'comment add successfully';
			
		}
		$this->encode_data($output);
	}

	//**************ticketing add comment**************
	//http://192.168.1.118/hrms/Api/ticketCommentList?ticket_id=27
	public function ticketCommentList()
	{
		$output=array();

		if(!$this->input->get_post('ticket_id') )
		{
			$output['success'] = 0;
			$output['msg'] = 'Check Parameter';

		}
		else
		{
			$getCommentList = $this->api_model->select_multiple_row("select `hrms_tickets_comments`.`ticket_comments`,`hrms_employees`.`first_name`,`hrms_tickets_comments`.`created_at`,`hrms_employees`.`last_name` from hrms_tickets_comments inner join  hrms_employees on `hrms_employees`.`user_id` = `hrms_tickets_comments`.`user_id` where hrms_tickets_comments.ticket_id ='".$this->input->get_post('ticket_id')."' order by  hrms_tickets_comments.created_at desc");
			if (!empty($getCommentList))
			{
				$output['success'] = 1;
				$output['msg'] = 'success';

				$sqlarray = array();
				$i=0;
				foreach ($getCommentList as  $value) 
				{
					$sqlarray[$i]['user'] = $value->first_name.' '.$value->last_name;
					$sqlarray[$i]['comment'] = $value->ticket_comments;
					$sqlarray[$i]['date'] = $value->created_at;


					 $i++;
				}
				$output["object"]= $sqlarray;
			}else
			{
				$output['success'] = 0;
				$output['msg'] = 'No Data';
			}
			
			
		}
		$this->encode_data($output);
	}
// *************print output **********************
	public function output( $response = '' )
	{
		$response = $this->checkNull( $response );
		echo json_encode($response);
	}

	public function checkNull($array='')
	{

		$resposeArray = array();

		if( is_array($array) || is_object( $array ) ){

			foreach ($array as $key2 => $array2) {

				if( is_array($array2) || is_object( $array2 ) ){

					foreach ($array2 as $key3 => $array3) {

						if( is_array($array3) || is_object( $array3 ) ){

							foreach ($array3 as $key => $val) {

								$value = (empty($val)) ? "" : $val;
								$resposeArray[$key2][$key3][$key] = $value;

							}

						} else {

							$value = (empty($array3)) ? "" : $array3;
							$resposeArray[$key2][$key3] = $value;

						}

					}

				} else {

					$value = (empty($array2)) ? "" : $array2;
					$resposeArray[$key2] = $value;

				}

			}

		} else {
			$respose = 'error';
		}

		return $resposeArray;
	}


}

?>