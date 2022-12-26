
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Employee Leave Request</h3>
                    <div class="d-flex float-right"> 
                        <button class="btn btn-secondary btn-fw">Time Off Requests</button>
                        <button class="btn btn-secondary btn-fw mx-2">Company Holidays</button>
                        <div class="btn-group">
                        <!--<a href="<?php echo site_url();?>timesheet"class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Leave </a>-->
                        <!--<button type="button" class="btn btn-secondary">Actions</button>-->
                        <!--<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--<span class="sr-only">Toggle Dropdown</span>-->
                        <!--</button>-->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                          <a class="dropdown-item" href="#">Calendar Feed</a>
                          
                        </div>
                      </div>
                    </div>  
                   </div>  
                </div> 
                <div class="filter-timesheets w-100 card p-3 my-4">
                    <!--<div class="d-flex justify-content-between mb-4">-->
                      <!--<h4 class="mb-3 font-weight-semibold">Filter Timesheets</h4>  -->
                      <!--<div class="d-flex">-->
                      <!--    <button class="btn btn-warning2 btn-sm">People Selected</button>-->
                      <!--    <button class="btn btn-warning2 btn-sm mx-4">Employment Selected</button>-->
                      <!--    <button class="btn btn-warning2 btn-sm ">Approver Selected</button>-->
                      <!--</div>  -->
                    <!--</div>                      -->
                    <div class="row">
                        <div class="col-sm-3">

                            <p class="mb-1">Request Status</p>
                            <select class="form-control" id="searchInput" >
                            
                              <option value="All">All </option>
                              <option value="Approved">Approved</option>
                              <option value="Rejected">Rejected</option>
                              <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>  
                        <div class="col-sm-3">
                            <p class="mb-1">Time</p>
                            <select class="form-control" >
                              <option >All time </option>
                              <option>Specific dates</option>
                              <option>Today</option>
                              <option>This week</option>
                              <option>This month</option>
                              <option>This quarter</option>
                              <option>Next week</option>
                              <option>Next month</option>
                              <option>Next quarter</option>
                              <option>Last week</option>
                              <option>Last month</option>
                              <option>Last quarter</option>
                            </select>
                        </div>  
                        <div class="col-sm-3">
                            <p class="mb-1">Start</p>
                            <input class="form-control" type="date" name="">
                        </div>    
                        <div class="col-sm-3">
                            <p class="mb-1">End</p>
                            <input class="form-control" type="date" name="">
                        </div>  
                        
                           
                    </div>  
                </div>  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Show</p>
                                <select class="form-control" id="searchInput">
                                  <option>My Approvals</option>
                                  <option>All Approvers</option>
                                  <option>Filtered Approvers</option>
                                </select>   
                            </div>
                            
                        </div>  
                      </div> 
                      <!--<div class="col-sm-6">-->
                      <!-- <div class="d-flex flex-row-reverse"> -->
                      <!--  <button class="btn btn-success btn-fw" type="submit" name="approve">Approve</button>-->
                      <!--  <button class="btn btn-secondary btn-fw mx-2"  type="submit" name="reject">Reject</button>-->
                      <!-- </div>-->
                      <!--</div> -->
                    </div>  
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 text-center" id="table11">
                        <thead>
                          <tr>
                            <th><input type="checkbox" name=""> </th>
                            <th>Person</th>
                            <th>Date</th>
                            <th>Leave Type</th>
                            <th>Reason</th>
                            <!--<th>Hours</th>-->
                            <th>Status</th>
                            <!--<th>Action</th>-->
                            <!--<th>Details</th>-->
                          </tr>
                        </thead>
                        <tbody id="fbody">
                          <?php 
                           foreach ($leave as $row)  
                          {
                          ?>
                          <tr>
                            <td><input type="checkbox" name=""></td>
                            <td><?php echo $row['emp_name'];?></td>
                            <td><?php echo $row['sdate']." - ".$row['edate'] ;?></td>
                            <td><?php echo $row['leave'];?></td>
                            <td><?php echo $row['note'];?></td>
                            <!--<td></td>-->
                          
                           <td>
                                          <?php if($row['status'] == 1) { ?>
                                              <button title="Change Status" class="btn-success  btn btn-sm" value="('<?=$row['id']?>')" onclick="change_status('<?=$row['id']?>','Pending')"> Approve </button>
                                          <?php } else { ?>
                                             <button  title="Change Status" type="button" id="button" class="btn-info btn btn-sm " value="('<?=$row['id']?>')" onclick="change_status('<?=$row['id']?>','Approve')"> Pending </button>
                                          <?php }  ?>
                                      </td>
                          <!--<td><a href="<?php echo site_url('timesheet/editleave/'. $row['id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>-->
                                    
                            <!--<td></td>-->
                          </tr>
                          <?php

                            } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row mt-4">
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
    
    <script>
         function change_status(id,value)
    {
        var id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this Request")){
            $.ajax({
                url: '<?php echo site_url("Timeoff/faq_status"); ?>',
                type: "POST",
                data: {
                    "id" : id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.faq_id).removeClass("btn-info").addClass('btn-success').text('Approve')
                    }
                    else 
                    {
                        $('#change_status_'+data.faq_id).removeClass("btn-success").addClass('btn-info').text('Pending')
                    }
                    location.reload();
                }
            });
        }
    }


    </script>
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
<!--<script type="text/javascript">-->
<!--$(document).ready(function() {-->
<!--    $('form button[type="submit"]').click(function(event) {-->
<!--        var val = $(this).attr('name');-->

<!--        alert(val);-->

<!--        if (val == 'approve') {-->
<!--            alert('approve');-->
<!--        } else if (val == 'reject') {-->
<!--            alert('reject');-->
<!--        } else if (val == 'cancel') {-->
<!--            alert('cancel');-->
<!--        }-->

        // Submit form
<!--        $('form').submit();-->

<!--        return false;-->
<!--    });        -->
<!--});-->
<!--</script>-->