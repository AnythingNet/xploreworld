$(function(){

	$('#select-airports').select2({
		placeholder: "Select Airport"
	});

	$('#select-countries').select2();

	$('#select-countries').change(function(){

		switchAirports('#select-countries');

	});

	switchAirports('#select-countries');

});

function switchAirports(selector) {

	var country = $(selector).val();
	var app_url = $(selector).data('app-url');

	var airport_id = $('#select-airports').val();

	var postData = {
		"country" : country,
		"airport_id" : airport_id
	};

	$.ajax({
		type: "POST",
		url: app_url,
		data: postData,
		success: function(response){
			$('#select-airports').empty().append(response);
		}
	});

}
