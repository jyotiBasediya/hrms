$(document).ready(function(){

	$(document).on('click', '.show', function(){

		$.ajax({
			url: base_url+'/finance_history/',
			method: 'POST',
			data: {finance_month: $('#finance_month').val()},
			success: function(response){
				
				response = jQuery.parseJSON(response);

				$('#project-amount').text(response.project);
				$('#salary-amount').text(response.salary);
				$('#benefit-amount').text(response.benefit);
				$('#travel-amount').text(response.travel);
				$('#award-amount').text(response.award);
				$('#pnl-amount').text(response.pnl);
				$('#finance-detail-month').text(response.month);

				pnl = parseFloat(response.pnl);
				
				if(pnl > 0){
					$('#pnl-amount').closest('div').addClass('text-success');
				} else {
					$('#pnl-amount').parent('div').addClass('text-danger');
				}

			}
		});

	});

	$('.show').trigger( "click" );

	$('#finance_month')['datepicker']({
		changeMonth:true,
		changeYear:true,
		showButtonPanel:true,
		dateFormat:'yy-mm',
		yearRange:'1900:'+ ( new Date()['getFullYear']()+ 15),
		beforeShow:function(m){
			$(m)['datepicker']('widget')['addClass']('hide-calendar')
		},
		onClose:function(n,o){
			var p=$('#ui-datepicker-div .ui-datepicker-month :selected')['val']();
			var q=$('#ui-datepicker-div .ui-datepicker-year :selected')['val']();
			$(this)['datepicker']('setDate', new Date(q,p,1));
			$(this)['datepicker']('widget')['removeClass']('hide-calendar');
			$(this)['datepicker']('widget')['hide']()
		}
	});

	var areaChartData = {
		labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octomber', 'November', 'December'],
		datasets: [
			{
				label				: 'Electronics',
				fillColor			: 'rgba(210, 214, 222, 1)',
				strokeColor			: 'rgba(210, 214, 222, 1)',
				pointColor			: 'rgba(210, 214, 222, 1)',
				pointStrokeColor	: '#c1c7d1',
				pointHighlightFill	: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data 				: values
			}
		]
	}

	var barChartCanvas					= $('#barChart').get(0).getContext('2d')
	var barChart 						= new Chart(barChartCanvas)
	var barChartData					= areaChartData
	barChartData.datasets[0].fillColor	= '#2585ff'
	barChartData.datasets[0].strokeColor= '#b8d524'
	var barChartOptions					= {
		scaleBeginAtZero		: false,
		scaleShowGridLines		: true,
		scaleGridLineColor		: 'rgba(0,0,0,.05)',
		scaleGridLineWidth		: 1,
		scaleShowHorizontalLines: true,
		scaleShowVerticalLines	: true,
		barShowStroke			: true,
		barStrokeWidth			: 2,
		barValueSpacing			: 15,
		barDatasetSpacing		: 1,
		legendTemplate			: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		responsive				: true,
		maintainAspectRatio		: true
	}

	console.log(barChart);

	barChartOptions.datasetFill = false
	barChart.Bar(barChartData, barChartOptions)

});