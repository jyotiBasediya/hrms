
        <?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Tasks </h3>
                     <?php if(in_array('13',$role_resources_ids)) { ?>
                    <div class="d-flex float-right"> 
                       <a href="<?php echo site_url();?>task/task_form"class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Tasks </a>
                    </div>  
                     <?php } ?>
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <!-- <div class="card-body"> -->
                    <div class="row align-items-center">
                      <div class="col-sm-6"> 
                        <div class="row">
                           
                        </div>  
                      </div> 
                     
                      </div> 
                    <!-- </div> --> 
                    <div class="table-responsive"> 
                      <table class="table table-hover mt-4 text-center" id="example">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th> <strong> Company Name</strong></th>
                            <th> <strong> Project Name</strong></th>
                            <th> <strong> Employee Name</strong></th>
                            <th> <strong> Task Name</strong></th>
                            <th><strong>Task Code</strong></th>
                            <!-- <th><strong>Task Status</strong></th> -->
                             <?php if(in_array('14',$role_resources_ids) || in_array('69',$role_resources_ids)) { ?>
                              <th>Action</th>
                             <?php } ?>
                          </tr>
                        </thead>
                        <tbody id="fbody">
                          <?php
                          $i =1;
                          foreach ($data as $row)  
                          {
                          ?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $row['client_first_name'];?></td>
                            <td><?php echo $row['project_name'];?></td>
                             <td ><?php echo $row['first_name'].' '.$row['last_name'];?></td>
                            <td ><?php echo $row['task_name'];?></td>
                            <td ><?php echo $row['task_code'];?></td>
                            <!-- <td ><?php echo $row['task_status'];?></td> -->
                             
                               <td>
                                <?php if(in_array('14',$role_resources_ids)) { ?>
                                    <a title="Edit" href="<?php echo site_url('task/editpost/'. $row['task_id']);?>"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                 <?php } if(in_array('69',$role_resources_ids)) { ?>

                                    <a  title="Delete" href="<?php echo base_url().'task/delete_task/'.$row['task_id'];?>" onclick="return deleteClient()">
                                                 <i class="fa fa-trash" ></i></a>

                                <?php }?>

                                
                               </td>
                                

                            
                          </tr>
                            
                          <?php

                            } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                   </div>
                  </div>
                </div>  

            </div>
            <!-- content-wrapper ends -->
            <!-- footer -->
 
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->
 <script type="text/javascript">
    function deleteClient(){
        var result = confirm("Are sure delete this task ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    } 

      $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                        exportOptions: {                    
                            columns: [0,1,2,3,4,5]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,5]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,5]                
                        },
                     },

                ],
        });
    });
  </script>