<?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
<!-- partial -->
<script type="text/javascript" src="jquery-1.4.2.min" ></script>
      <script type="text/javascript" src="weekly.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <div class="d-flex justify-content-between w-100">
            <h3 class="page-title">My Tasks </h3>
            <div class="d-flex float-right">
               <!-- <button type="submit">Save</button> -->
               <!--  -->
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <!-- <div class="card-body"> -->
               <div class="row align-items-center">
                  <div class="col-sm-6">
                     <div class="row">
                     </div>
                  </div>
               </div>
                <?php
                  (int)$currentpage = (!empty($_GET["currentpage"]))?$_GET["currentpage"]:0;
                  (int)$nextpage = $currentpage + 1;
                  (int)$prevpage = $currentpage - 1;

                    $ts = date(strtotime('last sunday'));
                    $ts += $currentpage * 86400 * 7;
                    $dow = date('w' , $ts);
                    $offset = $dow;
                    $ts = $ts - $offset * 86400;



                  
                ?>
               <!-- </div> -->  
               <table border="1" width="98%" align="center" class="table table-hover mt-4 text-center">
                  <tr>
                     <!-- <td><label class="logintext">Monday,February 01, 2021&nbsp;<b>to</b>&nbsp; Sunday,February 07, 2021</label></td> -->
                     <td>Time Sheet</label></td>
                  </tr>
                  <tr>
                     <td>
                        <table border="1" width="100%" align="center" cellpadding="5" cellspacing="5" id="myTable" class="table table-hover mt-4 text-center">
                           <form name="frmProjectStatus" action="<?php echo base_url('NewTimesheet/addNewTimeSheet')?>" method="post">
                              <input id="employeeid" name="employeeid" type="hidden" value="<??>"/>
                              <tr class="buttonrows">
                                 <td align="right" colspan="10">
                                    <a href="<?php echo "{$_SERVER['PHP_SELF']}?currentpage=$prevpage"; ?>"><< Previous</a>
                                    <a href="<?php echo base_url().'task/my_task'; ?>">Current</a>
                                    <a href="<?php echo "{$_SERVER['PHP_SELF']}?currentpage=$nextpage"; ?>">Next >>
                                    </a>
                                 </td>
                              </tr>
                              <tr class="headerStyle">
                                 <td><b>Task Name</b></td>
                                 <?php
                                    
                                    
                                    $ts = $ts - $offset * 86400;
                                    for ($x=0 ; $x<7 ; $x++,$ts += 86400) {
                                        echo '<td>'.date("l", $ts).'<br>' . date("d-m-Y", $ts) . '</td>' ;
                                    }
                                ?>
                                 <td>Total Time</td>
                                 <td>Status</td>
                              </tr>
                              <input name="totalrows" value="6" type="hidden"/>
                              <input name="totalrows" value="6" type="hidden"/>
                                
                                <?php 
                                    $a=0;
                                    
                                    $sum_day=0;

                                    $sum=array();
                                    $a=$a+1;

                                    for ($i=1; $i <= 5; $i++) { ?>
                                    <tr>
                                        <td class="prj_nam_cls">

                                           <select class="form-control" placeholder="Client Name" name="task_id[]" id="task_id">

                                      <option value="">Select Company Name</option>
                                      
                                    <?php foreach($data as $row) {?>
                                        <option  value="<?php echo $row['task_id']?>">
                                                     <?php echo $row['task_name']?></option>
                                                       <?php } ?>
                                                          </select>  

                                           <!--  <input type="hidden" readonly="true" name="company_id" class="prj_nam_cls"  value="" />
                                            <input type="hidden" readonly="true" name="cost" class="prj_nam_cls"  value="" />
                                            <input type="hidden" readonly="true" name="projectname[]" class="prj_nam_cls"  value="" /> -->
                                            <!-- <input type="hidden" readonly="true" name="task_id[]" class="prj_nam_cls"  value="<?php echo $v['task_id']?>" /> -->
                                        </td>
                                        <?php
                                            $y=0;

                                            $yts = date(strtotime('last sunday'));
                                            $yts += $currentpage * 86400 * 7;
                                            $dow = date('w' , $yts);
                                            $offset = $dow;
                                            
                                            $yts = $yts - $offset * 86400;

                                            for ($y; $y<7 ; $y++,$yts += 86400) {

                                                    $date = date("d-m-Y", $yts);
                                                    $allDate = strtotime($date);
                                                    $currentDate = strtotime("now");
                                                    $yw = date("l", $yts);

                                                    // $created =   date("d-m-Y", strtotime($v['created_at']));
                                                    // $task_create = strtotime($created);
                                                ?>
                                                <td>
                                                   <input type="hidden" name="date[]" value="<?php echo date("d-m-Y", $yts);?>" class="task_date_<?php echo $i;?>">

                                                  <input type="number" name="hour[]" value="0" placeholder="Hour" class="form-control task_hours_<?php echo $i;?> <?php echo $yw;?>" onblur="getHour(this.value,'<?php echo $i;?>','<?php echo date('d-m-Y', $yts);?>)')">
                                                </td>    
                                           <?php }  ?>          
                                        <td>
                                          <input id="tasktTotalHoure_<?php echo $i;?>"  type="text" name="total_hour[]" value="0" placeholder="Total Hour" class="form-control totalHour">


                                        </td>
                                        <td></td>
                                        
                                    </tr>
                                <?php } ?>
                              

                              <tr class="footerstyle">
                                 <td>Week Total </td>
                                 <td align="center"><span name=".sun" class="total_time_sun">0</span></td>
                                 <td align="center"><span name=".mon" class="total_time_mon" >0</span></td>
                                 <td align="center"><span name=".tue"  class="total_time_tue">0</span></td>
                                 <td align="center"><span name=".wed" class="total_time_wed">0</span></td>
                                 <td align="center"><span name=".thu" class="total_time_thu">0</span></td>
                                 <td align="center"><span name=".fri" class="total_time_fri">0</span></td>
                                 <td align="center"><span name=".sat" class="total_time_sat">0</span></td>
                                 <td align="center" class="totalhrsspent"><span name="totalhours" class="total_time_dis">0</span></td>
                                 <td align="center"></td>
                              </tr>
                              <tr class="buttonrows">
                                 <td align="center" colspan="3" > </td>
                                 <td align="center"  colspan="3"></td>
                                 <td align="center" colspan="3" ><input type="submit" title="contact admin for editing timesheet"  class="" name="submit_time" value="Submit Time status"> </td>
                                 <td align="center" colspan="3" ></td>
                              </tr>
                           </form>
                        </table>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content-wrapper ends -->
<!-- footer -->
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- js -->
<script type="text/javascript">
   $(document).ready(function() {
     $('#example').DataTable( {
         dom: 'Bfrtip',
         buttons: [
                 {
                     extend: 'pdfHtml5',
                     orientation: 'landscape',
                     pageSize: 'LEGAL',
                     columns: ':visible',
                     exportOptions: {                    
                         columns: [0,1,2,3,4]                
                     },
   
                 },
                 {
                     extend: 'excel',
                     orientation: 'landscape',
                     pageSize: 'LEGAL',
                     columns: ':visible',
                      exportOptions: {                    
                         columns: [0,1,2,3,4]                
                     },
                  },
                 {
                     extend: 'print',
                     orientation: 'landscape',
                     pageSize: 'LEGAL',
                     columns: ':visible',
                      exportOptions: {                    
                         columns: [0,1,2,3,4]                
                     },
                  },
   
             ],
     });
   });
</script>
<script type="text/javascript">

    function getHour(hour,id,taskDate)
    {
      console.log(id);


    //-----------------Total Hour----------------
        var total_task_hours = 0;
        $(".task_hours_"+id).each(function () 
        {
          console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                total_task_hours += parseFloat(this.value);
            }
        });        
        $("#tasktTotalHoure_"+id).val(total_task_hours.toFixed(2));

        //-----------------Sunday Week----------------
        var sunday_sum = 0;
        $(".Sunday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                // var total_time_sun = sunday_sum + this.value;

                sunday_sum += parseFloat(this.value);
            }
        });
        $(".total_time_sun").html(sunday_sum.toFixed(2));

    //-----------------Monday Week----------------
        var monday_sum = 0;
        $(".Monday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                monday_sum += parseFloat(this.value);
            }
        });
        $(".total_time_mon").html(monday_sum.toFixed(2));
    //-----------------Tuesday Week----------------
        var tue_sum = 0;
        $(".Tuesday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_tue").html(tue_sum.toFixed(2));
    //-----------------Wednesday Week----------------
        var tue_sum = 0;
        $(".Wednesday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_wed").html(tue_sum.toFixed(2));
    //-----------------Thursday Week----------------
        var tue_sum = 0;
        $(".Thursday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_thu").html(tue_sum.toFixed(2));
    //-----------------Friday Week----------------
        var tue_sum = 0;
        $(".Friday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_fri").html(tue_sum.toFixed(2));
    //-----------------Saturday Week----------------
        var tue_sum = 0;
        $(".Saturday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_sat").html(tue_sum.toFixed(2));
    //-----------------Full Total ----------------
        var tue_sum = 0;
        $(".totalHour").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_dis").html(tue_sum.toFixed(2));
        
    }

    //-----------------Sunday Week----------------
        var sunday_sum = 0;
        $(".Sunday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                // var total_time_sun = sunday_sum + this.value;

                sunday_sum += parseFloat(this.value);
            }
        });
        $(".total_time_sun").html(sunday_sum.toFixed(2));

    //-----------------Monday Week----------------
        var monday_sum = 0;
        $(".Monday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                monday_sum += parseFloat(this.value);
            }
        });
        $(".total_time_mon").html(monday_sum.toFixed(2));
    //-----------------Tuesday Week----------------
        var tue_sum = 0;
        $(".Tuesday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_tue").html(tue_sum.toFixed(2));
    //-----------------Wednesday Week----------------
        var tue_sum = 0;
        $(".Wednesday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_wed").html(tue_sum.toFixed(2));
    //-----------------Thursday Week----------------
        var tue_sum = 0;
        $(".Thursday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_thu").html(tue_sum.toFixed(2));
    //-----------------Friday Week----------------
        var tue_sum = 0;
        $(".Friday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_fri").html(tue_sum.toFixed(2));
    //-----------------Saturday Week----------------
        var tue_sum = 0;
        $(".Saturday").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_sat").html(tue_sum.toFixed(2));
    //-----------------Full Total ----------------
        var tue_sum = 0;
        $(".totalHour").each(function () 
        {
            // console.log(this.value);
            if (!isNaN(this.value) && this.value.length != 0) 
            {
                
                tue_sum += parseFloat(this.value);
            }
        });
        $(".total_time_dis").html(tue_sum.toFixed(2));

        

</script>