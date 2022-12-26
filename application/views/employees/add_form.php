<?php $session = $this->session->userdata('username');?>

        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add New Employee</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>employees">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
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
    
                          <form action="<?php echo site_url('add_form/register') ?>" method="post" name="add_employee" data-parsley-validate enctype="multipart/form-data">
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Basic Information</h4> 
                             <div class="form-group">
                                    <p>Level</p>
                                    <select class="form-control" name="level" id= "level" required data-parsley-required-message="Select level">
                                        <option>Select Level</option>
                                        <option value="L0">L0</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="L3">L3</option>
                                        <option value="L4">L4</option>
                                        <option value="L5">L5</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Full Name</p>
                                    <input class="form-control" type="text" name="full_name" required  data-parsley-group="block-2" data-parsley-required-message="Please enter Full Name">
                                 </div> 
                                 <div class="form-group">
                                    <p>Email Address</p>
                                    <input class="form-control" type="email" name="email" id="email" required data-parsley-required data-parsley-required-message="Please enter Email-Id" data-parsley-type = "email">
                                    <span id="errmsg" style="color: red;"></span>
                                 </div>
                                 <div class="form-group">
                                    <p>Contact Number</p>
                                    <input class="form-control" type="text" name="mobile_no" data-parsley-required-message="Please enter Contact Number"  required data-parsley-required data-parsley-required-message="Enter mobile number" data-parsley-type="number" data-parsley-required-message="Only number allow" pattern="[1-9]{1}[0-9]{9}"  data-parsley-pattern-message="Enter maxlength 10 digit"  maxlength="10" data-parsley-maxlength-message="Maxlength 10 digit">
                                 </div>
                                 <div class="form-group">
                                    <p>Password</p>
                                    <input class="form-control" type="text" name="password" id="password1" data-parsley-minlength="6" data-parsley-errors-container=".errorspannewpassinput"
                                    data-parsley-required-message="Please enter your new password.">
                                 </div> 
                                 <div class="form-group" >
                                    <p>Confirm Password</p>
                                    <input class="form-control" type="password" name="cpass"  data-parsley-minlength="6"
                                    data-parsley-errors-container=".errorspanconfirmnewpassinput"data-parsley-required-message="Please re-enter your new password."
                                    data-parsley-equalto="#password1">

                                 </div> 

                                 <div class="form-group">
                                    <p>Date of Birth</p>
                                     <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required data-parsley-required-message="Please select date of birth">
                                 </div>

                                 <div class="form-group">
                                    <p>Employment</p>
                                    <select class="form-control" name="employment" id="employmentType">
                                        <option value="">Select Employment Type</option>
                                        <option value="contractor">Contractor</option>
                                        <option value="Full-time">Full-time employee</option>
                                        <option value="Hourly">Hourly employee</option>
                                        <option value="Standard">Standard</option>
                                    </select>
                                 </div> 

                                 <div class="form-group">
                                    <p>Start Date</p>
                                     <input type="date" onchange="fromDate(this.value);" id="sdate" name="sdate" class="form-control" required data-parsley-required-message="Please select start date">
                                 </div>

                                 <div class="form-group end_date_div" style="display: none">
                                    <p>End Date</p>
                                    <input type="date" name="edate" id="edate" class="form-control">
                                 </div> 

                                 <div class="form-group">
                                    <p>Manager</p>
                                    <select class="form-control" placeholder=" Manager" name="manager_id" id="manager_id">
                                       <option value="">Select Manager</option>
                                      <?php foreach($employees as $row) {?>
                                       <option  value="<?php echo  $row['user_id'];?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                    </select>
                                                                  
                                 </div> 

                                 <div class="form-group">
                                    <p>Role</p>
                                     <select class="form-control" placeholder="Role" name="user_role_id" id="user_role_id" required data-parsley-required-message="Select role">
                                      <option  value="">Select Role</option>
                                        <?php foreach($all_roles as $row) {?>
                                            <option  value="<?php echo  $row->role_id?>"><?php echo $row->role_name?></option>
                                         <?php } ?>
                                    </select>
                                 </div> 
                                 
                                 <div class="form-group">
                                    <p>Division</p>
                                  <!--   <select class="form-control" name="division">
                                      <option>No Division</option>
                                    </select> -->

                                    <select class="form-control" placeholder="Division" name="division"  id="division" required data-parsley-required-message="Select division">
                                      <option  value="">Select Division</option>
                                        <?php foreach($all_division as $division) {?>
                                            <option  value="<?php echo  $division['id']?>"><?php echo $division['name']?></option>
                                         <?php } ?>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Default Task:</p>
                                    <input class="form-control" type="text" name="task">
                                 </div> 
                                 <div class="form-group">
                                    <p>Employee Number</p>
                                    <input class="form-control" type="text" name="enumuber">
                                 </div> 
                                 <div class="form-group">
                                    <p>Accounting Package Person ID</p>
                                    <input class="form-control" type="text" name="account">
                                 </div> 
                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status">
                                      <option value="1">Active </option>
                                      <option value="0">Inactive</option>
                                    </select>
                                 </div> 
                                  <div class="form-group">
                                    <p>Desk Number</p>
                                    <input class="form-control" type="text" name="desk_number" id="desk_number">
                                    <!-- <input class="form-control" type="text" name="desk_number" id="desk_number" required data-parsley-required data-parsley-required-message="Please enter Desk number"> -->
                                 </div> 

                                 <div class="form-group">
                                    <p>Location</p>
                                    <input class="form-control" type="text" name="location" id="location">
                                    <!-- <input class="form-control" type="text" name="location" id="location" required data-parsley-required data-parsley-required-message="Please enter location"> -->
                                 </div> 

                                 <div class="form-group">
                                    <p>Time Zone</p>
                                    <input class="form-control" type="text" name="time_zone" id="time_zone">
                                    <!-- <input class="form-control" type="text" name="time_zone" id="time_zone" required data-parsley-required data-parsley-required-message="Please enter time zone"> -->
                                 </div> 

                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="note" ></textarea>
                                 </div> 

                                 <div class="form-group">
                                    <p>Profile</p>
                                    <input type="file" id="myfile" name="picture" onchange="readURL(this);" ><br><br> 

                                     <img id="admin_img" name="image" class="mb-3" src="<?php echo base_url().'uploads/gst/default.png'?>" alt="your image" width="100px" height="100px" />
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
                                    <p class="mt-2"><input class="mr-2" type="checkbox" id ="timesheat_check" name="check_timesheat" onclick="timesheat(this)"> Timesheets are approved by </p>
                                      <select class="form-control" id="timesheet" name="timesheet" style="display: none;">
                                        <option value="">Select</option>         
                                        <?php foreach($groups as $row) {?>
                                            <option  value="<?php echo  $row['user_id']?>" >
                                                <?php echo $row['first_name']." " .$row['last_name']?>
                                            </option>
                                        <?php } ?> 
                                      </select>
                                  </div>  

                                  <div class="form-group">
                                       <p class="mt-2"><input class="mr-2" type="checkbox" id="timeoff_check" name="check_timeoff" onclick="timeoff(this)"> Time off is approved by </p>
                                      <select class="form-control" id="time_off" name="time_off" style="display: none;">
                                         <option  value="">Select</option>     
                                       <?php foreach($groups as $row) {?>
                                         <option  value="<?php echo  $row['user_id']?>">
                                        <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                      </select>
                                  </div>  

                                  <div class="form-group">
                                      <p class="mt-2"><input class="mr-2" type="checkbox" id="expense_check" name="check_expense" onclick="expence(this)"> Expenses are approved by </p>
                                      <select class="form-control" id="expenses" name="expenses" style="display: none;">
                                         <option value="">Select</option>     
                                       <?php foreach($groups as $row) {?>
                                         <option  value="<?php echo  $row['user_id']?>">
                                          <?php echo $row['first_name']." " .$row['last_name']?></option>
                                        <?php } ?>             
                                      </select>
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



