@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Luas Lahan Kritis
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
            <form class="form-horizontal" action="/data_luas" method="post">
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
                <div class="form-group">
                  <label class="col-sm-2 control-label">Luas</label>
                  <div class="col-sm-10">
                    <input type="number" step="any" class="form-control" placeholder="Masukkan Luas" name="luas" value="{{ old('luas') }}" required>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label">ID Data</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="jenis_data_id" value="1" required>
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
