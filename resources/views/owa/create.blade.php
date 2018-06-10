@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Objek Wisata Alam
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
            <form class="form-horizontal" action="/owa" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Lokasi</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="lokasiowa_id" data-parsley-required="true" required>
                    @foreach ($lokasi_owas as $item) 
                      <option name="lokasiowa_id" value="{{ $item->id }}">{{ $item->lokasi_owa }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bulan</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="bulan" required>
                      <option value=''>Pilih Bulan</option>
                      <option value='01'>Januari</option>
                      <option value='02'>Februari</option>
                      <option value='03'>Maret</option>
                      <option value='04'>April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="tahun" required>
                      <option value=''>Pilih Tahun</option>
                      <option value='2012'>2012</option>
                      <option value='2013'>2013</option>
                      <option value='2014'>2014</option>
                      <option value='2015'>2015</option>
                      <option value="2016">2016</option>
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                    </select>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" value="{{ old('tanggal') }}">
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Pengunjung</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Masukkan Pengunjung" name="pengunjung" value="{{ old('pengunjung') }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah Penerimaan</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Penerimaan" name="jumlah_penerimaan" value="{{ old('jumlah_penerimaan') }}" required>
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
