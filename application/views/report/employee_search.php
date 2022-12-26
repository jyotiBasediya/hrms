<?php $session = $this->session->userdata('username');?>
        <!-- partial -->


        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">

                    <h3 class="page-title">Report </h3>
                    
                   </div>  
                </div> 

                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-sm-12"> 
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="mb-2">Search by Name,location,Email-Id,Mobile Number,Employee Id</p>
                                 <input type="text" name="word" id="word" placeholder="Search by Name,location,Email-Id,Mobile Number,Employee Id" class="form-control">
                            </div>
                        </div>  
                      </div> 
                       <div class="card-body"></div>


                       <div class="col-sm-12"> 
                        <div class="row ml-2">
                             <button onclick="filterData();" class="btn btn-primary">Search</button>
                             <a href="<?php echo site_url();?>ReportController/employee_search" class="btn btn-primary ml-3">Refresh</a>
                        </div>  
                      </div> 
                    </div> 

                    <div class="emp_search"  style="display: none;">
                    <table class="table table-hover mt-4 text-center " id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Employee Name</th>
                          <th>Manager Name</th>
                          <th>Profile Image</th>
                          <th>Mobile Number</th>
                          <th>Email-Id</th>
                          <th>Date of birth</th>
                          <th>Level</th>
                          <th>Location</th>
                          <th>TIme zone</th>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                        <tr>
                          <td>1</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                    <div class="row mt-4">
                     <!--  <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
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

 <script type="text/javascript">
//   $(document).ready( function () {
//     $('#example').DataTable();
// } );


   

  function filterData()
  {
    $('.emp_search').show();

        var word = document.getElementById('word').value;

         var buildSearchData = {
            "word"           : word,
        };

         table = $('#example').DataTable({ 
            // "scrollY"       : "350px",
            // "scrollCollapse": true,
            "dom"     : 'lBfrtip',
            "buttons"   : [
                      {
                            'extend': 'pdfHtml5',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                            'exportOptions': {                    
                                'columns': [0,1,3,4,5,6,7,8]                
                            },
         
                        },
                        // 'excel',
                        {
                            'extend': 'excel',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1,3,4,5,6,7,8]                
                            },
                         },
                         // 'print',
                        {
                            'extend': 'print',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1,3,4,5,6,7,8]                
                            },
                         },
                    ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("ReportController/searchEmp"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        });
    }

    // $(document).ready(function() {
    //     $('#example').DataTable( {
    //         dom: 'Bfrtip',
    //         buttons: [
    //                 {
    //                     extend: 'pdfHtml5',
    //                     orientation: 'landscape',
    //                     pageSize: 'LEGAL',
    //                     columns: ':visible',
    //                     exportOptions: {                    
    //                         columns: [0,1,3,4,5,6,7,8]                
    //                     },
     
    //                 },
    //                 {
    //                     extend: 'excel',
    //                     orientation: 'landscape',
    //                     pageSize: 'LEGAL',
    //                     columns: ':visible',
    //                      exportOptions: {                    
    //                         columns: [0,1,3,4,5,6,7,8]                
    //                     },
    //                  },
    //                 {
    //                     extend: 'print',
    //                     orientation: 'landscape',
    //                     pageSize: 'LEGAL',
    //                     columns: ':visible',
    //                      exportOptions: {                    
    //                         columns: [0,1,3,4,5,6,7,8]                
    //                     },
    //                  },

    //             ],
    //     });
    // });
 </script>

