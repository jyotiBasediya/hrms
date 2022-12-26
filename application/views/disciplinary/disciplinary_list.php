<?php
/* Policy view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="row m-b-1">
  <div class="col-md-4">
    <div class="box box-block bg-white">
      <h2><strong><?php echo $this->lang->line('hrms_add_new');?></strong> <?php echo $this->lang->line('hrms_disciplinary');?></h2>
      <form class="m-b-1" action="<?php echo site_url("disciplinary/add_disciplinary") ?>" method="post" name="add_disciplinary" id="xin-form">
        <div class="form-group">
          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
          <label for="company"><?php echo $this->lang->line('module_company_title');?></label>
          <select class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('hrms_select_company');?>..." name="company">
            <option value="0"><?php echo $this->lang->line('hrms_all_companies');?></option>
            <?php foreach($all_companies as $company) {?>
            <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="title"><?php echo $this->lang->line('hrms_title');?></label>
          <input type="text" class="form-control" name="title" placeholder="<?php echo $this->lang->line('hrms_title');?>">
        </div>
        <div class="form-group">
          <label for="message"><?php echo $this->lang->line('hrms_description');?></label>
          <textarea class="form-control" placeholder="<?php echo $this->lang->line('hrms_description');?>" name="description" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('hrms_save');?></button>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-block bg-white">
      <h2><strong><?php echo $this->lang->line('hrms_list_all');?></strong> <?php echo $this->lang->line('hrms_disciplinary');?></h2>
      <div class="table-responsive" data-pattern="priority-columns">
        <table class="table table-striped table-bordered dataTable" id="hrms_table">
          <thead>
            <tr>
              <th><?php echo $this->lang->line('hrms_action');?></th>
              <th><?php echo $this->lang->line('hrms_title');?></th>
              <th><?php echo $this->lang->line('module_company_title');?></th>
              <th><?php echo $this->lang->line('hrms_created_at');?></th>
              <th><?php echo $this->lang->line('hrms_added_by');?></th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- responsive --> 
    </div>
  </div>
</div>
