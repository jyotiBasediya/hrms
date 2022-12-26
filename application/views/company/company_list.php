<?php
/* Company view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="add-form" style="display:none;">
  <div class="box box-block bg-white">
    <h2><strong><?php echo $this->lang->line('hrms_add_new');?></strong> <?php echo $this->lang->line('module_company_title');?>
      <div class="add-record-btn">
        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> <?php echo $this->lang->line('hrms_hide');?></button>
      </div>
    </h2>
    <div class="row m-b-1">
      <div class="col-md-12">
        <form action="<?php echo site_url("company/add_company") ?>" method="post" name="add_company" id="xin-form" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
        <div class="bg-white">
          <div class="box-block">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="company_name"><?php echo $this->lang->line('hrms_company_name');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_company_name');?>" name="name" type="text">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="email"><?php echo $this->lang->line('hrms_company_type');?></label>
                      <select class="form-control" name="company_type" data-plugin="hrms_select" data-placeholder="<?php echo $this->lang->line('hrms_company_type');?>">
                        <option value=""><?php echo $this->lang->line('hrms_select_one');?></option>
                        <?php foreach($get_company_types as $ctype) {?>
                        <option value="<?php echo $ctype->type_id;?>"> <?php echo $ctype->name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="trading_name"><?php echo $this->lang->line('hrms_company_trading');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_company_trading');?>" name="trading_name" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="registration_no"><?php echo $this->lang->line('hrms_company_registration');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_company_registration');?>" name="registration_no" type="text">
                    </div>
                    <div class="col-md-6">
                      <label for="contact_number"><?php echo $this->lang->line('hrms_contact_number');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_contact_number');?>" name="contact_number" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="email"><?php echo $this->lang->line('hrms_email');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_email');?>" name="email" type="email">
                    </div>
                    <div class="col-md-6">
                      <label for="website"><?php echo $this->lang->line('hrms_website');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_website_url');?>" name="website" type="text">
                    </div>
                  </div>
                </div>
                 <!-- compny Hr Details ****-->
 <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="epassword"><?php echo $this->lang->line('hrms_employee_password');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_employee_password');?>" name="epassword" type="password">
                    </div>
                    <div class="col-md-6">
                      <label for="fname"><?php echo $this->lang->line('hrms_employee_first_name');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_employee_first_name');?>" name="fname" type="text">
                    </div>
                  </div>
                </div>
<!-- end compnay Hr Details -->
               
                <div class="form-group">
                    <h6><?php echo $this->lang->line('hrms_company_logo');?></h6>
                    <span class="btn btn-primary btn-file">
                    	Browse <input type="file" name="logo" id="logo">
                    </span>
                    <br>
                    <small><?php echo $this->lang->line('hrms_company_file_type');?></small> </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="hrms_gtax"><?php echo $this->lang->line('hrms_gtax');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_gtax');?>" name="hrms_gtax" type="text">
                </div>
                <div class="form-group">
                  <label for="address"><?php echo $this->lang->line('hrms_address');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_address_1');?>" name="address_1" type="text">
                  <br>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_address_2');?>" name="address_2" type="text">
                  <br>
                  <div class="row">
                    <div class="col-xs-5">
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_city');?>" name="city" type="text">
                    </div>
                    <div class="col-xs-4">
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_state');?>" name="state" type="text">
                    </div>
                    <div class="col-xs-3">
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_zipcode');?>" name="zipcode" type="text">
                    </div>
                  </div>
                  <br>
                  <select class="form-control" name="country" data-plugin="hrms_select" data-placeholder="<?php echo $this->lang->line('hrms_country');?>">
                    <option value=""><?php echo $this->lang->line('hrms_select_country');?></option>
                    <?php foreach($all_countries as $country) {?>
                    <option value="<?php echo $country->country_id;?>"> <?php echo $country->country_name;?></option>
                    <?php } ?>
                  </select>

  <!-- compny Hr Details ****-->
 <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="lname"><?php echo $this->lang->line('hrms_employee_last_name');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('hrms_employee_last_name');?>" name="lname" type="text">
                    </div>
                    <div class="col-md-6">
                      <label for="username"><?php echo $this->lang->line('dashboard_username');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_username');?>" name="username" type="text">
                    </div>
                  </div>
                </div>
<!-- end compnay Hr Details -->

                </div>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('hrms_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-block bg-white">
  <h2><strong><?php echo $this->lang->line('hrms_list_all');?></strong> <?php echo $this->lang->line('hrms_companies');?>
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('hrms_add_new');?></button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('hrms_action');?></th>
          <th><?php echo $this->lang->line('module_company_title');?></th>
          <th><?php echo $this->lang->line('hrms_email');?></th>
          <th><?php echo $this->lang->line('hrms_website');?></th>
          <th><?php echo $this->lang->line('hrms_city');?></th>
          <th><?php echo $this->lang->line('hrms_country');?></th>
          <th><?php echo $this->lang->line('hrms_added_by');?></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
