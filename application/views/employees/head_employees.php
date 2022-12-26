<?php $result = $this->Employees_model->read_employees_by_designation($designation_id);?>

<div class="form-group">
    <label for="head_employee"><?php echo $this->lang->line('hrms_employee_head_designation');?></label>
    <select class="form-control" name="head_employee" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('hrms_headd_employee');?>">
        <option value=""></option>
        <?php if(!empty($result)){ ?>
        <?php foreach($result as $employee) {?>
        	<option value="<?php echo $employee->user_id?>"><?php echo $employee->first_name." ".$employee->last_name?></option>
        <?php } ?>
        <?php } ?>
    </select>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
});
</script>