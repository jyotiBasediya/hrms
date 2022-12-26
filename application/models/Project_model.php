<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class project_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



function getAllClient()
{



	$query = $this->db->get('add_client');
	return $query->result_array();
}
function getAllcurrency()
		{
			$query = $this->db->get('currency');
			return $query->result_array();
		}


		function getAllproject()
		{
			$query = $this->db->where('is_delete', 0)->get('add_project');
			return $query->result_array();
		}
				function getAllemp()
		{
			$query = $this->db->get('hrms_employees');
			return $query->result_array();
		}
		  public function edit($id)
    {
   			$this->db->from('add_project');
   			$this->db->where('id',$id);
   			$query = $this->db->get();
   			return $query->row();
   			//return $this->db->update($id);
 		
    }



 
	public function get_projects()
	{
	  return $this->db->get("hrms_projects");
	}

	public function get_projectsByCmp()
	{
	  $session = $this->session->userdata('username'); 
		$this->db->where('company_id', $session['companyId']);
 		$query = $this->db->get('hrms_projects');
 		return $query->result();
 		return $query->num_rows();
	}
	 
	 
	 public function read_project_information($id) {
	
		$condition = "project_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('hrms_projects');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	
	// Function to add record in table
	public function add($data){
		$this->db->insert('hrms_projects', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Function to Delete selected record from table
	public function delete_record($id){
		$this->db->where('project_id', $id);
		$this->db->delete('hrms_projects');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('project_id', $id);
		if( $this->db->update('hrms_projects',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function project_cost_list()
	{
		 $this->db->select("hrms_task_employee.*,hrms_tasks.task_name,add_project.project_name,hrms_employees.first_name,hrms_employees.last_name,add_client.first_name as client_first_name,add_client.last_name as client_last_name")
    		->from('hrms_task_employee')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
    		->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		->where(array("hrms_task_employee.is_delete" => 0))
    		->order_by("hrms_task_employee.id", "desc");
			// ->where(array("product.id" => $product_id));
		
		return $this->db->get()->result_array();
	}

	

	public function project_cost_view($id)
	{
		 $this->db->select("hrms_task_employee.*,hrms_tasks.task_name,add_project.project_name,add_project.currency,hrms_employees.first_name,hrms_employees.last_name,add_client.first_name as client_first_name,add_client.last_name as client_last_name")
    		->from('hrms_task_employee')
    		->join('hrms_tasks','hrms_tasks.task_id = hrms_task_employee.task_id','left')
    		->join('hrms_employees','hrms_employees.user_id = hrms_task_employee.employee','left')
    		->join('add_project','add_project.id = hrms_task_employee.project_name','left')
    		->join('add_client','add_client.id = hrms_task_employee.client_name','left')
    		// ->order_by("hrms_task_employee.id", "desc");
			->where(array("hrms_task_employee.id" => $id));
		
		return $this->db->get()->row();
	}
}


?>