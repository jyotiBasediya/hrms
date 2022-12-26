<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['benefit_id']) && $_GET['data']=='benefit'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Edit Benefit</h4>
</div>
<form class="m-b-1" action="<?php echo site_url("payroll/update_benefit").'/'.$benefit_id; ?>" method="post" name="update_benefit" id="update_benefit" autocomplete="off">
  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="_token" value="<?php echo $benefit_id;?>">
  <div class="modal-body">
    <div class="bg-white">
      <div class="box-block">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">                        
                  <label for="salary_grades">Benefit for employee</label>
                  <select id="employee_id" name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an Employee...">
                    <?php foreach($all_employees as $employee) {?>
                    <option value="<?php echo $employee->user_id;?>" <?= $employee_id == $employee->user_id ? 'selected' : '' ?>> <?php echo $employee->first_name.' '.$employee->last_name;?> (<?php echo $employee->username;?>)</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="benefit_type_id">Benefit Type</label>
                  <select id="benefit_type_id" name="benefit_type_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an Benefit Type...">
                    <?php foreach($benefit_types as $benefit_type) {?>
                    <option value="<?php echo $benefit_type->benefit_type_id;?>" <?= $benefit_type_id == $benefit_type->benefit_type_id ? 'selected' : '' ?>> <?php echo $benefit_type->benefit_type?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date">Start Date</label>
                  <input class="form-control" placeholder="Start Date" name="start_date" id="start_date2" type="text" readonly="true" value="<?=$start_date?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="end_date">End Date</label>
                  <input class="form-control" placeholder="End Date" name="end_date" id="end_date2" type="text" readonly="true" value="<?=$end_date?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="status">Status</label>
                  <select id="status" name="status" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an Status...">
                    <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Pending</option>
                    <option value="2" <?= $status == 2 ? 'selected' : '' ?>>Approved</option>
                    <option value="3" <?= $status == 3 ? 'selected' : '' ?>>Rejected</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input class="form-control" placeholder="Amount" name="amount" type="text" value="<?=$amount?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" placeholder="Description" name="description" rows="5"><?=$description?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/select2/dist/css/select2.min.css">
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

    $('#start_date2, #end_date2')['datepicker']({
      changeMonth:true,
      changeYear:true,
      dateFormat:'yy-mm-dd',
      yearRange: '1900:'+(new Date()['getFullYear']()+20)
    });
					
		// On page load: datatable
		var hrms_table = $('#hrms_table').dataTable({
			"bDestroy": true,
			"ajax": {
				url : "<?php echo site_url("payroll/benefits_list") ?>",
				type : 'GET'
			},
			"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
			}
    	});
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 

		/* Edit data */
		$("#update_benefit").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=benefit&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.save').prop('disabled', false);
					} else {
						hrms_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});	
	$(document).on("keyup", function () {
	var sum_total = 0;
	var deduction = 0;
	var net_salary = 0;
	var allowance = 0;
	$(".m_salary").each(function () {
		sum_total += +$(this).val();
	});
	
	$(".m_deduction").each(function () {
		deduction += +$(this).val();
	});
	
	$(".m_allowance").each(function () {
		allowance += +$(this).val();
	});
	
	$("#m_total").val(sum_total);
	$("#m_total_deduction").val(deduction);
	$("#m_total_allowance").val(allowance);
	
	var net_salary = sum_total - deduction;
	$("#m_net_salary").val(net_salary);
	});
  </script>
<?php } else if(isset($_GET['jd']) && isset($_GET['benefit_id']) && $_GET['data']=='view_benefit'){ ?>

<div class="modal-header animated fadeInRight">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Employee Benefit Detail</h4>
</div>
<div class="modal-body animated fadeInRight">
  <div class="row row-md">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-uppercase"><b><?php echo $employee_name;?></b></div>
        <div class="bg-white product-view">
          <div class="box-block">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="pv-content">
                  <div class="table-responsive" data-pattern="priority-columns">
                    <table class="table table-hover">
                      <tbody>
                        <tr>
                          <td><strong>Benefit Type</strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $benefit_type;?></td>
                        </tr>
                        <tr>
                          <td><strong>Start Date</strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $start_date;?></td>
                        </tr>
                        <tr>
                          <td><strong>End Date</strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $end_date;?></td>
                        </tr>
                        <tr>
                          <td><strong>Amount</strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $amount;?></td>
                        </tr>
                        <tr>
                          <td><strong>Status</strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $status;?></td>
                        </tr>
                        <tr>
                          <td><strong>Description</strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $description;?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
?>