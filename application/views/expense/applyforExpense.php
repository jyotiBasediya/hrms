
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Apply for expense</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>employeeExpense">
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
                          <?php if(isset($msg) && !empty($msg)){ ?>
                              <div class="alert alert-success" role="alert">
                                <?php echo $msg;?>
                              </div>
                          <?php
                          }?>
                          <form action="" method="post" data-parsley-validate enctype= "multipart/form-data">
                              <div class="">
                                 <div class="form-group">
                                  
                                    <p>Expense Category</p>
                                    <select  name="expense_category_id" class="form-control" required="" id="expense_category_id">
                                      <option value="">Select Expense</option>
                                      <?php if(isset($expense_categories) && !empty($expense_categories)){ foreach ($expense_categories as $expense_categoriesdata) {
                                      ?>
                                          <option value="<?php echo $expense_categoriesdata['expense_category_id']?>"><?php echo $expense_categoriesdata['name']?></option>
                                      <?php
                                      }

                                      }?>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Amount</p>
                                    <input class="form-control" type="text" name="amount" value="<?php echo (isset($pdata['amount']) && !empty($pdata['amount']) ? $pdata['amount'] : '');?>" required data-parsley-required data-parsley-required-message="Enter mobile number" data-parsley-type="number" data-parsley-required-message="Only number allow">
                                 </div>

                                 <div class="form-group">
                                    <p>Proof document for expense </p>
                                    <input type="file" id="myfile" name="picture" onchange="readURL(this);" ><br><br> 

                                     <img id="admin_img" name="image" class="mb-3" src="<?php echo base_url().'uploads/gst/default.png'?>" alt="your image" width="100px" height="100px" />
                                 </div>

                                 <div class="form-group">
                                    <p>Remark</p>
                                    <input class="form-control" type="text" name="remark" value="<?php echo (isset($pdata['remark']) && !empty($pdata['remark']) ? $pdata['remark'] : '');?>">
                                 </div> 
                                 <input type="hidden" name="id" value="<?php echo (isset($pdata['id']) && !empty($pdata['id']) ? $pdata['id'] : '');?>">
                                 
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5" type="submit">Save</button>
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



    $( document ).ready(function() {
        
        $('#expense_category_id').select2();
        
    });
</script>