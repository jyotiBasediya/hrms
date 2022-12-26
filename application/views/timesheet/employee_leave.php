
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Apply for Leave</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>timesheet/leave/">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>
                        <!--<button class="btn btn-secondary btn-fw mx-2">Next</button>-->
                      <!--  -->
                    </div>  
                   </div>  
                </div> 
                  
                  <?php

$session = $this->session->userdata('username');
$user_info = $this->Hrms_model->read_user_info($session['user_id']);
?>
                <div class="row">  
                  <div class="col-lg-8 grid-margin stretch-card m-auto">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                       <div class="col-lg-12">
                          <form action="<?php echo site_url();?>timesheet/insertleave" method="post" data-parsley-validate>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Make a Request</h4>  
                                   <div class="form-group">
                                       <p>Employee Name</p>
                                       <input type="text" name="emp_name" class="form-control" value="<?php echo $user_info[0]->first_name.' '.$user_info[0]->last_name;?>" readonly>
                                       
                                       <input type="hidden" value="<?php echo $user_info[0]->user_id?>" name="emp_name">
                                       
                                       </div>
                                 
                                 <div class="form-group">
                                    <p>Leave Type</p>
                                    <select class="form-control" name="leave" required data-parsley-required-message="Select Leave type">
                                        <?php foreach($leave_category as $row) {?>-->
                                        <option  value="<?php echo  $row['id']?>">
                                                     <?php echo $row['leave_name']?></option>
                                         <?php } ?>
                                    </select>
                                                          
                                                          
                                                                  
                                 </div> 
                                 <div class="form-group">
                                    <p>from</p>
                                    <!--<input class="form-control" name="sdate"  id="txtFrom" autocomplete="off" required>-->
                                     <!--<input type="date" onchange="fromDate(this.value);" id="sdate" name="sdate" class="form-control" required data-parsley-required-message="Please select start date">-->
                                     
                                     <input type="date" id="start_date" value="" name="sdate" class="form-control" onchange="fromDate(this.value);"/>
                                     
                                 </div> 
                                 <div class="form-group">
                                    <p>to</p>
                                    
                                    <!--<input type="date" onchange="endDate(this.value);" name="edate" id="edate" class="form-control"  required data-parsley-required-message="Please select end date">-->
                                     <input type="date" id="end_date" value="" name="edate" class="form-control" onchange="endDate(this.value);"/>
                                  </div>
                                  
                                  <input type="hidden" name="number_days" id="number_days" value="">

                                  
                                  <!-- <div class="form-group">-->
                                  <!--  <p>Hours:</p>-->
                                  <!-- <textarea class="form-group" cols="10" rows="3">-->
                                    
                                  
                                  <!-- </textarea>-->
                                  <!--</div>-->
                                 <!--  <div class="form-group">-->
                                 <!--   <p>Leave For Employee</p>-->

                                    <!-- <input class="form-control" type="text" name="cname"> -->
                                <!--<div class="form-group">-->
                                <!--    <p>Leave For Employee</p>-->
                                                                   
                                <!-- <select class="form-control" data-live-search="true" name="employee_id" id="employee_id" required data-parsley-required data-parsley-required-message="Select Brand Name" >-->
                                <!--      <option value disabled class selected="selected">Select Employee for leave</option>-->
                                                                 
                                <!--         <?php foreach($employees as $row) {?>-->
                                <!--        <option  value="<?php echo  $row['first_name']." " .$row['last_name']?>">-->
                                <!--                     <?php echo $row['first_name']." " .$row['last_name']?></option>-->
                                <!--                       <?php } ?>-->
                                <!--                          </select>-->
                               
                                <!-- </div> -->
                                  
                                   <div class="form-group">
                                    <p>Note (optional):</p>
                                    <textarea  class="form-control" name="note" ></textarea>
                                 </div> 
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Submit</button>
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
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script>
  $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('#start_date').attr('min', minDate);
});

  function fromDate() 
  {        
        from_date = document.getElementById('start_date').value;
        // alert(from_date)         
        var from = from_date.split("-")        
        // alert(from)    
        // from[1]+'/'+from[2]+'/'+from[0]        
        var f = from[0]+'-'+from[1]+'-'+from[2]        
        // console.log(from[0]+'-'+from[1]+'-'+from[2])        
        // alert(f)        
        document.getElementById("end_date").setAttribute("min", f);   
  }

  function endDate() 
  {        
    //   alert(1);
    var fromDate = $('#start_date').val(), 
        toDate = $('#end_date').val(), 
      from, to, druation;
    
    from = moment(fromDate, 'YYYY-MM-DD'); // format in which you have the date
    to = moment(toDate, 'YYYY-MM-DD');     // format in which you have the date
    
    duration = to.diff(from, 'days')    
    // alert(duration) ;

      // $('#number_days').text(duration + ' days');
      $('#number_days').val(duration);
  }
  </script>