@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Objek Wisata Alam
        <small>it all starts here</small>
      </h1>

    </section>
  <!-- Main content -->
    <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
              <h3 class="box-title">Edit Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/owa/{{$owas->id}}" method="post" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Lokasi</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="lokasiowa_id" data-parsley-required="true">
                    @foreach ($lokasi_owas as $item) 
                      <option name="lokasiowa_id" value="{{ $item->id }}">{{ $item->lokasi_owa }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" value="{{ $owas->tanggal }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Pengunjung</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Masukkan Pengunjung" name="pengunjung" value="{{ $owas->pengunjung }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah Penerimaan</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Penerimaan" name="jumlah_penerimaan" value="{{ $owas->jumlah_penerimaan }}">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
    </section>
  <!-- /.content -->


@endsection
