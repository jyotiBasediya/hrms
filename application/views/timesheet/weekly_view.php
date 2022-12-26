<?php $session = $this->session->userdata('username');?>
        <!-- partial -->



<!-- <!DOCTYPE >
<html>
<head>
  
 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body> -->
  <!--  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">

                     <h3 class="page-title"> Weekly View </h3>
                   </div>  
                </div> 
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">

                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Date</th>
                          <th>Client Name</th>
                          <th>Project Name</th>
                          <th>Task Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                        
                         <?php
                        $i =1;
                        foreach ($day_task as $v)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $i++;?></td>
                           <td><?php echo date("d-m-Y", strtotime($v['created_at']));?></td>
                      
                         <td><?php echo $v['client_first_name'];?></td>
                          <td><?php echo $v['project_name'];?></td>
                          <td><?php echo $v['task_name'];?></td>
                          <td><a href="<?php echo site_url();?>task/add_project_resource/<?php echo $v['task_id'];?>">Add Hour</a> </td>
                        </tr>
                        <?php

                          } ?>
                        
                       
                        
                      </tbody>
                    </table>
                    <div class="row mt-4">
                     <!--  <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                       <!--    <ul class="pagination float-right">
                            <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li> -->
<!-- 
                            <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">2</a></li> -->
                            
                          <!--   <li class="paginate_button page-item next" id="order-listing_next"><a href="#" aria-controls="order-listing" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li> -->
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
    <!-- container-scroller -->
    <!-- js -->
<!-- 
  <script src="assets/js/filter_data.js"></script> -->
   <!--  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
     <!- Custom js for this page-->
   <!-- <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
   <!--  <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
 -->

<!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  -->
  
<!-- <script>
  $("#searchInput").keyup(function() {
  var rows = $("#fbody").find("tr").hide();
  var data = this.value.split(" ");
  $.each(data, function(i, v) {
    rows.filter(":contains('" + v + "')").show();
  });
});
</script> -->

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
</script>