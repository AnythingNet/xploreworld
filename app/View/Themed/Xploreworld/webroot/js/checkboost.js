$.fn.checkboost = function() {

  var toggleButton = function() {

    if ($(this).hasClass('btn-primary')) {
      $(this).siblings('input[type="radio"]').attr('checked', false);
    } else {
      $('.seat-radio').prop('checked', false);
      $(this).siblings('input[type="radio"]').prop('checked', true);
    }

    $('.seat-radio').each(function() {

      if ($(this).is(':checked')) {
        $(this).siblings('.btn-primary').show();
        $(this).siblings('.btn-default').hide();
      } else {
        $(this).siblings('.btn-primary').hide();
        $(this).siblings('.btn-default').show();
      }

    });

  }

  var toggleButtonFromRadio = function() {

    $('.btn-primary').hide();
    $('.btn-default').show();

    if ($(this).is(':checked')) {
      $(this).siblings('.btn-primary').show();
      $(this).siblings('.btn-default').hide();
    } else {
      $(this).siblings('.btn-primary').hide();
      $(this).siblings('.btn-default').show();
    }

  }

  var replaceChecks = function() {

    $(this).css('display', 'none');

    var checked = $(this).attr('checked');
    $(this).on('change', toggleButtonFromRadio);

    var cross = $('<span>').addClass('glyphicon');
    var check = $('<span>').addClass('glyphicon glyphicon-ok');

    var button_crossed = $('<button>').addClass('btn btn-default checkboost').append(cross).on('click', toggleButton);
    var button_checked = $('<button>').addClass('btn btn-primary checkboost').append(check).on('click', toggleButton);

    if (checked) {
      button_checked.show();
      button_crossed.hide();
    } else {
      button_checked.hide();
      button_crossed.show();
    }

    $(this).after(button_crossed);
    $(this).after(button_checked);

  }

  this.each(replaceChecks);

}
