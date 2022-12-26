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
          <h2><strong>Set Date</strong></h2>
          <div class="row">
            <div class="col-md-12">
            <form class="add form-hrm" method="post" name="attendance_daily_report" id="attendance_daily_report">
              <input type="hidden" name="date_format" id="date_format" value="<?php echo $this->Hrms_model->set_date_format(date('Y-m-d'));?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control attendance_date" placeholder="Select Date" readonly id="attendance_date" name="attendance_date" type="text" value="<?php echo date('Y-m-d');?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group"> &nbsp;
                    <button type="submit" class="btn btn-primary save">Get</button>
                  </div>
                </div>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row m-b-1">
  <div class="col-md-12">
    <div class="box box-block bg-white">
      <h2><strong>Attendance for <span id="att_date"> <?php echo $edate = $this->Hrms_model->set_date_format(date('d M, Y'));?></strong></span> </h2>
      <div class="table-responsive" data-pattern="priority-columns">
        <table class="table table-striped table-bordered dataTable"  style="width:100%;">
          <thead>
            <tr>
              <th>Status</th>
              <th>Employee</th>
              <th>Clock IN</th>
              <th>Clock OUT</th>
              <th>Late</th>
              <th>Early Leaving</th>
              <th>Overtime</th>
              <th>Total Work</th>
              <th>Total Rest</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).on('click', '.btn-view', function(){
    var btn_view = $(this);
    $.ajax({
      url: '<?=base_url()?>timesheet/attendance_detail/',
      type: 'post',
      data: {user_id: btn_view.attr('data-user_id'), date: $('#attendance_date').val()},
      success: function(response){
        $('#ajax_modal_view').html(response);
        $('#view-modal-data').modal('show');
      }
    });
  });

</script>
