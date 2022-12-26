$(document).ready(function(){

	var a = $('#hrms_table')['dataTable']({
		"bDestroy": true,
		"ajax": {
			url: site_url+ 'performance/appraisal_applications_list',
			type: "GET"
		},
		"fnDrawCallback": function(b) {
			$('[data-toggle="tooltip"]')['tooltip']();
		}
	});

	$(document)['on']('click','.delete',function(){
		$('input[name=_token]')['val']($(this)['data']('record-id'));
		$('#delete_record')['attr']('action',site_url+ 'performance/delete_performance_application/'+ $(this)['data']('record-id'))
	});

	$('#delete_record')['submit'](function(d){
		d['preventDefault']();
		var f=$(this),
		c=f['attr']('name');
		$['ajax']({
			type:'POST',
			url:d['target']['action'],
			data:f['serialize']()+ '&is_ajax=2&type=delete&form='+ c,
			cache:false,
			success:function(g){
				if(g['error']!= ''){
					toastr['error'](g['error'])
				}else {
					$('.delete-modal')['modal']('toggle');
					a['api']()['ajax']['reload'](function(){
						toastr['success'](g['result'])}
						,true)
				}
			}
		})
	});

});