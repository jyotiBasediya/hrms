<?php
/* Payroll Template view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="add-form" style="display:none;">
  <div class="box box-block bg-white">
    <h2><strong>Setup</strong> New Benefit
      <div class="add-record-btn">
        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> Hide</button>
      </div>
    </h2>
    <div class="row m-b-1">
      <div class="col-md-12">
        <form class="form-hrm" action="<?php echo site_url("payroll/add_benefit") ?>" method="post" name="add_template" id="hrms-form" autocomplete="off">
          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
          <div class="bg-white">
            <div class="box-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">                        
                        <label for="salary_grades">Benefit for employee</label>
                        <select id="employee_id" name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose Employee...">
                          <option value="">Employee Name</option>
                          <?php foreach($all_employees as $employee) {?>
                          <option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?> (<?php echo $employee->username;?>)</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="benefit_type_id">Benefit Type</label>
                        <select id="benefit_type_id" name="benefit_type_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose Benefit Type...">
                          <option value="">Benefit Type</option>
                          <?php foreach($benefit_types as $benefit_type) {?>
                          <option value="<?php echo $benefit_type->benefit_type_id;?>"> <?php echo $benefit_type->benefit_type?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input class="form-control" placeholder="Start Date" name="start_date" id="start_date" type="text" readonly="true">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input class="form-control" placeholder="End Date" name="end_date" id="end_date" type="text" readonly="true">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="amount">Amount</label>
                        <input class="form-control" placeholder="Amount" name="amount" type="text" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" placeholder="Description" name="description" id="description" rows="5"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary save primary-btn-block col-right">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-block bg-white">
  <h2><strong>List All</strong> Payroll Templates
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> Add New</button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th>Action</th>
          <th>Employee</th>
          <th>Benefit Type</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Amount</th>
          <th>Created By</th>
          <th>Created Date</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
