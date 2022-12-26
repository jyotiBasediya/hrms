<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_performances()
	{
	  return $this->db->get("hrms_tasks_comments");
	}
 
	public function get_appraisal_applications()
	{
	  return $this->db->get("hrms_appraisal_apply");
	}

	public function delete_performance_application($id){
		$this->db->where('appraisal_id', $id);
		$this->db->delete('hrms_appraisal_apply');		
	}

}

?>