	<?php

	
		class Task_model extends CI_Model
	{
				function __construct()
			{
			    // Call the Model constructor
			    parent::__construct();
			    $this->load->database();
			}




		public function getdata()
		{
			$query=$this->db->select('*')
		->get('hrms_tasks');
		 // return $query; 
		 return $query->result();
	
		}
		public function edit_id($id)
    {
   			$this->db->from('hrms_tasks');
   			$this->db->where('task_id',$id);
   			$query = $this->db->get();
   			return $query->row();
   			// return $this->db->update($id);
 		
    }

    

    } 













	?>