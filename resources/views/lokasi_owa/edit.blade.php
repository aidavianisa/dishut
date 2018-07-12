@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Lokasi Balai Pengelola
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
            <form action="/lokasi_owa/{{$lokasi_owa->id}}" method="post" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Lokasi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Lokasi" name="lokasi_owa" value="{{ $lokasi_owa->lokasi_owa }}">
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
