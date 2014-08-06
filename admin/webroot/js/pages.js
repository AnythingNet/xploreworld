$(function(){

  var imageoption_refresh = function() {

    var selected_options = $('#img-selectmodal .image-option:checked');

    selected_options.each(function(){

      $(this).attr('checked', false);

    });

    $('#image-select').attr('disabled', true);

  }

  $('#img-selectmodal').bind('hidden.bs.modal', imageoption_refresh);

  $('.image-option').bind('click', function(){

    var selected_count = $('#img-selectmodal .image-option:checked').length;

    if (selected_count > 0) {
      $('#image-select').attr('disabled', false);
    } else {
      $('#image-select').attr('disabled', true);
    }

  });

  $('#image-select').bind('click', function(){

    $('.image-optiongroup').each(function(i, data){

      if ($(this).find('.image-option').is(':checked')) {

        var image = $(this).find('img').clone();
        var imageobj_index = 0;

        var code = $('#editor').code() + image[imageobj_index].outerHTML;
        $('#editor').code(code);
        
      }

      $('#img-selectmodal').modal('hide');
      
    });

  });

});
