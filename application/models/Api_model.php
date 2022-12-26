<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model 
{
	function insert_data($table,$data)
	{ 
		$this->db->insert($table,$data);
		$num = $this->db->insert_id();
		return $num;

	}

	function update_data($table,$where,$data)
	{

		$this->db->where($where);
		$update = $this->db->update($table,$data);
		if($update) { 
			return TRUE;
		} else { 
			return FALSE;
		}
	}

	function delete_data($table, $where)
	{ 
		$this->db->where($where);
		$this->db->delete($table);
		$result = $this->db->affected_rows();
		return ($result > 0)?true:false;

	}

	function update_data_all($table,$data)
	{
		$update = $this->db->update($table,$data);

		if($update) { 
			return TRUE;
		} else { 
			return FALSE;
		}
	}

	function getSingle($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->row();
		$num = $data->num_rows();
		if($num){
			return $get;
		} else {
			return false;
		}
	}

	function getCount($table,$where, $group_by)
	{
		$data = $this->db->select('COUNT(*) AS count')
						->from($table)
						->where($where)
						->group_by($group_by)
						->get();
		$get = $data->row();
		$num = $data->num_rows();
		echo $this->db->last_query();
		if($num){
			return $get;
		} else {
			return false;
		}
	}

	function getWhere($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->result();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

	function delete($table,$where){

		$this->db->where($where);
		$del = $this->db->delete($table);
		if($del){
			return true;
		} else {
			return false;
		}
	}

	function getAll($table, $id) 
	{ 

		$this->db->order_by($id,'asc');
		$data = $this->db->get($table); 
		$get = $data->result(); 
		if($get){ 
			return $get; 
		}else{ 
			return FALSE; 
		} 
	}

	function truncate($table){

		$del = $this->db->truncate($table);
		if($del){
			return true;
		}else{
			return false;
		}

	}

	public function select_single_row($sql)
	{
		$result=$this->db->query($sql);
		return $result->row();
	}

	public function select_multiple_row($sql)
	{
		$rs=$this->db->query($sql);
		return $rs->result();
	}

	public function afterpayoutcalculation($job_id,$userid,$date)
	{
		$this->db->from("checkin_out");
		$this->db->where(array('user_id'=>$userid,'job_id'=>$job_id,'punch_out_time!='=>'','datetime >'=> $date));
		$query = $this->db->get();
		return $query->result();

	}

	public function afterpayoutcalculationelse($job_id,$userid)
	{
		$this->db->from("checkin_out");
		$this->db->where(array('user_id'=>$userid,'job_id'=>$job_id));
		$query = $this->db->get();
		return $query->result();

	}

}

?>