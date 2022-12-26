<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	

class Common{

	public $CI;
	public function __construct()
    {
        //Define CI based variables (so you can use CI functions)
        $this->CI =& get_instance();
    }
	public function check_login(){

		//$login = $this->CI->session->userdata('user_id');
		//$role1 = $this->CI->session->userdata('role');
		$login = $this->CI->session->userdata('ses_user_id');
		if($login){
			return true;
		} else {
			redirect(base_url());
		}
	}

	public function check_adminlogin(){

		//$login = $this->CI->session->userdata('user_id');
		//$role1 = $this->CI->session->userdata('role');
		$login = $this->CI->session->userdata('ses_admin_id');
		if($login){
			return true;
		} else {
			redirect('admin/login');
		}
	}
	function encryption($string)
	{
		$key = $this->getKey();
		$result = '';
		for($i=0; $i<strlen($string); $i++)
		{
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}
	function decryption($string)
	{
		$result = '';
		$string = base64_decode($string);
		$key = $this->getKey();
		for($i=0; $i<strlen($string); $i++)
		{
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
	function getKey()
	{
		$key=$this->CI->config->item('encryption_key');
		return md5($key);
	}
}
	?>