<!DOCTYPE html>
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
                    <h3 class="page-title">Timesheet Review</h3>
                    <div class="d-flex float-right"> 
                        <!-- <button class="btn btn-secondary btn-fw">Time Entry Completion</button> -->
                        <button class="btn btn-secondary btn-fw mx-2"><a href="<?php echo base_url().'Timesheet/manually_attendance';?>">Manually Attendance</a></button>
                        
                    </div>  
                   </div>  
                </div> 
                <div class="filter-timesheets w-100 card p-3 my-4">
                    <div class="d-flex justify-content-between mb-4">
                      <h4 class="mb-3 font-weight-semibold">Filter Timesheets</h4>  
                    </div>                      
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-1">Project</p>
                             <select class="form-control" placeholder="Project Name" name="project_id" id="project_id" onchange="getTask(this.value);">

                              <option>Select Project</option>
                              
                            <?php foreach($project as $row) {?>
                                <option  value="<?php echo  $row['project_id']?>">
                                             <?php echo $row['project_name']?></option>
                                               <?php } ?>
                                                  </select>  
                        </div>  

                        <div class="col-sm-3">
                             <p>Task</p>
                               <select class="form-control" placeholder="Task Name" name="task_id" id="task_id">
                                <option  value="">Select Task</option> 
                              </select>
                        </div>  

                       
                        <div class="col-sm-3">
                           <p class="mb-1">Start</p>
                            <input class="form-control txtDate" type="date" name="" id="start" onchange="fromDate(this.value);">
                        </div>  
                        <div class="col-sm-3">
                            <p class="mb-1">End</p>
                            <!--<input class="form-control" type="date" name="">-->
                            <input class="form-control txtDate" type="date" name=""  id="end">
                        </div>   
                           <button onclick="filterData();" class="btn btn-primary">Filter</button>

                           <a href="<?php echo site_url();?>timesheet/timesheet_view" class="btn btn-primary">Refresh</a>
                    </div>  
                </div>  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                     <!--  <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Show</p>
                                <select class="form-control">
                                  <option>Active & Inactive People</option>
                                  <option>Active People</option>
                                  <option>Inactive People</option>
                                </select>   
                            </div>
                            <div class="col-sm-6">
                               <p class="mb-2">Group By</p>
                               <select class="form-control w-75">
                                  <option>Timesheet Period</option>
                                  <option>Person</option>
                                  <option>Approver</option>
                               </select>   
                            </div>
                        </div>  
                      </div>  -->
                      <!-- <div class="col-sm-6">
                       <div class="d-flex flex-row-reverse"> 
                        <button class="btn btn-secondary btn-fw">Approve</button>
                        <button class="btn btn-secondary btn-fw mx-2">Reject</button>
                        <button class="btn btn-secondary btn-fw">Send Email</button>
                       </div>
                      </div>  -->
                    </div>  
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 text-center" id="example">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Project Name</th>
                            <th>Task Name</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Comment</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                  $i = 1;
                                  foreach($attendances as $v) {
                            ?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $v['project_name'];?></td>
                            <td><?php echo $v['task_name'];?></td>
                            <td><?php echo date("d/m/Y", strtotime($v['date']));?></td>
                            <td><?php echo $v['start_time'];?></td>
                            <td><?php echo $v['end_time'];?></td>
                            <td>
                              <?php
                                  if ($v['status'] == '0') {
                                      $status =  "<span class = 'btn btn-default'>Pending</span>";
                                  }else if ($v['status'] == '1') {
                                    $status =  "<span class = 'btn btn-success'>Approved</span>";
                                  }else if ($v['status'] == '2') {
                                    $status =  "<span class = 'btn btn-danger'>Rejected</span>";
                                  }
                                  echo $status;
                              ?>
                            </td>
                            <td>
                              <?php 
                                  if(!empty($v['comment']))
                                  {
                                    echo $v['comment'];
                                  }else{
                                    echo 'No comment';
                                  }
                              ?>
                              
                            </td>
                            <!--<td>No Details</td>-->
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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
     <script type="text/javascript">
        function fromDate() {
              console.log(1);
            from_date = document.getElementById('start').value;
    
            var from = from_date.split("-")
            // console.log(from)
            // from[1]+'/'+from[2]+'/'+from[0]
            var f = from[0]+'-'+from[1]+'-'+from[2]
            // console.log(from[0]+'-'+from[1]+'-'+from[2])
            // alert(f)
            document.getElementById("end").setAttribute("min", f);
    
            // $( "#to_date" ).datepicker({ minDate: f});
         
            
            
        }   
    
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('.txtDate').attr('max', maxDate);
    });
    
    
    function filterData(){
        var project_id                   = document.getElementById('project_id').value;
        var task_id                     = document.getElementById('task_id').value;

        var start                     = document.getElementById('start').value;
        var end                     = document.getElementById('end').value;

        var buildSearchData =     {
            "project_id"                     : project_id,
            "task_id"                       : task_id,
             "start"                     : start,
            "end"                       : end
        };
        table = $('#example').DataTable({ 
            // "scrollY"       : "350px",
            // "scrollCollapse": true,
            "dom"     : 'lBfrtip',
            "buttons"   : [
                      {
                            'extend': 'pdfHtml5',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                            'exportOptions': {                    
                                'columns': [0,1,2,3,4,5]                
                            },
         
                        },
                        // 'excel',
                        {
                            'extend': 'excel',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1,2,3,4,5]                
                            },
                         },
                         // 'print',
                        {
                            'extend': 'print',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1,2,3,4,5]                
                            },
                         },
                    ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("timesheet/timesheet_view_filter"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );
    }
    </script>
    <!-- container-scroller -->
    <!-- js -->
<!--     <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script> -->
     <!-- Custom js for this page-->
<!--     <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
    <!-- <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
  </body>
</html> -->

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

 $( document ).ready(function() {
        $('#project_id').select2();
        $('#task_id').select2();
       
    });
  function getTask(project_name){

        $.ajax({
            url: '<?php echo site_url("ReportController/getTask"); ?>',
            type: "POST",
            data: {
                "project_name" : project_name
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select Task</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No Task Found</option>'
                      
                    $('#task_id').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++){
                        html += '<option value="'+obj[i]['task_id']+'">'+obj[i]['task_name']+'</option>'
                    }
                    $('#task_id').html(html);
                }
            }
        });
    }
</script>