<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Access_history_model extends CI_Model
{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_history($data)
    {
		$this->db->select('*');
		$this->db->from('hrms_access_history');
		
		if($data[0]['value'] !== ''){
			$this->db->where("DATE(created_at) >= '".$data[0]['value']."'");
		}
		
		if($data[1]['value'] !== ''){
			$this->db->where("DATE(created_at) <= '".$data[1]['value']."'");
		}
		
		if($data[2]['value'] !== ''){
			$this->db->where('employee_id', $data[2]['value']);
		}
		if(!empty($data[3]['value'])){

			$arr = array();

			foreach($data as $key => $item){
				$arr[] = ($item['name'] == 'action[]')?$item['value']:'';
			}

			$arr = array_filter($arr);

			$this->db->where_in('action', array_values($arr));
		}

		return $this->db->get();

    }

}

?>