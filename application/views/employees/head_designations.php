<?php $result = $this->Designation_model->get_designationsByCmy();?>
<?php //$result = $result->result(); ?>

<div class="form-group">
    <label for="designation"><?php echo $this->lang->line('hrms_employee_head_designation');?></label>
    <select class="form-control" name="head_designation" id="head_designation" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('hrms_employee_head_designation');?>">
        <option value=""></option>
        <?php foreach($result as $designation) {?>
        	<option value="<?php echo $designation->designation_id?>"><?php echo $designation->designation_name?></option>
        <?php } ?>
    </select>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	$('#head_designation').on('change', function(){
		$.get('<?=site_url('employees/employee_by_designation/')?>'+$(this).val(), function(m, n){
			$('#head_employees').html(m);
		});
	});
});
</script>