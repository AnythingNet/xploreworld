$(function(){

	//$('#select-airports').select2();

	$('a.media-select').click(function(){

		var select_target = $(this).data('select-target');

		$('#select-target').val(select_target);

	});

	$('img.media-thumbnail').click(function(){

		var id = $(this).data('thumbnail-id');
		var path = $(this).data('thumbnail-path');

		var select_target = $('#select-target').val();

		console.log('select_target:'+select_target);
		console.log('id:'+id);
		console.log('path:'+path);

		$('#'+select_target+' .selected-image').attr({"src":path});
		$('#'+select_target+' .media-id').val(id);

		$('#close-popup').click();

	});

});
