window.width_md = 1200;
window.width_sm = 992;
window.width_xs = 768;

$(function(){

  $('.window').on('mouseover', function() {

    if (window.outerWidth > window.width_sm) {

      var cover = $(this).find('.cover');
      var text = $(this).find('.cover-text-inner');

      cover.removeClass('open').addClass('closed');
      text.removeClass('hidden').addClass('show');

    }

  });

  $('.window').on('mouseout', function() {

    if (window.outerWidth > window.width_sm) {

      var cover = $(this).find('.cover');
      var text = $(this).find('.cover-text-inner');

      cover.removeClass('closed').addClass('open');
      text.removeClass('show').addClass('hidden');

    }

  });

});
