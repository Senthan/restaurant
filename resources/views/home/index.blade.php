@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
        <div id="map2" style="height: 400px;"></div>
          <div id="floating-panel"  style="height: 400px;margin-top: 20px;">
            <b>Select of Travel Restaurant: </b>
            <select id="restaurant">
            <option value="null">Select Restaurant</option>
            @foreach($restaurants as $restaurant)
              <option value="{{ $restaurant }}">{{ $restaurant->name }}</option>
            @endforeach 
            </select>
            
             <div id="map" style="height: 400px"></div>
          </div>
        </div>
    </div>

   
@stop
@section('script')
    <script>
        
        var locations = {!! $restaurants !!};
          function initMap() {
            var map = new google.maps.Map(document.getElementById('map2'), {
              zoom: 10,
              center: new google.maps.LatLng(1.28, 103.8),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
                map: map
              });
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i]['name']);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 10,
              center: new google.maps.LatLng(1.28, 103.8),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var directionsDisplay = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;

            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                directionsDisplay.setMap(map);


                calculateAndDisplayRoute(directionsService, directionsDisplay, latitude , longitude);

                document.getElementById('restaurant').addEventListener('change', function() {
                  calculateAndDisplayRoute(directionsService, directionsDisplay,latitude , longitude);
                });


                  },

                  function () {

                  }
               );

          }

          function calculateAndDisplayRoute(directionsService, directionsDisplay,latitude , longitude) {
            var restaurant = document.getElementById('restaurant').value;
            if(restaurant == 'null') {
                restaurant.latitude = locations[0]['latitude'];
                restaurant.longitude = locations[0]['longitude'];
            }
            var selectedMode = 'DRIVING';
            directionsService.route({
              origin: {lat: latitude, lng: longitude},  
              destination: {lat: parseFloat(restaurant.latitude), lng: parseFloat(restaurant.longitude)}, 

              travelMode: google.maps.TravelMode[selectedMode]
            }, function(response, status) {
              if (status == 'OK') {
                directionsDisplay.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
          }


    </script>
@endsection
