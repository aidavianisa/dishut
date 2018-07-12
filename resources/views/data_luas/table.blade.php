@extends('layouts.app_adminlte')

@section('title', 'Data Table Luas')

@section('content')

<?php 
// dd($data);
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Luas Lahan Kritis
        <small>it all starts here</small>
      </h1>
      <br>

      <a href="{{ action('DataLuasController@create') }}"class="btn btn-primary btn-s"> Tambah</a>
      <a href="{{ route('data_luas.excel') }}" class="btn btn-success btn-s">Export ke Excel</a>

      
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Data Luas Lahan Kritis</h3>
              <div class="box-tools">
                
                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive padding">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Lokasi</th>
                    <th>Tahun</th>
                    <th>Luas Lahan Kritis</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_luas as $key)
                    <tr>
                      <td>{{ $key->lokasi->lokasi_owa }}</td>
                      <td>{{ $key->tahun }}</td>
                      <td>{{ $key->luas }}</td>
                      <td>
                        <form action="/data_luas/{{$key->id}}" method="post">
                          <a class="btn btn-round btn-info btn-xs" href="/data_luas/{{$key->id}}/edit">Edit</a>
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
                {!! $data_luas->render() !!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
@endsection