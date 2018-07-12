@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Luas Hutan
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
            <form class="form-horizontal" action="/luas_hutan" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Hutan</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jenis_hutan_id" data-parsley-required="true">
                    @foreach ($jenis_hutans as $item) 
                      <option name="jenis_hutan_id" value="{{ $item->id }}">{{ $item->jenis_hutan }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kabupaten</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="kabupaten_id" data-parsley-required="true">
                    @foreach ($kabupatens as $item) 
                      <option name="kabupaten_id" value="{{ $item->id }}">{{ $item->kabupaten }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="year" class="form-control" placeholder="Tahun" name="tanggal" value="{{ old('tanggal') }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Luas</label>
                  <div class="col-sm-10">
                    <input type="number" step="any" class="form-control" placeholder="Masukkan Luas" name="luas" value="{{ old('luas') }}">
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
