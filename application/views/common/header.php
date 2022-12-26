<?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>::Aarav::</title>
     
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      
      <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
       <!-- <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css"> -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/css/vendor.bundle.addons.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/shared/style.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom/style.css">
      <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <!-- End Layout styles -->
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png" />
      <!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/parsley.css">
      <!-- <script src="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"></script> -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
      <style type="text/css">
         .parsley-errors-list {
         list-style-type: none;
         padding-left: 0;
         color: #ff0000;
         }
      </style>
      <script src="<?php echo base_url(); ?>assets/toastr.min.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/toastr.min.css">
      <!-- <script>
         $(document).ready(function () {
             $('#example').DataTable();
         });
         </script>
         -->
   </head>
   <body>
      <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
         <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo" href="<?php echo site_url();?>dashboard">
            <img src="<?php echo base_url();?>assets/images/logo.png" alt="logo" /> </a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo site_url();?>dashboard">
            <img src="<?php echo base_url();?>assets/images/logo-mini.png" alt="logo" /> </a>
         </div>
         <div class="navbar-menu-wrapper d-flex align-items-center">

          <h4 class="text-center ml-auto">AARAV SOLUTIONS HRMS PORTAL</h4>
            
            <ul class="navbar-nav ml-auto">

              
               <!--<li class="nav-item">-->
               <!--   <a class="nav-link">-->
               <!--   Personal-->
               <!--   </a>  -->
               <!--</li>-->
               <!--<li class="nav-item">-->
               <!--   <a class="nav-link">-->
               <!--   Company-->
               <!--   </a>  -->
               <!--</li>-->
               <li class="nav-item dropdown dropdown2 d-none d-inline-block user-dropdown">
                  <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                     <!-- <img class="" width="60" src="assets/images/user-btn.svg" alt="Profile image"> </a> -->
                     <i class="fa fa-user-circle" aria-hidden="true"></i>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <!-- <div class="dropdown-header text-center">
                           <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                           <p class="mb-1 mt-3 font-weight-semibold">Allen Moreno</p>
                           <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                           </div> -->
                  <a href="<?php echo site_url()?>Profile/my_profile" class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                  <!-- <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a> -->
                  <!-- <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a> -->
                  <!-- <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a> -->
                  <a href="<?php echo site_url()?>logout" class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
                  </div>
               </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
            </button>
         </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
      <!-- sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
         <ul class="nav">
         <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
               <div class="profile-image">
                  <!-- <img class="img-xs rounded-circle" src="../../assets/images/faces/face8.jpg" alt="profile image"> -->
                  <i style="font-size: 33px" class="fa fa-user-circle text-dark"></i>
                  <div class="dot-indicator bg-success"></div>
               </div>
               <div class="text-wrapper">
                  <p class="designation"><?php echo $user_info[0]->first_name.' '.$user_info[0]->last_name;?></p>
               </div>
            </a>
         </li>
         <?php
            // $active = $this->uri->segment(3);
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $record_num1 = $this->uri->segment($last-1);
            $record_num2 = $this->uri->segment($last-2);
            ?>
         <?php 
            if($record_num=='dashboard'  ){
                $dashboard_class= "nav-item active";
            }else{
                $dashboard_class= "nav-item";
            }
            ?>
         <?php if(in_array('0',$role_resources_ids)) { ?>
         <li class="<?php echo $dashboard_class;?>">
            <a class="nav-link" href="<?php echo site_url();?>dashboard">
            <i class="menu-icon typcn typcn-document-text"></i> 
            <span class="menu-title">Landing Page</span>
            <i class="menu-icon typcn menu-title typcn-shopping-bag"></i>
            </a>
         </li>
         <?php } ?>

         <?php if(in_array('1',$role_resources_ids) || in_array('2',$role_resources_ids) || in_array('3',$role_resources_ids) || in_array('68',$role_resources_ids)) { ?>
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-dashboard" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title ">Dashboard</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-dashboard">
               <ul class="nav flex-column sub-menu">
                  <?php 
                     if($record_num=='add_client'||$record_num=='client_form'){
                         $client_class= "nav-item active";
                     }else{
                         $client_class= "nav-item";
                     }
                     ?>
                    <?php if(in_array('1',$role_resources_ids)) { ?>
                          <li class="<?php echo $client_class;?>">
                             <a class="nav-link" href="<?php echo site_url();?>report">
                             <i class="menu-icon typcn typcn-shopping-bag"></i>
                             <span class="menu-title">Timesheet</span>
                             </a>
                          </li>
                    <?php }  if(in_array('2',$role_resources_ids) || in_array('68',$role_resources_ids)) { ?>
                      <li class="<?php echo $client_class;?>">
                         <a class="nav-link" href="<?php echo site_url();?>dashboard">
                         <i class="menu-icon typcn typcn-shopping-bag"></i>
                         <span class="menu-title">Landing Page</span>
                         </a>
                      </li>
                    <?php }  if(in_array('61',$role_resources_ids)) { ?>
                          <li class="nav-item">
                             <a class="nav-link" href="<?php echo site_url();?>task/my_task">
                             <i class="menu-icon typcn typcn-shopping-bag"></i>
                             <span class="menu-title">My Task</span>
                             </a>
                          </li>
                    <?php 
                          }  if(in_array('62',$role_resources_ids)) { 
                      ?>
                          <li class="nav-item">
                             <a class="nav-link" href="<?php echo site_url();?>ReportController/employee_report_list">
                             <i class="menu-icon typcn typcn-shopping-bag"></i>
                             <span class="menu-title">Task Status</span>
                             </a>
                          </li>
                     <?php
                           }   
                     ?>
               </ul>
            </div>
         </li>
     <?php } if(in_array('4',$role_resources_ids) || in_array('7',$role_resources_ids) || in_array('10',$role_resources_ids) || in_array('13',$role_resources_ids) || in_array('66',$role_resources_ids) || in_array('67',$role_resources_ids) || in_array('69',$role_resources_ids)) { ?>

         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">Project Settings</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
               <ul class="nav flex-column sub-menu">
                  <?php 
                     if($record_num=='add_client'||$record_num=='client_form'){
                         $client_class= "nav-item active";
                     }else{
                         $client_class= "nav-item";
                     }
                     ?>
                     <?php if(in_array('4',$role_resources_ids) || in_array('66',$role_resources_ids)) { ?>
                  <li class="<?php echo $client_class;?>">
                     <a class="nav-link" href="<?php echo site_url();?>add_client">
                     <i class="menu-icon typcn typcn-shopping-bag"></i>
                     <span class="menu-title">Client</span>
                     </a>
                  </li>
              <?php } if(in_array('7',$role_resources_ids) || in_array('67',$role_resources_ids)) { ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo site_url();?>add_project">
                     <i class="menu-icon typcn typcn-shopping-bag"></i>
                     <span class="menu-title">Project</span>
                     </a>
                  </li>
              <?php } if(in_array('10',$role_resources_ids)) { ?>
                  <li class="nav-item">
                     <a class="nav-link"href="<?php echo site_url();?>task">
                     <i class="menu-icon typcn typcn-bell"></i>
                     <span class="menu-title">Task</span>
                     </a>
                  </li>
                  <?php } if(in_array('13',$role_resources_ids)) { ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo site_url();?>project_cost">
                     <i class="menu-icon typcn typcn-th-large-outline"></i>
                     <span class="menu-title">Resource Cost</span>
                     </a>
                  </li>
              <?php } ?>
               </ul>
            </div>
         </li>
         <?php } if(in_array('15',$role_resources_ids) || in_array('18',$role_resources_ids) || in_array('21',$role_resources_ids) || in_array('23',$role_resources_ids) || in_array('64',$role_resources_ids) || in_array('25',$role_resources_ids) || in_array('28',$role_resources_ids) || in_array('31',$role_resources_ids) || in_array('31',$role_resources_ids) || in_array('33',$role_resources_ids) || in_array('35',$role_resources_ids) || in_array('36',$role_resources_ids) || in_array('70',$role_resources_ids) || in_array('27',$role_resources_ids) || in_array('26',$role_resources_ids)) { ?>

         
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">Employee Management</span>
            <i class="menu-arrow"></i>
            </a>
            <?php 
            if($record_num=='holiday_list'  ){
                $admin_class= "nav-item active";
            }else{
                $admin_class= "nav-item";
            }
            ?>
            <div class="collapse" id="ui-admin">
            <ul class="nav flex-column sub-menu">
                <?php if(in_array('15',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>employees">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Add New Employee</span>
                  </a>
               </li>
               <?php } if(in_array('18',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>timesheet/leave_category">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Leaves Category</span>
                  </a>
               </li>
               <?php } if(in_array('21',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>timesheet/leave/">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Apply for Leaves</span>
                  </a>
               </li>
               <?php } if(in_array('23',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>timesheet/leave_request">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Leave Request</span>
                  </a>
               </li>
           <?php } if(in_array('64',$role_resources_ids)) { ?>
                <?php if($user_info[0]->user_role_id == 3){?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url();?>timesheet/leave_balance">
                    <i class="menu-icon typcn typcn-shopping-bag"></i>
                    <span class="menu-title">Leave Balance</span>
                    </a>
                 </li>
                <?php }else{?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo site_url();?>timesheet/hr_leave_balance">
                      <i class="menu-icon typcn typcn-shopping-bag"></i>
                      <span class="menu-title">Leave Balance</span>
                      </a>
                   </li>
                <?php }?>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>timesheet/hr_leave_balance">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Leave Balance</span>
                  </a>
               </li> -->
           <?php } if(in_array('25',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>timesheet/holiday_list">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Holiday Calendar</span>
                  </a>
               </li>
           <?php } if(in_array('28',$role_resources_ids)) { ?>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="#">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Employees List</span>
                  </a>
                  </li> -->
               <!--<li class="nav-item">-->
               <!--   <a class="nav-link"href="#">-->
               <!--   <i class="menu-icon typcn typcn-bell"></i>-->
               <!--   <span class="menu-title">Audit Log</span>-->
               <!--   </a>-->
               <!--</li>-->
               <li class="nav-item">
                  <a class="nav-link"href="<?php echo site_url();?>expenseCategory">
                  <i class="menu-icon typcn typcn-bell"></i>
                  <span class="menu-title">Add Expense Category</span>
                  </a>
               </li>
           <?php } if(in_array('31',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>employeeExpense">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">Apply For Expenses</span>
                  </a>
               </li>
           <?php } if(in_array('33',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>employeeExpenseAdmin">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">Expense Request</span>
                  </a>
               </li>
           <?php } if(in_array('35',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a href="<?php echo site_url();?>timesheet/timesheet_list" class="nav-link">
                  <i class="menu-icon typcn typcn-coffee"></i>
                  <span class="menu-title">Attendance</span>
                  </a>
               </li>
            <?php } if(in_array('36',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>timeoff/timeoff_list">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Time Off</span>
                  </a>
               </li>
            <?php }  ?>
            </ul>
         </li>

        <?php } if(in_array('37',$role_resources_ids) || in_array('40',$role_resources_ids) || in_array('43',$role_resources_ids)) { ?>
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-organization" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">Other Settings</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-organization">
               <ul class="nav flex-column sub-menu">
                <?php if(in_array('37',$role_resources_ids)) { ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo site_url();?>location">
                     <i class="menu-icon typcn typcn-shopping-bag"></i>
                     <span class="menu-title">Location Management</span>
                     </a>
                  </li>
                <?php } if(in_array('40',$role_resources_ids)) { ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo site_url();?>OrganizationController/department">
                     <i class="menu-icon typcn typcn-shopping-bag"></i>
                     <span class="menu-title">Role & Access Management</span>
                     </a>
                  </li>
                <?php } if(in_array('43',$role_resources_ids)) { ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo site_url();?>OrganizationController/division">
                     <i class="menu-icon typcn typcn-shopping-bag"></i>
                     <span class="menu-title">Division Management</span>
                     </a>
                  </li>
                <?php }  ?>
               </ul>
            </div>
         </li>
        <?php } ?>

        <?php if(in_array('46',$role_resources_ids)) { ?>
         <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url();?>ReportController/employee_search">
            <i class="menu-icon typcn typcn-document-text"></i> 
            <span class="menu-title">Employee Search </span>
            <i class="menu-icon typcn menu-title typcn-shopping-bag"></i>
            </a>
         </li>
        <?php } if(in_array('47',$role_resources_ids)|| in_array('58',$role_resources_ids) || in_array('48',$role_resources_ids) || in_array('59',$role_resources_ids) || in_array('49',$role_resources_ids) || in_array('60',$role_resources_ids) || in_array('53',$role_resources_ids) || in_array('65',$role_resources_ids) || in_array('54',$role_resources_ids)) { ?>

         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#hr-cms" aria-expanded="false" aria-controls="ui-cms">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">HR Document & Policies</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="hr-cms">
            <ul class="nav flex-column sub-menu">
               <?php if(in_array('47',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CmsController/');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">About us</span>
                  </a>
               </li>

                <?php } if(in_array('58',$role_resources_ids)) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CmsController/view_about_us');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">About us</span>
                  </a>
               </li>

               <?php } if(in_array('48',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CmsController/terms_condition');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">Terms & Condition</span>
                  </a>
               </li>
           <?php } if(in_array('59',$role_resources_ids)) { ?>

                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CmsController/view_term_condition');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">Terms & Condition</span>
                  </a>
               </li>

               <?php } if(in_array('49',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CmsController/faq_list');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">FAQ</span>
                  </a>
               </li>
           <?php } if(in_array('60',$role_resources_ids)) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url('CmsController/faq_list');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">FAQ</span>
                  </a>
               </li>

               <?php } if(in_array('53',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link"  href="<?php echo site_url('CmsController/document');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">Document</span>
                  </a>
               </li>

               <?php } if(in_array('54',$role_resources_ids)) { ?>
               <li class="nav-item">
                  <a class="nav-link"  href="<?php echo site_url('CmsController/news_list');?>">
                  <i class="menu-icon typcn typcn-th-large-outline"></i>
                  <span class="menu-title">News</span>
                  </a>
               </li>

               <?php }  ?>
               <!-- <li class="nav-item">
                  <a class="nav-link"href="#">
                  <i class="menu-icon typcn typcn-bell"></i>
                  <span class="menu-title">Organization Hierarchy</span>
                  </a>
               </li> -->
            </ul>
         </li>
         <?php }  ?>
        <!--  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#hr-cms" aria-expanded="false" aria-controls="ui-cms">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">HR Document & Policies</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="hr-cms">
            <ul class="nav flex-column sub-menu">
              
              
              
               
               
               <li class="nav-item">
                  <a class="nav-link"href="#">
                  <i class="menu-icon typcn typcn-bell"></i>
                  <span class="menu-title">Organization Hierarchy</span>
                  </a>
               </li>
            </ul>
         </li> -->
      </nav>

      <!-- <script type="text/javascript">
        
          function fun(argument) {
            document.getElementByClassName('clr').style.backgroundColor = 'background:linear-gradient(119deg, #f37d04 11%, #b50705 55%);';
          }

      </script> -->