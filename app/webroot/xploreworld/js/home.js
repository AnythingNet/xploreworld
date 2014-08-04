$(function(){

  $('.window').on('mouseover', function() {

    var cover = $(this).find('.cover');

    cover.removeClass('open').addClass('closed');

    console.log('close');

  });

  $('.window').on('mouseout', function() {

    var cover = $(this).find('.cover');

    cover.removeClass('closed').addClass('open');

    console.log('open');

  });

});
