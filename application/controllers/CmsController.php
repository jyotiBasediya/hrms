<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsController extends MY_Controller {
	
	public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the models
          $this->load->model('Login_model');
		  $this->load->model('Designation_model');
		  $this->load->model('Department_model');
		  $this->load->model('Employees_model');
		  $this->load->model('Hrms_model');
		  $this->load->model('Expense_model');
		  $this->load->model('Timesheet_model');
		  $this->load->model('Job_post_model');
		  $this->load->model('Project_model');
		  $this->load->model('Awards_model');
		  $this->load->model('Announcement_model');
		  $this->load->model('Add_model');
		  		  $this->load->model('Client_model');
		  		  $this->load->model('CommonModel');

     }
	

	
	 public function index()
    {
        // echo 1;die();
        // $this->load->model('CommonModel');
       
         $aboutData['title'] = 'About Us';
        $condition = array(
            "id" => 1
        );

        // $aboutData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
        // $this->loadAdminView('admin/cms/page',$aboutData); 
        	// print_r($data['groups']);die();
        	$aboutData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
		$this->load->view('common/header');
		
		$this->load->view('cms/about_us',$aboutData);

		$this->load->view('common/footer');
        
        
    }

    public function about_us()
    {
       
        // $aboutData['title'] = 'About Us';
        $condition = array(
            "id" => 1
        );

        // $aboutData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
        // $this->loadAdminView('admin/cms/page',$aboutData); 
        	// print_r($data['groups']);die();
        	$aboutData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
		$this->load->view('common/header');
		
		$this->load->view('cms/about_us',$aboutData);

		$this->load->view('common/footer');
        
        
    }
public function update_cms()
    {
        
        $title = $this->input->post('title');
        $id = $this->input->post('id');
        
        $data = array(
            "description" => $this->input->post('description')
        );

        $condition = array(
            "id" => $this->input->post('id')
        );
        
        // print_r($condition);die;
        
        $updateData = $this->CommonModel->updateRowByCondition($condition,'cms',$data); 

        if ($updateData) 
        {
            // print_r($title);die;
            if($id == 3)
            {
                $this->session->set_flashdata('success','Terms and Condition updated successfully');
                redirect('CmsController/terms_condition');
            }else if($id == 1){
                 $this->session->set_flashdata('success','About Us updated successfully');
                redirect('CmsController/about_us');
            }else if($id == 2){
                 $this->session->set_flashdata('success','Privacy Policy updated successfully');
                redirect('CmsController/privacy_policy');    
            }
        }else{
            if($id == 3)
            {
                $this->session->set_flashdata('error','Terms and Condition not updated successfully');
                redirect('CmsController/terms_condition');
            }else if($id == 1){
                 $this->session->set_flashdata('error','About Us not updated successfully');
                redirect('CmsController/about_us');
            }else if($id == 2){
                 $this->session->set_flashdata('error','Privacy Policy not updated successfully');
                redirect('CmsController/privacy_policy');    
            }
        }
        
    }
    public function privacy_policy()
    {
        $privacyData['title'] = 'Privacy Policy';

        $condition = array(
            "id" => 2
        );

        $privacyData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
        $this->loadAdminView('admin/cms/page',$privacyData); 
    }

    public function terms_condition()
    {
        $termData['title'] = 'Terms and Condition';
        $condition = array(
            "id" => 3
        );

        $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        //  $this->loadAdminView('admin/cms/page',$termData);
        	$this->load->view('common/header');
		
		$this->load->view('cms/page',$termData);

		$this->load->view('common/footer');
        
         

    }
 public function document()
    {
        $termData['title'] = 'Document';
        // $condition = array(
        //     "id" => 4
        // );

        // $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 


        $data['getAllDocument'] = $this->CommonModel->selectResultData('document','document.id');
        //  $this->loadAdminView('admin/cms/page',$termData);
        	$this->load->view('common/header');
		
		// $this->load->view('cms/document',$termData);
        $this->load->view('cms/document_list',$data);

		$this->load->view('common/footer');
    }


    public function insert_document()
    {
        
            $config['upload_path']          =  'uploads/gst/';
            $config['allowed_types']        =  'gif|jpg|png|jpeg|pdf|doc|xml';
            $config['max_size'] = 2000;
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('doc_img')) 
            {
                $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                 $this->session->set_flashdata('error','You select invalid image format');
                         redirect('CmsController/document'); 
            } 
            else 
            {
                $doc_img = $this->upload->data('file_name');  
            }


            $doc_img = $this->upload->data('file_name');  

            $data = array (
                    'name'         =>  $this->input->post('name'),
                    'img'         =>  $doc_img,
                    "created_at"    =>  date('Y-m-d H:i:s a'),
                );

                $insertData = $this->CommonModel->insertData($data,' document');  

            if($insertData){
                $this->session->set_flashdata('success','Document add successfully');
               redirect('CmsController/document');
            }else{
               $this->session->set_flashdata('error','Document not added, Please try again.');
                redirect('CmsController/document');
            }
 
    }

    public function delete_document()
    {
        $condition = array(
            "id" => $this->uri->segment(3)
        );
        $categoryData = $this->CommonModel->delete($condition,'document');
        
        if ($categoryData) {
            $this->session->set_flashdata('success','Document deleted successfully');
            redirect('CmsController/document');
        }else{
            $this->session->set_flashdata('error', 'Document not deleted');
            redirect('CmsController/document');
        }
    }

     public function status_documentr()
    {
        $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('document_id')),'document');

        $condition = array(
            "id" => $this->input->post('document_id')
        );
        if($data->status == 1){
            $data = array("status" => '0');
        }else{
            $data = array("status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'document',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }

    }
    public function update_document()
    {
        // print_r($_POST);die;
    
        $condition = array("id" => $this->input->post('banner_id'));
             
        $documentDetail = $this->CommonModel->getsingle('document',$condition);


        if (isset($_FILES['doc_img'])) 
        {  
            if($_FILES['doc_img']['size'] != 0)
            {
                $config['upload_path']          =  'uploads/gst/';
                $config['allowed_types']        =  'gif|jpg|png|jpeg|pdf|doc|xml';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('doc_img'))
                {
                    $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                    $this->session->set_flashdata('error','You select invalid image format');
                      redirect('CmsController/document');
                }
                else
                {
                    $this->upload_data['file'] = $this->upload->data();
                    $doc_img = $this->upload->data('file_name');      
                }
            }
            else
            {
               $doc_img =  $documentDetail->img;  
            }
        }
        else
        {
            $doc_img =  $documentDetail->img;  
        }
 
       $data = array (
                    'name'         =>  $this->input->post('name'),
                    'img'         =>  $doc_img,
                    "created_at"    =>  date('Y-m-d H:i:s a'),
                );

                
        // print_r($condition);exit;
        $bannerData = $this->CommonModel->updateRowByCondition($condition,'document',$data);  
        
        if ($bannerData) {
            $this->session->set_flashdata('success','Document updated successfully');
              redirect('CmsController/document');
        }else{
            $this->session->set_flashdata('error', 'Document not updated');
               redirect('CmsController/document');
        }
    }

   
    
    public function contact_information()
    {
        $termData['title'] = 'Contact Information';

        $condition = array(
            "id" => 1
        );

        $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'contact_information'); 
        
         $this->loadAdminView('admin/cms/contact_information',$termData); 
    }
    
    public function update_contact_information()
    {
        $data = array(
            "email_id" => $this->input->post('email_id'),
            "address" => $this->input->post('address'),
            "mbl_number_one" => $this->input->post('mbl_number_one'),
            "mbl_number_two" => $this->input->post('mbl_number_two'),
            "facebook" => $this->input->post('facebook'),
            "instagram" => $this->input->post('instagram'),
            "twitter" => $this->input->post('twitter'),
            "skype" => $this->input->post('skype'),
            "linkedin" => $this->input->post('linkedin'),
            
        );
        $condition = array(
            "id" => $this->input->post('id')
        );
        $updateData = $this->CommonModel->updateRowByCondition($condition,'contact_information',$data); 
        if ($updateData) { 
            $this->session->set_flashdata('success','Contact Infomation change Successfully');
            redirect('admin/cms/contact_information');
        }else{
            $this->session->set_flashdata('error','Somethings went wrong');
            redirect('admin/cms/contact_information');
        }
        
    }
    
    public function faq_list()
    {
        $data['title'] = "FAQ List";

        $data['allFaq'] = $this->CommonModel->selectResultData('faq','faq.id');

        // $this->loadAdminView('admin/cms/faq_list',$data); 
        	$this->load->view('common/header');
		
		$this->load->view('cms/faq_list',$data);

		$this->load->view('common/footer');
    }
    
    public function add_faq()
    {
        $data['title'] = "Add Faq List";

        // $this->loadAdminView('admin/cms/add_faq',$data); 
        	$this->load->view('common/header');
		
		$this->load->view('cms/add_faq',$data);

		$this->load->view('common/footer');
    }
    
    public function insert_faq()
    {
        $data = array(
                "question"      =>  $this->input->post('question'),
                "answer"        =>  $this->input->post('answer'),
                "created_at"    =>  date('Y-m-d H:i:s a'),
                "updated_at"    =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,' faq');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success','Faq added successfully');
            redirect('CmsController/faq_list'); 
        }else{
            $this->session->set_flashdata('error','Faq not added successfully ');
            redirect('CmsController/add_faq'); 
            
        }
    }
    
     public function view_faq()
    {
        
        
       $data['title'] = 'View Faq';

        $where = array('id'=>$this->uri->segment(3));
        $data['getfaqDetail'] = $this->CommonModel->getsingle('faq',$where);
    //  print_r($where);die();

        // $this->loadAdminView('admin/cms/view_faq',$data); 
        	$this->load->view('common/header');
		$this->load->view('cms/view_faq',$data);

		$this->load->view('common/footer');
    
    }
     public function employee_view_faq()
    {
        
        
       $data['title'] = 'View Faq';
         $condition = array(
            "id" => 1
        );

        $where = array('id'=>$this->uri->segment(2));
        $data['getfaqDetails'] = $this->CommonModel->getsingle('faq',$condition);
    //  print_r($where);die();

        // $this->loadAdminView('admin/cms/view_faq',$data); 

        $data['allFaq'] = $this->CommonModel->selectResultData('faq','faq.id');
        
        	$this->load->view('common/header');
		$this->load->view('cms/employee_view_faq',$data);

		$this->load->view('common/footer');
    
    }
     public function view_about_us()
    {
        
        
       $data['title'] = 'About Us';
     $condition = array(
            "id" => 1
        );
        $where = array('id'=>$this->uri->segment(2));
        // 	$aboutData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms');
        $data['getfaqDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'cms');
       //   print_r($where);die();

        // $this->loadAdminView('admin/cms/view_faq',$data); 
        	$this->load->view('common/header');
		$this->load->view('cms/view_about_us',$data);

		$this->load->view('common/footer');
    
    }
         public function view_term_condition()
    {
        
        
       $termData['title'] = 'Terms and Condition';
        $condition = array(
            "id" => 3
        );

        $where = array('id'=>$this->uri->segment(2));
        
        // $data['getfaqDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'cms');
        $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
    //   print_r($where);die();

        // $this->loadAdminView('admin/cms/view_faq',$data); 
        	$this->load->view('common/header');
		$this->load->view('cms/view_term_condition',$termData);

		$this->load->view('common/footer');
    
    }
      public function view_document()
    {
        
        
      
        $termData['title'] = 'Document';
        $condition = array(
            "id" => 4
        );

        // $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 

        // $where = array('id'=>$this->uri->segment(2));
        
        // $data['getfaqDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'cms');
        $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
    //   print_r($where);die();

        // $this->loadAdminView('admin/cms/view_faq',$data); 
        	$this->load->view('common/header');
		$this->load->view('cms/view_document',$termData);

		$this->load->view('common/footer');
    
    }
    public function edit_faq()
    {
       $data['title'] = 'Edit Faq';

        $where = array('id'=>$this->uri->segment(3));
        $data['getfaqDetail'] = $this->CommonModel->getsingle('faq',$where);
// print_r($where);die();
        // $this->loadAdminView('admin/cms/edit_faq',$data); 
        
    	$this->load->view('common/header');
		
		$this->load->view('cms/edit_faq',$data);

		$this->load->view('common/footer');
    }
    
    //  public function faq_status(){
    //      $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('faq_id')),'faq');

    //     $condition = array(
    //         "id" => $this->input->post('faq_id')
    //     );
    //     if($data->status == 1){
    //         $data = array("status" => '0');
    //     }else{
    //         $data = array("status" => '1');
    //     }

    //     $updateData = $this->CommonModel->updateRowByCondition($condition,'faq',$data);  

    //     if($updateData)
    //     {
    //         echo "1";
    //     }else{
    //         echo "0";
    //     }
    // }
    
    public function update_faq()
    {
         $where = array(
            'id'    =>  $this->input->post('faq_id')
        );
        
         $data = array(
                "question"      =>  $this->input->post('question'),
                "answer"        =>  $this->input->post('answer'),
                "created_at"    =>  date('Y-m-d H:i:s a'),
                "updated_at"    =>  date('Y-m-d H:i:s a'),
            );
        
        $updateData = $this->CommonModel->updateRowByCondition($where,'faq',$data); 

        if($updateData){
             $this->session->set_flashdata('success','Faq updated successfully');
             redirect('CmsController/faq_list'); 
        }else{
             $this->session->set_flashdata('error','Faq not updated successfully');
             redirect('admin/cms/edit_faq/'.$this->input->post('faq_id'));  
        }
    }
    
    public function delete_faq()
    {
    
         $where = array('id'=>$this->uri->segment(3));
        //  print_r($where);die();
        $clientData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(3)),'faq');

        if($clientData){

            $data = array("delete" => '1');
            
            $updateData = $this->CommonModel->delete($where,'faq'); 

            if($updateData)
            {
                $this->session->set_flashdata('success','Faq deleted successfully');
                 redirect('CmsController/faq_list');  
            }else{
                $this->session->set_flashdata('error','Faq not deleted successfully');
                 redirect('CmsController/faq_list'); 
            }
        }

        else{
             
            $this->session->set_flashdata('error','Something went wrong');
            redirect('CmsController/faq_list');  
            
        }
    }
    
    public function deletedata()
        	{
            	$id=$this->input->get('id');
            	$this->CommonModel->delete($id,'faq');
            	redirect('CmsController/faq_list');
        	}
    
    public function faq_status(){
         $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('faq_id')),'faq');

        $condition = array(
            "id" => $this->input->post('faq_id')
        );
        if($data->status == 1){
            $data = array("status" => '0');
        }else{
            $data = array("status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'faq',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }
    public function contactUs_list()
    {
        $data['title'] = "Contact Us List";

        $vendor_id = "";
        $data['allContactList'] = $this->CommonModel->allVendorContact($vendor_id);

        $this->loadAdminView('admin/cms/contactus_list',$data); 
    }

    public function update_contact()
    {

        $where = array(
            'id'    =>  1
        );

        $data = array(
            "email_id"          => $this->input->post('email_id'),
            "address"           => $this->input->post('address'),
            "mobile_number"     => $this->input->post('mobile_number'),
            "whatsapp_number"   => $this->input->post('whatsapp_number'),
            "facebook"          => $this->input->post('facebook'),
            "twitter"           => $this->input->post('twitter'),
            "instagram"         => $this->input->post('instagram'),
            "linkedin"          => $this->input->post('linkedin'),
        );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'contact_information',$data); 

        if($updateData){
             $this->session->set_flashdata('success','Information Updated Successfully');
                redirect('admin/cms/contact_us'); 
        }else{
             $this->session->set_flashdata('error','Information not Updated Successfully');
                redirect('admin/cms/contact_us'); 
        }
    }


    public function news_list()
    {
        $data['title'] = "News List";

        $data['allNews'] = $this->CommonModel->selectResultData('hrms_newsletter',' hrms_newsletter.id');

        // $this->loadAdminView('admin/cms/faq_list',$data); 
        	$this->load->view('common/header');
		
		$this->load->view('cms/newsletter_list',$data);

		$this->load->view('common/footer');
    }


    public function add_news()
    {
        $data['title'] = "Add News List";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        	// print_r($_POST);die;
        	$data = array(
                "title"      =>  $this->input->post('title'),
                "description"        =>  $this->input->post('description'),
                "created_at"    =>  date('Y-m-d H:i:s a'),
                "updated_at"    =>  date('Y-m-d H:i:s a'),
            );

        	$insertData = $this->CommonModel->insertData($data,'hrms_newsletter');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success','News added successfully');
            redirect('CmsController/news_list'); 
        }else{
            $this->session->set_flashdata('error','News not added successfully ');
            redirect('CmsController/news_list'); 
        }

        }else{

	        $this->load->view('common/header');
			
			$this->load->view('cms/add_newsletter',$data);

			$this->load->view('common/footer');
		}
    }

    public function view_news()
    {
       $data['title'] = 'View News';

       
        $where = array('id'=>$this->uri->segment(3));
        $data['getNewDetail'] = $this->CommonModel->getsingle('hrms_newsletter',$where);
		// print_r($where);die();
        
        $this->load->view('common/header');
        
        $this->load->view('cms/view_newsletter',$data);

        $this->load->view('common/footer');
	    
    }

    public function edit_news()
    {
       $data['title'] = 'Edit News';

       	if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        	$where = array(
	            'id'    =>  $this->input->post('news_id')
	        );
	        
	         $data = array(
	                "title"      =>  $this->input->post('title'),
	                "description"        =>  $this->input->post('description'),
	                "created_at"    =>  date('Y-m-d H:i:s a'),
	                "updated_at"    =>  date('Y-m-d H:i:s a'),
	            );
	        
	        $updateData = $this->CommonModel->updateRowByCondition($where,'hrms_newsletter',$data); 

	        if($updateData){
	             $this->session->set_flashdata('success','News updated successfully');
	             redirect('CmsController/news_list'); 
	        }else{
	             $this->session->set_flashdata('error','News not updated successfully');
	             redirect('admin/cms/edit_newsletter/'.$this->input->post('news_id'));  
	        }
        }else
        {
	        $where = array('id'=>$this->uri->segment(3));
	        $data['getNewDetail'] = $this->CommonModel->getsingle('hrms_newsletter',$where);
			// print_r($where);die();
	        
	        $this->load->view('common/header');
	        
	        $this->load->view('cms/edit_newsletter',$data);

	        $this->load->view('common/footer');
	    }
    }

    public function news_status(){
         $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('news_id')),'hrms_newsletter');

        $condition = array(
            "id" => $this->input->post('news_id')
        );
        if($data->status == 1){
            $data = array("status" => '0');
        }else{
            $data = array("status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'hrms_newsletter',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

     public function delete_news()
    {
    
         $where = array('id'=>$this->uri->segment(3));
        //  print_r($where);die();
        $clientData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(3)),'hrms_newsletter');

        if($clientData){

            // $data = array("delete" => '1');
            
            $updateData = $this->CommonModel->delete($where,'hrms_newsletter'); 

            if($updateData)
            {
                $this->session->set_flashdata('success','News deleted successfully');
                 redirect('CmsController/news_list');  
            }else{
                $this->session->set_flashdata('error','News not deleted successfully');
                 redirect('CmsController/news_list'); 
            }
        }
        else{
             
            $this->session->set_flashdata('error','Something went wrong');
            redirect('CmsController/news_list');  
            
        }
    }
}