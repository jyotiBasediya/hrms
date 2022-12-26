
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add Expense Category</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>expenseCategory">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>
                        <!--<button class="btn btn-secondary btn-fw mx-2">Next</button>-->
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
                          <form action="" method="post" data-parsley-validate>
                              <div class="">
                                 
                                 <div class="form-group">
                                    <p>Category Name</p>
                                    <input class="form-control" type="text" name="name" value="<?php echo (isset($pdata['name']) && !empty($pdata['name']) ? $pdata['name'] : '');?>"required="">
                                 </div> 
                                 <input type="hidden" name="expense_category_id" value="<?php echo (isset($pdata['expense_category_id']) && !empty($pdata['expense_category_id']) ? $pdata['expense_category_id'] : '');?>">
                                 
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