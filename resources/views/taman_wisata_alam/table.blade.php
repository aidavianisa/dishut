@extends('layouts.app_adminlte')

@section('title', 'Taman Wisata Alam')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Taman Wisata Alam
        <small>it all starts here</small>
      </h1>
      <br>
      <button type="button" class="btn btn-primary btn-s" onclick="location.href='{{url('/taman_wisata_alam/create')}}'">Tambah</button>
      <a href="{{ route('taman_wisata_alam.excel') }}" class="btn btn-success btn-s">Export ke Excel</a>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Luas Taman Wisata Alam</h3>
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
                    <!-- <th>Jenis Hutan</th> -->
                    <th>Kabupaten</th>
                    <th>Tahun</th>
                    <th>Luas</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($luas_hutans as $luas_hutan)
                    <tr>
                      <!-- <td>{{ $luas_hutan->jenis_hutan->jenis_hutan }}</td> -->
                      <td>{{ $luas_hutan->kabupaten->kabupaten }}</td>
                      <td>{{ $luas_hutan->tanggal }}</td>
                      <td>{{ $luas_hutan->luas }}</td>
                      <td>
                        <form action="/taman_wisata_alam/{{$luas_hutan->id}}" method="post">
                          <a class="btn btn-round btn-info btn-xs" href="/taman_wisata_alam/{{$luas_hutan->id}}/edit">Edit</a>
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
                {!! $luas_hutans->render() !!}
              </div>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  <!-- /.content -->
@endsection
