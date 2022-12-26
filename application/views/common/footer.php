<!-- footer -->
  <footer class="footer">
    <div class="container-fluid clearfix">
      <div class="row">
        <div class="col-md-3 text-center">
          <img width="180px" src="<?php echo base_url();?>assets/images/logo.png" class=" mb-2">
        </div>
        <div class="col-md-9">
          <div class="d-md-flex align-items-center justify-content-md-between flex-wrap mt-md-4">
            <span class="text-muted d-block text-center ">Copyright © 2020 aaravsolutions, Inc.</span>

            <span class="text-muted d-block text-center ">Terms & conditions</span>

            <span class="text-muted d-block text-center  ">Privacy Policy and Cookie Policy</span>
          <div>
        </div>
      </div>
    </div>
  </footer>

        
     <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js"></script> -->
    <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="<?php echo base_url();?>assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url();?>assets/js/shared/misc.js"></script>
    <script src="<?php echo base_url();?>assets/js/dashboard/dashboard.js"></script>
     <!-- Custom js for this page-->
    <script src="<?php echo base_url();?>assets/js/shared/chart.js"></script>
    <!-- End custom js for this page-->
    <script src="<?php echo base_url();?>assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/parsley.min.js" type="text/javascript"></script>

    
  <script src="<?php echo base_url();?>assets/js/filter_data.js"></script>
    <!------------------------ Select picker JS -------------------------------->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/select2.min.js"></script> <!-- Select picker JS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom-file-input.js"></script> <!--  name file inpute -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
        type="text/javascript"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
        rel="Stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/js/parsley.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>    
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript">
      $(function () {
          $("#txtFrom").datepicker({
              numberOfMonths: 1,
              onSelect: function (selected) {
                  var dt = new Date(selected);
                  dt.setDate(dt.getDate() + 1);
                  $("#txtTo").datepicker("option", "minDate", dt);
              }
          });
          $("#txtTo").datepicker({
              numberOfMonths: 1,
              onSelect: function (selected) {
                  var dt = new Date(selected);
                  dt.setDate(dt.getDate() - 1);
                  $("#txtFrom").datepicker("option", "maxDate", dt);
              }
          });
      });
 

    


  $(document).ready(function(){
      
    $('#email_address').parsley();

    window.ParsleyValidator.addValidator('checkemail', {
      validateString: function(value)
      {
        return $.ajax({
          url:'<?php echo site_url('add_form/register') ?>',
          method:"POST",
          data:{email:value},
          dataType:"json",
          success:function(data)
          {
            return true;
          }
        });
      }
    });

  });

        
$(document).ready(function() {
  $(document).on('click','#click_form',function(){
    jQuery.ajax({
    type: "POST",
    url: "<?php echo site_url('add_form/register') ?>",    
    data: $("#reg_form").serialize(),
    success: function(res) {
     $(".ajax_response_result").html(res);
     }
    });
  });
});



        $('.alert-danger').delay(7000).fadeOut();    

        $('.alert').delay(5000).fadeOut(); 

        

        <?php if($this->session->flashdata('success')){ ?>

            toastr.success("<?php echo $this->session->flashdata('success'); ?>");

        <?php }else if($this->session->flashdata('error')){  ?>

            toastr.error("<?php echo $this->session->flashdata('error'); ?>");

        <?php }else if($this->session->flashdata('warning')){  ?>

            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");

        <?php }else if($this->session->flashdata('info')){  ?>

            toastr.info("<?php echo $this->session->flashdata('info'); ?>");

        <?php } ?>

// $(function() {
//     $('.multiselect-ui').multiselect({
//         includeSelectAllOption: true
//     });
// });
</script>

    
    </body>
</html>