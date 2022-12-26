<?php 
$session = $this->session->userdata('username');

$user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
?>

        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Profile</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>dashboard">
                        <button class="btn btn-secondary btn-fw">Dashboard</button>
                      </a>
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-8 grid-margin stretch-card m-auto">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                       <div class="col-lg-12">
    
                          <form action="<?php echo base_url('profile/update_profile');?>" method="post" name="add_employee" data-parsley-validate enctype="multipart/form-data">
                              <div class="">
                                <input type="hidden" name="id" value="<?php echo $session['user_id']; ?>">
                                 <h4 class="mb-4 font-weight-semibold">Profile</h4> 
                             <div class="form-group">
                                    <p>Level</p>
                                     <select class="form-control" name="level" required data-parsley-required-message="Select level" disabled="">
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
                                    <input class="form-control" type="text" name="full_name" required  data-parsley-group="block-2" data-parsley-required-message="Please enter Full Name" value="<?php echo $employees_detail->first_name . " " .  $employees_detail->last_name;?>">
                                 </div> 

                                 <?php if($user_info[0]->user_role_id == 1){?>
                                  <div class="form-group">
                                    <p>Email Address</p>
                                    <input class="form-control" type="email" name="email" id="email" required data-parsley-required data-parsley-required-message="Please enter Email-Id" data-parsley-type = "email" value="<?php echo $employees_detail->email; ?>">
                                    <span id="errmsg" style="color: red;"></span>
                                 </div>
                                 <?php }else{?>
                                  <div class="form-group">
                                    <p>Email Address</p>
                                    <input class="form-control" type="email" name="email" id="email" required data-parsley-required data-parsley-required-message="Please enter Email-Id" data-parsley-type = "email" value="<?php echo $employees_detail->email; ?>" readonly>
                                    <span id="errmsg" style="color: red;"></span>
                                 </div>
                                 <?php }?>
                                 
                                 <div class="form-group">
                                    <p>Contact Number</p>
                                    <!-- <input class="form-control" type="text" name="mobile_no" data-parsley-required-message="Please enter Contact Number"  required data-parsley-required data-parsley-required-message="Enter mobile number" data-parsley-type="number" value=" <?php echo $employees_detail->mobile_no; ?>"> -->
                                    <input class="form-control" type="text" name="mobile_no" data-parsley-required-message="Please enter Contact Number"  required data-parsley-required data-parsley-required-message="Enter mobile number" value="<?php echo $employees_detail->mobile_no; ?>">
                                 </div>
                                 <div class="form-group">
                                    <p>Date of Birth</p>
                                     <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required data-parsley-required-message="Please select date of birth"  value="<?php echo $employees_detail->date_of_birth?>" >
                                 </div>

                                 <div class="form-group">
                                    <p>Employment</p>
                                    <select class="form-control" name="employment" id="employmentType" disabled="">
                                         <option value="">Select Employment Type</option>
                                        <option value="contractor" <?php if ($employees_detail->empType=='contractor') {  echo "selected";}?>>Contractor</option>
                                        <option value="Full-time" <?php if ($employees_detail->empType=='Full-time') {  echo "selected"; }?>>Full-time employee</option>
                                        <option value="Hourly" <?php if ($employees_detail->empType=='Hourly') { echo "selected";}?>>Hourly employee</option>
                                        <option value="Standard" <?php if ($employees_detail->empType=='Standard') { echo "selected";  }?>>Standard</option>
                                    </select>
                                 </div> 

                                 <div class="form-group" disabled="">
                                    <p>Start Date</p>
                                     <input type="date" onchange="fromDate(this.value);" id="sdate" name="sdate" class="form-control" required data-parsley-required-message="Please select start date" value="<?php echo $employees_detail->date_of_joining?>" readonly>
                                 </div>

                                  <?php if($employees_detail->empType=='contractor') {?>
                                     <div class="form-group end_date_div">
                                        <p>End Date</p>
                                        <input type="date" name="edate" id="edate" class="form-control" value="<?php echo $employees_detail->date_of_leaving?>" readonly>
                                     </div> 
                                  <?php } else {?>
                                    <div class="form-group end_date_div" style="display: none">
                                        <p>End Date</p>
                                        <input type="date" name="edate" id="edate" class="form-control" >
                                     </div> 

                                  <?php }?>

                                  <div class="form-group">
                                    <p>Manager</p>
                                    <select class="form-control" placeholder=" Manager" name="manager_id" id="manager_id" disabled="">
                                       <option value="">Select Manager</option>
                                      <?php foreach($employees as $row) {?>
                                       <option  value="<?php echo  $row['user_id'];?>"  <?php if( $row['user_id']==$employees_detail->manager_id){ echo 'selected'; } ?>>
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                    </select>
                                                                  
                                 </div> 



                                 <div class="form-group">
                                    <p>Role</p>
                                     <select class="form-control" placeholder="Role" name="user_role_id" id="user_role_id" disabled="">
                                     <option  value="">Select Division</option>
                                        <?php foreach($all_division as $division) {?>
                                            <option  value="<?php echo  $division['id']?>" <?php if($division['id']==$employees_detail->division){ echo 'selected'; } ?>><?php echo $division['name']?></option>
                                         <?php } ?>
                                    </select>
                                 </div> 
                                 
                                 <div class="form-group">
                                    <p>Division</p>
                                    <select class="form-control" placeholder="Division" name="division"  id="division" disabled="">
                                     <option  value="">Select Division</option>
                                        <?php foreach($all_division as $division) {?>
                                            <option  value="<?php echo  $division['id']?>" <?php if($division['id']==$employees_detail->division){ echo 'selected'; } ?>><?php echo $division['name']?></option>
                                         <?php } ?>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Default Task:</p>
                                    <input class="form-control" type="text" name="task" value="<?php echo $employees_detail->default_task?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Employee Number</p>
                                    <input class="form-control" type="text" name="enumuber"  value="<?php echo $employees_detail->employee_id?>" readonly>
                                 </div> 
                                 <div class="form-group">
                                    <p>Accounting Package Person ID</p>
                                    <input class="form-control" type="text" name="account" value="<?php echo $employees_detail->accounting_id?>" readonly>
                                 </div> 
                                 <!-- <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status" disabled="">
                                      <option value="1" <?php if ($employees_detail->status=='1') { echo "selected"; }?>>Active </option>
                                      <option value="0" <?php if ($employees_detail->status=='0') { echo "selected"; }?>>Inactive</option>
                                    </select>
                                 </div>  -->
                                  <div class="form-group">
                                    <p>Desk Number</p>
                                    <input class="form-control" type="text" name="desk_number" id="desk_number"  value="<?php echo $employees_detail->desk_number?>">
                                    <!-- <input class="form-control" type="text" name="desk_number" id="desk_number" required data-parsley-required data-parsley-required-message="Please enter Desk number"> -->
                                 </div> 

                                 <div class="form-group">
                                    <p>Location</p>
                                    <input class="form-control" type="text" name="location" id="location"  value="<?php echo $employees_detail->location?>">
                                    <!-- <input class="form-control" type="text" name="location" id="location" required data-parsley-required data-parsley-required-message="Please enter location"> -->
                                 </div> 

                                 <div class="form-group">
                                    <p>Time Zone</p>
                                    <input class="form-control" type="text" name="time_zone" id="time_zone"  value="<?php echo $employees_detail->time_zone?>">
                                    <!-- <input class="form-control" type="text" name="time_zone" id="time_zone" required data-parsley-required data-parsley-required-message="Please enter time zone"> -->
                                 </div> 

                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="note" ><?php echo $employees_detail->notes;?></textarea>
                                 </div> 

                                 <div class="form-group">
                                    <p>Profile</p>

                                      <?php if(!empty($employees_detail->profile_picture))
                                        {
                                          $gst_img = base_url().'uploads/gst/'.$employees_detail->profile_picture;
                                        }else{
                                          $gst_img =  base_url().'uploads/gst/default.png';
                                        }
                                      ?>

                                    <input type="file" id="myfile" name="picture" onchange="readURL(this);" ><br><br> 
                                     <img id="admin_img" name="image" class="mb-3" src="<?php echo $gst_img; ?>" alt="your image" width="100px" height="100px" />
                                 </div>
                                 
                                 <!-- <div class="">
                                    <input type="checkbox"  name=""> Email sign-in instructions with password (this can be sent later or at anytime)
                                 </div>  -->
                              </div> 
                              <div class="mt-5">
                                  <h4 class="font-weight-semibold mb-0">Timesheet Settings & Approvals</h4>
                                  <p class="mb-4 small text-muted">Set approvers and edit timesheet settings for this person.</p>

                                  <h5 class="font-weight-semibold mb-0">Approvals</h5>
                                  <p class="mb-4 small text-muted">It may take a few moments to populate the most current approvers.</p>

                                  <div class="form-group">
                                    <p class="mt-2"><input class="mr-2" type="checkbox" id ="timesheat_check" name="check_timesheat" onclick="timesheat(this)" <?php if($employees_detail->check_timesheat == 'on'){ echo 'checked'; } ?> disabled> Timesheets are approved by </p>
                                      <?if(empty($employees_detail->check_timesheat) || $employees_detail->check_timesheat != 'on') { ?>
                                          <select class="form-control" id="timesheet" name="timesheet" style="display: none;" disabled="">
                                            <option value="">Select</option>         
                                            <?php foreach($groups as $row) {?>
                                                <option  value="<?php echo  $row['user_id']?>" >
                                                    <?php echo $row['first_name']." " .$row['last_name']?>
                                                </option>
                                            <?php } ?> 
                                          </select>
                                       <?php }else{ ?>      
                                          <select class="form-control" id="" name="timesheet" disabled="">
                                            <option value="">Select</option>         
                                            <?php foreach($groups as $row) {?>
                                                <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$employees_detail->timesheet){ echo 'selected'; } ?>>
                                                    <?php echo $row['first_name']." " .$row['last_name']?>
                                                </option>
                                            <?php } ?> 
                                          </select>
                                      <?php } ?> 
                                  </div>  

                                  <div class="form-group">
                                       <p class="mt-2"><input class="mr-2" type="checkbox" id="timeoff_check" name="check_timeoff" onclick="timeoff(this)" <?php if($employees_detail->check_timeoff == 'on'){ echo 'checked'; } ?> disabled> Time off is approved by </p>
                                       <?if(empty($employees_detail->check_timeoff) || $employees_detail->check_timeoff != 'on') { ?>
                                            <select class="form-control" id="time_off" name="time_off" style="display: none;" disabled="">
                                               <option  value="">Select</option>     
                                             <?php foreach($groups as $row) {?>
                                               <option  value="<?php echo  $row['user_id']?>">
                                              <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                             <?php } ?>
                                            </select>
                                      <?php }else{ ?>      
                                               <select class="form-control" id="" name="time_off" disabled="">
                                               <option  value="">Select</option>     
                                             <?php foreach($groups as $row) {?>
                                               <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$employees_detail->time_off){ echo 'selected'; } ?>>
                                                  <?php echo $row['first_name']." " .$row['last_name']?></option>    
                                              <?php } ?>  
                                              </select>  
                                       <?php } ?> 
                                  </div>  

                                  <div class="form-group">
                                      <p class="mt-2"><input class="mr-2" type="checkbox" id="expense_check" name="check_expense" onclick="expence(this)" <?php if($employees_detail->expense_check == 'on'){ echo 'checked'; } ?> disabled> Expenses are approved by </p>

                                      <?if(empty($employees_detail->check_expense) || $employees_detail->check_expense != 'on') { ?>
                                        <select class="form-control" id="expenses" name="expenses" style="display: none;" disabled="">
                                           <option value="">Select</option>     
                                         <?php foreach($groups as $row) {?>
                                           <option  value="<?php echo  $row['user_id']?>">
                                            <?php echo $row['first_name']." " .$row['last_name']?></option>
                                          <?php } ?>             
                                        </select>

                                       <?php }else{ ?>      
                                           <select class="form-control" id="expenses" name="expenses" disabled="">
                                             <option value="">Select</option>     
                                           <?php foreach($groups as $row) {?>
                                             <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$employees_detail->expense_check){ echo 'selected'; } ?>>
                                              <?php echo $row['first_name']." " .$row['last_name']?></option>
                                            <?php } ?>             
                                          </select>  
                                       <?php } ?>        
                                  </div>  
                              </div>  
                              <!-- <div class="mt-5">
                                  <h4 class="font-weight-semibold mb-0">Settings</h4>
                                  <p class="mb-4 small text-muted">Set approvers and edit timesheet settings for this person.</p>

                                  <div class="form-group">
                                     <div class="d-flex align-items-center mb-4"> 
                                        <input class="form-control w-25" type="" name="" max="24">
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
                                  <!-- <h4 class="font-weight-semibold mb-0">Costs</h4>
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
                                      <button class="btn btn-warning2 t mt-4 px-5">Next</button>
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
       
           


        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

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


    // $('#employmentType').on('click', function() {
    //   alert("hi");
    //   var currentValues = $(this).val();
    //   alert(currentValues);
    // }

    $('#employmentType').on('change', function() {
      var currentValues = $(this).val();
      if(currentValues == "contractor"){
        $(".end_date_div").css("display", "block");
      }else{
        $(".end_date_div").css("display", "none");
      }
    });
    
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

        $('#timesheet').hide();
        $('#time_off').hide();
        $('#expenses').hide();

        // $('#timesheet').select2();
        // $('#time_off').select2();
        // $('#expenses').select2();


        $('#employmentType').select2();
        $('#user_role_id').select2();
        $('#division').select2();
        $('#level').select2();
        $('#manager_id').select2();
       
    });

      function readURL(input) {

      if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

          $('#admin_img').attr('src', e.target.result);

          $('.image-upload-wrap').hide();

    

          $('.file-upload-image').attr('src', e.target.result);

          $('.file-upload-content').show();

    

          $('.image-title').html(input.files[0].name);

        };

        reader.readAsDataURL(input.files[0]);

      } else {

        removeUpload();

      }

      $("#imgInp").change(function(){

        readURL(this);

      });

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
    $('#date_of_birth').attr('max', maxDate);
});
</script>


    <!-- container-scroller -->
    <!-- js --><!-- 
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
     Custom js for this page-->
  <!--   <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
   <!--  <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
  </body>
</html>  -->



