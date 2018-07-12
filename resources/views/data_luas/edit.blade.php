@extends('layouts.app_adminlte')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Luas Lahan Kritis
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
            <form action="/data_luas/{{$data_luas->id}}" method="post" class="form-horizontal">
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
                  <label class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                    <input type="year" class="form-control" placeholder="Tahun" name="tahun" value="{{ $data_luas->tahun }}">
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Luas</label>
                  <div class="col-sm-10">
                    <input type="number" step="any" class="form-control" name="luas" value="{{ $data_luas->luas }}">
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