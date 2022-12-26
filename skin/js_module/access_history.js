$(document).ready(function(){

	var table = $('#hrms_table')['dataTable']({
		"bDestroy": true,
		"ajax": {
			url: site_url+ 'access_history/history_list',
			type: "GET",
			data: function ( d ) {
				d.form = $('#hrms-form').serializeArray();
			}
		},
		"fnDrawCallback": function(b) {
			$('[data-toggle="tooltip"]')['tooltip']();
		}
	});

	$(document).on('click', '.show-history', function(){

		table.api().ajax.reload(function(){
			toastr['success']('Data fetched')}
		,true);

	});

	$('[data-plugin="select_hrm"]').select2();

	$('.datepicker').datepicker({
		uiLibrary: 'bootstrap',
		dateFormat:'yy-mm-dd'
	});

});