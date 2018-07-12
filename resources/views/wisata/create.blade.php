@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Wana Wisata
        <small>it all starts here</small>
      </h1>

    </section>
  <!-- Main content -->
    <section class="content">
      <div class="box box-info ">
         <div class="box-header with-border">
              <h3 class="box-title">Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/wisata" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Wisata</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Masukkan nama wisata" name="wisata" value="{{ old('wisata') }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kabupaten</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="kabupaten_id" data-parsley-required="true">
                    @foreach ($kabupaten as $item) 
                      <option name="kabupaten_id" value="{{ $item->id }}">{{ $item->kabupaten }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Lokasi</label>
                  <div class="col-sm-10">
                    <a class="btn btn-primary btn-s" onclick="getLocation()">Dapatkan Lokasi</a>
                    <p id="demo"></p>
                    <div id="map" style="width:auto;height:200px;"></div>
                  </div>
                </div> -->
                <!-- <input id="lat" class="form-control hidden" name="latitude" value="">
                <input id="long" class="form-control hidden" name="longitude" value=""> -->

                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Masukkan Keterangan" name="keterangan" value="{{ old('keterangan') }}">
                  </div>
                </div> -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
              {{ csrf_field() }}
            </form>
          </div>
    </section>

    <!-- <script>
      var x = document.getElementById("demo");
      var map;
      var lat = document.getElementById("lat");
      var long = document.getElementById("long");

      function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
              x.innerHTML = "Geolocation is not supported by this browser.";
          }
      }

      function showPosition(position) {
          x.innerHTML = "Latitude: " + position.coords.latitude + 
          "<br>Longitude: " + position.coords.longitude;
          var myCenter = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
          map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: position.coords.latitude, lng: position.coords.longitude},
              zoom: 8, mapTypeId: google.maps.MapTypeId.HYBRID
            });
          var marker = new google.maps.Marker({position:myCenter});
          marker.setMap(map);
          lat.value = position.coords.latitude;
          long.value = position.coords.longitude;
      }
    </script> -->
    <!-- <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -34.397, lng: 150.644},
              zoom: 8
            });
      }
    </script> -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA56N7R4u4rWcb6ixM7eKoF-izl2U0w65Q&callback=initMap"></script> -->
  <!-- /.content -->
@endsection
