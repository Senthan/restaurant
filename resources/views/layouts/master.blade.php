<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
      }
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
      #directions-panel {
        margin-top: 10px;
        background-color: #FFEE77;
        padding: 10px;
        overflow: scroll;
        height: 174px;
      }
    </style>
  </head>
  <body>
  <div id="map2" style="height: 400px;"></div>
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
            console.log(latitudeCurrent, longitudeCurrent);
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
         //addressCurrent = 'Blk 203, Singapore';
         addressEnd = 'Blk 203, Singapore';
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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM8LtJcXEjCABtsGyigU0dCN4agXmvmag&callback=initMap">
    </script>
  </body>
</html>
