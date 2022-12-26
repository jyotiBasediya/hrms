
<?php $session = $this->session->userdata('username');?>
        <!-- partial -->



<!-- <!DOCTYPE >
<html>
<head>
  
 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body> -->
  <!--  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                      

                    <h3 class="page-title">Faq List </h3>
                    <!--<div class="d-flex float-right"> -->
                    <!--    <button class="btn btn-secondary btn-fw">Employment Types</button>-->
                    <!--    <button class="btn btn-secondary btn-fw mx-2">Employee Performance Review</button>-->
                    <!--    <a href="<?php echo site_url();?>add_form">-->
                    <a class="btn btn-primary icon-btn" href="<?php echo site_url('CmsController/add_faq');?>"><i class="fa fa-plus"></i>Add Faq  </a>
                    <!--    <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Employee </button>-->
                    <!--  </a>-->
                      <!--  -->
                    <!--</div>  -->
                   </div>  
                </div> 




                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                      <!--  <div class="col-sm-3">
                                <p class="mb-2">Search</p>
                                <input class="form-control" id="searchInput" type="" name="">   
                            </div> -->
  
                    <table class="table table-hover table-bordered" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th> Question</th>
                          <th>Answer</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                      <tbody id="fbody">
                        
                         <?php
                         $i = 1;
                                    if(!empty($allFaq)){
                                        foreach ($allFaq as $key => $value) { 
                        ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                      
                        <td><?=$value['question'];?></td>
                        <td>
                           <style>
                                .show-read-more .more-text{
                                    display: none;
                                }
                            </style>
                        <p class="show-read-more mb-0"><?=$value['answer'];?></p>
                          
                          
                        </td>
                        <!-- <td>hhdigg</td> -->
                       
                                    </tr>
                                    <?php $i++; } }?>
                      
                        
                       
                        
                      </tbody>
                    </table>
                    <div class="row mt-4">
                     <!--  <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                       <!--    <ul class="pagination float-right">
                            <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li> -->
<!-- 
                            <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">2</a></li> -->
                            
                          <!--   <li class="paginate_button page-item next" id="order-listing_next"><a href="#" aria-controls="order-listing" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li> -->
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
 <script> 
 function deleteFaq(){
        var result = confirm("Are sure delete this FAQ ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  
      function change_status(id,value)
    {
        var faq_id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this FAQ")){
            $.ajax({
                url: '<?php echo site_url("CmsController/faq_status"); ?>',
                type: "POST",
                data: {
                    "faq_id" : faq_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.faq_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {
                        $('#change_status_'+data.faq_id).removeClass("btn-success").addClass('btn-info').text('Inactive')
                    }
                    location.reload();
                }
            });
        }
    }

  $(document).ready(function() {
    // $('#example').DataTable( {
    //     "scrollY": 200,
    //     "scrollX": true
    // } );
        $('#example').DataTable( {
            dom: 'Bfrtip',
            scrollX : true,
            buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                        exportOptions: {                    
                            columns: [0,1]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1]                
                        },
                     },

                ],
        });
    });
  
$(document).ready(function(){
  var maxLength = 1;
  $(".show-read-more").each(function()
  {
        var myStr = $(this).text();
        // alert(myStr);
        if($.trim(myStr).length > maxLength)
        {
          // alert('hi');
          var newStr = myStr.substring(0, maxLength);
          var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
          $(this).empty().html(newStr);
          $(this).append('<br> <a href="javascript:void(0);" class="read-more" style="color:blue;">read more...</a>');
          $(this).append('<span class="more-text">' + removedStr + '</span>');
          // alert(removedStr);
        }
        // else{
        //   alert('no');
        // }
  });
  $(".read-more").click(function()
  {
    $(this).siblings(".more-text").contents().unwrap();
    $(this).remove();
  });
});
</script>