<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong>View Finance History</strong></h2>
  <form method="post" action="<?=site_url('finance/finance_history')?>">
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="finance_month">Month</label>
              <input type="text" name="finance_month" id="finance_month" class="form-control" placeholder="Month" value="<?=date('Y-m')?>" readonly>
            </div>    
          </div>
        </div>
        <button type="button" class="btn btn-primary show">Show</button>
      </div>
    </div>    
  </form>
</div>

<div class="box box-block bg-white Finance_detail">
  <div class="row">
    <div class="col-md-12">
      <h2>Finance Detail For <strong id="finance-detail-month"><?='Aug 2017'?></strong></h2>
    </div>
    <div class="finance_details_cell">
      <h6>Project's Credit</h6>
      <h3 id="project-amount">0$</h3>
    </div>
    <div class="finance_details_cell">
      <h6>Salary Paid</h6>
      <h3 id="salary-amount">0$</h3>
    </div>
    <div class="finance_details_cell">
      <h6>Employee Benefit</h6>
      <h3 id="benefit-amount">0$</h3>
    </div>
    <div class="finance_details_cell">
      <h6>Travel Expenses</h6>
      <h3 id="travel-amount">0$</h3>
    </div>
    <div class="finance_details_cell">
      <h6>Award Given</h6>
      <h3 id="award-amount">0$</h3>
    </div>
    <div class="finance_details_cell">
      <h6>Profit/Loss</h6>
      <h3 id="pnl-amount">0$</h3>
    </div>
  </div>
</div>

<div class="box box-block bg-white">
  <div class="row">
    <div class="col-md-12">
      <h2><strong>Profit/Loss</strong></h2>
    </div>
    <canvas id="barChart" style="height:230px"></canvas>
  </div>
</div>

<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>

<script type="text/javascript">
  var values = <?=json_encode($pnlGraphData)?>;
</script>