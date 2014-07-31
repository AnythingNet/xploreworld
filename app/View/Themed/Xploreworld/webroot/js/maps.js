if (!mapStyle) {
  var mapStyle = null;
}

var Xplore = {
  map: null,
  //markers: markerObj,
  markers: [],
  datePickerOption : {
    dateFormat: 'dd/mm/yy'
  },
  mapStyler: mapStyle,
  infoWindows: []
}

var init = function() {

  var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(13.30, 144.48),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    maxZoom: 5,
    minZoom: 2,
    styles: Xplore.mapStyler
  }

  Xplore.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  google.maps.event.addListener(Xplore.map, 'click', function(){
    
    for (var i in Xplore.infoWindows) {
      Xplore.infoWindows[i].close();
    }

  });

  renderMarkers();

}

var Marker = function(id, cordinates, content) {

  var options = {
    position: new google.maps.LatLng(cordinates.lat, cordinates.lng),
    map: Xplore.map
  };

  var marker = new google.maps.Marker(options);
  var infoWindow = new google.maps.InfoWindow();

  infoWindow.id = id;

  Xplore.infoWindows.push(infoWindow);

  google.maps.event.addListener(marker, 'click', function(){
    infoWindow.setContent(content);
    infoWindow.open(Xplore.map, marker); 
    addToList(infoWindow.id);
  });

  return marker;

}

var addToList = function(id) {

  var data = markerObj[id];

  var selected_list = $('#selected-list');

  var id = 'list-item-'+data.airport_code;

  var removeAction = function(e) {

    e.preventDefault(); 

    var id = '#' + $(this).attr('data-list-item');

    $(id).remove();
    
  };

  var label = $('<div>').addClass('list-label').text(
    data.airport_code + ', ' +
    data.name + ', ' +
    data.city + ', ' +
    data.country
  );

  var inputs = $('<div>').addClass('date-inputs')
  //.append($('<input>').addClass('departure-date datepicker').attr('type', 'text').attr('placeholder', 'departure date').datepicker(Xplore.datePickerOption))
  //.append($('<input>').addClass('arrival-date datepicker').attr('type', 'text').attr('placeholder', 'arrival date').datepicker(Xplore.datePickerOption))
  .append($('<a>').addClass('remove').attr('href', '#').attr('data-list-item', id).text('remove').on('click', removeAction));

  var list = $('<li>').attr('id', id).addClass('selected-item').append(label).append(inputs);

  selected_list.append(list);
  
}

var createInfoWindowContent = function(data) {

  var ul = $('<ul>').addClass('infowindow');
  var airport_code = $('<li>')
          .append($('<span>').addClass('infolabel').text('Code'))
          .append($('<span>').addClass('infoitem').text(data.airport_code));
  var airport_name = $('<li>')
          .append($('<span>').addClass('infolabel').text('Airport Name'))
          .append($('<span>').addClass('infoitem').text(data.name));
  var city_name = $('<li>')
          .append($('<span>').addClass('infolabel').text('City'))
          .append($('<span>').addClass('infoitem').text(data.city));
  var country_name = $('<li>')
          .append($('<span>').addClass('infolabel').text('Country'))
          .append($('<span>').addClass('infoitem').text(data.country));

  ul.append(airport_code)
    .append(airport_name)
    .append(city_name)
    .append(country_name);

  return $('<div>').append(ul).html();

}

var renderMarkers = function() {

  for (var i in markerObj) {
    
    content = createInfoWindowContent(markerObj[i]);
    var marker = new Marker(i, {lat: markerObj[i].latitude, lng: markerObj[i].longitude}, content);
    Xplore.markers.push(marker); 
  
  }

}

//append selected labels as hidden for #user-form
var mapDone = function() {

  var selected_items = $('.selected-item');

  if (selected_items.length == 0) {

    var message = $('<p>').addClass('alert alert-danger').text('select at least one location');
    $('#mapdone').before(message);

  } else {
    
    $('.collapse').collapse('toggle');

    selected_items.each(function(i, item){

      var label = $(item).children('.list-label').text();

      var hidden = $('.hidden-dummy').clone();

      var unique_name = hidden.attr('name');
      var name = hidden.attr('name', unique_name);

      hidden.removeClass('hidden-dummy').addClass('items');
      hidden.val(label);
      hidden.appendTo($('#user-form'));

    });

  }
  
}

var formDone = function(e) {

  e.preventDefault();

  var params = {
    seat: $('.seats:checked').val(),
    first_name: $('#first_name').val(),
    last_name: $('#last_name').val(),
    email: $('#email').val(),
    phone: $('#phone').val(),
    comment: $('#comment').val()
  }

  console.log($('.items').val());

  var items = $('.items');

  for (var i = 0; i < items.length; i++) {
    params.items.push($(items[i]).val());
  }

  var options = {
    type: 'post', 
    url: addUrl, 
    data: params,
    dataType: 'json', 
    success: function(data) {

      if (data.status == 'success') {

        $('#success-modal .modal-body').text(data.message);
        $('#success-modal').modal('show');

      }
      if (data.status == 'error') {

        var message = $('<p>').addClass('alert alert-danger').text(data.message);
        $('#mapDone').before(message);

      } else if (data.status == 'forminvalid') {

        for (var i in data.fields) {

          var message = $('<label>').addClass('control-label').text(data.fields[i].message);
          $('#' + data.fields[i].id).parent('.form-group').addClass('has-error');
          $('#' + data.fields[i].id).before(message);

        }

      }

    }
  }

  //$.ajax(options);
  
}

var formBack = function() {
  console.log('bbb');
  $('.collapse').collapse('toggle');
}

var fadeOutAlerts = function(e) {

  var element = $(e.target);

  if (element.hasClass('alert')) {

    window.setTimeout(function(){
      element.fadeOut();
    }, 3000);    

  }

}

var redirectToHome = function() {
  window.location.href = homeUrl;
}

$(function() {

  google.maps.event.addDomListener(window, 'load', init);

  //$('departure-date').datepicker();
  //$('arrival-date').datepicker();

  $('#mapdone').on('click', mapDone);
  $('#formdone').on('click', formDone);

  $('#formback').on('click', formBack);

  $('body').on('DOMNodeInserted', fadeOutAlerts);

  $('#success-modal').on('hidden.bs.modal', redirectToHome);

});
