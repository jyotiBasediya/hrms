<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(isset($_GET['jd']) && isset($_GET['file_id']) && $_GET['data']=='file'){ ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Edit Award</h4>
</div>
<form class="m-b-1" action="<?php echo site_url("file_management/update").'/'.$file_id; ?>" method="post" name="edit_file" id="edit_file">
  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="_token" value="<?php echo $file_id;?>">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="employee">Employee</label>
          <input type="text" name="employee" class="form-control" value="<?=$employee?>" readonly>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="department">Department</label>
          <input type="text" name="department" class="form-control" value="<?=$department?>" readonly>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="status">Status</label>
          <input type="text" name="status" class="form-control" value="<?=$status?>" readonly>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="file_date">Date</label>
          <input type="text" name="file_date" class="form-control" value="<?=$file_date?>" readonly>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <div>
            <label for="file">File</label>
          </div>
          <?php if($file_name != ''){ ?><p><a href="<?=base_url().'uploads/files/'.$file_name?>" download><?=$file_name?></a></p><?php } ?>
          <span class="btn btn-primary btn-file">
            Browse <input type="file" name="file_manage" id="file_manage">
          </span>
          <small>Upload file</small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="title">Title</label>
          <textarea name="title" class="form-control" readonly><?=$title?></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function(){

    var hrms_table = $('#hrms_table').dataTable({
      "bDestroy": true,
      "ajax": {
        url : "<?php echo site_url("file_management/files_list") ?>",
        type : 'GET'
      },
      "fnDrawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();          
      }
    });

    $("#edit_file").submit(function(e){
      var fd = new FormData(this);
      var obj = $(this), action = obj.attr('name');
      var description = $("#description2").code();
      fd.append("is_ajax", 1);
      fd.append("edit_type", 'file');
      fd.append("description", description);
      fd.append("form", action);
      e.preventDefault();
      $('.icon-spinner3').show();
      $('.save').prop('disabled', true);
      $.ajax({
        url: e.target.action,
        type: "POST",
        data:  fd,
        contentType: false,
        cache: false,
        processData:false,
        success: function(JSON)
        {
          if (JSON.error != '') {
            toastr.error(JSON.error);
            $('.save').prop('disabled', false);
            $('.icon-spinner3').hide();
          } else {
            hrms_table.api().ajax.reload(function(){ 
              toastr.success(JSON.result);
            }, true);
            $('.icon-spinner3').hide();
            $('.edit-modal-data').modal('toggle');
            $('.save').prop('disabled', false);
          }
        },
        error: function() 
        {
          toastr.error(JSON.error);
          $('.icon-spinner3').hide();
          $('.save').prop('disabled', false);
        }
      });
    });
  });	
</script>

<?php } ?>