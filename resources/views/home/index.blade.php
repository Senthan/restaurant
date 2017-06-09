@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
                <div id="map"></div>
                <div id="right-panel">
                <div>
                <b>Select of Travel Restaurant: </b>
              <select id="restaurant">
              <option value="null">Select Restaurant</option>
              @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant }}">{{ $restaurant->name }}</option>
              @endforeach 
              </select>
                <br>
                <input type="submit" id="submit">
                </div>
                <div id="directions-panel"></div>
                </div>
        </div>
    </div>

@stop
@section('script')
    <script>
       function initMap() {
   
      
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }
    
    var addressCurrent = '';
     navigator.geolocation.getCurrentPosition(function (position) {
            var latitudeCurrent = position.coords.latitude;
            var longitudeCurrent = position.coords.longitude;
        var addressCurrent = codeLatLng(latitudeCurrent, longitudeCurrent);
    });
        
        
      
  function codeLatLng(lat, lng) {
    var geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if(status == google.maps.GeocoderStatus.OK) {
        if(results[1]) {
          //formatted address
          return addressCurrent = results[0].formatted_address;
        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      } 
      
      return;
    });
  }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
            waypts.push({
              location: '37 Yishun Central 1, Singapore',
              stopover: true
            });
    
    var restaurant = document.getElementById('restaurant').value;
    var addressEnd = codeLatLng(parseFloat(restaurant.latitude), parseFloat(restaurant.longitude));
    // addressEnd = 'Blk 203, Singapore';
        directionsService.route({
          origin: addressCurrent,
          destination: addressEnd,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>

@endsection
