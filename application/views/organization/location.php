<?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    
                    <h3 class="page-title">Location </h3>
                    <div class="d-flex float-right"> 
                       <?php if(in_array('38',$role_resources_ids)) { ?>
                        <a href="<?php echo site_url();?>OrganizationController/add_location">
                        <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Location </button>
                      </a>
                      <?php } ?>
                      <!--  -->
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 text-center"  id="example">
                        <thead>
                          <tr>
                            <th>S.No</th>
                                      <th>Location Name</th>
                                      <th>Email Id</th>
                                      <th>Phone Number</th>
                                      <th>Address</th>
                                      <?php if(in_array('39',$role_resources_ids)) { ?>
                                        <th style="width:150px;">Action</th>
                                      <?php } ?>
                          </tr>
                        </thead>
                          <tbody id="fbody">

                            <?php
                                $i=1;
                                foreach ($location as $row)  
                                {
                                ?>
                                <tr>
                                 <td><?php echo $i++;?></td>
                                  <td><?php echo $row['location_name'];?></td>
                                  <td ><?php echo $row['email'];?></td>
                                 <td ><?php echo $row['phone'];?></td>
                                 <td ><?php echo $row['address_1'];?></td>
                                 <?php if(in_array('39',$role_resources_ids)) { ?>
                                  <td> <a href="<?php echo site_url('OrganizationController/edit_location/'. $row['location_id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                   </a></td>
                                 <?php } ?>
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
                  </div>
                </div>  

            </div>
            <!-- content-wrapper ends -->
           

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->

    <script type="text/javascript">
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
                            columns: [0,1,2,3,4]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4]                
                        },
                     },

                ],
        });
    });


function change_status(id,value)
    {
        var holiday_id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this holiday")){
            $.ajax({
                url: '<?php echo site_url("timesheet/status_holiday"); ?>',
                type: "POST",
                data: {
                    "holiday_id" : holiday_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.holiday_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {
                        $('#change_status_'+data.holiday_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }
    </script>