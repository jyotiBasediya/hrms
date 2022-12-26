<?php
/* User Roles view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong>List All</strong> Files</h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th>Action</th>
          <th>Employee Name</th>
          <th>Department</th>
          <th>Status</th>
          <th>File</th>
          <th>Title</th>
          <th>Added Date</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<style type="text/css">
.k-in { display:none !important; }
</style>