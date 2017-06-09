<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Restaurant Direction</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>
	
    <style>
      
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
  
    <div class="ui pointing menu">
	  <a href="/" class="active item">
		Home
	  </a>
	  <a href="{{ route('restaurant.index') }}" class="item">
		Admin
	  </a>
	</div>  
    <div class="ui vertical stripe segment" id="access">
		<div class="ui middle aligned stackable container">
			<div class="ui text container">
				<h3 class="ui header centered">Restaurant Location</h3>
			</div>
		<div class="ui embed" id="map2"></div>
		</div>
	</div>
	
	<div class="ui vertical stripe segment" >
	  <div class="ui middle aligned stackable container"> 
		<div class="ui text container"> 
			<h3 class="ui header centered"> Restaurant Direction</h3>
		</div>
		<div class="ui grid">
		  <div class="ten wide column">
			<div class="ui embed" id="map" ></div>
		  </div>
		  <div class="six wide column">
			<b>Select of Travel Restaurant: </b>
			<select id="restaurant">
			<option value="null">Select Restaurant</option>
			@foreach($restaurants as $restaurant)
			  <option value="{{ $restaurant }}">{{ $restaurant->name }}</option>
			@endforeach 
			</select>
			<br>
			<input type="submit" id="submit">
			<div id="directions-panel"></div>
		  </div>
		</div>
	  </div>
	</div>
    <script>
      function initMap() {
	 
			var locations = {!! $restaurants !!};
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
//		var addressEnd = codeLatLng(parseFloat(restaurant.latitude), parseFloat(restaurant.longitude));
		 addressEnd = 'Jurong East, Singapore';
		 addressCurrent = 'Ang mo kio, Singapore';
        directionsService.route({
          origin: addressCurrent,
          destination: addressEnd,
          waypoints: [],
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
