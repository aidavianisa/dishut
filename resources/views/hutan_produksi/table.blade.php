@extends('layouts.app_adminlte')

@section('title', 'Hutan Produksi')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hutan Produksi
        <small>it all starts here</small>
      </h1>
      <br>
      <button type="button" class="btn btn-primary btn-s" onclick="location.href='{{url('/hutan_produksi/create')}}'">Tambah</button>
      <a href="{{ route('hutan_produksi.excel') }}" class="btn btn-success btn-s">Export ke Excel</a>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Luas Hutan Produksi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <!-- {{ Form::open(array('url' => '/owa', 'method' => 'get')) }}
                    <?php 
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggal = date('Y');
                    echo Form::selectRange('tahun', 2012, 2025, $tanggal); ?>
                {{ Form::close() }} -->
              <div id="container" style="min-width: auto; height: auto; margin: 0 auto"></div>
            </div>
            <!-- /.box-body -->
          </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Luas Hutan Produksi</h3>
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
                        <form action="/hutan_produksi/{{$luas_hutan->id}}" method="post">
                          <a class="btn btn-round btn-info btn-xs" href="/hutan_produksi/{{$luas_hutan->id}}/edit">Edit</a>
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

  <script type="text/javascript">
    let tahun;
    tahun = "<?php echo json_encode($jarak_tahun) ?>";
    tahun = JSON.parse(tahun);
   
    let list;
    list = '<?php echo json_encode($list) ?>'
    list = JSON.parse(list);
   
    Highcharts.chart('container', {
              title: {
                text: 'Data Luas Hutan Produksi'
              },
              chart: {
                  type: 'area'
              },
              xAxis : {
                  // categories: [
                  //   'Jan','Feb','Mar','Apr','Mei','Juni','Juli','Ags','Sep','Okt','Nov','Des'
                  // ]
                  categories: tahun
              },
              yAxis: {
                title: {
                  text: 'Jumlah Kasus'
                }
              },

              series: getDataHutanTahun(list, tahun),

              responsive: {
                  rules: [{
                      condition: {
                          maxWidth: 500
                      },
                      chartOptions: {
                          legend: {
                              align: 'center',
                              verticalAlign: 'bottom',
                              layout: 'horizontal'
                          },
                          yAxis: {
                              labels: {
                                  align: 'left',
                                  x: 0,
                                  y: -5
                              },
                              title: {
                                  text: null
                              }
                          },
                          subtitle: {
                              text: null
                          },
                          credits: {
                              enabled: false
                          }
                      }
                  }]
              }


            });
    function getDataHutanTahun(list, tahun){
      datas = [];
      for(let i = 0; i < list.length; i++){
        data = {};
        data['name'] = list[i]['jenis_hutan'];
        data['data'] = [];
        k = 0;
        for(let j = 0; j < tahun.length; j++){
          try{
            tahun_obj = list[i]['data_luas'][k]['tanggal'];            
          }
          catch(err){
            tahun_obj = 0;
          }
          if(tahun_obj != tahun[j]){
            data['data'].push(0);
          }
          else{
            data['data'].push( list[i]['data_luas'][k]['luass']);
            k++;
          }
        }
        datas.push(data);

      }
      return datas;
    }
  </script>
@endsection
