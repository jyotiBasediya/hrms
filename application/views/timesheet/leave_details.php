<?php

/* Leave Detail view

*/

?>

<?php $session = $this->session->userdata('username');?>

<?php $user = $this->Hrms_model->read_user_info($session['user_id']);?>

<style type="text/css">

  .circles-wrp, .circles-wrp svg {

    margin: 0 auto;

    display: block !important;

    margin-bottom: 30px;

  }

</style>

<script type="text/javascript" src="<?php echo base_url();?>skin/js/circles.min.js"></script>

<div class="row m-b-1">

  <?php $i = 1; ?>

  <?php foreach($all_leave_types as $leave_type) {?>

  <div class="col-md-3">

    <div class="box box-block bg-white">

      <h2 class="text-xs-center"><strong><?php echo $leave_type->type_name;?></strong></h2>

        <?php



          $leaveCount = $this->Employees_model->all_leaves_count($employee_id);

          

          $TotalLeave = 0;



          if($leave_type->type_name == "Casual Leave"){

            $TotalLeave = $leaveCount[0]->casual_leave;

          } else if($leave_type->type_name == "Medical Leave"){

            $TotalLeave = $leaveCount[0]->medical_leave;

          }



          $count_l = 0;

          $leaves = $this->Timesheet_model->count_total_leaves($leave_type->leave_type_id,$employee_id);

          

          foreach ($leaves as $leave) {

            $fdate = new DateTime($leave['from_date']);

            $tdate = new DateTime($leave['to_date']);

            $interval   = $fdate->diff($tdate);

            $count_l += $interval->format('%a')+1;

          }



          if($TotalLeave != 0){

            $count_data = $count_l / $TotalLeave * 100;

          } else {

            $count_data = 0;

          }



          // progress

          if($count_data <= 20) {

            $progress_class1 = '#43b968';

            $progress_class2 = '#95d2ac';

          } else if($count_data > 20 && $count_data <= 50){

            $progress_class1 = '#20b9ae';

            $progress_class2 = '#84d2cf';

          } else if($count_data > 50 && $count_data <= 75){

            $progress_class1 = '#f59345';

            $progress_class2 = '#efc09b';

          } else {

            $progress_class1 = '#f44236';

            $progress_class2 = '#ee9691';

          }

          

        ?>

      <div class="circle" id="circles-<?=$i?>"></div>

      <script type="text/javascript">

        var myCircle = Circles.create({

          id:                  'circles-<?=$i?>',

          radius:              60,

          value:               <?=$count_data?>,

          maxValue:            100,

          width:               15,

          text:                function(value){return '<strong>'+<?=($TotalLeave-$count_l > 0)?$TotalLeave-$count_l:0;?>+'d</strong><br>available';},

          colors:              ['<?=$progress_class2?>', '<?=$progress_class1?>'],

          duration:            400,

          wrpClass:            'circles-wrp',

          textClass:           'circles-text',

          valueStrokeClass:    'circles-valueStroke',

          maxValueStrokeClass: 'circles-maxValueStroke',

          styleWrapper:        true,

          styleText:           true

        });

      </script>



      <div>

        <h6>Available <strong class="float-xs-right"><?=($TotalLeave-$count_l > 0)?$TotalLeave-$count_l:0;?>D</strong></h6>

        <h6>Consumed <strong class="float-xs-right"><?=$count_l;?>D</strong></h6>

        <!-- <h6>Accrued so far <strong class="float-xs-right">0D</strong></h6> -->

        <h6>Annual Quota <strong class="float-xs-right"><?=$TotalLeave;?>D</strong></h6>

      </div>



    </div>

  </div>

  <?php $i++; } ?>

</div>



<div class="row m-b-1">

  <div class="col-md-6">

    <div class="box box-block bg-white">

      <h2><strong>Leave Detail</strong></h2>
      <div class="table-responsive">
      <table class="table table-striped m-md-b-0">

        <tbody>

          <tr>

            <th scope="row">Employee</th>

            <td class="text-right"><?php echo $first_name.' '.$last_name;?></td>

          </tr>

          <tr>

            <th scope="row">Leave Type</th>

            <td class="text-right"><?php echo $type;?></td>

          </tr>

          <tr>

            <th scope="row">Applied On</th>

            <td class="text-right"><?php echo $this->Hrms_model->set_date_format($created_at);?></td>

          </tr>

          <tr>

            <th scope="row">From Date</th>

            <td class="text-right"><?php echo $this->Hrms_model->set_date_format($from_date);?></td>

          </tr>

          <tr>

            <th scope="row">To Date</th>

            <td class="text-right"><?php echo $this->Hrms_model->set_date_format($to_date);?></td>

          </tr>

        </tbody>

      </table>
    </div>

      <br>

      <div class="the-notes info"><?php echo $reason;?></div>

    </div>

  </div>

  <?php if($user[0]->user_role_id == 1) {?>

  <div class="col-md-6">

    <div class="box box-block bg-white">

      <h2><strong>Update Status</strong></h2>

      <form action="<?php echo site_url("timesheet/update_leave_status").'/'.$leave_id;?>/" method="post" name="update_status" id="update_status">

        <input type="hidden" name="_token_status" value="<?php echo $leave_id;?>">

        <div class="row">

          <div class="col-md-12">

            <div class="form-group">

              <label for="status">Status</label>

              <select class="form-control" name="status" data-plugin="select_hrm" data-placeholder="Status">

                <option value="1" <?php if($status=='1'):?> selected <?php endif; ?>>Pending</option>

                <option value="2" <?php if($status=='2'):?> selected <?php endif; ?>>Approved</option>

                <option value="3" <?php if($status=='3'):?> selected <?php endif; ?>>Rejected</option>

              </select>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-12">

            <div class="form-group">

              <label for="remarks">Remarks</label>

              <textarea class="form-control textarea" placeholder="Remarks" name="remarks" id="remarks" cols="30" rows="5"><?php echo $remarks;?></textarea>

            </div>

          </div>

        </div>

        <button type="submit" class="btn btn-primary save">Save</button>

      </form>

    </div>

  </div>

  <?php } ?>

  <!-- <div class="col-md-4">

    <div class="box box-block bg-white">

      <h2><strong>Leave Statistics </strong> of <?php echo $first_name.' '.$last_name;?></h2>

      <?php foreach($all_leave_types as $type) {?>

      <?php 

        $count_l = 0;

        $leaves = $this->Timesheet_model->count_total_leaves($type->leave_type_id,$employee_id);

        foreach ($leaves as $leave) {

          $from_date = new DateTime($leave['from_date']);

          $to_date = new DateTime($leave['to_date']);

          $interval   = $from_date->diff($to_date);

          $count_l += $interval->format('%a');

        }

      ?>

      <?php

					$count_data = $count_l / $type->days_per_year * 100;

					// progress

					if($count_data <= 20) {

						$progress_class = 'progress-success';

					} else if($count_data > 20 && $count_data <= 50){

						$progress_class = 'progress-info';

					} else if($count_data > 50 && $count_data <= 75){

						$progress_class = 'progress-warning';

					} else {

						$progress_class = 'progress-danger';

					}

				?>

      <div id="leave-statistics">

        <p><strong><?php echo $type->type_name;?> (<?php echo $count_l;?>/<?php echo $type->days_per_year;?>)</strong></p>

        <progress class="progress <?php echo $progress_class;?>" value="<?php echo $count_data;?>" max="100"></progress>

        <?php } ?>

      </div>

    </div>

  </div> -->



</div>