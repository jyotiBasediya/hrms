
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Leave Request</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>project">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>
                        <button class="btn btn-secondary btn-fw mx-2">Next</button>
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
                          <form action="<?php echo site_url();?>timesheet/leave_update" method="post" data-parsley-validate>
                              <div class="">
                                  <input type="hidden" name="id" value="<?php echo $leave_detail->leave_id; ?>">
                                 <h4 class="mb-4 font-weight-semibold">Make a Request</h4>  
                                 <div class="form-group">
                                    <p>Leave Type</p>

                                    <!-- <input class="form-control" type="text" name="cname"> -->

                                    <select class="form-control" name="leave">

                                   <option value disabled class selected="selected">Select Leave Type</option>
                                  <option <?php if ($leave_detail->leave_type=='Casual Leave') {
                                     echo "selected";
                                    }?>>Casual Leave</option>
                                  <option <?php if ($leave_detail->leave_type=='Vacation Leave') {
                                     echo "selected";
                                    }?>>Vacation Leave</option>
                                  <option <?php if ($leave_detail->leave_type=='Medical Leave') {
                                     echo "selected";
                                    }?>>Medical Leave</option>
                                                          </select>
                                                                  
                                 </div> 
                                 <div class="form-group">
                                    <p>from</p>
                                    <!--<input class="form-control" name="sdate"  id="txtFrom" autocomplete="off" required>-->
                                     <input type="date" onchange="fromDate(this.value);" id="sdate" name="sdate" class="form-control" value="<?php echo $leave_detail->from_date?>" required data-parsley-required-message="Please select start date">
                                 </div> 
                                 <div class="form-group">
                                    <p>to</p>
                                    <!--<input class="form-control"  name="edate" id="txtTo"   autocomplete="off">-->
                                        <input type="date" name="edate" id="edate" class="form-control" value="<?php echo $leave_detail->to_date?>"  required data-parsley-required-message="Please select end date">
                                  </div>
                                  <!-- <div class="form-group">-->
                                  <!--  <p>Hours:</p>-->
                                  <!-- <textarea class="form-group" cols="10" rows="3">-->
                                    
                                  
                                  <!-- </textarea>-->
                                  <!--</div>-->
                                   <div class="form-group">
                                    <p>Leave For Employee</p>

                                    <!-- <input class="form-control" type="text" name="cname"> -->

                                                                   
                                 <select class="form-control" data-live-search="true" name="employee_id" id="employee_id" required data-parsley-required data-parsley-required-message="Select Employee Name" >
                                      <option value disabled class selected="selected">Select Employee for leave</option>
                                                                 
                                         <?php foreach($employees as $row) {?>
                                        <option  value="<?php echo  $row['first_name']." " .$row['last_name']?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                                          </select>
                                        
                                        
                               
                                 </div> 
                                  
                                   <div class="form-group">
                                    <p>Note (optional):</p>
                                    <textarea  class="form-control" name="note" >
                                       <?php echo $leave_detail->note?>
                                      
                                    </textarea>
                                 </div> 
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Update</button>
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
 
    // <script>
    //     $( document ).ready(function() {
    //     $('#employee_id').select2();
       
    // });
    function fromDate() {
        from_date = document.getElementById('sdate').value;

        var from = from_date.split("-")
        // console.log(from)
        // from[1]+'/'+from[2]+'/'+from[0]
        var f = from[0]+'-'+from[1]+'-'+from[2]
        // console.log(from[0]+'-'+from[1]+'-'+from[2])
        // alert(f)
        document.getElementById("edate").setAttribute("min", f);

        // $( "#to_date" ).datepicker({ minDate: f});
    }
    // </script>