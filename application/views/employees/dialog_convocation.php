<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['convocation_id']) && $_GET['data']=='convocation'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Edit Task</h4>
</div>
<form class="m-b-1" action="<?php echo site_url("employees/edit_convocation").'/'.$convocation_id; ?>" method="post" name="edit_convocation" id="edit_convocation">
  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="convocation_id" value="<?php echo $convocation_id;?>">
  <input type="hidden" name="employee_id" value="<?php echo $employee_id;?>">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="employees" class="control-label">Employee</label>
          <input type="text" name="employee_name" value="<?php foreach($all_employees as $employee) { echo ($employee->user_id == $employee_id)?$employee->first_name.' '.$employee->last_name:''; } ?>" class="form-control" readonly>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="start_date">Convocation Date</label>
          <input class="form-control edate" placeholder="Convocation Date" readonly name="convocation_date" type="text" value="<?=$convocation_date?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="task_name">Health Status</label>
          <input class="form-control" placeholder="Health Status" name="health_status" type="text" value="<?=$health_status?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="disease">Disease</label>
          <input class="form-control" placeholder="Disease" name="disease" type="text" value="<?=$disease?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="blood_group">Blood Group</label>
          <input class="form-control" placeholder="Blood Group" name="blood_group" type="text" value="<?=$blood_group?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="height">Height</label>
          <input class="form-control" placeholder="Height" name="height" type="text" value="<?=$height?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="weight">Weight</label>
          <input class="form-control" placeholder="Weight" name="weight" type="text" value="<?=$weight?>">
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/select2/dist/css/select2.min.css">
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/ion.rangeSlider/css/ion.rangeSlider.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css">
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/ion.rangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script> 
<script type="text/javascript">
 $(document).ready(function(){
					
		// On page load: datatable
		var hrms_table = $('#hrms_table').dataTable({
        "bDestroy": true,
		    "ajax": {
            url : "<?php echo site_url("employees/medical_convocation_list") ?>",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
    	});
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
		
		/*$('#description2').summernote({
		  height: 140,
		  minHeight: null,
		  maxHeight: null,
		  focus: false
		});*/
		$('.note-children-container').hide();
		// Date
		$('.edate').datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat:'yy-mm-dd',
		  yearRange: new Date().getFullYear() + ':' + (new Date().getFullYear() + 10)
		});

		/* Edit data */
		$("#edit_convocation").submit(function(e){
		  e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=convocation&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.save').prop('disabled', false);
					} else {
						hrms_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});	
  </script> 
<?php }
?>
