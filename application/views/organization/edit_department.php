<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <div class="d-flex justify-content-between w-100">
            <h3 class="page-title">Edit Role & Access</h3>
            <div class="d-flex float-right">
               <a href="<?php echo site_url();?>OrganizationController/department">
               <button class="btn btn-secondary btn-fw">Cancel</button>
               </a>
               <!-- <button class="btn btn-secondary btn-fw mx-2">Next</button> -->
               <!--  -->
            </div>
         </div>
               <?php
                              $checked_arr = explode(',',$role_detail->role_resources);
                            ?>
      </div>
      <div class="row">
         <div class="col-lg-8 grid-margin stretch-card m-auto">
            <div class="card">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-lg-12">
                        <form action="<?php echo site_url();?>OrganizationController/update_department" method="post" data-parsley-validate enctype= "multipart/form-data">
                           <div class="">
                              <input type="hidden" name="role_id" value=" <?php echo $role_detail->role_id ?>">
                              <!--   <h4 class="mb-4 font-weight-semibold">Basic Information</h4> -->  
                              <div class="form-group">
                                 <p>Role Name</p>
                                 <input class="form-control" type="text" name="role_name" value="<?php echo $role_detail->role_name ?>" data-parsley-required-message="Please enter role Name" required data-parsley-group="block1" >
                              </div>
                              <h3>Access</h3>
                              <div class="table-responsive add-table f-0 d-b" >
                                 <table class="table fancy-chack" >
                                    <thead>
                                       <tr>
                                          <th width="20%">Main Menu</th>
                                          <th width="15%">Sub Menu</th>
                                          <th>Function</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                       <tr>
                                          <td style="padding-right: 17px;">
                                             <div class="form-group">
                                                <label for="html">Dashboard</label>
                                             </div>
                                          </td>
                                          <td style="padding-right: 27px;padding-left: 13px;">
                                             <div class="form-group">
                                                <label for="html">Time Sheet</label>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="1" name="role_resources[]" class="reporting" <?php if(in_array("1", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">Change Status</label>
                                                <input type="checkbox" id="html" value="68" name="role_resources[]" class="reporting" <?php if(in_array("68", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>


                                          <td colspan="9"> 
                                             <span id="errmsg_reporting" style="color: red"></span>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Landing Page</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="2" name="role_resources[]" class="reporting" <?php if(in_array("2", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="3" name="role_resources[]" class="reporting" <?php if(in_array("3", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">My Task</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="61" name="role_resources[]" class="reporting" <?php if(in_array("61", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>
                                       
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Approved Task</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="62" name="role_resources[]" class="reporting" <?php if(in_array("62", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Approved Status</label>
                                                <input type="checkbox" id="html" value="63" name="role_resources[]" class="reporting" <?php if(in_array("63", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                       <tr>
                                          <td style="padding-right: 17px;">
                                             <div class="form-group">
                                                <label for="html">Project Setting</label>
                                             </div>
                                          </td>
                                          <td style="padding-right: 27px;padding-left: 13px;">
                                             <div class="form-group">
                                                <label for="html">Client</label>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="4" name="role_resources[]" class="reporting" <?php if(in_array("4", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                           <td>
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="5" class="reporting" name="role_resources[]" <?php if(in_array("5", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                           <td>
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="6" name="role_resources[]" class="reporting" <?php if(in_array("6", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                            <td>
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="66" name="role_resources[]" class="reporting" <?php if(in_array("66", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                          <td colspan="9"> 
                                             <span id="errmsg_reporting" style="color: red"></span>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Project</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="7" name="role_resources[]" class="reporting" <?php if(in_array("7", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="8" name="role_resources[]" class="reporting" <?php if(in_array("8", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="9" name="role_resources[]" class="reporting" <?php if(in_array("9", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="67" name="role_resources[]" class="reporting" <?php if(in_array("67", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Task</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="10" name="role_resources[]" class="reporting" <?php if(in_array("10", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="11" name="role_resources[]" class="reporting" <?php if(in_array("11", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="12" name="role_resources[]" class="reporting" <?php if(in_array("12", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="69" name="role_resources[]" class="reporting" <?php if(in_array("69", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Resource Cost</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="13" name="role_resources[]" class="reporting" <?php if(in_array("13", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="14" name="role_resources[]" class="reporting" <?php if(in_array("14", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>
                                     
                                     
                                     <tr>
                                          <td style="padding-right: 17px;">
                                             <div class="form-group">
                                                <label for="html">Employee Managment</label>
                                             </div>
                                          </td>
                                          <td style="padding-right: 27px;padding-left: 13px;">
                                             <div class="form-group">
                                                <label for="html">Add New Employee</label>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">View</label>
                                               <input type="checkbox" id="html" value="15" name="role_resources[]" class="reporting" <?php if(in_array("15", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="16" name="role_resources[]" class="reporting" <?php if(in_array("16", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="17" name="role_resources[]" class="reporting" <?php if(in_array("17", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td>
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="70" name="role_resources[]" class="reporting" <?php if(in_array("70", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                          <td colspan="9"> 
                                             <span id="errmsg_reporting" style="color: red"></span>
                                          </td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Leave Category</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="18" name="role_resources[]" class="reporting" <?php if(in_array("18", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="19" name="role_resources[]" class="reporting" <?php if(in_array("19", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="20" name="role_resources[]" class="reporting" <?php if(in_array("20", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="71" name="role_resources[]" class="reporting" <?php if(in_array("71", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Apply Leave</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="21" name="role_resources[]" class="reporting" <?php if(in_array("21", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Add</label>
                                               <input type="checkbox" id="html" value="22" name="role_resources[]" class="reporting" <?php if(in_array("22", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Leave Request</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="23" name="role_resources[]" class="reporting" <?php if(in_array("23", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Approved Status</label>
                                                <input type="checkbox" id="html" value="24" name="role_resources[]" class="reporting" <?php if(in_array("24", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Holiday</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="25" name="role_resources[]" class="reporting" <?php if(in_array("25", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="26" name="role_resources[]" class="reporting" <?php if(in_array("26", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="27" name="role_resources[]" class="reporting" <?php if(in_array("27", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="72" name="role_resources[]" class="reporting" <?php if(in_array("72", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Expense Category</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="28" name="role_resources[]" class="reporting" <?php if(in_array("28", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="29" name="role_resources[]" class="reporting" <?php if(in_array("29", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="30" name="role_resources[]" class="reporting" <?php if(in_array("30", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="73" name="role_resources[]" class="reporting" <?php if(in_array("73", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Apply Expense</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="31" name="role_resources[]" class="reporting" <?php if(in_array("31", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Add</label>
                                               <input type="checkbox" id="html" value="32" name="role_resources[]" class="reporting" <?php if(in_array("32", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                        <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Expenses Request</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="33" name="role_resources[]" class="reporting" <?php if(in_array("33", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                              <div class="form-group">
                                                <label for="html">Approved Status</label>
                                                <input type="checkbox" id="html" value="34" name="role_resources[]" class="reporting" <?php if(in_array("34", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                       

                                        <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Leave Balance</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="64" name="role_resources[]" class="reporting" <?php if(in_array("64", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"></td>
                                       </tr>

                                       <tr>
                                          <td style="padding-right: 17px;">
                                             <div class="form-group">
                                                <label for="html">Other Setting</label>
                                             </div>
                                          </td>
                                          <td style="padding-right: 27px;padding-left: 13px;">
                                             <div class="form-group">
                                                <label for="html">Location Management</label>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="37" name="role_resources[]" class="reporting" <?php if(in_array("37", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                           <td>
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="38" name="role_resources[]" class="reporting" <?php if(in_array("38", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                           <td>
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="39" name="role_resources[]" class="reporting" <?php if(in_array("39", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                          <td colspan="9"> 
                                             <span id="errmsg_reporting" style="color: red"></span>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Role & Access</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="40" name="role_resources[]" class="reporting" <?php if(in_array("40", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="41" name="role_resources[]" class="reporting" <?php if(in_array("41", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="42" name="role_resources[]" class="reporting" <?php if(in_array("42", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Division</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                               <input type="checkbox" id="html" value="43" name="role_resources[]" class="reporting" <?php if(in_array("43", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                               <input type="checkbox" id="html" value="44" name="role_resources[]" class="reporting" <?php if(in_array("44", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                               <input type="checkbox" id="html" value="45" name="role_resources[]" class="reporting" <?php if(in_array("45", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                        <tr>
                                          <td style="padding-right: 17px;">
                                             <div class="form-group">
                                                <label for="html">HR Document & Policies</label>
                                             </div>
                                          </td>
                                          <td style="padding-right: 27px;padding-left: 13px;">
                                             <div class="form-group">
                                                <label for="html">About Us</label>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="58" name="role_resources[]" class="reporting" <?php if(in_array("58", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                           <td>
                                                <div class="form-group">
                                                <label for="html">Edit</label>
                                               <input type="checkbox" id="html" value="73" name="role_resources[]" class="reporting" <?php if(in_array("73", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                           </td>

                                           <td></td>

                                          <td colspan="9"> 
                                             <span id="errmsg_reporting" style="color: red"></span>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Terms & Condition</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="59" name="role_resources[]" class="reporting" <?php if(in_array("59", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                               <input type="checkbox" id="html" value="48" name="role_resources[]" class="reporting" <?php if(in_array("48", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"> </td>
                                          <td style="border-top: 0;"></td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                       <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">FAQ</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                               <input type="checkbox" id="html" value="49" name="role_resources[]" class="reporting" <?php if(in_array("49", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                               <input type="checkbox" id="html" value="50" name="role_resources[]" class="reporting" <?php if(in_array("50", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                                <input type="checkbox" id="html" value="52" name="role_resources[]" class="reporting" <?php if(in_array("52", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                                <input type="checkbox" id="html" value="51" name="role_resources[]" class="reporting" <?php if(in_array("51", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                        <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Document</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                               <input type="checkbox" id="html" value="65" name="role_resources[]" class="reporting" <?php if(in_array("65", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                               <input type="checkbox" id="html" value="74" name="role_resources[]" class="reporting" <?php if(in_array("74", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                               <input type="checkbox" id="html" value="53" name="role_resources[]" class="reporting" <?php if(in_array("53", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                               <input type="checkbox" id="html" value="75" name="role_resources[]" class="reporting" <?php if(in_array("75", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>

                                         <tr>
                                          <td style="border-top: 0;"> </td>
                                          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">News</label>
                                                <!-- <input type="checkbox" id="html" value="18" name="client[]" class="reporting"> -->
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="54" name="role_resources[]" class="reporting" <?php if(in_array("54", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Add</label>
                                                <input type="checkbox" id="html" value="55" name="role_resources[]" class="reporting" <?php if(in_array("55", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Edit</label>
                                               <input type="checkbox" id="html" value="56" name="role_resources[]" class="reporting" <?php if(in_array("56", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;">
                                             <div class="form-group">
                                                <label for="html">Delete</label>
                                               <input type="checkbox" id="html" value="57" name="role_resources[]" class="reporting" <?php if(in_array("57", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>
                                          <td style="border-top: 0;"> </td>
                                       </tr>



                                        <tr>
                                          <td style="padding-right: 17px;">
                                             <div class="form-group">
                                                <label for="html">Employee Search</label>
                                             </div>
                                          </td>
                                          <td style="padding-right: 27px;padding-left: 13px;"></td>

                                          <td>
                                             <div class="form-group">
                                                <label for="html">View</label>
                                                <input type="checkbox" id="html" value="46" name="role_resources[]" class="reporting" <?php if(in_array("46", $checked_arr)) {?> checked="checked"<?php } ?>>
                                             </div>
                                          </td>

                                           <td></td>

                                           <td></td>

                                          <td colspan="9"> 
                                             <span id="errmsg_reporting" style="color: red"></span>
                                          </td>
                                       </tr>
                                       
                                      
                                    </tbody>
                                 </table>
                              </div>
                              <div class="text-center">
                                 <input type="submit" class="btn btn-warning2 t mt-4 px-5" name="userSubmit" value="Save">
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
<!--     <script src="assets/vendors/js/vendor.bundle.base.js"></script>
   <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
   <script src="assets/js/shared/off-canvas.js"></script>
   <script src="assets/js/shared/misc.js"></script>
   <script src="assets/js/dashboard/dashboard.js"></script>
    <!-Custom js for this page-->
<!-- <script src="assets/js/shared/chart.js"></script> -->
<!-- End custom js for this page-->
<!-- <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
   <script src="assets/js/custom.js" type="text/javascript"></script>
   </body>
   </html> 