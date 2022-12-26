<?php
/*
* Designation View
*/
$session = $this->session->userdata('username');
?>

<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-4">
    <div class="box box-block bg-white">
      <h2><strong><?php echo $this->lang->line('hrms_add_new');?></strong> <?php echo $this->lang->line('hrms_designation');?></h2>
      <form class="m-b-1" action="<?php echo site_url("designation/add_designation") ?>" method="post" name="add_designation" id="xin-form">
        <div class="form-group">
          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
          <label for="name"><?php echo $this->lang->line('hrms_department');?></label>
          <select class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('hrms_select_department');?>..." name="department_id">
            <option value=""></option>
            <?php foreach($all_departments as $deparment) {?>
            <option value="<?php echo $deparment->department_id?>"><?php echo $deparment->department_name?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('hrms_designation_name');?></label>
          <input type="text" class="form-control" name="designation_name" placeholder="<?php echo $this->lang->line('hrms_designation_name');?>">
        </div>
        <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('hrms_save');?></button>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-block bg-white">
      <h2><strong><?php echo $this->lang->line('hrms_list_all');?></strong> <?php echo $this->lang->line('hrms_designations');?></h2>
      <div class="table-responsive" data-pattern="priority-columns">
        <table class="table table-striped table-bordered dataTable" >
          <thead>
            <tr>
              <th style="width:150px;"><?php echo $this->lang->line('hrms_action');?></th>
              <th><?php echo $this->lang->line('hrms_designation');?></th>
              <th><?php echo $this->lang->line('hrms_department');?></th>
              <th><?php echo $this->lang->line('hrms_added_by');?></th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- responsive --> 
    </div>
  </div>
</div>
