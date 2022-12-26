        <?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
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
                    <?php if(in_array('5',$role_resources_ids)) { ?>
                    <div class="d-flex float-right"> 
                        <a href="<?php echo site_url();?>client_form"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Client </button></a>
                      <!--  -->
                    </div> 
                    <?php } ?> 
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <!-- <div class="row align-items-center">
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
                    </div>  --> 
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 text-center"  id="example">
                        <thead>
                          <tr>
                            <th>S.no</th>
                            <!-- <th>Client Name</th> -->
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Gst Number</th>
                            <th>PAN Number</th>
                            <th>SPOC Number</th>
                            <th>Company Document</th>
                            <!--<th>Contact Person Name</th>-->
                            <th>Contact Number</th>
                            <th>Contact Mail-Id </th>
                            <th>
                              <?php if(in_array('6',$role_resources_ids) || in_array('66',$role_resources_ids)) { ?>
                                Action
                                <?php } ?>
                              </th>
                            
                          </tr>
                        </thead>
                        <tbody id="fbody">

                          <?php
                          $i=1;
                          foreach ($data as $row)  
                          {
                          ?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><span><?php echo $row->first_name ." ".$row->last_name ;?></span></td>
                            <!-- <td ><?php echo $row->company_name;?></td> -->
                            <td ><?php echo $row->company_address;?></td>
                            <td ><?php echo $row->gst_number;?></td>
                            <td ><?php echo $row->pan_number;?></td>
                            <td ><?php echo $row->spoc_name;?></td>
                            <td>
                               <?php if(!empty($row->gst_certificate))
                                {
                                  $gst_img = base_url().'uploads/gst/'.$row->gst_certificate;
                                }else{
                                  $gst_img =  base_url().'uploads/gst/default.png';
                                }
                              ?>
                              <img src="<?php echo $gst_img; ?>" alt="img" width="500" height="600">
                            </td>
                            <!--<td ><?php echo $row->person_name;?></td>-->
                            <td ><?php echo $row->contact_no;?></td>
                           <td ><?php echo $row->mail_id;?></td>
                           
                            <td>
                              <?php if(in_array('6',$role_resources_ids)) { ?>
                                  <a title="Edit" href="<?php echo site_url('add_client/editpost/'. $row->id);?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                  </a>
                            <?php } if(in_array('66',$role_resources_ids)) { ?>

                             <a  title="Delete" href="<?php echo base_url().'add_client/delete_client/'.$row->id;?>" onclick="return deleteClient()">
                                                 <i class="fa fa-trash" ></i>
                                          </a>
                              <?php } ?>
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
                    </div>
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
 

<script type="text/javascript">


   function deleteClient(){
        var result = confirm("Are sure delete this client ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    } 

  $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                        exportOptions: {                    
                            columns: [0,1,2,3,4,6,7,8]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,6,7,8]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,6,7,8]                
                        },
                     },

                ],
        });
    });
</script>