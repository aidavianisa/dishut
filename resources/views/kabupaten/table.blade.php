@extends('layouts.app_adminlte')

@section('title', 'Tabel Lokasi')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kabupaten
        <small>it all starts here</small>
      </h1>
      <br>
      <button type="button" class="btn btn-primary btn-s" onclick="location.href='{{url('/kabupaten/create')}}'">Tambah</button>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Kabupaten</h3>
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
                    <th>Kabupaten</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($kabupatens as $kabupaten)
                    <tr>
                      <td>{{ $kabupaten->kabupaten }}</td>
                      <td>
                        <form action="/kabupaten/{{$kabupaten->id}}" method="post">
                          <a class="btn btn-round btn-info btn-xs" href="/kabupaten/{{$kabupaten->id}}/edit">Edit</a>
                          <input class="btn btn-round btn-danger btn-xs" type="submit" name="submit" value="Hapus">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="Delete">
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  <!-- /.content -->
@endsection
