<?php
class CommonModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
// 		$this->load->library( 'Utility' );
	}

	//fetch all data api
	public function selectResultData($table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		return $this->db->get()->result_array();
	}

	//select all data asc
	public function selectAllResultData($table)
	{
		$this->db->select('*')
		->from($table);
		return $this->db->get()->result_array();
	}
//     public function updateRowByCondition($condition,$table,$data)
// 	{  
// 		//echo $this->email->print_debugger();
// 		return $this->db->update($table, $data , $condition);
// 	}
	//update condition api
// 	public function updateRow($table,$data)
// 	{  
// 		//echo $this->email->print_debugger();
// 		return $this->db->update($table, $data);
// 	}
	public function countData($table)
	{
		return $this->db->count_all_results($table);
	}
	public function countDataWithCondition($table,$condition)
	{
		return $this->db->where($condition)->from($table)->count_all_results();
	}
	public function totalColumnSumWithCondition($table,$condition,$param)
	{
		$this->db->select('SUM('.$param.') as rate');
        $this->db->from($table);
        $result = $this->db->get()->row();
        // return $this->db->last_query();
        return $result;
	}

	//check condition api
	public function selectRowDataByCondition($condition,$table)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		return $this->db->get()->row();
	}
	//check condition api
	public function selectRowDataByConditionAndFieldName($condition,$table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		$this->db->order_by($fieldName, "desc")->limit(1);
		return $this->db->get()->row();
	}
	
	//get all data with where condition api
	public function selectResultDataByCondition($condition,$table)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}

	public function selectResultDataByCondition1($condition,$table)
	{
		// print_r($condition);
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		$data = $this->db->get();
		// print_r($data);
		if (!empty($data->result_array())) {
			return $data->result_array();
		}
	}
	
	//get all data with where condition api
	public function selectResultDataByConditionAndFieldName($condition,$table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}

	//insert api
	public function insertData($data,$table)
	{
		$result = $this->db->insert($table, $data);
		if( $result != FALSE )
		{
			return $data;
		}
		else
		{
			return FALSE;
		} 	
	}

	//update condition api
	public function updateRowByCondition($condition,$table,$data)
	{  
		//echo $this->email->print_debugger();
		return $this->db->update($table, $data , $condition);
	}
	//update condition api
	public function updateRow($table,$data)
	{  
		//echo $this->email->print_debugger();
		return $this->db->update($table, $data);
	}

	public function update_entry($table,$data,$where)
	{
	    $this->db->where($where);
	    $query = $this->db->update($table,$data);
	    return $this->db->affected_rows();
	}
	
   public function sendMail1($data)
   {
   	// print_r($data);exit;
   	    $this->email->initialize(array(
			'protocol' 	=> 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_user' => 'neeteshagrawal',
			'smtp_pass' => 'neetesh@12345',
			'smtp_port' => 587,
			'crlf' 		=> "\r\n",
			'mailtype' 	=> "html",
			'charset' 	=> "iso-8859-1",
			'newline' 	=> "\r\n"
		));

		$this->email->from('info@pueodj.com', 'Pueo Dj');
		$this->email->to($data['to']);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		if($this->email->send())
		{
			return 1;
		}else{
			return 0;
		}
   	}


   	public function sendMail($to,$subject,$message,$options = array())
    {
    	// print_r($to);die;
        $this->load->library('email');
        $config = array (
		        'mailtype' => 'html',
		        'charset'  => 'utf-8',
		        'priority' => '1'
	      	);

        $this->email->initialize($config);
		if (isset($options['fromEmail']) && isset($options['fromName'])) 
		{
			$this->email->from($options['fromEmail'], $options['fromName']);  
		}
		else
		{
			$this->email->from('info@sliceledger.com', 'DJ');         
        }

		$this->email->to($to);

		if(isset($options['replyToEmail']) && isset($options['replyToName']))
		{
			$this->email->reply_to($options['replyToEmail'],$options['replyToName']);
		}

	    $this->email->subject($subject);
	    $this->email->message($message);

     // echo $message;die();

        if($this->email->send())
        {
            return true;
        }else
        {
            return false;
        }
    } 
	//delete api
	public function delete($condition,$table)
	{
		$this->db->where($condition);
		return $this->db->delete($table);
	}

    public function getsingle($table,$where)
    {
        $this->db->where($where);
        $data = $this->db->get($table);
        $get = $data->row();
         
        $num = $data->num_rows();
        
        if($num)
        {
          return $get;
        }
        else
        {
          return false;
        }
    }
    
    public function select_single_row($sql)
    {
        $res= $this->db->query($sql);
        return $res->row();
    }
    

    public function getReport($client_name,$project_name,$task_id,$employee)
    {
       
        $this->db->select("hrms_task_employee.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_employees.first_name,hrms_employees.last_name")
    		->from('hrms_task_employee')
    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left');

		if(!empty($client_name)){
			$this->db->where(array("hrms_task_employee.client_name" => $client_name));
		}

		if(!empty($project_name)){
			$this->db->where(array("hrms_task_employee.project_name" => $project_name));
		}

		if(!empty($task_id)){
			$this->db->where(array("hrms_task_employee.task_id" => $task_id));
		}

		if(!empty($employee)){
			$this->db->where(array("hrms_task_employee.employee" => $employee));
		}

		$this->db->order_by("hrms_task_employee.id", "desc");

		return $this->db->get()->result_array();
	}



	public function getTimesheetReport($client_name,$project_name,$task_id,$employee,$task_status,$approved_status,$start_date,$end_date)
    {
    	// print_r($approved_status);

        $this->db->select("employee_resources.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_employees.first_name,hrms_employees.last_name,hrms_employees.email as employee_email,hrms_tasks.task_status,hrms_task_employee.cost")
    		->from('employee_resources')
    		->join('hrms_tasks','hrms_tasks.task_id = employee_resources.task_id','left')
    		->join('hrms_employees','hrms_employees.user_id = employee_resources.employee_id','left')
    		->join('add_client','add_client.id = employee_resources.company_id','left')
    		->join('add_project','add_project.id = employee_resources.project_id','left')
    		->join('hrms_task_employee','hrms_task_employee.task_id = employee_resources.task_id','left');

		if(!empty($client_name)){
			$this->db->where(array("employee_resources.company_id" => $client_name));
		}

		if(!empty($project_name)){
			$this->db->where(array("employee_resources.project_id" => $project_name));
		}

		if(!empty($task_id)){
			$this->db->where(array("employee_resources.task_id" => $task_id));
		}

		if(!empty($employee)){
			$this->db->where(array("employee_resources.employee_id" => $employee));
		}

		if(!empty($task_status)){
			$this->db->where(array("hrms_tasks.task_status" => $task_status));
		}

		
		if($approved_status != 'ALL'){
			if($approved_status == 0)
			{
				$this->db->where(array("employee_resources.approved_status" => 0));
			}

			if($approved_status == 1)
			{
				$this->db->where(array("employee_resources.approved_status" => 1));
			}

			if($approved_status == 2)
			{
				$this->db->where(array("employee_resources.approved_status" => 2));
			}

			if($approved_status == 3)
			{
				$this->db->where(array("employee_resources.approved_status" => 3));
			}
		}
		
		

		if(!empty($start_date)){
	      $this->db->where(array("employee_resources.date <=" => $start_date));
	    }

	    if(!empty($end_date)){
	      $this->db->where(array("employee_resources.date >=" => $end_date));
	    }

		$this->db->order_by("employee_resources.id", "desc")
			->group_by("employee_resources.date");

		return $this->db->get()->result_array();
	}

	

	public function getTask($employee_id)
    {
        // print_r($task_id);die;
        
        if(empty($employee_id))
    	{
	        $this->db->select("hrms_task_employee.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_tasks.task_code,hrms_employees.first_name,hrms_employees.last_name,add_project.id as add_project_id")
	    		->from('hrms_task_employee')
	    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
	    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
			    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
	    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
	    		->where(array("hrms_task_employee.is_delete" => 0))
				->order_by("hrms_task_employee.id", "desc");
		}else{
			$this->db->select("hrms_task_employee.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_tasks.task_code,hrms_employees.first_name,hrms_employees.last_name,add_project.id as add_project_id")
	    		->from('hrms_task_employee')
	    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
	    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
			    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
	    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
	    		->where(array("hrms_task_employee.employee" => $employee_id))
	    		->where(array("hrms_task_employee.is_delete" => 0))
				->order_by("hrms_task_employee.id", "desc");
		}

		return $this->db->get()->result_array();
	}


    
    public function getEmployeeTask($task_id)
    {
        // print_r($task_id);die;
        
        $this->db->select("hrms_task_employee.*,hrms_employees.first_name,hrms_employees.last_name")
    		->from('hrms_task_employee')
    		// ->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		// ->join('vendor','vendor.id = hrms_task_employee.task_id','left')
    		// ->join('hrms_tasks','hrms_tasks.id = hrms_task_employee.project_name','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
			->where(array("hrms_task_employee.task_id" => $task_id))
			->order_by("hrms_task_employee.id", "desc");

		return $this->db->get()->result_array();
	}
    


    public function getEmployeeMyTask($employee_id)
    {
        
    	if(!empty($employee_id))
    	{
    		$this->db->select("employee_resources.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_tasks.task_code,hrms_employees.first_name,hrms_employees.last_name")
    		->from('employee_resources')
    		->join('add_client','add_client.id = employee_resources.company_id','left')
    		->join('add_project','add_project.id = employee_resources.project_id','left')
    		->join('hrms_tasks','hrms_tasks.task_id = employee_resources.task_id','left')
		    ->join('hrms_employees','hrms_employees.user_id = employee_resources.employee_id','left')
			->where(array("employee_resources.employee_id" => $employee_id))
			->order_by("employee_resources.id", "desc");

    	}else{

	        $this->db->select("employee_resources.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_tasks.task_code,hrms_employees.first_name,hrms_employees.last_name")
	    		->from('employee_resources')
	    		->join('add_client','add_client.id = employee_resources.company_id','left')
	    		->join('add_project','add_project.id = employee_resources.project_id','left')
	    		->join('hrms_tasks','hrms_tasks.task_id = employee_resources.task_id','left')
			    ->join('hrms_employees','hrms_employees.user_id = employee_resources.employee_id','left')
				// ->where(array("employee_resources.employee_id" => $employee_id))
				->order_by("employee_resources.id", "desc");
		}

		return $this->db->get()->result_array();
	}


	public function daywise($user_id,$today)
    {

        if(!empty($today))
        {
        	$this->db->select("hrms_task_employee.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_employees.first_name,hrms_employees.last_name")
    		->from('hrms_task_employee')
    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
		    ->where(array("hrms_task_employee.employee" => $user_id))
		     ->where('date(hrms_task_employee.created_at)', $today)
		     ->order_by("hrms_task_employee.id", "desc");
        }
        
		return $this->db->get()->result_array();
	}
    
    
    public function weeklywise($user_id,$today)
    {
        // print_r($task_id);die;

        // YEARWEEK(created_at) = YEARWEEK(NOW())

        if(!empty($today))
        {
        	$this->db->select("hrms_task_employee.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_employees.first_name,hrms_employees.last_name")
    		->from('hrms_task_employee')
    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
		    ->where(array("hrms_task_employee.employee" => $user_id))
		    // ->where('week(hrms_task_employee.created_at)',week(now()))
		     // week('hrms_task_employee.created_at')=week(now())

		     ->order_by("hrms_task_employee.id", "desc");
        }
        
		return $this->db->get()->result_array();
	}
	
		function getemployee_leavebalance($leave_id,$emp_name)
		{
		    
		   $this->db->select("hrms_leaves.*,hrms_employees.first_name,hrms_employees.last_name,SUM(number_days) as total_days")->from('hrms_leaves')->join('hrms_employees','hrms_employees.user_id = hrms_leaves.emp_name','left');
                        
			$where = '(leave="'.$leave_id.'" AND emp_name = "'.$emp_name.'")';
		 
          return  $this->db->where($where)->get()->row();
          
		}


	public function getEmployeeProject($employee_id)
    {
        // print_r($task_id);die;
        
        $this->db->select("hrms_task_employee.*,hrms_task_employee.project_name as project_id,hrms_employees.first_name,hrms_employees.last_name,add_project.project_name")
    		->from('hrms_task_employee')
    		// ->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		// ->join('vendor','vendor.id = hrms_task_employee.task_id','left')
    		// ->join('hrms_tasks','hrms_tasks.id = hrms_task_employee.project_name','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
		    ->join('add_project','add_project.id = hrms_task_employee.project_name','left')
			->where(array("hrms_task_employee.employee" => $employee_id))
			->order_by("hrms_task_employee.id", "desc");

		return $this->db->get()->result_array();
	}

	public function get_attendance($project_id,$task_id,$start,$end,$employee_id)
    {
        $this->db->select(" hrms_manumally_attendrance.*,hrms_employees.first_name,hrms_employees.last_name,add_project.project_name,hrms_tasks.task_name")
    		->from(' hrms_manumally_attendrance')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_manumally_attendrance.task_id','left')
		    ->join('hrms_employees','hrms_employees.user_id =  hrms_manumally_attendrance.employee_id','left')
		    ->join('add_project','add_project.id =  hrms_manumally_attendrance.project_id','left');
			// ->where(array(" hrms_manumally_attendrance.employee_id" => $employee_id));

		if(!empty($employee_id)){
			$this->db->where(array(" hrms_manumally_attendrance.employee_id" => $employee_id));
		}

		if(!empty($project_id)){
			$this->db->where(array(" hrms_manumally_attendrance.project_id" => $project_id));
		}

		if(!empty($task_id)){
			$this->db->where(array(" hrms_manumally_attendrance.task_id" => $task_id));
		}

		if(!empty($start)){
			$this->db->where(array(" hrms_manumally_attendrance.date <=" => $start));
		}

		if(!empty($end)){
			$this->db->where(array(" hrms_manumally_attendrance.date >=" => $end));
		}
		$this->db->order_by(" hrms_manumally_attendrance.id", "desc");


		return $this->db->get()->result_array();
	}

	
	public function getEmpProject($emp_name)
    {
    	$this->db->select("hrms_task_employee.*,hrms_task_employee.project_name as project_id,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_employees.first_name,hrms_employees.last_name")
			->from('hrms_task_employee')
			->join('add_client','add_client.id = hrms_task_employee.client_name','left')
			->join('add_project','add_project.id = hrms_task_employee.project_name','left')
			->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
		    ->where(array("hrms_task_employee.employee" => $emp_name))
		     ->order_by("hrms_task_employee.id", "desc");
     
        
		return $this->db->get()->result_array();
	}

	public function searchEmp($word)
    {

    	if(!empty($word))
    	{
    		$query = "SELECT hrms_employees.*, m.first_name as m_f_name, m.last_name as m_l_name from  hrms_employees LEFT JOIN hrms_employees m ON m.user_id =  hrms_employees.manager_id where  hrms_employees.user_role_id = 3 and hrms_employees.location LIKE '%".$word."%' OR hrms_employees.first_name LIKE '%".$word."%' OR hrms_employees.email LIKE '%".$word."%' OR hrms_employees.mobile_no = '".$word."' OR hrms_employees.employee_id = '".$word."' ORDER BY hrms_employees.user_id DESC";
    	
    	}else{
    		$query = "SELECT hrms_employees.*, m.first_name, m.last_name from  hrms_employees LEFT JOIN hrms_employees m ON m.user_id =  hrms_employees.manager_id where hrms_employees.user_role_id = 3 ORDER BY hrms_employees.user_id DESC";
    	
    	}
    	
        $query = $this->db->query($query);

		return $query->result_array();

	}


	public function newsletterList()
	{
		$this->db->select("hrms_newsletter.*")
			->from('hrms_newsletter')
		     ->order_by("hrms_newsletter.id", "desc")
		     ->limit(3);
     
        
		return $this->db->get()->result_array();
	}

	public function latestTask($employee_id)
    {
        // print_r($task_id);die;
		$this->db->select("hrms_task_employee.*,add_client.first_name as client_first_name,add_client.last_name as client_last_name,add_project.project_name,hrms_tasks.task_name,hrms_tasks.task_code,hrms_employees.first_name,hrms_employees.last_name")
    		->from('hrms_task_employee')
    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
		    ->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
    		->where(array("hrms_task_employee.employee" => $employee_id))
			->order_by("hrms_task_employee.id", "desc")
			->limit(3);

		return $this->db->get()->result_array();
	}

	public function latestThroughofday()
	{
		$this->db->select("hrms_throughofday.*")
			->from('hrms_throughofday')
		     ->order_by("hrms_throughofday.id", "desc")
		     ->limit(1);
     
        
		return $this->db->get()->row();
	}
}
