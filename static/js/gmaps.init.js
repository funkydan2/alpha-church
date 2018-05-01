/* global GMaps: true */

$(document).ready(function() {
  if ($('#map').length) {
    initMap();
  }
});

function initMap() {
  if ($('#map').length){
    var myloc = { lat: Number($("#gmap-lat").val()), lng: Number($("#gmap-lng").val()) };
    console.log(myloc);
    var map = new google.maps.Map(document.getElementById("map"), {
      zoom: Number($("#gmap-zoom").val()),
      center: myloc
    });
    var marker = new google.maps.Marker({ position: myloc, map: map });
  }
}
