	<?php

	class Add_model extends CI_Model
	{

	public function index()
	{
		$data['full_name'] = $this->input->post('full_name');
		$data['email'] = $this->input->post('email');
		$data['start_date'] = $this->input->post('sdate');
		$data['end_date'] = $this->input->post('edate');
		$data['role'] = $this->input->post('role');
		$data['employment'] = $this->input->post('employment');
		$data['division'] = $this->input->post('division');
		$data['default_task'] = $this->input->post('task');
		$data['emp_id'] = $this->input->post('enumuber');
		$data['accounting_id'] = $this->input->post('account');

		$data['status'] = $this->input->post('status');
		$data['note'] = $this->input->post('note');

		$data['password'] = $this->input->post('password');

		$this->db->insert('employees', $data);
	}
	
	// public function save($request)
	// {
	// 	$result = $this->db->insert("hrms_employees",$request);
	// 	if ($result) {
	// 		return true ;
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	// public function checkemail($condition)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('hrms_employees');
	// 	$this->db->where($condition);
	// 	return $this->db->get()->row();



	// }
			// if ($query->num_rows()>0 ) {
		// 	return false;
		// }
		// else
		// {
		// 	return true;
		// }


function getAllGroups()
{



	$query = $this->db->get('hrms_employees');
	return $query->result_array();
}


		public function getdata(){
			$query=$this->db->select('*')
			->where(array("is_delete" => 0))
		->get('hrms_employees');
		 // return $query; 
		 return $query->result();
	}

			public	function update_records($id,$full_name,$email)
				{
				$query=$this->db->query("update employees SET full_name='$full_name',email='$email' where id='$id'");
				}
				// public function update_record($data, $id){
				// 	$this->db->where('id', $id);
				// 	if( $this->db->update('hrms_employees',$data)) {
				// 		return true;
				// 	} else {
				// 		return false;
				// 	}		
				// }


	

	public function read_user_role_info($id) {
	
		$condition = "role_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_user_roles');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get('hrms_employees');
		
		return $query->result_array();
	}

	


    } 













	?>