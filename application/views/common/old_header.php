 <!-- this is employe side -->

            <?php 
               if($record_num=='day_view' || $record_num=='day_view'){
                       $day_class= "nav-item active";
                   }else{
                       $day_class= "nav-item";
                   }
               
               ?>

            <?php if(in_array('25',$role_resources_ids)) { ?>
               <!--  <li class="<?php echo $day_class;?>">
                   <a class="nav-link" href="<?php echo site_url();?>timesheet/day_view/">
                   <i class="menu-icon typcn typcn-shopping-bag"></i>
                   <span class="menu-title">Day View</span>
                   </a>
                </li> -->
            <?php } 
               if($record_num=='weekly_view' || $record_num=='leave'){
                       $weekly_class= "nav-item active";
                   }else{
                       $weekly_class= "nav-item";
                   }
               
               ?>
            <?php if(in_array('26',$role_resources_ids)) { ?>
           <!--  <li class="<?php echo $weekly_class;?>">
               <a  href="<?php echo site_url();?>timesheet/weekly_view" class="nav-link">
               <i class="menu-icon typcn typcn-coffee"></i>
               <span class="menu-title">Weekly View</span>
               </a>
            </li> -->
            <?php } ?>
            <?php if(in_array('27',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url();?>timesheet/timesheet_view/">
               <i class="menu-icon typcn typcn-shopping-bag"></i>
               <span class="menu-title">Time sheet View</span>
               </a>
            </li>
            <?php } ?>
            <?php if(in_array('28',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url();?>timesheet/timeoff/">
               <i class="menu-icon typcn typcn-shopping-bag"></i>
               <span class="menu-title">Time Off</span>
               </a>
            </li>
            <?php } ?>
            
            <?php 
               if($record_num=='leave_insert' || $record_num=='leave'){
                   $leave_class= "nav-item active";
               }else{
                   $leave_class= "nav-item";
               }
               
               if($record_num=='leave_balance'|| $record_num=='hr_leave_balance'){
                   $leavebalance_class= "nav-item active";
               }else{
                   $leavebalance_class= "nav-item";
               }
               ?>

            <?php if(in_array('29',$role_resources_ids)) { ?>
                <li class="<?php echo $leave_class;?>">
                   <a class="nav-link" href="<?php echo site_url();?>timesheet/leave/">
                   <i class="menu-icon typcn typcn-shopping-bag"></i>
                   <span class="menu-title">Apply for Leaves</span>
                   </a>
                </li>

            <?php } if(in_array('30',$role_resources_ids)) { ?>

                <li class="<?php echo $leavebalance_class;?>">
                   <a class="nav-link" href="<?php echo site_url();?>timesheet/leave_balance">
                   <i class="menu-icon typcn typcn-shopping-bag"></i>
                   <span class="menu-title">Leave Balance</span>
                   </a>
                </li>
            <?php } if(in_array('31',$role_resources_ids)) { ?>

                <li class="<?php echo $leavebalance_class;?>">
                   <a class="nav-link" href="<?php echo site_url();?>timesheet/hr_leave_balance">
                   <i class="menu-icon typcn typcn-shopping-bag"></i>
                   <span class="menu-title">HR Leave Balance</span>
                   </a>
                </li>
            <?php } if(in_array('32',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url();?>employeeExpense">
               <i class="menu-icon typcn typcn-th-large-outline"></i>
               <span class="menu-title">Apply For Expenses</span>
               </a>
            </li>
           
            <?php } if(in_array('33',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url();?>employee_report_list">
               <i class="menu-icon typcn typcn-shopping-bag"></i>
               <span class="menu-title">Report</span>
               </a>
            </li>
            <?php } if(in_array('34',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url();?>task/my_task">
               <i class="menu-icon typcn typcn-shopping-bag"></i>
               <span class="menu-title">My Task</span>
               </a>
            </li>
            <!-- <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url();?>task/project_resource">
               <i class="menu-icon typcn typcn-shopping-bag"></i>
               <span class="menu-title">Task Resources</span>
                </a>
               </li> -->
            <?php } if(in_array('35',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url('CmsController/view_about_us');?>">
               <i class="menu-icon typcn typcn-th-large-outline"></i>
               <span class="menu-title">About us</span>
               </a>
            </li>
            <?php } if(in_array('36',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url('CmsController/view_term_condition');?>">
               <i class="menu-icon typcn typcn-th-large-outline"></i>
               <span class="menu-title">Terms & Condition</span>
               </a>
            </li>
            <?php } if(in_array('37',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link"  href="<?php echo site_url('CmsController/view_document');?>">
               <i class="menu-icon typcn typcn-th-large-outline"></i>
               <span class="menu-title">Document</span>
               </a>
            </li>
            <?php } if(in_array('38',$role_resources_ids)) { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo site_url('CmsController/employee_view_faq');?>">
               <i class="menu-icon typcn typcn-th-large-outline"></i>
               <span class="menu-title">Faq</span>
               </a>
            </li>
            <?php } ?>
         </ul>