<?php 

	class Client_model extends CI_Model
	{
				function __construct()
			{
			    // Call the Model constructor
			    parent::__construct();
			}
		// 	public function index()
		// {
		
  //      $data = array(
  //               'first_name' => $this->input->post('fname'),
  //               'last_name' => $this->input->post('lname'),
  //               'company_name' => $this->input->post('cname'),
  //               'contact_no' => $this->input->post('cnumber'),
  //               'mail_id' => $this->input->post('email')
  //           );
  //      $this->db->insert('add_client', $data);
		
		
       
		// }


				public function getdata(){
			$query=$this->db->select('*')->where('is_delete',0)
		->get('add_client');
		 // return $query; 
		 return $query->result();
	}
			public function insert_data()
			{
				
       $data = array(
                'first_name' => $this->input->post('fname'),
                'last_name' => $this->input->post('lname'),
                'company_name' => $this->input->post('cname'),
                'contact_no' => $this->input->post('cnumber'),
                'mail_id' => $this->input->post('email')
             );
        $this->db->insert('add_client', $data);
        

			}

function getAllClient()
{



	$query = $this->db->get('add_client');
	return $query->result_array();
}
	public function edit($id)
    {
   			$this->db->from('add_client');
   			$this->db->where('id',$id);
   			$query = $this->db->get();
   			return $query->row();
   			//return $this->db->update($id);
 		
    }
	


    
	}



?>