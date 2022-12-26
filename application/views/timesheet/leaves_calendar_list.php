<link rel="stylesheet" type="text/css" href="<?=base_url('skin/vendor/zabuto_calendar/zabuto_calendar.min.css')?>">
<style type="text/css">
	div.zabuto_calendar .table tr td.dow-clickable {
		border: 1px solid #e1e1e1;
	}
	.color-box {
		display: table;
		width: 70%;
		margin: 0 auto;
	}
	.show-color-1, .show-color-2, .show-color-3  { 
		display: table-cell;
	}
	.show-color-1:before, .show-color-2:before, .show-color-3:before  { 
		content: '';
		background: #f59345;
		font-size: 10px;
		margin-right: 2px;
		display: none;
		border-radius: 50%;
		height: 10px;
		width: 10px;
		margin: 0 auto;
	}
	.show-color-2:before { 
		background: #43B967;   
	}	
	.show-color-3:before { 
    	background: #f44236;      
	}
	div.zabuto_calendar .badge-event, div.zabuto_calendar div.legend span.badge-event {
		background-color: transparent;
		color: #000;
		width: 100%;
		display: inline-block;
	}
	.color-1 .show-color-1:before, .color-2 .show-color-2:before, .color-3 .show-color-3:before {
		display: block;
	}
	.badge-pending {
		background-color: #f59345;
		border-radius: 50%;
	}
	.badge-approved {
		background-color: #43B967;
		border-radius: 50%;
	}
	.badge-rejected {
		background-color: #f44236;
		border-radius: 50%;
	}
</style>

<div id="my-calendar"></div>

<script type="application/javascript">
	$(document).ready(function () {

		var eventData = <?=json_encode($calendar_dates)?>;

		$("#my-calendar").zabuto_calendar({
			action: function () {
				$('#hrms_table')['dataTable']({
					"bDestroy":!0,
					"ajax":{
						url: site_url+'timesheet/date_wise_leave_detail/',
						type: 'GET',
						data: {leave_date: this.id.split('_')[3]},
					},
					"fnDrawCallback":function(d){
						$('[data-toggle="tooltip"]')['tooltip']()
					}
				});				
			},
			ajax: {
				url: site_url+'timesheet/leaves_calendar_list_next_prev',
			},
			nav_icon: {prev: '<i class="fa fa-chevron-left" aria-hidden="true"></i>', next: '<i class="fa fa-chevron-right" aria-hidden="true"></i>'},
            legend: [
                {type: "block", label: "Pending", classname: 'badge-pending'},
                {type: "block", label: "Approved", classname: 'badge-approved'},
                {type: "block", label: "Rejected", classname: 'badge-rejected'}
            ]
		});

	});
</script>


<script type="text/javascript" src="<?=base_url('skin/vendor/zabuto_calendar/zabuto_calendar.min.js')?>"></script>