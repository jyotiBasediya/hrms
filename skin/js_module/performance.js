$(document).ready(function(){

	$('#hrms_table')['dataTable']({
		"bDestroy": true,
		"ajax": {
			url: site_url+ 'performance/performance_list',
			type: "GET"
		},
		"fnDrawCallback": function(b) {
			$('[data-toggle="tooltip"]')['tooltip']();
		}
	});

});