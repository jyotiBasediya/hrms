<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Client </h3>
                    <div class="d-flex float-right"> 
                        <a href="<?php echo site_url();?>client_form"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Client </button></a>
                      <!--  -->
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Search</p>
                                <input class="form-control" id="searchInput" type="" name="">   
                            </div>
                            
                        </div>  
                      </div> 
                      <div class="col-sm-6">
                       <div class="d-flex float-right"> 
                         <div class="btn-group">
                          <button type="button" class="btn btn-secondary">Active</button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">
                            <a class="dropdown-item" href="#">Active</a>
                            <a class="dropdown-item" href="#">Active & Inactive</a>
                            <a class="dropdown-item" href="#">Inactive</a>
                            
                          </div>
                       </div>
                         <div class="btn-group mx-2">
                          <button type="button" class="btn btn-secondary">Actions</button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">
                            <a class="dropdown-item" href="#">Mark as Inactive</a>
                            <a class="dropdown-item" href="#">Mark as Active</a>
                          </div>
                       </div>
                         <div class="btn-group">
                          <button type="button" class="btn btn-secondary">Columns</button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Accounting Package ID</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Project</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Project Name</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Project Short Name</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Notes</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Status</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Time Entry Preview </a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Client Detail Link</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Duplicate Client</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Restore Column Defaults</a>
                          </div>
                       </div>
                       </div>
                      </div> 
                    </div>  
                    <table class="table table-hover mt-4 text-center"  id="example">
                      <thead>
                        <tr>
                          <!--<th><input type="checkbox" name=""> </th>-->
                          <th>Client Name</th>
                          <th>Company Name</th>
                          <th>Company Address</th>
                          <th>Gst Number</th>
                          <th>Image</th>
                          <!--<th>Contact Person Name</th>-->
                          <th>Contact Number</th>
                          <th>Contact Mail-Id </th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody id="fbody">

                        <?php
                        
                        foreach ($data as $row)  
                        {
                        ?>
                        <tr>
                          <!--<td><input type="checkbox" name=""></td>-->
                          <td><span><?php echo $row->first_name ." ".$row->last_name ;?></span></td>
                          <td ><?php echo $row->company_name;?></td>
                          <td ><?php echo $row->company_address;?></td>
                          <td ><?php echo $row->gst_number;?></td>
                          <td>
                          
                          <img src="<?php echo base_url()?>uploads/gst/<?= $row->gst_certificate?>" alt="img" width="500" height="600">

</td>
                          <!--<td ><?php echo $row->person_name;?></td>-->
                          <td ><?php echo $row->contact_no;?></td>
                         <td ><?php echo $row->mail_id;?></td>
                          <td>
                           <a href="<?php echo site_url('add_client/editpost/'. $row->id);?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                           </a>
                            <!--<i class="fa fa-plus ml-3" aria-hidden="true"></i>-->
                          </td>
                        </tr>
                        <?php

                          } ?>

                       <!--  <tr>
                          <td><input type="checkbox" name=""></td>
                          <td><span> Project Name </span></td>
                          <td >Project 1</td>
                          <td><span> </span></td>
                          <td> Project 1 </td>
                          <td>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <i class="fa fa-plus ml-3" aria-hidden="true"></i>
                          </td>
                        </tr> -->
                       <!--  <tr>
                          <td><input type="checkbox" name=""></td>
                          <td><span> Project Name </span></td>
                          <td >Project 1</td>
                          <td><span> </span></td>
                          <td> Project 1 </td>
                          <td>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <i class="fa fa-plus ml-3" aria-hidden="true"></i>
                          </td>
                        </tr> -->
                     <!--    <tr>
                          <td><input type="checkbox" name=""></td>
                          <td><span> Project Name </span></td>
                          <td >Project 1</td>
                          <td><span> </span></td>
                          <td> Project 1 </td>
                          <td>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <i class="fa fa-plus ml-3" aria-hidden="true"></i>
                          </td>
                        </tr> -->
                        
                      </tbody>
                    </table>
                  <!--   <div class="row mt-4">
                      <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                     <!--  <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                          <ul class="pagination float-right">
                            <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li> -->
<!-- 
                            <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                             --><!-- 
                            <li class="paginate_button page-item next" id="order-listing_next"><a href="#" aria-controls="order-listing" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li> -->
                          </ul>
                        </div>
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
 

