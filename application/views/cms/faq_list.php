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
                       <?php if(in_array('50',$role_resources_ids)) { ?>
                    <a class="btn btn-primary icon-btn" href="<?php echo site_url('CmsController/add_faq');?>"><i class="fa fa-plus"></i>Add Faq	</a>
                     <?php } ?>
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
                       <!-- <div class="col-sm-3">
                                <p class="mb-2">Search</p>
                                <input class="form-control" id="searchInput" type="" name="">   
                            </div> -->
                    <div class="table-responsive">
                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                                    <th> Question</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                    <?php if(in_array('51',$role_resources_ids) || in_array('52',$role_resources_ids) || in_array('49',$role_resources_ids)) { ?>
                                    <th>Action</th>
                                  <?php } ?>
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
                          <?php
                                

                             echo $str = $value['answer'];
                             
                          ?>
                          

                        </td>
                         
                          <td>
                                        <?php if($value['status'] == 1) { ?>
                                            <button title="Change Status" class="btn-success  btn btn-sm" value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Inactive')"> Active </button>
                                        <?php } else { ?>
                                           <button  title="Change Status" type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Active')"> Inactive </button>
                                        <?php }  ?>
                                    </td>
                          <td>
                             <?php if(in_array('49',$role_resources_ids)) { ?>
				                        <a  title="View" href="<?php echo base_url().'CmsController/view_faq/'.$value['id'];?>" class="btn btn-primary edit_add"><i class="fa fa-eye"></i></a>
                                 <?php } if(in_array('52',$role_resources_ids)) { ?>
                                        <a  title="Edit" href="<?php echo base_url().'CmsController/edit_faq/'.$value['id'];?>" class="btn btn-primary edit_add"><i class="fa fa-pencil"></i></a>
                                   <?php } if(in_array('51',$role_resources_ids)) { ?>
                                        <a  title="Delete" href="<?php echo base_url().'CmsController/delete_faq/'.$value['id'];?>" onclick="return deleteFaq()" class="btn btn-danger">
					                           <i class="fa fa-trash" ></i>
					                    </a>
                               <?php } ?>
                                    </td>
                                    </tr>
                                    <?php $i++; } }?>
                      
                        
                       
                        
                      </tbody>
                    </table>
                  </div>
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
 $(document).ready( function () {
   
      $('#example').DataTable({
            dom: 'Bfrtip',
            scrollX: true,
            buttons: [
                {
                  extend: 'pdfHtml5',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                  columns: ':visible',
                  exportOptions: {                    
                      columns: [0,1,2]                
                  },
                },

                {
                  extend: 'excel',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                  columns: ':visible',
                   exportOptions: {                    
                      columns: [0,1,2]                
                  },
               },
               {
                  extend: 'print',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                  columns: ':visible',
                   exportOptions: {                    
                      columns: [0,1,2]                
                  },
               },

            ],
        
      });



  });
    
</script>
<!-- <script>-->
     
<!--     $(document).ready(function() {-->
<!--	var showChar = 100;-->
<!--	var ellipsestext = "...";-->
<!--	var moretext = "more";-->
<!--	var lesstext = "less";-->
<!--	$('.more').each(function() {-->
<!--		var content = $(this).html();-->

<!--		if(content.length > showChar) {-->

<!--			var c = content.substr(0, showChar);-->
<!--			var h = content.substr(showChar-1, content.length - showChar);-->

<!--			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';-->

<!--			$(this).html(html);-->
<!--		}-->

<!--	});-->

<!--	$(".morelink").click(function(){-->
<!--		if($(this).hasClass("less")) {-->
<!--			$(this).removeClass("less");-->
<!--			$(this).html(moretext);-->
<!--		} else {-->
<!--			$(this).addClass("less");-->
<!--			$(this).html(lesstext);-->
<!--		}-->
<!--		$(this).parent().prev().toggle();-->
<!--		$(this).prev().toggle();-->
<!--		return false;-->
<!--	});-->
<!--});-->
<!-- </script>-->
 
 
 
 
 
    <!-- js -->
<!-- 
  <script src="assets/js/filter_data.js"></script> -->
   <!--  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
     <!- Custom js for this page-->
   <!-- <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
   <!--  <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
 -->

<!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  -->
  
<!-- <script>
  $("#searchInput").keyup(function() {
  var rows = $("#fbody").find("tr").hide();
  var data = this.value.split(" ");
  $.each(data, function(i, v) {
    rows.filter(":contains('" + v + "')").show();
  });
});
</script> -->
 