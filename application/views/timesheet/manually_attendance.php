<link href="<?php echo base_url(); ?>assets/timer_picker/timepicki.css" rel="stylesheet">
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add Project Resource</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>timesheet/timesheet_view">
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
                          <form action="<?php echo base_url().'Timesheet/insertmanually_attendance';?>" method="post" data-parsley-validate>
                               <div class="col-md-12 mt-3">
                        <div class="product-item-box mb-3 add_input_item">
                           <div class="form-group">
                              <p>Project</p>
                               <select class="form-control" placeholder="Project Name" name="project_id[]" id="project_id" onchange="getTask(this.value);">

                              <option>Select Project</option>
                              
                            <?php foreach($project as $row) {?>
                                <option  value="<?php echo  $row['id']?>">
                                             <?php echo $row['project_name']?></option>
                                               <?php } ?>
                                                  </select>  
                           </div> 

                           <div class="form-group">
                              <p>Task</p>
                               <select class="form-control" placeholder="Task Name" name="task_id[]" id="task_id" multiple>
                                <option  value="">Select Task</option>
                              </select>
                           </div> 

                           <div class="form-group">
                              <p>Date</p>
                              <input type="date" name="date" id="date" class="form-control txtDate"  required data-parsley-required-message="Please select end date">
                           </div> 

                           <div class="row">
                                  <div class="col-md-5 col-sm-12">
                                     <div class="form-group ">
                                        <label>Start Time</label>
                                         <input id="trip_start_1" class="timepicker1" type="text" name="start_time[]" required data-parsley-required data-parsley-required-message="Select Start time" />
                                     </div>
                                  </div>

                                   <div class="col-md-5 col-sm-12">
                                     <div class="form-group ">
                                        <label>End Time</label>
                                         <input id="end_time_1" class="timepicker1" type="text" name="end_time[]" required data-parsley-required data-parsley-required-message="Slect End time"/>
                                     </div>
                                  </div>
                                <div class="col-sm-2 add-btn">
                                     <label>Action</label>

                                     <input type="button" class="item_add btn btn-primary w-100" value="Add">
                                   <!-- <button class="btn btn-primary w-100 item_add" type="submit"> <i class="fa fa-plus fa-3x" aria-hidden="true"></i> &nbsp; Add</button> -->
                                </div>
                            </div>
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
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->
    

<script src="<?php echo base_url(); ?>assets/timer_picker/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/timer_picker/timepicki.js"></script>

    <script>
    $( document ).ready(function() {
        $('#project_id').select2();
        $('#task_id').select2();
       
    });



      
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


    $( document ).ready(function() {
         $('#brand_id').select2();
        //Add more Image
        var wrapper1         = $(".add_input_item"); //Fields wrapper
        var add_button1      = $(".item_add"); //Add button ID
        
        var y = 1; //initlal text box count
        var yy = 1;
        $(add_button1).click(function(e){ //on add input button click
            e.preventDefault();
            y++; //text box increment
            yy= yy+1; 
            $(wrapper1).append(`
               <div class="row ">
                      <div class="col-md-5 col-sm-12">
                         <div class="form-group ">
                             <input id="trip_start_`+yy+`" class="timepicker1" type="text" name="start_time[]" required data-parsley-required data-parsley-required-message="Select Start time" />
                         </div>
                      </div>    
                      <div class="col-md-5 col-sm-12">
                                     <div class="form-group ">
                                        <input id="end_time_`+yy+`" class="timepicker1" type="text" name="end_time[]" required data-parsley-required data-parsley-required-message="Slect End time"/>
                                     </div>
                                  </div>
                
                    <div class="col-sm-2 add-btn">
                          <button class="btn btn-danger w-100 remove_field" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Delete</button>
                    </div>
                </div>
            `); //add input box

        });




        $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); y--;
        })
    });


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

    $('.timepicker1').timepicki({increase_direction:'up'});
</script>