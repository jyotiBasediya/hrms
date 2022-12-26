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
                    <h3 class="page-title">Timesheet List</h3>
                    <div class="d-flex float-right"> 
                        <!-- <button class="btn btn-secondary btn-fw">Time Entry Completion</button> -->
                        <!-- <button class="btn btn-secondary btn-fw mx-2"><a href="<?php echo base_url().'Timesheet/manually_attendance';?>">Manually Attendance</a></button> -->
                        <!--  <div class="btn-group">
                        <button type="button" class="btn btn-secondary">Bulk Actions</button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                          <a class="dropdown-item" href="#">Add timesheet entries</a>
                          <a class="dropdown-item" href="#">Delete timesheet entries</a>
                          <a class="dropdown-item" href="#">Find and replace timesheet entries</a>
                          
                        </div>
                      </div> -->
                    </div>  
                   </div>  
                </div> 
                <div class="filter-timesheets w-100 card p-3 my-4">
                    <div class="d-flex justify-content-between mb-4">
                      <h4 class="mb-3 font-weight-semibold">Filter Timesheets</h4>  
                    </div>                      
                    <div class="row">
                      <div class="col-sm-3">
                            <p class="mb-1">Employee</p>
                             <select class="form-control" placeholder="Project Name" name="employees_id" id="employees_id" onchange="getProject(this.value);">

                              <option>Select Employee</option>
                              
                            <?php foreach($employees as $row) {?>
                                <option  value="<?php echo  $row['user_id']?>">
                                             <?php echo $row['first_name'].' '.$row['last_name']?></option>
                                               <?php } ?>
                                                  </select>  
                        </div>  

                        <div class="col-sm-3">
                            <p class="mb-1">Project</p>
                             <select class="form-control" placeholder="Project Name" name="project_id" id="project_id" onchange="getTask(this.value);">
                              <option>Select Project</option>
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
                            <th>Employee Name</th>
                            <th>Project Name</th>
                            <th>Task Name</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Comment</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                  $i = 1;
                                  foreach($attendances as $v) {
                            ?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $v['first_name'].' '.$v['last_name'];?></td>
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
                            <td>
                              <?php if($v['status'] == 1){ ?>
                                 <span class="btn btn-success remove_effect">Approved</span>
                              <?php } elseif ($v['status'] == 2) { ?>
                                 <span class="btn btn-danger remove_effect">Rejected</span>
                              <?php }else{ ?>
                                 <a href="#myModalAccept" data-toggle="modal" value="<?php echo $v['id']; ?>" class="btn btn-primary accept" data-id ="<?php echo $v['id']; ?>">Accept</a>

                                  <a href="#myModalReject" data-toggle="modal" value="<?php echo $v['id']; ?>" class="btn btn-danger reject" data-id ="<?php echo $v['id']; ?>">Reject</a>
                               <?php } ?>
                            </td>
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
            
 <!-- Modal for comment the status -->
    <div id="myModalAccept" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Message</h4>
                </div>
                <form method="POST" data-parsley-validate action="<?php echo base_url().'Timesheet/time_status'?>">
                    <div class="modal-body">
                      <input type="hidden" name="attendance_id" id="attendance_id">
                      <input type="hidden" name="status" id="status_approved">
                      <center><strong>Are you sure want to accept ?</strong></center>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!-- Modal for comment the status -->
    <div id="myModalReject" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Message</h4>
                </div>
                <form method="POST" data-parsley-validate action="<?php echo base_url().'Timesheet/time_status'?>">
                    <div class="modal-body">
                      <input type="hidden" name="attendance_id" id="attendanceid">
                      <input type="hidden" name="status" id="status_reject">
                      <center><strong>Are you sure want reject this business profile ? </strong></center>
                    </div>
                    


                    <div class="modal-body" style="padding: 0rem 1rem">
                      <input class="form-control mt-2" id="comment" type="text" placeholder="Comment" name="admin_comment" required data-parsley-required data-parsley-required-message="Please Enter Reason For Rejected">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        var employees_id                   = document.getElementById('employees_id').value;
        var project_id                   = document.getElementById('project_id').value;
        var task_id                     = document.getElementById('task_id').value;

        var start                     = document.getElementById('start').value;
        var end                     = document.getElementById('end').value;

        var buildSearchData =     {
            "employees_id"                     : employees_id,
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
               "url"        : '<?php echo site_url("timesheet/timesheet_list_filter"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );
    }
    </script>

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
        $('#employees_id').select2();
       
    });

 function getProject(emp_name){

        $.ajax({
            url: '<?php echo site_url("ReportController/getEmpProject"); ?>',
            type: "POST",
            data: {
                "emp_name" : emp_name
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select Project</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No Project Found</option>'
                      
                    $('#project_id').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++){
                        html += '<option value="'+obj[i]['project_id']+'">'+obj[i]['project_name']+'</option>'
                    }
                    $('#project_id').html(html);
                }
            }
        });
    }


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


       //------ change the status------------
    $(document).ready(function() {
        $(document).on('click','.accept', function() { 
              var term = $(this).data('id');
              
              $('#attendance_id').val(term);
              $('#status_approved').val(1);
        });
        $(document).on('click','.reject', function() { 
              var term = $(this).data('id');
              
              $('#attendanceid').val(term);
              $('#status_reject').val(2); 
        });
    });
</script>



