<?php
/* Promotion view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="add-form" style="display:none;">
  <div class="box box-block bg-white">
    <h2><strong>Add New</strong> Promotion
      <div class="add-record-btn">
        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> Hide</button>
      </div>
    </h2>
    <div class="row m-b-1">
      <div class="col-md-12">
        <form action="<?php echo site_url("promotion/add_promotion") ?>" method="post" name="add_promotion" id="xin-form">
          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
          <div class="bg-white">
            <div class="box-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="employee">Promotion For</label>
                    <select name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an Employee...">
                      <option value=""></option>
                      <?php foreach($all_employees as $employee) {?>
                      <option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_designation_from">Designation</label>
                        <select class="select2 designationData" data-plugin="select_hrm" data-placeholder="Select Department..." name="transfer_designation_from">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Promotion Title</label>
                        <input class="form-control" placeholder="Promotion Title" name="title" type="text">
                      </div>
                    </div> -->
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="promotion_date">Promotion Date</label>
                        <input class="form-control date" placeholder="Promotion Date" readonly name="promotion_date" type="text">
                      </div>
                    </div> -->
                  </div>
                      <div class="row">
  <!-- Transfer To location -->
                       <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_location">Transfer To (Location)</label>
                        <select class="select2" data-plugin="select_hrm" data-placeholder="Select Location..." name="transfer_location">
                          <option value=""></option>
                          <?php foreach($all_locations as $location) {?>
                          <option value="<?php echo $location->location_id?>"><?php echo $location->location_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
  <!-- Transfer From location -->
                         <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_fromlocation">Transfer From (Location)</label>
                        <select class="select2" data-plugin="select_hrm" data-placeholder="Select Location..." name="transfer_fromlocation">
                          <option value=""></option>
                          <?php foreach($all_locations as $location) {?>
                          <option value="<?php echo $location->location_id?>"><?php echo $location->location_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
  <!-- transfer to Department -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_department">Transfer To (Department)</label>
                        <select class="select2" data-plugin="select_hrm" data-placeholder="Select Department..." name="transfer_department" id="transfer_department">
                          <option value=""></option>
                          <?php foreach($all_departments as $department) {?>
                          <option value="<?php echo $department->department_id?>"><?php echo $department->department_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

  <!-- transfer From Department -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_department_from">Transfer From (Department)</label>
                        <select class="select2" data-plugin="select_hrm" data-placeholder="Select Department..." name="transfer_department_from">
                          <option value=""></option>
                          <?php foreach($all_departments as $department) {?>
                          <option value="<?php echo $department->department_id?>"><?php echo $department->department_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                  </div>

<!-- designation -->

                  <div class="row">
<!-- transfer to Designation -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_designation_to">Transfer To (Designation)</label>
                        <select class="select2 designationData" data-plugin="select_hrm" data-placeholder="Select Department..." name="transfer_designation_to">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>

 <!-- transfer From Designation -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="transfer_designation_from">Transfer From (Designation)</label>
                        <select class="select2 designationData" data-plugin="select_hrm" data-placeholder="Select Department..." name="transfer_designation_from">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                 </div>
                

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control textarea" placeholder="Description" name="description" cols="30" rows="5" id="description"></textarea>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary save">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-block bg-white">
  <h2><strong>List All</strong> Promotions
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> Add New</button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table">
      <thead>
        <tr>
          <th>Action</th>
          <th>Employee Name</th>
          <th>Promotion Title</th>
          <th>Promotion Date</th>
          <th>Added By</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<script type="text/javascript">
   $("#transfer_department").change(function(){
        var ID = $(this).val();
        $.post('<?php echo base_url('transfers/getDesignation'); ?>', {
            id: ID
        }, function(response){
            var html = '<option value="">Select designation</option>';
            for( var i=0; i<response.data.length; i++) {
                html += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
            }
            $('.designationData').html(html);
        });


    });
</script>