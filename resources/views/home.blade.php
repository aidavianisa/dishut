@extends('layouts.app_adminlte')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>it all starts here</small>
      </h1>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lokasi Pengurus Objek Wisata Alam</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div style="width: auto; height: 500px;">
                {!! Mapper::render() !!}
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-4 col-xs-4">
                    <div class="description-block border-right">
                      <img src="{{ asset('images/marker_hijau.png') }}">
                      <span class="info-box-text">Pemasukan terendah</span>
                      <?php foreach ($data as $key) {?>
                        <span>Rp <?= number_format((double)$key['penerimaan_rendah'], 0, ',', '.') ?>,-</span>
                      <?php } ?>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-xs-4">
                    <div class="description-block border-right">
                      <img src="{{ asset('images/marker_kuning.png') }}">
                      <span class="info-box-text">Antara tertinggi dan terendah</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-xs-4">
                    <div class="description-block border-right">
                      <img src="{{ asset('images/marker_merah.png') }}">
                      <span class="info-box-text">Pemasukan Tertinggi</span>
                      <?php foreach ($data as $key) {?>
                        <span>Rp <?= number_format((double)$key['penerimaan_tinggi'], 0, ',', '.') ?>,-</span>
                      <?php } ?>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
            </div>
            <!-- /.box-body -->
          </div>
    </section>
  <!-- /.content -->
@endsection
