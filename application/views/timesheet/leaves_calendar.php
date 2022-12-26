<?php
/* Attendance view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="row m-b-1">
  <div class="col-md-12">
    <div class="box box-block bg-white col-md-5">
      <div class="row">
        <div class="col-md-12">
          <h2><strong>Leaves Calendar</strong></h2>
          <div class="row">
            <div class="col-md-12">
              <div id="calendar-box"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="box box-block bg-white">
        <h2><strong>Leave Detail </strong></h2>
        <div class="table-responsive" data-pattern="priority-columns">
          <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
            <thead>
              <tr>
                <th>Action</th>
                <th>Employee</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>  
</div>

