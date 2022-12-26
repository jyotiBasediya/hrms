
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add New Task</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>task">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>
                        <!-- <button class="btn btn-secondary btn-fw mx-2">Next</button> -->
                      <!--  -->
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-8 grid-margin stretch-card m-auto">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                       <div class="col-lg-12">
                          
                          <?php if(!empty($this->session->flashdata('success'))){ ?>
                            <div class="alert alert-success" role="alert">
                              <?php echo $this->session->flashdata('success'); ?>
                            </div>
                          <?php }?>
                          <?php if(!empty($this->session->flashdata('error'))){ ?>
                            <div class="alert alert-danger" role="alert">
                              <?php echo $this->session->flashdata('error'); ?>
                            </div>
                          <?php }?>
                          <form action="<?php echo site_url('task/insert') ?>" method="post" name="add_task" data-parsley-validate>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Task Description</h4>  
                                 <div class="form-group">
                                    <p>Company Name</p>
                                    <select class="form-control" placeholder="Client Name" name="client_name" id="client_name" onchange="getProject(this.value);">
                                      <option>Select Company Name</option>
                                      <?php foreach($clients as $row) {?>
                                        <option  value="<?php echo  $row['id']?>">
                                         <?php echo $row['first_name']." " .$row['last_name']?></option>
                                      <?php } ?>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                     <p>Project Name</p>
                                      <select class="form-control" placeholder="Project Name" name="project_name" id="project_name">
                                        <option  value="">Select Project Name</option>
                                      </select>
                                     </div>
                                
                                 <div class="form-group">
                                    <p>Task Name</p>
                                    <input class="form-control" type="text" name="task_name" data-parsley-required data-parsley-required-message="Please enter Task Name">
                                 </div> 
                                 <div class="form-group">
                                    <p>Task Code</p>
                                    <input class="form-control" type="text" name="task_code" data-parsley-required data-parsley-required-message="Please enter Task Code">
                                    <small>(suggested 3-5 characters)</small>
                                 </div>  
                                 <div class="form-group">
                                    <p>Accounting Package Task ID</p>
                                    <input class="form-control" type="number" name="task_id" >
                                 </div> 
                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status" id="status">
                                      <option value="">Select Status</option>
                                       <option value="billing" >Billable </option>
                                      <option value="non_billing">Non Billable</option>
                                    </select>
                                 </div> 
                                 
                                 <div class="form-group">
                                    <p>Assign To</p>
                                     <select class="form-control"  data-live-search="true" name="employee_id[]" id="employee_id" required data-parsley-required data-parsley-required-message="Select Brand Name" multiple onchange="checkEmployeeTask(this);" >
                                         <option value="">Select  Employee Assign To</option>
                                         <?php foreach($employees as $row) {?>
                                          <option  value="<?php echo  $row['user_id']?>">
                                          <?php echo $row['first_name']." " .$row['last_name']?></option>
                                        <?php } ?>
                                     </select>
                                    <span id="errmsg_employee" style="color: red"></span>
                                    </div>
                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="notes">
                                      
                                    </textarea>
                                 </div> 
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Save</button>
                                  </div> 
                              </div>     
                          </form>
                       </div>      
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
    <script>
        $( document ).ready(function() {
        $('#employee_id').select2();
        $('#project_name').select2();
        $('#client_name').select2();
        $('#status').select2();
       
    });


    function getProject(client_name){

        $.ajax({
            url: '<?php echo site_url("task/getProject"); ?>',
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

    $(document).on('change', '#employee_id', function() {
      // alert("hi");
      // Does some stuff and logs the event to the console
    });
    var selectedOption;
    function checkEmployeeTask(employee_id){
      // alert(employee_id);            
      // if($("#employee_id").is(":selected")) {
      //   last_selected = $(this).attr('value');
      // }
      // last_selected = $("#employee_id").attr('value');
      // alert(last_selected);
      // console.log(employee_id);
      //alert($("#employee_id").val());
      // var currentSelection;
      // if (selectedOption) {
      //   var currentValues = $(this).val();
      //   currentSelection = currentValues.filter(function(el) {
      //     return selectedOption.indexOf(el) < 0;
      //   });
      // }
      // selectedOption = $(this).val();
      // alert(selectedOption);
      var opts = [],
      opt;
      var len = employee_id.options.length;
      // alert(len);
      for (var i = 0; i < len; i++) {
        opt = employee_id.options[i];
        if (opt.selected) {
           opts.push(opt);

           var employeeid = opt.value
           
           // console.log(employeeid);
           
        }

      }

      // alert(employeeid);

      $.ajax({
          url: '<?php echo site_url("task/checkEmployeeTask"); ?>',
          type: "POST",
          data: {
              "employee_id" : employeeid
          },
          dataType:'json',
          success: function (response)
          {
              console.log(response);
              if (response.status == 1) {
                  if(response.taskcount > 2){
                    $('#errmsg_employee').html('This employee is 100% occupied as already added in two projects and you can not add him to any new project');
                  }else{
                    if(response.taskcount == 1){
                      $('#errmsg_employee').html("This employee is 50% occupied as already added in one project");
                    }else{
                      $('#errmsg_employee').html('');
                    }

                  }
                   
              } else {
                console.log('no');
                $('#errmsg_employee').html('');
                
              }
          }
      });
    }
    </script>