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
                      

                    <h3 class="page-title">Document List </h3>
                    <!--<div class="d-flex float-right"> -->
                    <!--    <button class="btn btn-secondary btn-fw">Employment Types</button>-->
                    <!--    <button class="btn btn-secondary btn-fw mx-2">Employee Performance Review</button>-->
                    <!--    <a href="<?php echo site_url();?>add_form">-->
                       <?php if(in_array('74',$role_resources_ids)) { ?>
                    <!-- <a class="btn btn-primary icon-btn" href="<?php echo site_url('CmsController/add_faq');?>"><i class="fa fa-plus"></i>Add Document	</a> -->

                     <a class="btn btn-primary icon-btn" href="javascript:void(0);" data-toggle="modal" data-target="#addPromodeModal"><i class="fa fa-plus"></i>Add Document</a>
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
  
                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Name</th>
                          <th>Document</th>
                           <?php if(in_array('75',$role_resources_ids) || in_array('53',$role_resources_ids)) { ?>
                          <th>Status</th>                         
                          <th>Action</th>
                        <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                        
                         <?php
                         $i = 1;
                                    if(!empty($getAllDocument)){
                                        foreach ($getAllDocument as $key => $value) { 
                        ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                      
                        <td>
                          <?= $value['name'];?>
                        </td>
                        <td>
                          <a href="<?php echo base_url().'uploads/gst/'.$value['img'];?>" target="_blank">View</a>
                        </td>
                         
                        <?php if(in_array('53',$role_resources_ids) || in_array('75',$role_resources_ids)) { ?>
                          <td>
                            <?php if($value['status'] == 1) { ?>
                                <button title="Change Status" class="btn-success  btn btn-sm" value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Inactive')"> Active </button>
                            <?php } else { ?>
                               <button  title="Change Status" type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Active')"> Inactive </button>
                            <?php }  ?>
                        </td>
                         <?php } ?>


                          <td>
                             <?php if(in_array('53',$role_resources_ids)) { ?>
				                        
      
                                        <a class="btn btn-primary edit_category" title="edit" href="javascript:void(0);" data-id="<?php echo $value['id']; ?>" data-image="<?php echo $value['img']; ?>"  data-name="<?php echo $value['name']; ?>"><i class="fa fa-pencil"></i></a>



                                   <?php } if(in_array('75',$role_resources_ids)) { ?>
                                        <a  title="Delete" href="<?php echo base_url().'CmsController/delete_document/'.$value['id'];?>" onclick="return deleteFaq()" class="btn btn-danger">
					                           <i class="fa fa-trash" ></i>
					                    </a>
                               <?php } ?>
                                    </td>
                                    </tr>
                                    <?php $i++; } }?>
                      
                      </tbody>
                    </table>
                  </div>
                   </div>
                  </div>
                </div>  

            </div>
            <!-- content-wrapper ends -->
           
          <!-- partial -->
        </div>


    <div id="addPromodeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Document</h4>
                </div>
                <form method="POST" data-parsley-validate action="<?php echo base_url().'CmsController/insert_document'?>"  enctype="multipart/form-data">
                    <div class="modal-body">
                    </div>
                    <div class="modal-body" style="padding: 0rem 1rem">
                       <div class="form-group col-12">
                            <label for="name">Name</label>
                           <input class="form-control mt-2" id="name" type="text" placeholder="Name" name="name" required data-parsley-required data-parsley-required-message="Please Enter Name">
                           <span id="errmsg_brand_name" style="color: red"></span>
                      </div>

                       <div class="form-group col-12">
                            <label for="promo_code_desc">Image</label>
                            <br>
                            <img width="100" id="img_add" name="img">
                            <br>
                            <input type='file' name="doc_img" id="imgadd" class="upload" />
                            <br>
                            <span id="errmsg_file_type" style="color: red"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--Edit Category Modal  -->    
    <div id="editCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Document</h4>
                </div>
                <form method="POST" data-parsley-validate action="<?php echo base_url().'CmsController/update_document'?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <input type="hidden" name="banner_id" id="banner_id">
                    </div>

                    <div class="form-group col-12">
                            <label for="name">Name</label>
                           <input class="form-control mt-2" id="d_name" type="text" placeholder="Name" name="name" required data-parsley-required data-parsley-required-message="Please Enter Name">
                           <span id="errmsg_brand_name" style="color: red"></span>
                      </div>



                     <div class="form-group col-12">
                            <label for="promo_code_desc">Image</label>
                            <br>
                            <!-- <img width="100" id="img_tag" name="img"> -->


                            <a target="_blank" id="img_tag" href="">View</a>
                            <br>
                            <input type='file' name="doc_img" id="imgInp" class="upload" />
                            <br>
                            <span id="errmsg_file_type" style="color: red"></span>
                        </div>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
 <script>	
 function deleteFaq(){
        var result = confirm("Are sure delete this document ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  
      function change_status(id,value)
    {
        var document_id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this document")){
            $.ajax({
                url: '<?php echo site_url("CmsController/status_documentr"); ?>',
                type: "POST",
                data: {
                    "document_id" : document_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.document_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {
                        $('#change_status_'+data.document_id).removeClass("btn-success").addClass('btn-info').text('Inactive')
                    }
                    location.reload();
                }
            });
        }
    }
 // $(document).ready( function () {
   
 //      $('#example').DataTable({
 //            dom: 'Bfrtip',
 //            scrollX: true,
 //            // buttons: [
 //            //     {
 //            //       extend: 'pdfHtml5',
 //            //       orientation: 'landscape',
 //            //       pageSize: 'LEGAL',
 //            //       columns: ':visible',
 //            //       exportOptions: {                    
 //            //           columns: [0,1,2]                
 //            //       },
 //            //     },

 //            //     {
 //            //       extend: 'excel',
 //            //       orientation: 'landscape',
 //            //       pageSize: 'LEGAL',
 //            //       columns: ':visible',
 //            //        exportOptions: {                    
 //            //           columns: [0,1,2]                
 //            //       },
 //            //    },
 //            //    {
 //            //       extend: 'print',
 //            //       orientation: 'landscape',
 //            //       pageSize: 'LEGAL',
 //            //       columns: ':visible',
 //            //        exportOptions: {                    
 //            //           columns: [0,1,2]                
 //            //       },
 //            //    },

 //            // ],
        
 //      });

 //  });

  $(document).on('click','.edit_category', function() { 
        var id = $(this).data('id'); 
        var name = $(this).data('name'); 
        
        var base_url = "<?php echo site_url('uploads/gst/');?>";

        var brandImage = $(this).data('image'); 

        console.log(brandImage);
        var banner_img = base_url + brandImage;
         
        $('#banner_id').val(id);
        $('#d_name').val(name);
        // $('#img_tag').prop('src',banner_img);

        $("#img_tag").attr("href",banner_img);

        $('#editCategoryModal').modal('show');
    });




</script>