<?php
/* Survey view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong>List All</strong> Survey
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th>Action</th>
          <th>Employee Name</th>
          <th>Survey Name</th>
          <th>Survey At</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<style type="text/css">
.question-box {
    background-color: #f4f4f4;
    padding: 10px;
    margin-bottom: 10px;
    display: table;
    width: 100%;
}
</style>