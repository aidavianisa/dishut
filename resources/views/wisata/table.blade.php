@extends('layouts.app_adminlte')

@section('title', 'Data Table Wana Wisata')

@section('content')

<?php 
// dd($data);
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Wana Wisata
        <small>it all starts here</small>
      </h1>
      <br>
      <button type="button" class="btn btn-primary btn-s" onclick="location.href='{{url('/wisata/create')}}'">Tambah</button>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Wana Wisata</h3>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($wisata as $key)
                    <tr>
                      <td>{{ $key->wisata }}</td>
                      <td>{{ $key->kabupaten->kabupaten }}</td>
                      <td>
                        <form action="/wisata/{{$key->id}}" method="post">
                          <a class="btn btn-round btn-info btn-xs" href="/wisata/{{$key->id}}/edit">Edit</a>
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
                {!! $wisata->render() !!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
@endsection
