
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add Project Resource</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>task/my_task">
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
                          <form action="<?php echo site_url();?>task/add_project_resource" method="post" data-parsley-validate>
                               <div class="col-md-12 mt-3">
                        <div class="product-item-box mb-3 add_input_item">
                           <div class="form-group">
                              <p>Task Name</p>
                              <input class="form-control" type="text" name="full_name" value="<?php echo $task_detail->task_name?>" readonly>
                           </div> 
                           <div class="row">
                            <input type="hidden" name="task_id" value="<?php echo $task_detail->task_id?>">
                            <input type="hidden" name="project_name" value="<?php echo $task_detail->project_name?>">
                            <input type="hidden" name="client_name" value="<?php echo $task_detail->client_name?>">

                                  <div class="col-md-5 col-sm-12">
                                     <div class="form-group ">
                                        <label>Date</label>
                                        <input type="date" name="date[]" id="date_1" class="form-control txtDate"  required data-parsley-required-message="Please select end date">
                                     </div>
                                  </div>

                                   <div class="col-md-5 col-sm-12">
                                     <div class="form-group ">
                                        <label>Hours</label>
                                        <input class="form-control" id="hour_1" type="text" placeholder="Hour" name="hour[]" required data-parsley-required data-parsley-required-message="Enter hour">
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
    
    <script>
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
                             <input type="date" name="date[]" id="date_`+yy+`" class="form-control txtDate"  required data-parsley-required-message="Please select end date">
                         </div>
                      </div>    
                      <div class="col-md-5 col-sm-12">
                                     <div class="form-group ">
                                        <input class="form-control" id="hour_1" type="text" placeholder="hour" name="hour[]" required data-parsley-required data-parsley-required-message="Enter hour">
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
</script>