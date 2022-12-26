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
                    <h3 class="page-title">List All Holidays </h3>
                     <?php if(in_array('26',$role_resources_ids)) { ?>
                    <div class="d-flex float-right"> 
                        <a href="<?php echo site_url();?>timesheet/holidays"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Holiday </button></a>
                    </div>  
                    <?php } ?>
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
                            <th>Event Name</th>
                            <th>Location</th>
                            
                            <th>Start Date</th>
                            <th>Start End</th>
                            <th>Status</th>
                            <?php if(in_array('27',$role_resources_ids) || in_array('72',$role_resources_ids)) { ?>
                            <th style="width:150px;">Action</th> 
                            <?php } ?>
                          </tr>
                        </thead>
                          <tbody id="fbody">

                                  <?php
                                      $i=1;
                                      foreach ($holiday as $row)  
                                      {
                                      ?>
                                      <tr>
                                       <td><?php echo $i++;?></td>
                                        <td><?php echo $row['event_name'];?></td>
                                        <td>
                                          <?php
                                              $data = $this->CommonModel->selectRowDataByCondition(array('location_id' => $row['location']),'hrms_office_location');

                                              if(!empty($data))
                                              {
                                                 echo $data->location_name;

                                              }else{
                                                 echo 'No location';
                                              }
                                          ?>
                                        </td>
                                        <td ><?php echo $row['start_date'];?></td>
                                       <td ><?php echo $row['end_date'];?></td>
                                       <td >
                                         <?php if($row['is_publish'] == 1) { ?>
                                            <button title="Change Status" class="btn-success  btn btn-sm" value="('<?=$row['holiday_id']?>')" onclick="change_status('<?=$row['holiday_id']?>','Deactive')"> Published </button>
                                        <?php } else { ?>
                                           <button  title="Change Status" type="button" id="button" class="btn-info btn btn-sm " value="('<?=$row['holiday_id']?>')" onclick="change_status('<?=$row['holiday_id']?>','Active')"> Un Published </button>
                                        <?php }  ?>
                                       </td>
                                        <td> 
                                          <?php if(in_array('27',$role_resources_ids)) { ?>
                                            <a href="<?php echo site_url('timesheet/edit_holiday_list/'. $row['holiday_id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                          <?php } if(in_array('72',$role_resources_ids)) { ?>
                                          <a  title="Delete" href="<?php echo base_url().'timesheet/deleteHoliday/'.$row['holiday_id'];?>" onclick="return deleteClient()">
                                                             <i class="fa fa-trash" ></i></a>
                                          <?php } ?>
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

    function deleteClient(){
        var result = confirm("Are sure delete this holiday calendra ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    } 
    </script>