@extends('layouts.app_adminlte')

@section('title', 'Data Table Pengunjung OWA')

@section('content')

<?php 
// dd($data);
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengunjung dan Penerimaan Objek Wisata Alam
        <small>it all starts here</small>
      </h1>
      <br>

      <button type="button" class="btn btn-primary btn-s" onclick="location.href='{{url('/owa/create')}}'">Tambah</button>
      <a href="{{ route('owa.excel') }}" class="btn btn-success btn-s">Export ke Excel</a>

      <div class="pull-right" style="display: inline-block;">
      <form method="PUT" action="/owa/" accept-charset="utf-8">
        <div style="display: inline-block;">
        <select class="form-control" name="months" onchange="this.form.submit()">
          <option disabled>Pilih Bulan</option>
          <option value=''>Semua Bulan</option>
          <option value='1' <?php if ((isset($_GET['months'])) && ($_GET['months'] == 1)) echo "selected"; ?>>Januari</option>
          <option value='2' <?php if ((isset($_GET['months'])) && ($_GET['months'] == 2)) echo "selected"; ?>>Februari</option>
          <option value='3' <?php if ((isset($_GET['months'])) && ($_GET['months'] == 3)) echo "selected"; ?>>Maret</option>
          <option value='4' <?php if ((isset($_GET['months'])) && ($_GET['months'] == 4)) echo "selected"; ?>>April</option>
          <option value="5" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 5)) echo "selected"; ?>>Mei</option>
          <option value="6" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 6)) echo "selected"; ?>>Juni</option>
          <option value="7" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 7)) echo "selected"; ?>>Juli</option>
          <option value="8" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 8)) echo "selected"; ?>>Agustus</option>
          <option value="9" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 9)) echo "selected"; ?>>September</option>
          <option value="10" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 10)) echo "selected"; ?>>Oktober</option>
          <option value="11" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 11)) echo "selected"; ?>>November</option>
          <option value="12" <?php if ((isset($_GET['months'])) && ($_GET['months'] == 12)) echo "selected"; ?>>Desember</option>
        </select>
        </div>
        <div style="display: inline-block;">
        <select class="form-control" name="years" onchange="this.form.submit()">
          <option disabled>Pilih Tahun</option>
          <option value=''>Semua Tahun</option>
          <option value='2012' <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2012)) echo "selected"; ?>>2012</option>
          <option value='2013' <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2013)) echo "selected"; ?>>2013</option>
          <option value='2014' <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2014)) echo "selected"; ?>>2014</option>
          <option value='2015' <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2015)) echo "selected"; ?>>2015</option>
          <option value="2016" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2016)) echo "selected"; ?>>2016</option>
          <option value="2017" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2017)) echo "selected"; ?>>2017</option>
          <option value="2018" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2018)) echo "selected"; ?>>2018</option>
          <option value="2019" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2019)) echo "selected"; ?>>2019</option>
          <option value="2020" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2020)) echo "selected"; ?>>2020</option>
          <option value="2021" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2021)) echo "selected"; ?>>2021</option>
          <option value="2022" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2022)) echo "selected"; ?>>2022</option>
          <option value="2023" <?php if ((isset($_GET['years'])) && ($_GET['years'] == 2023)) echo "selected"; ?>>2023</option>
        </select>
        </div>
        <div style="display: inline-block;">
        <select class="form-control" name="lokasiowa_id" onchange="this.form.submit()">
          <option disabled>Pilih Lokasi</option>
          <option value=''>Semua Lokasi</option>
          @foreach ($lokasi_owas as $item) 
            <option value="{{ $item->id }}" <?php if ((isset($_GET['lokasiowa_id'])) && ($_GET['lokasiowa_id'] == $item->id)) echo "selected"; ?>>{{ $item->lokasi_owa }}</option>
          @endforeach
        </select>
        </div> 
      </form>
      </div>
      
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Data Objek Wisata Alam</h3>
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
                    <!-- <th>Tanggal</th> -->
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Pengunjung</th>
                    <th>Penerimaan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($owa as $key)
                    <tr>
                      <td>{{ $key->lokasi->lokasi_owa }}</td>
                      <!-- <td>{{ $key->tanggal }}</td> -->
                      <td>{{ $key->bulan }}</td>
                      <td>{{ $key->tahun }}</td>
                      <td>{{ $key->pengunjung }}</td>
                      <td>{{ $key->jumlah_penerimaan }}</td>
                      <td>
                        <form action="/owa/{{$key->id}}" method="post">
                          <a class="btn btn-round btn-info btn-xs" href="/owa/{{$key->id}}/edit">Edit</a>
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
                {!! $owa->render() !!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
@endsection
