
<?php $session = $this->session->userdata('username');?>

<div class="add-form" style="display:none;">
  <div class="box box-block bg-white">
    <h2><strong>Add New</strong> Employee Convocation
      <div class="add-record-btn">
        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> Hide</button>
      </div>
    </h2>
    <div class="row m-b-1">
      <div class="col-md-12">
        <form action="<?php echo site_url("employees/add_medical_convocation") ?>" method="post" name="add_task" id="hrms-form">
          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
          <div class="bg-white">
            <div class="box-block">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="employees" class="control-label">Employee</label>
                        <select class="form-control" name="employee_id" data-plugin="select_hrm" data-placeholder="Employee">
                          <option value=""></option>
                          <?php foreach($all_employees as $employee) {?>
                          <option value="<?php echo $employee->user_id?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="start_date">Convocation Date</label>
                        <input class="form-control date" placeholder="Convocation Date" readonly name="convocation_date" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="task_name">Health Status</label>
                        <input class="form-control" placeholder="Health Status" name="health_status" type="text" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="disease">Disease</label>
                        <input class="form-control" placeholder="Disease" name="disease" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="blood_group">Blood Group</label>
                        <input class="form-control" placeholder="Blood Group" name="blood_group" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="height">Height</label>
                        <input class="form-control" placeholder="Height" name="height" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="weight">Weight</label>
                        <input class="form-control" placeholder="Weight" name="weight" type="text" value="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary save">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-block bg-white">
  <h2><strong>List All</strong> Worksheets
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> Add New</button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('hrms_action');?></th>
          <th>Employee</th>
          <th>Last Checkup</th>
          <th>Disease</th>
          <th>Health Status</th>
          <th>Blood Group</th>
          <th>Height</th>
          <th>Weight</th>
          <th>Disease By Employee</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- responsive --> 
</div>