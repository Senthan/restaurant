@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
        @foreach($restaurants as $restaurant)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{!! $restaurant->name !!}</h3>
                </div>
            </div>
            <div id="map" style="height: 400px;"></div>
        @endforeach
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function () {

        var locations = {!! $restaurants !!};
        var map;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
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




    });
    </script>
@endsection
