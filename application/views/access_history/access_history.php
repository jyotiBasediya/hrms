<?php $session = $this->session->userdata('username');?>

<div class="row m-b-1">
  <div class="col-md-4">
    <div class="box box-block bg-white">
      <h2><strong><img src="<?=base_url('/skin/img/history-clock-button.png')?> " width="25px;" style="margin-right:10px;">View History</strong></h2>
      <form class="m-b-1" action="access_history/history_list" method="post" name="access_history" id="hrms-form">
        <h4>Timeline</h4>
        <div class="timeline-content">
          <div class="timeline-single">
            <label>From Date</label>
            <input class="form-control datepicker" name="from_date" placeholder="From Date" readonly="readonly" value="<?=date('Y-m-d')?>">
          </div>
          <div class="timeline-single">
            <label>To Date</label>
            <input class="form-control datepicker" name="to_date" placeholder="To Date" readonly="readonly" value="<?=date('Y-m-d')?>">
          </div>
          <hr>
          <div class="timeline-single">
            <label>People</label>
            <select class="form-control" name="employee_id" data-plugin="select_hrm" data-placeholder="Employee">
              <option value=""></option>
              <?php foreach($all_employees as $employee) {?>
              <option value="<?php echo $employee->user_id?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="timeline-single">
            <label>Action</label><br>
            <div class="checkbox">
              <input id="checkbox1" type="checkbox" name="action[]" value="Edited">
              <label for="checkbox1">Edited</label>
            </div>
            <div class="checkbox">
              <input id="checkbox2" type="checkbox" name="action[]" value="Added">
              <label for="checkbox2">Added</label>
            </div>
            <div class="checkbox">
              <input id="checkbox3" type="checkbox" name="action[]" value="Deleted">
              <label for="checkbox3">Deleted</label>
            </div>
            <div class="checkbox">
              <input id="checkbox4" type="checkbox" name="action[]" value="Processed">
              <label for="checkbox4">Processed</label>
            </div>
          </div>
          <hr>
          <button type="button" class="btn btn-md btn-primary show-history">Show</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-block bg-white">
      <h2 id="history-date"><strong><?php echo $this->lang->line('hrms_list_all');?></strong> Access History of <?=$this->Hrms_model->set_date_format(date('Y-m-d'))?></h2>
      <div class="table-responsive" data-pattern="priority-columns">
        <table class="table table-bordered" id="hrms_table">
          <thead>
            <tr>
              <th>Date Time</th>
              <th>Access</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  .table tbody td:first-child {
    width: 15%;
  }
</style>