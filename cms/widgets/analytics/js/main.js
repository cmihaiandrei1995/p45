$(document).ready(function(){
	
	$('.save_ga_widget_token').click(function(){
		val = $(this).parent().find('input.ga_widget_token').val();
		if(val != ""){
			ajax_url = $_base_cms + 'widgets/analytics/ajax/actions.php';

			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					token: val,
					action: 'save_token',
				},
				success: function(data) {
					location.reload();
				}
			});
		}else{
			(this).parent().find('input.ga_widget_token').focus();
		}
	});
	
	$('#ga_reset_account').click(function(e){
		e.preventDefault();
		
		ajax_url = $_base_cms + 'widgets/analytics/ajax/actions.php';

		$.ajax({
			type: 'POST',
			url: ajax_url,
			data: {
				action: 'reset_account',
			},
			success: function(data) {
				location.reload();
			}
		});
	});
	
	$('#ga_widget_account').change(function(){
		val_account = $(this).find('option:selected').val();
		if(val_account != ""){
			ajax_url = $_base_cms + 'widgets/analytics/ajax/actions.php';

			$.ajax({
				type: 'POST',
				url: ajax_url,
				dataType: 'json',
				data: {
					account: val_account,
					action: 'get_profiles',
				},
				success: function(data) {
					$('#ga_widget_profile').prop("disabled", false).find('option').remove();
					$('#ga_widget_profile').append(
				  		'<option value="">Alege profil</option>'
					);
					$.each(data, function(index, value) {
						$('#ga_widget_profile').append(
					  		'<option value="' + data[index].id + '">' + data[index].text + '</option>'
						);
					});
				}
			});
		}
	});
	
	$('#ga_widget_profile').change(function(){
		val_profile = $(this).find('option:selected').val();
		val_account = $('#ga_widget_account').find('option:selected').val();
		if(val_profile != "" && val_account != ""){
			ajax_url = $_base_cms + 'widgets/analytics/ajax/actions.php';

			$.ajax({
				type: 'POST',
				url: ajax_url,
				dataType: 'json',
				data: {
					account: val_account,
					profile: val_profile,
					action: 'get_views',
				},
				success: function(data) {
					$('#ga_widget_view').prop("disabled", false).find('option').remove();
					$('#ga_widget_view').append(
				  		'<option value="">Alege view</option>'
					);
					$.each(data, function(index, value) {
						$('#ga_widget_view').append(
					  		'<option value="' + data[index].id + '">' + data[index].text + '</option>'
						);
					});
				}
			});
		}
	});
	
	$('#ga_widget_view').change(function(){
		
		val_view = $(this).find('option:selected').val();
		val_profile = $('#ga_widget_profile').find('option:selected').val();
		val_account = $('#ga_widget_account').find('option:selected').val();
		
		if(val_view != "" && val_account != "" && val_profile != ""){
			$('#save_ga_widget_profile').prop("disabled", false);
		}
	});
	
	$('#save_ga_widget_profile').click(function(){
		val_view = $('#ga_widget_view').find('option:selected').val();
		val_profile = $('#ga_widget_profile').find('option:selected').val();
		val_account = $('#ga_widget_account').find('option:selected').val();
		
		if(val_view != "" && val_account != "" && val_profile != ""){
			ajax_url = $_base_cms + 'widgets/analytics/ajax/actions.php';

			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					account: val_account,
					profile: val_profile,
					view: val_view,
					action: 'save_profile',
				},
				success: function(data) {
					location.reload();
				}
			});
		}
	});
	
	
	$('.ga-data-change').change(function(){
		val_date = $('#ga_date').find('option:selected').val();
		val_metrics = $('#ga_metrics').find('option:selected').val();
		
		if(val_date != "" && val_metrics != ""){
			$('#ga-loading').fadeIn();
			$('#ga-results').fadeOut();
			
			ajax_url = $_base_cms + 'widgets/analytics/ajax/data.php';

			$.ajax({
				type: 'POST',
				url: ajax_url,
				dataType: 'json',
				data: {
					date: val_date,
					metrics: val_metrics
				},
				success: function(data) {
					
					$('#ga-data-sessions').html(data.sums.sessions);
					$('#ga-data-users').html(data.sums.users);
					$('#ga-data-hits').html(data.sums.hits);
					$('#ga-data-organic').html(data.sums.organic);
					$('#ga-data-bounce').html(data.sums.bounce);
					$('#ga-data-pages').html(data.sums.pages);
					
					var result = [];
					for(var i in data.values){
    					result.push([parseInt(i), data.values [i]]);
    				}
    				
    				switch(val_metrics){
    					case 'sessions' : text = ' vizite'; break;
						case 'users' : text = ' unici'; break;
						case 'pageviews' : text = ' afisari'; break;
						case 'organicSearches' : text = ' cautari'; break;
						case 'visitBounceRate' : text = '% bounce rate'; break;
    				}
    				
					ga_data = [{
					    data: result,
					    color: "#0088cc"
					}];
					
					$('#ga-loading').fadeOut();
					$('#ga-results').fadeIn();
					
					if(val_date == "today" || val_date == "yesterday"){
						timeformat = "%H:%M";
					}else{
						timeformat = "%d.%m.%Y";
					}
					
					$.plot('#ga-chart-data', ga_data, {
						series: {
							lines: {
								show: true,
								lineWidth: 2
							},
							points: {
								show: true
							},
							shadowSize: 1
						},
						grid: {
							hoverable: true,
							clickable: true,
							borderColor: 'rgba(0,0,0,0.1)',
							borderWidth: 1,
							labelMargin: 10,
							backgroundColor: 'transparent'
						},
						yaxis: {
							min: 0,
							color: 'rgba(0,0,0,0.1)'
						},
						xaxis: {
							mode: 'time',
							timeformat: timeformat,
							color: 'rgba(0,0,0,0)',
							font: {
							    size: 1,
							    lineHeight: 1,
							    color: "#ffffff"
							}
						},
						legend: {
							show: false
						},
						tooltip: true,
						tooltipOpts: {
							content: '%x: %y' + text,
							shifts: {
								x: -30,
								y: 25
							},
							defaultTheme: false
						}
					});
					
				}
			});
		}
	});
	$('#ga_date').change();
	
});
