<?php
/* Awards view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong>List All</strong> Performance</h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th>Employees</th>
          <th>Task Name</th>
          <th>Performance</th>
          <th>Performance By</th>
          <th>Date</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>
