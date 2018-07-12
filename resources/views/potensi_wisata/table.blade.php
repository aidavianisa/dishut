@extends('layouts.app_adminlte')

@section('title', 'Data Table Potensi Wisata')

@section('content')

<?php 
// dd($data);
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Potensi Wisata
        <small>it all starts here</small>
      </h1>
      <br>
      <button type="button" class="btn btn-primary btn-s" onclick="location.href='{{url('/potensi_wisata/create')}}'">Tambah</button>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Potensi Wisata</h3>
              <!-- <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive padding">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Wana Wisata</th>
                    <th>Kabupaten</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($potensi_wisata as $key)
                    <tr>
                      <td>{{ $key->wisata }}</td>
                      <td>{{ $key->kabupaten->kabupaten }}</td>
                      <td>{{ $key->keterangan }}</td>
                      <td>
                        <form action="/potensi_wisata/{{$key->id}}" method="post">
                          <!-- <button type="button" class="btn btn-default btn-round btn-xs" data-toggle="modal" data-target="#myModal" data-lat='{{ $key->latitude }}' data-lng='{{ $key->longitude }}' data-wisata='{{ $key->wisata }}' data-keterangan='{{ $key->keterangan }}'>
                            Lihat
                          </button> -->
                          <a class="btn btn-round btn-default btn-xs" href="/potensi_wisata/{{$key->id}}/lihat">Lihat</a>
                          <a class="btn btn-round btn-info btn-xs" href="/potensi_wisata/{{$key->id}}/edit">Edit</a>
                          <input class="btn btn-round btn-danger btn-xs" type="submit" name="submit" value="Hapus">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="Delete">
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination">
                {!! $potensi_wisata->render() !!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lihat Posisi</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 modal_body_content">
                    <b><p id="wisata"></p></b>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 modal_body_map">
                    <select id="mode1">
                      <option value="DRIVING">Driving</option>
                      <option value="WALKING">Walking</option>
                      <option value="BICYCLING">Bicycling</option>
                      <option value="TRANSIT">Transit</option>
                    </select>
                    <div class="location-map" id="location-map">
                      <div style="width: 600px; height: 400px;" id="map_canvas"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 modal_body_end">
                    <p id="keterangan"></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
    </section>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//maps.googleapis.com/maps/api/js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q6libraries=places" type="text/javascript"></script> -->



    <!-- <script>
      $(document).ready(function() {
        var map = null;
        var wisata;
        var keterangan;
        var myMarker;
        var myLatlng;

        function initializeGMap(lat, lng, wisata, keterangan) {
          myLatlng = new google.maps.LatLng(lat, lng);

          var myOptions = {
            zoom: 12,
            zoomControl: true,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };

          map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
          wisata = document.getElementById("wisata").innerHTML = wisata;
          keterangan = document.getElementById("keterangan").innerHTML = keterangan;

          myMarker = new google.maps.Marker({
            position: myLatlng
          });
          myMarker.setMap(map);
        }

        // Re-init map before show modal
        $('#myModal').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget);
          initializeGMap(button.data('lat'), button.data('lng'), button.data('wisata'), button.data('keterangan'));
          $("#location-map").css("width", "100%");
          $("#map_canvas").css("width", "100%");
        });

        // Trigger map resize event after modal shown
        $('#myModal').on('shown.bs.modal', function() {
          google.maps.event.trigger(map, "resize");
          map.setCenter(myLatlng);
        });
      });
    </script> -->
    
@endsection