<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['faq_id']) && $_GET['data']=='faq'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('hrms_edit_faq');?></h4>
</div>
<form class="m-b-1" action="<?php echo site_url("faq/update").'/'.$faq_id; ?>" method="post" name="edit_faq" id="edit_faq">
  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="_token" value="<?php echo $faq_id;?>">
  <input type="hidden" name="ext_name" value="<?php echo $title;?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="company"><?php echo $this->lang->line('module_company_title');?></label>
      <select class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('hrms_select_company');?>..." name="company">
        <option value="0"><?php echo $this->lang->line('hrms_all_companies');?></option>
        <?php foreach($all_companies as $company) {?>
        <option value="<?php echo $company->company_id;?>" <?php if($company_id==$company->company_id):?> selected="selected" <?php endif;?>> <?php echo $company->name;?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Question</label>
      <input type="text" class="form-control" name="title" placeholder="Question" value="<?php echo $title;?>">
    </div>
    <div class="form-group">
      <label for="message">Answer</label>
      <textarea class="form-control" placeholder="Answer" name="description" id="description2"><?php echo $description;?></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('hrms_close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('hrms_update');?></button>
  </div>
</form>
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/select2/dist/css/select2.min.css">
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script> 
<script type="text/javascript">
 $(document).ready(function(){
					
		// On page load: datatable
		var hrms_table = $('#hrms_table').dataTable({
        "bDestroy": true,
		"ajax": {
            url : "<?php echo site_url("faq/faq_list") ?>",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
    });
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	
    
		$('.note-children-container').hide();

		/* Edit data */
		$("#edit_faq").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=faq&form="+action,
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
  </script>
<?php } else if(isset($_GET['jd']) && isset($_GET['faq_id']) && $_GET['data']=='view_faq'){ ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('hrms_view_faq');?></h4>
</div>
<form class="m-b-1">
  <div class="modal-body">
    <div class="form-group">
      <label for="company"><?php echo $this->lang->line('module_company_title');?></label>
      <input class="form-control" readonly="readonly" style="border:0" type="text" value="<?php foreach($all_companies as $company) {?><?php if($company_id==$company->company_id):?><?php echo $company->name;?><?php endif;?><?php } ?>">
    </div>
    <div class="form-group">
      <label for="title">Question</label>
      <input type="text" class="form-control" readonly="readonly" style="border:0" value="<?php echo $title;?>">
    </div>
    <div class="form-group">
      <label for="message">Answer</label>
      <br />
      <?php echo html_entity_decode($description);?> </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('hrms_close');?></button>
  </div>
</form>
<?php }
?>
