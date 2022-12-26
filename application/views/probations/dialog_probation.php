<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Edit Probation</h4>
</div>
<form class="m-b-1" action="<?php echo site_url("probations/update").'/'.$probation_id; ?>" method="post" name="edit_probation" id="edit_probation">
  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="_token" value="<?php echo $probation_id;?>">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="employee">Employee</label>
          <select name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an Employee...">
            <option value=""></option>
            <?php foreach($all_employees as $employee) {?>
            <option value="<?php echo $employee->user_id;?>" <?php if($employee->user_id==$employee_id):?> selected <?php endif; ?>> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="start_date">Start Date</label>
              <input class="form-control start_date2" placeholder="Start Date" readonly name="start_date" type="text" value="<?=$start_date?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_date">End Date</label>
              <input class="form-control end_date2" placeholder="End Date" readonly name="end_date" type="text" value="<?=$end_date?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="result">Employee</label>
          <select name="result" id="select2-demo-7" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an result...">
            <option value="0" <?=($result == 0)?'selected':''?>>Pending</option>
            <option value="1" <?=($result == 1)?'selected':''?>>Pass</option>
            <option value="2" <?=($result == 2)?'selected':''?>>Fail</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control textarea" placeholder="Description" name="description" cols="30" rows="5" id="description2"><?php echo $description;?></textarea>
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

    // On page load: datatable
    var hrms_table = $('#hrms_table').dataTable({
      "bDestroy": true,
      "ajax": {
        url : "<?php echo site_url("probations/probation_list") ?>",
        type : 'GET'
      },
      "fnDrawCallback": function(settings){
      $('[data-toggle="tooltip"]').tooltip();          
      }
      });
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });

		$('.note-children-container').hide();
		// Probation Date
		$('.start_date2, .end_date2').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'yy-mm-dd',
		beforeShow: function(input) {
			$(input).datepicker("widget").show();
		}
		});

		
		$("#edit_probation").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		var description = $("#description2").val();
		fd.append("is_ajax", 1);
		fd.append("edit_type", 'award');
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