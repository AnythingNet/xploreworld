$(function(){


  //define selecter for the active tab
  var active_tag_selector = '#menu-header';

  $('.tab-toggler').bind('show.bs.tab', function(){
    active_tag_selector = $(this).attr('href');
  });

  //set body as droppable to delete menu tag when dragged out
  $('body').droppable({
    drop: function(e, ui) {
      ui.draggable.remove();
    }
  });

  //set greedy to true to prevent menu tag from being deleted within sortable area

  var droppable_options = {greedy: true};

  var sortable_options_group = {
    items: '.menutag-group',
    update: function(e, ui) {
    }
  };

  var sortable_options_tag = {
    items: '.menutag',
    connectWith: '.menutag-group',
    update: function(e, ui) {
      $('.menutag-group').each(function(){
        var children_num = $(this).find('.menutag').length;
        if (children_num == 0) {
          $(this).remove();
        }
      });
    }
  };

  $('#menu-header')
      .droppable(droppable_options)
      .sortable(sortable_options_group);

  $('#menu-footer')
      .droppable(droppable_options)
      .sortable(sortable_options_group);

  $('.menutag-group')
      .droppable(droppable_options)
      .sortable(sortable_options_tag);

  var validate_input = function(input) {

    var result = false;

    if (input != '') {
      result = true;
    }

    return result;

  }

  var create_menu_text = function(label, url) {

    var result = '';

    if (!url.match(/^http+s?:\/\/+/i)) {
      url = '/' + url + '/';
    }
    
    result = label + ' - ' + url;
    return result;

  }

  var create_new = function(label, url, tag_selector) {

    var tag_text = create_menu_text(label, url);

    var menu_tag = $('<div>')
          .addClass('bg-primary menutag')
          .attr('data-label', label)
          .attr('data-url', url)
          .text(tag_text);

    var menu_taggroup = $('<div>')
          .addClass('menutag-group');

    menu_tag.appendTo(menu_taggroup)
    //menu_taggroup.appendTo(tag_selector);
    //$(tag_selector+' .btn.save').before(menu_taggroup);
    $(tag_selector).append(menu_taggroup);
    //refresh sortable 
    $('.menutag-group').sortable(sortable_options_tag);

  }

  /* custom menu */

  var custommenu_show_invalid = function() {
    $('#menu-custom-panel').addClass('panel-danger');
    $('#menu-custom-panel .panel-heading-text').text('Please enter all items.');
  }

  var custommenu_refresh = function() {

    $('#menu-custom-panel')
        .removeClass('panel-danger')
        .addClass('panel-default');

    $('#menu-custom-panel .panel-heading-text').text('Add Custom Menu');

    $('#menu-custom-label input').val('');
    $('#menu-custom-url input').val('');

  }

  $('#menu-custom-button input').bind('click', function(){

    var label = $('#menu-custom-label input').val();
    var url = $('#menu-custom-url input').val();

    if (!validate_input(label) || !validate_input(url)) {

      custommenu_show_invalid();
      
    } else {

      create_new(label, url, active_tag_selector);
      custommenu_refresh();

    }

  });

  /* add from menu */

  var pagemenu_refresh = function() {

    var selected_options = $('#menu-page-selectmodal .menu-page-option:checked');

    selected_options.each(function(){

      $(this).attr('checked', false);

    });

    $('#menu-page-select').attr('disabled', true);

  }

  $('.menu-page-option').bind('click', function(){

    var selected_count = $('#menu-page-selectmodal .menu-page-option:checked').length;

    if (selected_count > 0) {
      $('#menu-page-select').attr('disabled', false);
    } else {
      $('#menu-page-select').attr('disabled', true);
    }

  });
  
  $('#menu-page-select').bind('click', function(){

    $('.menu-page-optiongroup').each(function(i, data){

      if ($(this).find('.menu-page-option').is(':checked')) {

        var option_label = $(this).find('.menu-page-optionlabel').attr('data-label');
        var option_value = $(this).find('.menu-page-optionlabel').attr('data-url');

        console.log(option_label);
        console.log(option_value);

        create_new(option_label, option_value, active_tag_selector);

      }

      $('#menu-page-selectmodal').modal('hide');
      
    });

  });

  $('#menu-page-selectmodal').bind('hidden.bs.modal', pagemenu_refresh);

  /* add parameters to the form */

  var create_formvalues = function() {

    var menu_sections = $('.menu-section-pane');

    for (var i = 0; i < menu_sections.length; i++) {

      var section = $(menu_sections[i]);
      var section_id = section.attr('data-section-id');
      var menu_groups = section.find('.menutag-group');

      for (var group_id = 0; group_id < menu_groups.length; group_id++) {

        var menu_group = $(menu_groups[group_id]);
        var menu_items = menu_group.find('.menutag');

        for (var order = 0; order < menu_items.length; order++) {
          
          var item = $(menu_items[order]);
          var label = item.attr('data-label');
          var url = item.attr('data-url');

          var label_name = 'data[Menu]['+section_id+']['+group_id+']['+order+'][label]';
          var url_name = 'data[Menu]['+section_id+']['+group_id+']['+order+'][url]';

          var formdata_label = $('<input>')
                .val(label)
                .attr('name', label_name)
                .attr('type', 'hidden');

          var formdata_url = $('<input>')
                .val(url)
                .attr('name', url_name)
                .attr('type', 'hidden');

          $('#menu-formdata-area').append(formdata_label).append(formdata_url);
 
        }

      }

    }
 
  }

  $('#btn-save').bind('click', function(e){
    e.preventDefault();
    create_formvalues();
    $('#menu-form').submit();
  });

});
