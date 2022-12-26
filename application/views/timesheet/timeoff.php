
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
                    <h3 class="page-title">Leave Request List</h3>
                    <div class="d-flex float-right"> 
                    </div>  
                   </div>  
                </div> 
                </div> 
               
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                           <th>S.No</th>
                          <th>Employee Name</th>
                          <th>Leave Category</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Note</th>
                          <th>Status</th>
                          <?php if(in_array('24',$role_resources_ids)) { ?>
                          <th>Action</th>
                        <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                         <?php
                        $i=1;
                        foreach ($leave as $v)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $i++;?></td>
                      
                         <td><?php echo $v['first_name'].' '.$v['last_name'];?></td>
                        <td><?php echo $v['leave_name'];?></td>
                        
                          <td><?php echo  date("d-m-Y", strtotime($v['sdate']));?></td>
                          <td><?php echo  date("d-m-Y", strtotime($v['edate']));?></td>
                          <td><?php echo $v['note'];?></td>
                          <td>
                            
                            <?php 
                              if(!empty($v['status'] == 0)){
                                    $status = 'Pending';
                                }else if(!empty($v['status'] == 2)){
                                    $status = 'Rejected';
                                }
                                else{
                                    $status = 'Approved';
                                }
                                echo $status;
                              ?>
                                <!-- <span>Pending</span> -->
                            
                          </td>
                          <?php if(in_array('41',$role_resources_ids)) { ?>
                          <td>
                             <?php if($v['status'] == 0){ ?>
                              <a href="<?php echo site_url('Timesheet/approve/'. $v['id']);?>">Approve </a> /
                              <a href="<?php echo site_url('Timesheet/decline/'. $v['id']);?>"> </i>Decline</a>
                            <?php } ?>
                            <?php if($v['status'] != 0){ 
                              if(!empty($v['status'] == 0)){
                                    $status = 'Pending';
                                }else if(!empty($v['status'] == 2)){
                                    $status = 'Rejected';
                                }
                                else{
                                    $status = 'Approved';
                                }
                                echo $status;
                              ?>
                                <!-- <span>Pending</span> -->
                            <?php } ?>
                          </td>
                        <?php } ?>
                        </tr>
                        <?php  } ?>
                      </tbody>
                    </table>
                  </div>
                    <!-- <div class="row mt-4">
                      <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div>
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                          <ul class="pagination float-right">
                            <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>

                            <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                            
                            <li class="paginate_button page-item next" id="order-listing_next"><a href="#" aria-controls="order-listing" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                          </ul>
                        </div>
                      </div>
                    </div> -->
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
   <!--  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script> -->
     <!-- Custom js for this page-->
   <!--  <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
  <!--   <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
  </body>
</html> -->
<script type="text/javascript">
$(document).ready(function() {
    $('form button[type="submit"]').click(function(event) {
        var val = $(this).attr('name');

        alert(val);

        if (val == 'approve') {
            alert('approve');
        } else if (val == 'reject') {
            alert('reject');
        } else if (val == 'cancel') {
            alert('cancel');
        }

        // Submit form
        $('form').submit();

        return false;
    });        
});

$(document).ready(function() {
       $('#employee_name').select2();
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