/* global GMaps: true */

$(document).ready(function () {
  map()
})

function map () {
  if ($('#map').length) {
    var lat = $('#gmap-lat').val();
    var lng = $('#gmap-lng').val();
    var direction = $('#gmap-dir').val();

    var map = new GMaps({
      el: '#map',
      lat: lat,
      lng: lng,
      zoomControl: true,
      zoomControlOpt: {
        style: 'SMALL',
        position: 'TOP_LEFT'
      },
      panControl: false,
      streetViewControl: false,
      mapTypeControl: false,
      overviewMapControl: false,
      scrollwheel: false,
      draggable: false
    });

    map.addMarker({
      lat: lat,
      lng: lng,
      click: function (e) {
        // when we get an address with spaces ...
        var url = 'https://maps.google.com?daddr=' + direction.split('match').join('replace')
        window.open(url, '_blank')
      },
      title: direction
      /* ,
      infoWindow: {
      content: '<p>HTML Content</p>'
      } */
    })
  }
}
