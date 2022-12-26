<?php $session = $this->session->userdata('username');?>

        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Employee</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>employees">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>

                        <button class="btn btn-secondary btn-fw mx-2">Next</button>
                  
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-8 grid-margin stretch-card m-auto">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                       <div class="col-lg-12">
    
                         <form action="<?php echo base_url('employees/updates');?>" method="post" name="add_employee" data-parsley-validate>
                              <div class="">
                                <input type="hidden" name="id" value="<?php echo $employees_detail->user_id; ?>">
                                 <h4 class="mb-4 font-weight-semibold">Basic Information</h4>  
                                  <div class="form-group">
                                    <p>Level</p>
                                    <select class="form-control" name="level" required data-parsley-required-message="Select level" disabled>
                                        <option>Select Level</option>
                                        <option value="L0" <?php if('L0'==$employees_detail->level){ echo 'selected'; } ?>>L0</option>
                                        <option value="L1" <?php if('L1'==$employees_detail->level){ echo 'selected'; } ?>>L1</option>
                                        <option value="L2" <?php if('L2'==$employees_detail->level){ echo 'selected'; } ?>>L2</option>
                                        <option value="L3" <?php if('L3'==$employees_detail->level){ echo 'selected'; } ?>>L3</option>
                                        <option value="L4" <?php if('L4'==$employees_detail->level){ echo 'selected'; } ?>>L4</option>
                                        <option value="L5" <?php if('L5'==$employees_detail->level){ echo 'selected'; } ?>>L5</option>
                                    </select>
                                 </div> 

                                 <div class="form-group">
                                    <p>Full Name</p>
                                    <input class="form-control" type="text" name="full_name" value="<?php echo $employees_detail->first_name . " " .  $employees_detail->last_name;?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Email Address</p>
                                    <input class="form-control" type="email" name="email" value="<?php echo $employees_detail->email; ?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Start Date</p>
                                    <input class="form-control" name="sdate" id="txtFrom" value="<?php echo $employees_detail->date_of_joining?>" readonly >
                                 </div> 
                                 <div class="form-group">
                                    <p>End Date</p>
                                    <input class="form-control" name="edate" id="txtTo" value="<?php echo $employees_detail->date_of_leaving?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Role</p>
                                     <select class="form-control" placeholder="Role" name="user_role_id" required data-parsley-required-message="Select role" disabled>
                                        <?php foreach($all_roles as $row) {?>
                                            <option  value="<?php echo  $row->role_id?>" <?php if($row->role_id==$employees_detail->user_role_id){ echo 'selected'; } ?>><?php echo $row->role_name?></option>
                                         <?php } ?>
                                    </select>
                                 </div> 

                                 <div class="form-group">
                                    <p>Employment</p>
                                    <select class="form-control" name="employment" disabled>
                                        <option <?php if ($employees_detail->empType=='Contractor') {
                                     echo "selected";
                                    }?>>Contractor</option>
                                        <option <?php if ($employees_detail->empType=='Full-time employee') {
                                     echo "selected";
                                    }?>>Full-time employee</option>
                                        <option <?php if ($employees_detail->empType=='Hourly employee') {
                                     echo "selected";
                                    }?>>Hourly employee</option>
                                        <option <?php if ($employees_detail->empType=='Standard') {
                                     echo "selected";
                                    }?>>Standard</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Division</p>
                                    <select class="form-control" name="division" value="<?php echo $employees_detail->division?>" readonly>
                                      <option>No Division</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Default Task:</p>
                                    <input class="form-control" type="text" name="task" value="<?php echo $employees_detail->default_task?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Employee Number</p>
                                    <input class="form-control" type="text" name="enumuber" value="<?php echo $employees_detail->employee_id?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Accounting Package Person ID</p>
                                    <input class="form-control" type="text" name="account" value="<?php echo $employees_detail->accounting_id?>" readonly>
                                 </div> 
                                  <div class="form-group">
                                    <p>Desk Number</p>
                                    <input class="form-control" type="text" name="desk_number" id="desk_number" required data-parsley-required data-parsley-required-message="Please enter Desk number" value="<?php echo $employees_detail->desk_number?>" readonly>
                                 </div> 

                                 <div class="form-group">
                                    <p>Location</p>
                                    <input class="form-control" type="text" name="location" id="location" required data-parsley-required data-parsley-required-message="Please enter location" value="<?php echo $employees_detail->location?>" readonly>
                                 </div> 

                                 <div class="form-group">
                                    <p>Time Zone</p>
                                    <input class="form-control" type="text" name="time_zone" id="time_zone" required data-parsley-required data-parsley-required-message="Please enter time zone" value="<?php echo $employees_detail->time_zone?>" readonly>
                                 </div> 


                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status" value="<?php echo $employees_detail->status?>" disabled>
                                      <option <?php if ($employees_detail->status=='active') {
                                     echo "selected";
                                    }?>>active </option>
                                      <option <?php if ($employees_detail->status=='inactive') {
                                     echo "selected";
                                    }?>>inactive</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="note" value="<?php echo $employees_detail->notes?>" readonly>
                                      <?php echo $employees_detail->notes;?>
                                    </textarea>
                                 </div> 
                                 <!-- <div class="form-group">
                                    <p>Password</p>
                                    <input class="form-control" type="password" name="password" value="<?php echo $employees_detail->password?>">
                                 </div> 
                                 <div class="form-group" >
                                    <p>Confirm Password</p>
                                    <input class="form-control" type="password" name="cpass" >

                                 </div>  -->
                                 <!-- <div class="">
                                    <input type="checkbox" name=""> Email sign-in instructions with password (this can be sent later or at anytime)

                                 </div>  -->

                                 

                              </div> 
                               <div class="mt-5">
                                  <h4 class="font-weight-semibold mb-0">Timesheet Settings & Approvals</h4>
                                  <p class="mb-4 small text-muted">Set approvers and edit timesheet settings for this person.</p>

                                  <h5 class="font-weight-semibold mb-0">Approvals</h5>
                                  <p class="mb-4 small text-muted">It may take a few moments to populate the most current approvers.</p>

                                  <div class="form-group">
                                    <p class="mt-2"><input class="mr-2" type="checkbox" id ="timesheat_check" name="check_timesheat" onclick="timesheat(this)" <?php if($employees_detail->check_timesheat == 'on'){ echo 'checked'; } ?> disabled> Timesheets are approved by </p>

                                    <?php if(!empty($employees_detail->check_timesheat)) {?>
                                      <?if(!empty($employees_detail->check_timesheat) || $employees_detail->check_timesheat == 'on') { ?>  
                                          <select class="form-control" id="" name="timesheet" disabled>
                                            <option value="">Select</option>         
                                            <?php foreach($groups as $row) {?>
                                                <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$employees_detail->timesheet){ echo 'selected'; } ?>>
                                                    <?php echo $row['first_name']." " .$row['last_name']?>
                                                </option>
                                            <?php } ?> 
                                          </select>
                                      <?php } ?> 
                                      <?php } ?> 
                                  </div>  

                                  <div class="form-group">
                                       <p class="mt-2"><input class="mr-2" type="checkbox" id="timeoff_check" name="check_timeoff" onclick="timeoff(this)" <?php if($employees_detail->check_timeoff == 'on'){ echo 'checked'; } ?> disabled> Time off is approved by </p>

                                       <?php if(!empty($employees_detail->check_timeoff)) {?>
                                       <?if(!empty($employees_detail->check_timeoff) || $employees_detail->check_timeoff == 'on') { ?>   
                                               <select class="form-control" id="" name="time_off" disabled>
                                               <option  value="">Select</option>     
                                             <?php foreach($groups as $row) {?>
                                               <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$employees_detail->time_off){ echo 'selected'; } ?>>
                                                  <?php echo $row['first_name']." " .$row['last_name']?></option>    
                                              <?php } ?>  
                                              </select>  
                                       <?php } ?> 
                                       <?php } ?> 
                                  </div>  

                                  <div class="form-group">
                                      <p class="mt-2"><input class="mr-2" type="checkbox" id="expense_check" name="check_expense" onclick="expence(this)" <?php if($employees_detail->expense_check == 'on'){ echo 'checked'; } ?> disabled> Expenses are approved by </p>

                                      <?php if(!empty($employees_detail->expense_check)) {?>
                                      <?if(!empty($employees_detail->check_expense) || $employees_detail->check_expense == 'on') { ?>    
                                           <select class="form-control" id="expenses" name="expenses" disabled>
                                             <option value="">Select</option>     
                                           <?php foreach($groups as $row) {?>
                                             <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$employees_detail->expense_check){ echo 'selected'; } ?>>
                                              <?php echo $row['first_name']." " .$row['last_name']?></option>
                                            <?php } ?>             
                                          </select>  
                                       <?php } }?>        
                                  </div>  
                              </div>  
                              <!-- <div class="mt-5">
                                  <h4 class="font-weight-semibold mb-0">Settings</h4>
                                  <p class="mb-4 small text-muted">Set approvers and edit timesheet settings for this person.</p>

                                  <div class="form-group">
                                     <div class="d-flex align-items-center mb-4"> 
                                        <input class="form-control w-25" type="" name="">
                                        <span class="mx-2">hours per</span> 
                                        <select class="form-control w-25">
                                         <option>Day</option>
                                         <option>Week</option>
                                        </select>
                                        <span class="mx-2">are entered</span>
                                     </div> 
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Timesheet is incomplete if less than </p>
                                  </div>  

                                  <div class="form-group">
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Incomplete timesheets cannot be submitted </p>
                                  </div>  

                                  <div class="form-group">
                                      
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Notes must be entered with every time entry
                                      </p>
                                  </div> 
                                  <div class="form-group">
                                      
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Start and end times must be entered with every time entry
                                      </p>
                                  </div>
                                  <div class="form-group pl-5">
                                      
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name="">Allow entering break times (for meals, breaks, etc.)
                                      </p>

                                      <p class="mt-2"><input class="mr-2" type="checkbox" name="">Prevent stopwatches from being restarted</p>

                                      <p class="mt-2 pl-5"><input class="mr-2" type="checkbox" name="">Time can only be entered with a stopwatch
                                      </p>
                                  </div>

                              </div>  -->

                              <div class="mt-5">
                                 <!--  <h4 class="font-weight-semibold mb-0">Costs</h4>
                                  <p class="mb-4 small text-muted">The hourly cost rate associated with this person.</p>

                                  <h5>The estimated cost rate for this person is:</h5>
                                  <div class="d-flex justify-content-between align-items-center border-top border-bottom mt-4 py-1">
                                      <div class="align-items-center d-flex">
                                         <span class="mr-2 p-3">RS</span>
                                         <input class="form-control w-25" type="" name="">
                                      </div>
                                      <p class="mb-0 text-muted font-italic">The company default is set to Rs75/hr.</p>
                                  </div>
                                  <div class="d-inline-block w-100">  
                                    <a class="btn btn-warning2 btn-rounded mt-3 float-right"> 
                                     <i class="fa fa-magic py-2" aria-hidden="true"></i>
                                    </a> 

                                    <div class="costWizardArrowText">Looking for a more accurate number? Click the icon to get started!</div>
                                  </div>  -->
                                  <div class="text-center">
                                      <!-- <button class="btn btn-warning2 t mt-4 px-5">Update</button> -->
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
           

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->
<script type="text/javascript">
function checkEmail(email)
{
  // console.log(email);
    if (email !='') {
        $.ajax({
            url:'<?php echo site_url('add_form/check_email')?>',
            type:"POST",
            data:{
                "email":email
            },

            success: function (response)
            {
                console.log(response);
                if (response=='0') {
                    $('#errmsg').html('');
                }
                else{
                    $('#errmsg').html("<?php echo 'email already exist'?>"),
                    $('#email').val('');
                }
            }
        });
    }
}


    function fromDate() {
        from_date = document.getElementById('sdate').value;
        var from = from_date.split("-")
        var f = from[0]+'-'+from[1]+'-'+from[2]
        document.getElementById("edate").setAttribute("min", f);
    }
    // <script>
    
    function timesheat(check)
    {
        if ($('#timesheat_check').is(":checked")) {
          $('#timesheet').show()
        }else{
            $('#timesheet').hide();
        }
    }

    function timeoff(check)
    {

        if ($('#timeoff_check').is(":checked")) {
          $('#time_off').show()
        }else{
            $('#time_off').hide();
        }
    }

    function expence(check)
    {
        if ($('#expense_check').is(":checked")) {
          $('#expenses').show()
        }else{
            $('#expenses').hide();
        }
    }


    // $( document ).ready(function() {
    //     $('#employee_id').select2();
    //     $('#project_name').select2();
    //     $('#client_name').select2();

    //      $.each($("input[name='check_timesheat']:checked"), function(){            
    //         var check_timesheat = $(this).val();
    //         alert(check_timesheat);
    //     });
       
    // });
      $( document ).ready(function() {

        // $('#timesheet').hide();
        // $('#time_off').hide();
        // $('#expenses').hide();

        // $('#timesheet').select2();
    //     $('#time_off').select2();
    //     $('#expenses').select2();
       
    });
</script>