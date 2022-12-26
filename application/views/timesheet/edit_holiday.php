<?php
/* Holidays view
*/
?>
<?php $session = $this->session->userdata('username');?>

<!--<div class="row m-b-1">-->
<!--  <div class="col-md-4">-->
<!--    <div class="box box-block bg-white">-->
<!--      <h2><strong>Add New</strong> Holiday</h2>-->
<!--      <form class="m-b-1" action="<?php echo site_url("timesheet/add_holiday") ?>" method="post" name="add_holiday" id="xin-form">-->
<!--        <div class="row">-->
<!--          <div class="col-md-12">-->
<!--            <div class="form-group">-->
<!--              <label for="name">Event Name</label>-->
<!--              <input type="text" class="form-control" name="event_name" placeholder="Event Name">-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--          <div class="col-md-6">-->
<!--            <div class="form-group">-->
<!--              <label for="start_date">Start Date</label>-->
<!--              <input class="form-control date" placeholder="Start Date" readonly name="start_date" type="text">-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-6">-->
<!--            <div class="form-group">-->
<!--              <label for="end_date">End Date</label>-->
<!--              <input class="form-control date" placeholder="End Date" readonly name="end_date" type="text">-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--          <div class="col-md-12">-->
<!--            <div class="form-group">-->
<!--              <label for="description">Description</label>-->
<!--              <textarea class="form-control textarea" placeholder="Description" name="description" cols="30" rows="15" id="description"></textarea>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--          <div class="col-md-12">-->
<!--            <div class="form-group">-->
<!--              <label for="is_publish">Status</label>-->
<!--              <select name="is_publish" class="select2" data-plugin="select_hrm" data-placeholder="Choose Status...">-->
<!--                <option value="1">Published</option>-->
<!--                <option value="0">Un Published</option>-->
<!--              </select>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-primary save">Save</button>-->
<!--      </form>-->
<!--    </div>-->
<!--  </div>-->
   <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Holidays</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>timesheet/holidays">
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
                          <form action="<?php echo site_url("timesheet/edit_holiday") ?>" method="post" data-parsley-validate>
                              <div class="">
                                   <input type="hidden" name="id" value="<?php echo $holiday_detail->holiday_id; ?>">
                                 <!--<h4 class="mb-4 font-weight-semibold">Make a Request</h4>  -->
                                 <div class="form-group">
                                  <label for="name">Event Name</label>
                                  <input type="text" class="form-control" name="event_name" placeholder="Event Name" value="<?php echo $holiday_detail->event_name;?>">

                                 
                                                                  
                                 </div> 
                                 <div class="form-group">
                                    <p>Start Date</p>
                                    <!--<input class="form-control" name="sdate"  id="txtFrom" autocomplete="off" required>-->
                                     <input type="date" onchange="fromDate(this.value);" id="sdate" name="sdate" value="<?php echo $holiday_detail->start_date;?>" class="form-control" required data-parsley-required-message="Please select start date">
                                 </div> 
                                 <div class="form-group">
                                    <p>End Date</p>
                                    <!--<input class="form-control"  name="edate" id="txtTo"   autocomplete="off">-->
                                        <input type="date" name="edate" id="edate" class="form-control" value="<?php echo $holiday_detail->end_date;?>"  required data-parsley-required-message="Please select end date">
                                  </div>
                                  <!-- <div class="form-group">-->
                                  <!--  <p>Hours:</p>-->
                                  <!-- <textarea class="form-group" cols="10" rows="3">-->
                                    
                                  
                                  <!-- </textarea>-->
                                  <!--</div>-->
                                   <div class="form-group">
                                 
                                 <div class="form-group">
              <label for="is_publish">Status</label>
              <select name="is_publish" class="form-control"  data-plugin="select_hrm" data-placeholder="Choose Status...">
                <!--<option value="1">Published</option>-->
                <!--<option value="0">Un Published</option>-->
                  <option  value="1" <?php if ($holiday_detail->is_publish==1) { echo "selected";  }?>>Published</option>
                  <option value="0" <?php if ($holiday_detail->is_publish==0) { echo "selected"; }?>>Un Published</option>
                                 
              </select>
            </div>


             <div class="form-group">
            <p>Location</p>
            <select name="location" class="form-control"  data-plugin="select_hrm" data-placeholder="Choose Location..." required data-parsley-required-message="Please select location">
                <option value="">Select Location</option>
                <?php foreach($location as $row) {?>
                  <option value="<?php echo $row['location_id']?>" <?php if ($holiday_detail->location== $row['location_id']) { echo "selected";  }?>><?php echo $row['location_name']?></option>
                <?php } ?>
              </select>
            </div>
            
                                 <div class="form-group">
             <label for="description">Description</label>
            <textarea class="form-control textarea" placeholder="Description" name="description" cols="30" rows="15" id="description"> <?php echo $holiday_detail->description;?></textarea>
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
<!--  <div class="col-md-8">-->
<!--    <div class="box box-block bg-white">-->
<!--      <h2><strong>List All</strong> Holidays</h2>-->
<!--      <div class="table-responsive" data-pattern="priority-columns">-->
<!--        <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">-->
<!--          <thead>-->
<!--            <tr>-->
<!--              <th style="width:150px;">Action</th>-->
<!--              <th>Event Name</th>-->
<!--              <th>Status</th>-->
<!--              <th>Start Date</th>-->
<!--              <th>Start End</th>-->
<!--            </tr>-->
<!--          </thead>-->
<!--        </table>-->
<!--      </div>-->
      <!-- responsive --> 
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
