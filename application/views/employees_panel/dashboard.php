<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::Arrow::</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <link rel="stylesheet" href="assets/css/custom/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="assets/images/logo.png" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="assets/images/logo-mini.png" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav ml-auto">
           <li class="nav-item">
              <a class="nav-link">
                 Personal
              </a>  
           </li> 
           <li class="nav-item">
              <a class="nav-link">
                 Company
              </a>  
           </li> 
            <li class="nav-item dropdown dropdown2 d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <!-- <img class="" width="60" src="assets/images/user-btn.svg" alt="Profile image"> </a> -->
                <i class="fa fa-user-circle" aria-hidden="true"></i>

              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <!-- <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold">Allen Moreno</p>
                  <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                </div> -->
                <!-- <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a> -->
                <a href="login.html" class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
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
                      <p class="designation">Ajay Shukla</p>
                    </div>
                  </a> 
             </li> 
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="timesheets.html" class="nav-link">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Timesheets</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="time-off.html">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Time Off</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add-employee.html">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Add Employee </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add-project.html">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Add Project</span>
              </a>
            </li>
            
            <li class="nav-item active">
              <a class="nav-link" href="add-task.html">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title">Add Task</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reports.html">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title">Reports</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="expenses.html">
                <i class="menu-icon typcn typcn-th-large-outline"></i>
                <span class="menu-title">Expenses</span>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add New Task</h3>
                    <div class="d-flex float-right"> 
                        <button class="btn btn-secondary btn-fw">Cancel</button>
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
                          <form>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Task Description</h4>  
                                 <div class="form-group">
                                    <p>Task Name</p>
                                    <input class="form-control" type="" name="">
                                 </div> 
                                 <div class="form-group">
                                    <p>Task Code</p>
                                    <input class="form-control" type="" name="">
                                    <small>(suggested 3-5 characters)</small>
                                 </div>  
                                 <div class="form-group">
                                    <p>Accounting Package Task ID</p>
                                    <input class="form-control" type="" name="">
                                 </div> 
                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control">
                                      <option>active </option>
                                      <option>inactive</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control">
                                      
                                    </textarea>
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
            <!-- footer -->
            <footer class="footer">
              <div class="container-fluid clearfix">
                <img width="180px" src="assets/images/logo.png">

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mr-5 ml-5">Copyright © 2020 aaravsolutions, Inc.</span>

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mr-5">Terms & conditions</span>

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mr-5">Privacy Policy and Cookie Policy</span>
                
              </div>
            </footer>

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
     <!-- Custom js for this page-->
    <script src="assets/js/shared/chart.js"></script>
    <!-- End custom js for this page-->
    <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
  </body>
</html>