 <?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class CommingSoonController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->library('session');
    	$this->load->library('pdf');
	}
	
	public function commingsoon()
	{
	    echo "1";die();
        // $this->common->check_serviceProviderlogin();

    	   // $this->session->set_flashdata('error','Comming Soon');
        redirect('dashboard');
	}
	
}
