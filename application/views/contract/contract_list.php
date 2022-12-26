<?php
/* Employees view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="add-form" style="display:none;">
  <div class="box box-block bg-white">
    <h2><strong><?php echo $this->lang->line('hrms_add_new');?></strong> <?php echo $this->lang->line('contract_type');?>
      <div class="add-record-btn">
        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> <?php echo $this->lang->line('hrms_hide');?></button>
      </div>
    </h2>
    <div class="row m-b-1">
      <div class="col-md-12">
        <form action="<?php echo site_url("contract_type/add_contract") ?>" method="post" name="add_contract" id="xin-form">
          <input type="hidden" name="_user" value="<?php echo $session['user_id'];?>">
          <div class="bg-white">
            <div class="box-block">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="contract_type"><?php echo $this->lang->line('contract_type');?></label>
                        <input required="true" class="form-control" placeholder="<?php echo $this->lang->line('contract_type');?>" name="contract_type" type="text" value="">
                      </div>
                    </div>
                  </div>
                  
                </div>
                
              </div>
              <button style="float: right;" type="submit" class="btn btn-primary save"><?php echo $this->lang->line('hrms_save');?></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-block bg-white">
  <h2><strong><?php echo $this->lang->line('hrms_list_all');?></strong> <?php echo $this->lang->line('hrms_employees');?>
    <div class="add-record-btn">
      <a href="<?=site_url('employees/export')?>"><button class="btn btn-sm btn-primary"><i class="fa fa-database icon"></i> <?php echo $this->lang->line('hrms_employees_export');?></button></a>
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('hrms_add_new');?></button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('hrms_action');?></th>
          <th><?php echo $this->lang->line('hrms_contract_type_id');?></th>
          <th><?php echo $this->lang->line('contract_type');?></th>
        </tr>
      </thead>
      <tbody>
      <?php
      $i = 1;
            foreach ($contarct_list as $key => $contarctList) 
            {
            
      ?>
        <tr>
          <td>
<span data-toggle="tooltip" data-placement="top" title="<?=$this->lang->line('hrms_update')?>">
          <a href="javascript:void(0);" onclick="setContractUpdate('<?=$contarctList->contract_type_id?>','<?=$contarctList->name?>')" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" ><i class="fa fa-pencil"></i></a></span>
          <span data-toggle="tooltip" data-placement="top" title="<?=$this->lang->line('hrms_delete')?>">
          <a href="javascript:void(0);" onclick="setContractDelete('<?=$contarctList->contract_type_id?>')" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light" ><i class="fa fa-trash-o"></i></a>
          </span></td>
          <td><?=$i?></td>
          <td><?=$contarctList->name?></td>
        </tr>
        <?php
        $i++;
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
  
</script>