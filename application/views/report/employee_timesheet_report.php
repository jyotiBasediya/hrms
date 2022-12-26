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

                    <h3 class="page-title">Timesheet Report</h3>
                    
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
                                <p class="mb-2">Company Name</p>
                                 <!-- <select class="form-control" placeholder="Client Name" name="client_name" id="client_name" onchange="getProject(this.value);"> -->
                                 <select class="form-control" placeholder="Client Name" name="client_name" id="client_name">

                                      <option value="">Select Company Name</option>
                                      
                                    <?php foreach($clients as $row) {?>
                                        <option  value="<?php echo  $row['id']?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                                          </select>  
                            </div>
                            <div class="col-sm-6">
                               <p class="mb-2">Project</p>
                               <!-- <select class="form-control" placeholder="Project Name" name="project_name" id="project_name" onchange="getTask(this.value);"> -->
                               <select class="form-control" placeholder="Project Name" name="project_name" id="project_name">
                                <option  value="">Select Project Name</option>
                                <?php foreach($project as $row) {?>
                                        <option  value="<?php echo  $row['id']?>">
                                                     <?php echo $row['project_name']?></option>
                                                       <?php } ?>
                              </select>
                            </div>

                        </div>  
                      </div> 
                       <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Task</p>
                                 <!-- <select class="form-control" placeholder="Task Name" name="task_id" id="task_id" onchange="getEmployee(this.value);"> -->
                                 <select class="form-control" placeholder="Task Name" name="task_id" id="task_id">
                                <option  value="">Select Task</option>
                                <?php foreach($task as $row) { ?>
                                        <option  value="<?php echo  $row->task_id;?>"><?php echo $row->task_name;?></option>
                                                       <?php } ?>

                              </select>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name" value="<?php echo $session['user_id']?>">
                           <!--  <div class="col-sm-6">
                               <p class="mb-2">Employee</p>
                               <select class="form-control" placeholder="Employee Name" name="employee_name" id="employee_name" >
                                <option  value="">Select Employee Name</option>
                                  <?php foreach($employees as $row) {  ?>
                                        <option  value="<?php echo  $row['user_id'];?>"><?php echo $row['first_name'].' '.$row['last_name'];?></option>
                                                       <?php } ?>
                              </select>
                            </div> -->
                             <!-- <button onclick="filterData();" class="btn btn-primary">Filter</button> -->
                        </div>  
                      </div> 
                       <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Type</p>
                                 <select class="form-control" placeholder="Task Name" name="task_status" id="task_status">
                                <option  value="">Select Task</option>
                                <option  value="billing">Billing</option>
                                <option  value="non_billing">Non Billing</option>
                              </select>
                            </div>
                            <div class="col-sm-6">
                               <p class="mb-2">Status</p>
                               <select class="form-control" placeholder="Task Name" name="approved_status" id="approved_status">
                                <option  value="">Select Status</option>
                                <option  value="0">Pending</option>
                                <option  value="1">Approved</option>
                                <option  value="2">Rejected</option>
                                <option  value="3">Completed</option>
                              </select>
                            </div>
                             <!-- <button onclick="filterData();" class="btn btn-primary">Filter</button> -->
                        </div>  
                      </div> 
                       <div class="col-sm-6"> 
                        <div class="row">
                            <!-- <div class="col-sm-6">
                                <p class="mb-2">Time</p>
                                 <select class="form-control" name="time" id="time">
                                <option  value="">Select Time</option>
                                <option  value="billing">Weak</option>
                                <option  value="non_billing">Month</option>
                              </select>
                            </div> -->

                            <div class="col-sm-6">
                                <p class="mb-2">Start Date</p>
                                  <input type="date" onchange="fromDate(this.value);" id="start" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <p class="mb-2">End Date</p>
                                <input type="date" id="end" class="form-control">
                            </div>
                             

                        </div>  
                      </div> 

                      <div class="col-sm-6 my-2"> 

                             <button onclick="filterData();" class="btn btn-primary">Filter</button>
                             <a href="<?php echo site_url();?>ReportController/employee_report_list" class="btn btn-primary">Refresh</a>
                      </div> 
                    </div> 
                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Company Name</th>
                          <th>Project Name</th>
                          <th>Task Name</th>
                          <th>Employee Name</th>
                          <th>Employee Email</th>
                          <th>Date</th>
                          <th>Hour</th>
                          <th>Billing Status</th>
                          <th>Status</th>
                          <th>Comment</th>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                        
                         <?php
                        $i =1;
                        foreach ($report_list as $v)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $i++;?></td>
                      
                         <td><?php echo $v['client_first_name'] . " " . $v['client_last_name'];?></td>
                          <td><?php echo $v['project_name'];?></td>
                          <td><?php echo $v['task_name'];?></td>
                          <td><?php echo $v['first_name'] . " " . $v['last_name'];?></td>
                          <td><?php echo $v['employee_email'];?></td>
                          <td><?php echo date("d-m-Y", strtotime($v['date']));?></td>
                          <td><?php echo $v['hour'];?></td>
                          <td><?php echo $v['task_status'];?></td>
                          <td>
                            <?php if($v['approved_status'] == 1){ ?>
                                           <span class="btn btn-success remove_effect">Approved</span>
                              <?php } elseif ($v['approved_status'] == 2) { ?>
                                           <span class="btn btn-danger remove_effect">Rejected</span>
                               <?php } elseif ($v['approved_status'] == 3) { ?>
                                           <span class="btn btn-success remove_effect">Completed</span>
                                <?php } elseif ($v['approved_status'] == 0) { ?>
                                           <span class="btn btn-info remove_effect">Pending</span>
                                <?php } ?>
                          </td>
                          <td>
                            <?php 
                                  
                                  if(!empty($v['comment']))
                                  {
                                      $comment = $v['comment'];
                                  }else{
                                      $comment = "No Comment";
                                  }

                                  echo $comment;
                            ?>
                            
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
            <!-- content-wrapper ends -->
           
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>


      <!-- page-body-wrapper ends -->
    </div>

 <script type="text/javascript">
  //------ change the status------------
   


    function fromDate() {
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
    


  $(document).ready( function () {
    $('#client_name').select2();
    $('#project_name').select2();
    $('#task_id').select2();
    $('#employee_name').select2();
    $('#task_status').select2();
    $('#approved_status').select2();

  });

  $(document).ready( function () { 

      $('#example').DataTable({
            dom: 'Bfrtip',
            scrollX: true,
            buttons: [
                {
                  extend: 'pdfHtml5',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                  columns: ':visible',
                  exportOptions: {                    
                      columns: [0,1,2,3,4,5,6,7,8,9,10]                
                  },
                },

                {
                  extend: 'excel',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                  columns: ':visible',
                   exportOptions: {                    
                      columns: [0,1,2,3,4,5,6,7,8,9,10]                
                  },
               },
               {
                  extend: 'print',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                  columns: ':visible',
                   exportOptions: {                    
                      columns: [0,1,2,3,4,5,6,7,8,9,10]                
                  },
               },

            ],
        
      });


  });


   function getProject(client_name){

        $.ajax({
            url: '<?php echo site_url("ReportController/getProject"); ?>',
            type: "POST",
            data: {
                "client_name" : client_name
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select Project</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No Project Found</option>'
                      
                    $('#project_name').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++){
                        html += '<option value="'+obj[i]['id']+'">'+obj[i]['project_name']+'</option>'
                    }
                    $('#project_name').html(html);
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

    function getEmployee(task_id){

        $.ajax({
            url: '<?php echo site_url("ReportController/getEmployee"); ?>',
            type: "POST",
            data: {
                "task_id" : task_id
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select employee</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No employee Found</option>'
                      
                    $('#employee_name').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++)
                    {
                        var name = obj[i]['first_name']+' '+obj[i]['last_name'];

                        html += '<option value="'+obj[i]['employee']+'">'+name+'</option>'
                    }
                    $('#employee_name').html(html);
                }
            }
        });
    }

    function filterData(){

        var client_name = document.getElementById('client_name').value;
        var project_name = document.getElementById('project_name').value;
        var task_id = document.getElementById('task_id').value;
        var employee_name = $("#employee_name").val();

        var task_status = document.getElementById('task_status').value;
        var approved_status = document.getElementById('approved_status').value;

         var start                   = document.getElementById('start').value;
        var end                     = document.getElementById('end').value;

         var buildSearchData = {
            "client_name"           : client_name,
            "project_name"          : project_name,
            "task_id"               : task_id,
            "employee_name"         : employee_name,
            "task_status"         : task_status,
            "approved_status"         : approved_status,

             "start"                     : start,
            "end"                       : end
        };

         table = $('#example').DataTable({ 
            // "scrollY"       : "350px",
            // "scrollCollapse": true,
            "scrollX": true,
            "dom"     : 'lBfrtip',
            "buttons"   : [
                      {
                            'extend': 'pdfHtml5',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                            'exportOptions': {                    
                                'columns': [0,1,2,3,4,5,6,7,8,9,10]                
                            },
         
                        },
                        // 'excel',
                        {
                            'extend': 'excel',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1,2,3,4,5,6,7,8,9,10]                
                            },
                         },
                         // 'print',
                        {
                            'extend': 'print',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1,2,3,4,5,6,7,8,9,10]                
                            },
                         },
                    ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("ReportController/employee_filter"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        });
    }
 </script>

