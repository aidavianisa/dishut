@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Luas Hutan Lindung
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
            <form action="/hutan_lindung/{{$luas_hutans->id}}" method="post" class="form-horizontal">
              <div class="box-body">
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
                    <input type="year" class="form-control" placeholder="Tahun" name="tanggal" value="{{ $luas_hutans->tanggal }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Luas</label>
                  <div class="col-sm-10">
                    <input type="number" step="any" class="form-control" placeholder="Masukkan Luas" name="luas" value="{{ $luas_hutans->luas }}">
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
