<?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                    <h3 class="page-title">Dashboard</h3>
                </div> 
                <div class="row">
                  <?php if(in_array('2',$role_resources_ids)) { ?>
                     <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3 text-center">NEWS</h4>
                              <div class="dash-cont-hv">
                                <?php foreach($newsletter as $v) {?>
                                <div class="d-flex mb-2">
                                    <div class="wrapper">
                                       <h5 class="mb-2 font-weight-semibold"><?php echo $v['title'];?></h5>
                                        <p><?php echo $v['description'];?></p><hr>
                                    </div>
                                </div>  
                                 <?php }?>
                                <div class="d-flex mb-2" style="float: right;">
                                    <div class="wrapper">
                                      <a href="<?php echo site_url('CmsController/news_list');?>" class="btn btn-warning2 ">Click More</a>
                                    </div>
                                </div>  
                              </div>  
                          </div>  
                       </div> 
                     </div> 
                <?php } if(in_array('61',$role_resources_ids)) { ?>
                     <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3 text-center">My Task</h4>
                              <div class="dash-cont-hv">
                                <table class="table table-hover table-grey-head mb-md-0">
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>Project Name</th>
                                      <th>Task Name</th>
                                      <!-- <th>Progress</th> -->
                                    </tr>
                                  </thead>
                                  <tbody>
                                     <?php
                                      $i = 1; 
                                      foreach($task as $v) {?>

                                    <tr>
                                      <td><?php echo $i++;?></td>
                                      <td><?php echo $v['project_name'];?></td>
                                      <td><?php echo $v['task_name'];?></td>
                                    </tr>
                                    <?php }?>
                                  </tbody>
                                  </table><br>
                                <div class="d-flex mb-2" style="float: right;">
                                    <div class="wrapper">
                                      <a href="<?php echo site_url();?>task/my_task" class="btn btn-warning2">Click More</a>
                                    </div>
                                </div>  
                              </div>  
                          </div>  
                       </div> 
                     </div> 
                <?php } ?>

                <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3 text-center">
                                <?php if(empty($through_of_day->heading)) {?>
                                        Through of the day
                                <?php }else {?>
                                    <?php echo $through_of_day->heading;?>
                                <?php }?>

                              </h4>
                               <form action="<?php echo site_url('dashboard/add_throughofday');?>" method="post" data-parsley-validate enctype= "multipart/form-data">
                              <div class="dash-cont-hv"> 
                                 <div class=" mb-2">
                                    <div class="wrapper">

                                        <?php if(!empty($through_of_day)) {?>
                                          <div class="text-center mb-2">
                                              <div class="wrapper">
                                                  <p class=" through_descrip">" <?php echo $through_of_day->description;?> "</p>
                                              </div>
                                          </div>    
                                        <?php } ?>

                                         <?php if(in_array('3',$role_resources_ids)) { ?>
                                        <!-- <form action="<?php echo site_url('dashboard/add_throughofday');?>" method="post" data-parsley-validate enctype= "multipart/form-data"> -->

                                          <div class="form-group">
                                              <p class="">Heading</p>
                                              <input class="form-control" type="text" name="heading" data-parsley-required-message="Please enter heading" required="">
                                           </div> 

                                           <div class="form-group">
                                              <p>Description</p>
                                              <input class="form-control" type="text" name="description" data-parsley-required-message="Please enter description" required="">
                                           </div>                                           
                                        <!-- </form> -->
                                        <?php } ?>
                                    </div>

                                </div>  

                                      <div style="clear:both"></div>
                                      <?php if(in_array('3',$role_resources_ids)) { ?>
                                        <div class="text- " style="float: right;">
                                            <input type="submit" class="btn btn-warning2 t mt-4 px-5" name="userSubmit" value="Save">
                                        </div> 
                                      <?php } ?>
                              </div> 
                              </form> 
                          </div>  
                       </div> 
                     </div> 
                     <!-- <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3">AMPLE DECEMBER BILLABLE HOURS</h4>
                              <div class="dash-cont-hv">
                                <div class="h-100 justify-content-center d-flex">
                                 <canvas class="my-auto" id="pieChart" height="130"></canvas>
                                </div>
                              </div>  
                          </div>  
                       </div> 
                     </div>  -->
                     <!-- <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3">SAMPLE RECENT TIMESHEET STATUS</h4>
                              <div class="dash-cont-hv">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th></th>
                                        <th><p class="mb-0 mb-1">2 Timesheets Ago</p>
                                           <p class="mb-0 ">11/29/2020 - 12/5/2020ss</p>
                                        </th>
                                        <th>
                                           <p class="mb-0 mb-1">Last Timesheet</p>
                                           <p class="mb-0 ">12/6/2020 - 12/12/2020</p>
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><p class="mb-0 h5 text-danger">Rejected</p> </td>
                                        <td>21</td>
                                        <td>28</td>
                                      </tr>
                                      <tr>
                                        <td><p class="mb-0 h5 text-primary">Open</p> </td>
                                        <td>17</td>
                                        <td>9</td>
                                      </tr>
                                      <tr>
                                        <td><p class="mb-0 h5 text-warning">Waiting</p> </td>
                                        <td>9</td>
                                        <td>32</td>
                                      </tr>
                                      <tr>
                                        <td><p class="mb-0 h5 text-success">Approved</p> </td>
                                        <td>23</td>
                                        <td>8</td>
                                      </tr>
                                    </tbody>
                                  </table> 
                              </div>  
                          </div>  
                       </div> 
                     </div>  -->
                     <!-- <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3">REPORTS</h4>
                              <div class="dash-cont-hv">
                                <div class="d-flex mb-2">
                                    <div class="wrapper w-100">
                                       <h5 class="mb-2 font-weight-semibold">
                                          POPULAR REPORTS
                                       </h5>
                                        <div class="row mx-0"> 
                                          <div class="col-6 px-2 mb-3"> 
                                            <div class="d-flex p-2 bg-white shadow py-3"> 
                                             <img width="24" height="24" src="assets/images/profile-user.png">  
                                             <p class="mb-0 ml-2">Detail By Person</p>
                                            </div> 
                                          </div>  
                                          <div class="col-6 px-2 mb-3"> 
                                            <div class="d-flex p-2 bg-white shadow py-3"> 
                                             <img width="24" height="24" src="assets/images/profile-user.png">  
                                             <p class="mb-0 ml-2">Horizontal Timesheet</p>
                                            </div> 
                                          </div>  
                                          <div class="col-6 px-2 mb-3"> 
                                            <div class="d-flex p-2 bg-white shadow py-3"> 
                                             <img width="24" height="24" src="assets/images/profile-user.png">  
                                             <p class="mb-0 ml-2">Vertical Timesheet</p>
                                            </div> 
                                          </div>  
                                          <div class="col-6 px-2 mb-3"> 
                                            <div class="d-flex p-2 bg-white shadow py-3"> 
                                             <img width="24" height="24" src="assets/images/profile-user.png">  
                                             <p class="mb-0 ml-2">Detail By Person</p>
                                            </div> 
                                          </div>  
                                        </div>
                                    </div>
                                </div>  
                                <div class="d-flex mb-2">
                                    <div class="wrapper">
                                       <h5 class="mb-2 font-weight-semibold d-flex justify-content-between align-items-center">
                                          REPORT BUILDER <a href="" class="btn btn-sm btn-warning2">CREATE REPORT</a>
                                       </h5>
                                        <div class="d-flex">
                                           <img width="24" height="24" src="assets/images/profile-user.png">
                                           <p class="ml-2">Report Builder allows you to create your own custom reports using multiple filters, sorting options, subtotals, charts, graphs and other advanced tools.</p>
                                        </div>
                                    </div>
                                </div>    
                                <div class="d-flex mb-2">
                                    <div class="wrapper">
                                       <h5 class="mb-2 font-weight-semibold d-flex justify-content-between align-items-center">
                                          CUSTOMIZABLE DATA EXPORT <a href="" class="btn btn-sm btn-warning2">CREATE REPORT</a>
                                       </h5>
                                        <div class="d-flex">
                                           <img width="24" height="24" src="assets/images/profile-user.png">
                                           <p class="ml-2">The customizable data export gives you the ability to specify which information to include when exporting data to Excel, text, CSV, or XML.  Save your custom report and link to it from external systems using Data Linking.</p>
                                        </div>
                                    </div>
                                </div>  
                              </div>  
                          </div>  
                       </div> 
                     </div>  -->
                     <!-- <div class="col-lg-6">
                       <div class="card mb-3"> 
                          <div class="card-body"> 
                              <h4 class="h4 mb-3 font-weight-bold text-warning border-bottom pb-3">AMPLE HOURS WORKED IN LAST 7 DAYS BY CLIENT</h4>
                              <div class="dash-cont-hv justify-content-center d-flex">
                                  <canvas id="mixed-chart2" height="150"></canvas>
                                 <div class="chart-graph w-100">
                                    <div class="card1">
                                        
                                          <div class="card__chart">
                                           <div class="card__axis">
                                            <div class="card__row card__row--top">460</div>
                                            <div class="card__row card__row--middle">230</div>
                                           <div class="card__row card__row--bottom">0</div>
                                          </div>

                                          <div class="card__column">
                                            <div class="card__bar" style="--index: 0;"></div>
                                          </div>
                                          <div class="card__column">
                                            <div class="card__bar" style="--index: 1;"></div>
                                          </div>
                                          <div class="card__column">
                                            <div class="card__bar" style="--index: 2;"></div>
                                          </div>
                                          <div class="card__column">
                                            <div class="card__bar" style="--index: 3;"></div>
                                          </div>
                                          <div class="card__column">
                                            <div class="card__bar" style="--index: 4;"></div>
                                          </div>
                                          <div class="card__column">
                                            <div class="card__bar" style="--index: 5;"></div>
                                          </div>
                                          <div class="card__column active">
                                            <div class="card__bar" style="--index: 6;"></div>
                                          </div>

                                          <div class="card__number">460</div>
                                        </div>
                                      </div>   
                                 </div>
                              </div>  
                          </div>  
                       </div> 
                     </div>  -->
                </div> 

            </div>
            <!-- content-wrapper ends -->
            <!-- footer -->
<!--             <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
      Custom js for this page-->
 <!--    <script src="assets/js/shared/chart.js"></script>
    < End custom js for this page-->
   <!--  <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
  </body>
</html>  -->
       