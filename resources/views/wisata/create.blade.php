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
  <!-- /.content -->
@endsection
