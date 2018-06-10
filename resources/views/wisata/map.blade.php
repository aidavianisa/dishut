@extends('layouts.app_adminlte')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Wana Wisata
        <small>it all starts here</small>
      </h1>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lokasi Wana Wisata</h3>

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
            <!-- /.box-footer -->
            </div>
            <!-- /.box-body -->
          </div>
    </section>
  <!-- /.content -->
@endsection
