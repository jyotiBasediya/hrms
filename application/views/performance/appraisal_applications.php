<?php
/* Appraisal Application view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong>List All</strong> Appraisal Application</h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th>Action</th>
          <th>Applied By</th>
          <th>Name</th>
          <th>Designation</th>
          <th>Last Appraisal</th>
          <th>Expected Appraisal</th>
          <th>Curretnt Salary</th>
          <th>Expected Salary</th>
          <th>Promotion</th>
          <th>Status</th>
          <th>Applied On</th>
        </tr>
      </thead>
    </table>
  </div>
</div>