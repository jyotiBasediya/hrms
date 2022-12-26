
<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	

	function getAdminData()
	{
		
		$CI =& get_instance();
		return $result = $CI->admin_model->getAdminDetailsById();
		
	}

	function getjobitem($job_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getjobitem($job_id);
	}
	function getAllEmployee()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getAllEmployee();
	}
	function getAllnotes($job_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getAllnotes($job_id);
	}
	function getteamCommunicationForNewjob($job_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getteamCommunicationForNewjob($job_id);
	}
	function jobattacment($job_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->jobattacment($job_id);
	}
	function getjobtextMessage($job_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getjobtextMessage($job_id);
	}
	function recentActivity($recent_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->recentActivity($recent_id);
	}
	//*************21-11-17************
	function getestimateitem($estimate_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getestimateitem($estimate_id);
	}
	function getestimatetextMessage($estimate_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getestimatetextMessage($estimate_id);
	}
	function recentActivityEstimation($estimate_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->recentActivityEstimation($estimate_id);
	}
	function getAllEstimatenotes($estimate_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getAllestimatenotes($estimate_id);
	}
	function estimateattacment($estimate_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->estimateattacment($estimate_id);
	}
	function getteamCommunicationForNewjobestimation($estimate_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getteamCommunicationForNewjobestimation($estimate_id);
	}
	function getUserWorkTime($where)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getUserWorkTime($where);
	}
	function getNotification($data)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getNotification($data);
	}
	//**************1-12-17***************************
	function getInvoiceImg($id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getInvoiceImg($id);
	}
	function assignJobList($id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->assignJobList($id);
	}
	function getpaymentByUser($userid)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getpaymentByUser($userid);
	}
	function totalbyUserAmount($userid)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->totalbyUserAmount($userid);
	}
	function punchInOutTimeCompleteCalculation($job_id,$userid)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->punchInOutTimeCompleteCalculation($job_id,$userid);
	}
		//*******************count user*************
	//*******************count user*************
	function countTotalUser()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->countTotalUser();
	}
	function countTotalcompletejob()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->countTotalcompletejob();
	}
	function countTotalestimation()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->countTotalestimation();
	}
	function countTotaljob()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->countTotaljob();
	}
 function countAdminNotification()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->countAdminNotification();
	}
 function getAdminNotification()
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getAdminNotification();
	}
	function afterpayoutcalculation($job_id,$userid,$date)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->punchInOutTimeCompleteCalculation($job_id,$userid,$date);
	}
	function afterpayoutcalculationelse($job_id,$userid)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->afterpayoutcalculationelse($job_id,$userid);
	}
	//****************7-12*************
	function getsingledata($table,$where)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getsingledata($table,$where);
	}
	//***************8-12****************

	function getnotmatch($table,$field_name,$where = array())
	{	
		$CI =& get_instance();
		return $result = $CI->admin_model->where_Not_in($table,$field_name,$where);
	}
	//**************11-12******************
	function getAdminjobitem($job_id)
	{
		$CI =& get_instance();
		return $result = $CI->admin_model->getAdminjobitem($job_id);
	}