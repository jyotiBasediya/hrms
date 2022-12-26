
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Apply for Leave</h3>
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
                          <form action="<?php echo site_url();?>timesheet/add_leave_category" method="post" data-parsley-validate>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Leave Category</h4>  
                                 <div class="form-group">
                                    <p>Leave Name</p>
                                     <input class="form-control" type="text" name="leave">

                                    <!-- <input class="form-control" type="text" name="cname"> -->

                                  <!--  <select class="form-control" name="leave">-->

                                  <!-- <option value disabled class selected="selected">Select Leave Type</option>-->
                                  <!--<option>Casual Leave</option>-->
                                  <!--<option>Vacation Leave</option>-->
                                  <!--<option>Medical Leave</option>-->
                                  <!--                        </select>-->
                                                                  
                                 </div> 
                            <div class="form-group">
                               <p>Yearly Number</p>
                                 <input class="form-control" type="text" name="yearly_number">
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