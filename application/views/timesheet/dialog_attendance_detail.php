<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
    <h4 class="modal-title" id="edit-modal-data">Attendance detail for <?=$date?></h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Clock In</th>
              <th>Clock Out</th>
              <th>In Lat</th>
              <th>In Lang</th>
              <th>Out Lat</th>
              <th>Out Lang</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($attendances as $attendance) { ?>
              <tr>
                <td><?=($attendance->clock_in)?date('h:i a', strtotime($attendance->clock_in)):'-'?></td>
                <td><?=($attendance->clock_out)?date('h:i a', strtotime($attendance->clock_out)):'-'?></td>
                <td><?=($attendance->in_latitude)?$attendance->in_latitude:'-'?></td>
                <td><?=($attendance->in_longitude)?$attendance->in_longitude:'-'?></td>
                <td><?=($attendance->out_latitude)?$attendance->out_latitude:'-'?></td>
                <td><?=($attendance->out_longitude)?$attendance->out_longitude:'-'?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
