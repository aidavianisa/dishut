@extends('layouts.app_adminlte')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lihat Lokasi Wisata
        <small>it all starts here</small>
      </h1>
      <br>
      <div style="display: inline-block;">
          <select class="form-control" id="mode">
          <option value="DRIVING">Driving</option>
          <option value="WALKING">Walking</option>
          <option value="BICYCLING">Bicycling</option>
          <option value="TRANSIT">Transit</option>
          </select>
      </div>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lihat Lokasi <?= $wisata->wisata ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

              <div style="width: 100%;">
                <div style="width: 100%; height: 500px;" id="map"></div>
              </div>
              <div class="box-footer">
                <!-- <p>Kabupaten :</p>
                <?php foreach ($kabupaten as $key) { ?>
                  <b><?= $key->kabupaten ?></b>
                <?php } ?> -->
                
              </div>
            <!-- /.box-body -->
          </div>
    </section>
  <!-- /.content -->

  <script>

      function initMap() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          x.innerHTML = "Geolocation is not supported by this browser.";
        }
      }

      function showPosition(position) {
          var directionsDisplay = new google.maps.DirectionsRenderer;
          var directionsService = new google.maps.DirectionsService;

          infoWindow = new google.maps.InfoWindow;
          
          var myCenter = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
          
          var lat_a = position.coords.latitude;
          var long_a = position.coords.longitude;

          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: {lat: position.coords.latitude, lng: position.coords.longitude}
          });
          directionsDisplay.setMap(map);

          calculateAndDisplayRoute(directionsService, directionsDisplay, lat_a, long_a);
          document.getElementById('mode').addEventListener('change', function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay, lat_a, long_a);
          });
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay, lat_a, long_a) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: {lat: lat_a, lng: long_a},
          destination: {lat: <?= $wisata->latitude ?>, lng: <?= $wisata->longitude ?> },
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
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
