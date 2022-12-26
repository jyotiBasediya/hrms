<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();    
		$ci =& get_instance();

        $session = $ci->session->userdata('username');

        if(empty($session)){
            redirect();
        } else {

            $ci->load->helper('language');
            $siteLang = $ci->session->userdata('site_lang');
            if ($siteLang) {
                $ci->lang->load('hrms',$siteLang);
            } else {
                $ci->lang->load('hrms','english');
            } 
        
        }
    }

    function sendSMTPMail($data)
    {
        $ci =& get_instance();
        $ci->load->library('email');

        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['priority'] = 1;

        $ci->email->initialize($config);
        $ci->email->from('info@ilinkhr.in','iLinkHR');
        $ci->email->to($data['email_to']);
        $ci->email->subject($data['email_subject']);
        $ci->email->message($data['email_message']);

        $sent = $ci->email->send();
        
        $ci->load->model('Email_model');
        $ci->Email_model->add($data);

        return ($sent === TRUE)?TRUE:FALSE;
    }
	
	
	
	

}
?>